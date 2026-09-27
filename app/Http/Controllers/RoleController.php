<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display the role selection page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('role.selection');
    }

    /**
     * Set the user's role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function setRole(Request $request)
    {
        $role = $request->input('role');
        $motivation = $request->input('motivation');
        $experience = $request->input('experience');
        
        // Store application data in session (in a real app, this would be saved to the database)
        session([
            'user_role' => $role,
            'role_motivation' => $motivation,
            'role_experience' => $experience,
            'role_application_date' => now(),
            'role_status' => 'pending'
        ]);
        
        // Return the pending approval view
        return view('role.pending', [
            'role' => $role
        ]);
    }
    
    /**
     * Display the pending approval page.
     * 
     * @return \Illuminate\View\View
     */
    public function pending()
    {
        $role = session('user_role', 'utilisateur');
        return view('role.pending', ['role' => $role]);
    }
}
