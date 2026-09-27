<?php

namespace App\Http\Controllers;

use App\Models\Don;
use App\Http\Requests\StoreDonRequest;
use App\Http\Requests\UpdateDonRequest;

class DonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonRequest $request)
    {
        $validated = $request->validated();
        $don = Don::create([
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
        ]);
        return redirect()->route('dons.index')->with('success', __('messages.donation_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Don $don)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Don $don)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonRequest $request, Don $don)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Don $don)
    {
        //
    }
}
