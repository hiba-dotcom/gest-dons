<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Don; // Import the Don model
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Don::with(['user', 'association'])
            ->latest()
            ->paginate(10);
        return view('admin.donations', ['donations' => $donations]);
    }

    public function show(Don $donation)
    {
        $donation->load(['user', 'association']);
        return view('admin.donation-details', ['donation' => $donation]);
    }

    public function updateStatus(Request $request, Don $donation)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed'
        ]);

        $donation->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Donation status updated successfully');
    }

    public function destroy(Don $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations')->with('success', 'Donation deleted successfully');
    }

    public function showDonationPage()
    {
        $associations = \App\Models\Association::whereHas('postulation', function ($query) {
            $query->where('statut', 'validé');
        })->get();
        
        $donations = auth()->user() ? auth()->user()->dons()->with('association')->latest()->get() : collect();
        
        return view('sections.welcome.donation', [
            'associations' => $associations,
            'donations' => $donations
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'association_id' => 'required|exists:associations,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $donation = Don::create([
            'user_id' => $request->user_id,
            'association_id' => $request->association_id,
            'amount' => $request->amount,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Donation submitted successfully');
    }
}
