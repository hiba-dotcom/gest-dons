<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DonationController;

Route::get('/donation', [DonationController::class, 'showDonationPage'])->middleware('auth')->name('donation');
