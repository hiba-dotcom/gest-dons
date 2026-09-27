<?php

namespace App\Http\Controllers;

use App\Enums\CategorieEnum;
use App\Enums\RoleEnum;
use App\Models\Association;
use App\Models\Cours;
use App\Models\Mosquee;
use App\Models\Postulation;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getImamCourses()
    {

        $cours = Cours::where('imam', auth()->user()->id)->paginate(10);
        $categories = CategorieEnum::cases();

        return view(
            'imam/imamCours',
            [
                'cours' => $cours,
                'categories' => $categories,
            ]
        );
    }

    public function getUsers()
    {
        $users = User::all();
        return view('admin/users', ['users' => $users]);
    }

    public function changeRoleFromAdmin(Request $request)
    {
        // dd($request->all());
        $user = User::findOrFail($request->user_id);
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'vous pouvez pas changer le role d\'un administrateur');
        }

        $user->role = RoleEnum::from($request->role);
        $user->save();

        // dd($user);

        return redirect()->back()->with('success', 'role mise à jour avec succées');
    }
    public function statistique()
    {
        $mosquees = Mosquee::all();
        $zakat = Zakat::all();
        $association = Association::all();
        $users = User::all();
        $donations = \App\Models\Don::all();
        return view('admin/dashboard', [
            'mosquees' => $mosquees,
            'zakat' => $zakat,
            'association' => $association,
            'users' => $users,
            'donations' => $donations
        ]);
    }
    public function getPostulations(Request $request)
    {
        if ($request->has('statut') && $request->statut) {
            $postulations = Postulation::where('statut', $request->statut)->get()->all();
            if (!$postulations) {
                return redirect()->back()->with('error', 'il n y\'a pas des postulations avec cet statut');
            }
            return view('admin/postulations', ['postulations' => $postulations]);
        }
        $postulations = Postulation::all();
        return view('admin/postulations', ['postulations' => $postulations]);
    }

    public function getPostulationsWithStatus(Request $request)
    {

        if ($request->statut) {
            dd($request);
            $postulations = Postulation::where('statut', $request->statut);
            return view('admin/postulations', ['postulations' => $postulations]);
        }
    }


    public function updateStatus(Postulation $postulation, Request $request)
    {
        $request->validate([
            'statut' => 'required|in:pending,validé,refusé'
        ]);

        $postulation->update(['statut' => $request->statut]);

        return response()->json(['success' => true]);
    }

    public function indexDonations()
    {
        $donations = \App\Models\Don::with('user')->get(); // Fetch all donations and eager load the user relationship
        return view('admin.donations', ['donations' => $donations]); // Pass data to the view
    }
}
