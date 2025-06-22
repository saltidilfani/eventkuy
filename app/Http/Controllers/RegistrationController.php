<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pendaftaran, urutkan dari yang terbaru
        // Eager load relasi 'user' dan 'event' untuk optimasi query
        $registrations = Registration::with(['user', 'event'])
            ->latest()
            ->paginate(15);

        return view('admin.registrations.index', compact('registrations'));
    }
} 