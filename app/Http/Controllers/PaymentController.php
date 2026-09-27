<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use App\Models\User;
use App\Enums\StatutEnum;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
use PDF;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('sendZakaat');
    }

    // Add this method to match your form route
    public function processZakaat(Request $request)
    {
        return $this->processPayment($request);
    }

    public function processPayment(Request $request)
    {
        // Clean the request data first
        $this->cleanRequestData($request);


        // Dynamic validation based on payment method
        $rules = $this->getValidationRules($request->payment_method);
        $request->validate($rules);


        try {
            // Create Zakat record
            $zakat = $this->createZakatRecord($request);

            // Process payment based on method
            if ($request->payment_method === 'card') {
                $this->processCardPayment($request, $zakat);
            } else {
                $this->processVirementPayment($request, $zakat);
            }

            // Generate PDF receipt
            $pdfPath = $this->generatePdfReceipt($zakat);
            $zakat->update(['receipt_path' => $pdfPath]);

            $message = $request->payment_method === 'card'
                ? 'Zakaat envoyée avec succès ! Votre reçu est disponible ci-dessous.'
                : 'Demande de virement enregistrée ! Veuillez effectuer le virement selon les instructions. Votre reçu est disponible ci-dessous.';
            return back()->with('success', $message)
                ->with('zakat_id', $zakat->id);
        } catch (Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    private function cleanRequestData(Request $request)
    {
        // Remove irrelevant data based on payment method
        if ($request->payment_method === 'card') {
            // Remove bank details if card payment
            $request->request->remove('bank_details');
        } else {
            // Remove stripe token if virement payment
            $request->request->remove('stripeToken');
        }
    }

    private function getValidationRules($paymentMethod)
    {
        $baseRules = [
            'montant' => 'required|numeric|min:1',
            'association_name' => 'required|string|max:255',
            'email' => 'required|email',
            'payment_method' => 'required|in:card,virement',
            'purpose' => 'nullable|string|max:500',
        ];

        if ($paymentMethod === 'card') {
            $baseRules['stripeToken'] = 'required|string';
        } else {
            $baseRules['bank_details'] = 'required|array';
            $baseRules['bank_details.account_holder'] = 'required|string|max:255';
            $baseRules['bank_details.iban'] = 'required|string|max:34';
            $baseRules['bank_details.bic'] = 'required|string|max:11';
        }

        return $baseRules;
    }

    private function createZakatRecord(Request $request)
    {
        $user = Auth::user();
        if (!$user && $request->email) {
            $user = User::firstOrCreate(
                ['email' => $request->email],
                ['name' => 'Utilisateur Anonyme']
            );
        }

        // Set initial status based on payment method
        $initialStatus = $request->payment_method === 'card'
            ? StatutEnum::pending->value
            : StatutEnum::pending->value; // Changed from 'refuse' to 'pending' for virement

        $zakat = new Zakat();
        $zakat->user()->associate($user);
        $zakat->reference = 'ZAK-' . strtoupper(uniqid());
        $zakat->montant = $request->montant;
        $zakat->payment_method = $request->payment_method;
        $zakat->status = $initialStatus;
        $zakat->purpose = $request->purpose;
        $zakat->metadata = json_encode([
            'association_name' => $request->association_name,
            'email' => $request->email,
            'bank_details' => $request->payment_method === 'virement' ? $request->bank_details : null,
        ]);

        $zakat->save();
        return $zakat;
    }

    private function processCardPayment(Request $request, Zakat $zakat)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $charge = Charge::create([
            'amount' => intval($request->montant * 100),
            'currency' => 'eur',
            'description' => 'Zakaat pour ' . $request->association_name,
            'source' => $request->stripeToken,
            'receipt_email' => $request->email,
            'metadata' => [
                'zakat_reference' => $zakat->reference,
                'association' => $request->association_name,
            ]
        ]);

        $zakat->update([
            'status' => StatutEnum::valide->value,
            'metadata' => json_encode(array_merge(
                json_decode($zakat->metadata, true),
                ['stripe_charge_id' => $charge->id]
            ))
        ]);
    }

    private function processVirementPayment(Request $request, Zakat $zakat)
    {
        // For virement, keep status as pending until manual confirmation
        // You might want to send email instructions here
        $zakat->update([
            'status' => StatutEnum::pending->value, // Changed from 'refuse'
            'metadata' => json_encode(array_merge(
                json_decode($zakat->metadata, true),
                ['virement_instructions_sent' => now()->toISOString()]
            ))
        ]);

        // Optional: Send email with virement instructions
        // Mail::to($request->email)->send(new VirementInstructionsMail($zakat));
    }

    private function generatePdfReceipt(Zakat $zakat)
    {
        $metadata = json_decode($zakat->metadata, true);

        $data = [
            'zakat' => $zakat,
            'association_name' => $metadata['association_name'],
            'email' => $metadata['email'],
            'bank_details' => $metadata['bank_details'] ?? null,
            'date' => $zakat->created_at->format('d/m/Y H:i'),
        ];

        $pdf = FacadePdf::loadView('pdf.zakat-receipt', $data);
        $filename = 'zakat-receipt-' . $zakat->reference . '.pdf';
        $path = 'receipts/' . $filename;

        Storage::put($path, $pdf->output());

        return $path;
    }

    public function downloadReceipt($zakat_id)
    {
        try {
            // Find the zakat record
            $zakat = Zakat::findOrFail($zakat_id);

            // You might want to check if the user owns this record
            // if (auth()->check() && $zakat->user_id !== auth()->id()) {
            //     abort(403, 'Unauthorized access to receipt');
            // }

            // Generate receipt data
            $receiptData = [
                'zakat_id' => $zakat->id,
                'amount' => $zakat->montant,
                'association' => $zakat->association_name,
                'email' => $zakat->email,
                'date' => $zakat->created_at->format('d/m/Y'),
                'payment_method' => $zakat->payment_method,
                'purpose' => $zakat->purpose,
            ];


            // Option A: Generate PDF using a library like TCPDF or DOMPDF
            $pdf = app('dompdf.wrapper');

            $pdf->loadView('receipts.zakat', $receiptData);

            return $pdf->download("recu_zakat_{$zakat->id}.pdf");

            // Option B: Simple text receipt
            /*
        $content = $this->generateTextReceipt($receiptData);
        $filename = "recu_zakat_{$zakat->id}.txt";
        
        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
        */
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du téléchargement du reçu.');
        }
    }

    private function generateTextReceipt($data)
    {
        return "
REÇU DE ZAKAT
=============

ID Transaction: {$data['zakat_id']}
Date: {$data['date']}
Montant: {$data['amount']} €
Association: {$data['association']}
Email: {$data['email']}
Méthode de paiement: {$data['payment_method']}
Objet: {$data['purpose']}

Merci pour votre générosité.
";
    }

    public function showVirementInstructions($id)
    {
        $zakat = Zakat::findOrFail($id);
        $metadata = json_decode($zakat->metadata, true);

        return view('virement-instructions', compact('zakat', 'metadata'));
    }
}
