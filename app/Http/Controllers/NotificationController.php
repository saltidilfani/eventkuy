<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Menampilkan halaman notifikasi dan riwayat user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil riwayat pendaftaran event user
        $registrations = Registration::with(['event.category', 'event.location'])
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->get();
        
        // Ambil event yang diajukan user (jika ada)
        $submittedEvents = Event::with(['category', 'location'])
            ->where('submitted_by', $user->id)
            ->latest('created_at')
            ->get();
        
        // Hitung statistik
        $totalRegistrations = $registrations->count();
        $totalSubmittedEvents = $submittedEvents->count();
        $pendingEvents = $submittedEvents->where('status', 'pending')->count();
        $approvedEvents = $submittedEvents->where('status', 'approved')->count();
        $rejectedEvents = $submittedEvents->where('status', 'rejected')->count();
        
        return view('pages.notifications', compact(
            'registrations',
            'submittedEvents',
            'totalRegistrations',
            'totalSubmittedEvents',
            'pendingEvents',
            'approvedEvents',
            'rejectedEvents'
        ));
    }
}
