<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function welcome()
    {
        $events = Event::with(['category', 'location'])
            ->where('status', 'approved')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(6)
            ->get();

        $categories = Category::withCount(['events' => function ($query) {
            $query->where('status', 'approved')->where('event_date', '>=', now());
        }])->get();

        return view('pages.homepage', compact('events', 'categories'));
    }

    public function index(Request $request)
    {
        $query = Event::with(['category', 'location', 'registrations'])
            ->withCount('registrations')
            ->latest();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(10)->withQueryString();

        return view('admin.events.daftar_events', [
            'events' => $events,
            'search' => $request->search ?? ''
        ]);
    }

    public function show($id)
    {
        $event = Event::with(['category', 'location'])
            ->where('status', 'approved')
            ->findOrFail($id);
        return view('pages.detail_event', compact('event'));
    }

    public function showByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $events = Event::where('category_id', $categoryId)
            ->where('status', 'approved')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->paginate(12);
        return view('pages.event-perkategori', compact('events', 'category'));
    }

    public function allEvents(Request $request)
    {
        $query = Event::with(['category', 'location'])
            ->where('status', 'approved')
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(12)->withQueryString();

        return view('pages.semua_event', [
            'events' => $events,
            'search' => $request->search ?? ''
        ]);
    }

    public function showRegistrationForm($id)
    {
        $event = Event::findOrFail($id);
        if (Registration::where('user_id', auth()->id())->where('event_id', $id)->exists()) {
            return redirect()->route('pages.detail', $id)->with('error', 'Anda sudah terdaftar di event ini!');
        }
        return view('pages.pendaftaran', compact('event'));
    }

    public function register(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'institution' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        
        $registrationData = $request->only(['phone', 'institution', 'notes']);
        $request->session()->put('registration_data', $registrationData);
        
        return redirect()->route('events.register.confirm', $id);
    }

    public function showConfirmation($id)
    {
        $event = Event::findOrFail($id);
        $registrationData = session('registration_data');
        if (!$registrationData) {
            return redirect()->route('events.register', $id)->with('error', 'Data pendaftaran tidak ditemukan.');
        }
        return view('pages.konfirmasi', compact('event', 'registrationData'));
    }

    public function confirmRegistration(Request $request, $id)
    {
        $registrationData = session('registration_data');
        if (!$registrationData) {
            return redirect()->route('events.register', $id)->with('error', 'Sesi pendaftaran berakhir, silakan coba lagi.');
        }

        Registration::create([
            'user_id' => auth()->id(),
            'event_id' => $id,
            'phone' => $registrationData['phone'],
            'institution' => $registrationData['institution'],
            'notes' => $registrationData['notes'],
            'status' => 'confirmed'
        ]);

        $request->session()->forget('registration_data');
        return redirect()->route('events.detail', $id)->with('success', 'Selamat! Anda berhasil terdaftar.');
    }

    /**
     * Tampilkan form pengajuan event oleh user
     */
    public function showSubmitForm()
    {
        $categories = \App\Models\Category::all();
        $locations = \App\Models\Location::all();
        return view('pages.submit_event', compact('categories', 'locations'));
    }

    /**
     * Simpan event baru dari user (status pending)
     */
    public function storeSubmittedEvent(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'category_id' => 'required|exists:salti_categories,id',
            'location_id' => 'required|exists:salti_locations,id',
            'organizer' => 'nullable|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $validatedData['poster'] = $request->file('poster')->store('posters', 'public');
        }
        $validatedData['status'] = 'pending';
        $validatedData['submitted_by'] = auth()->id();

        \App\Models\Event::create($validatedData);
        return redirect()->route('events.submit.form')->with('success', 'Event berhasil diajukan! Menunggu persetujuan admin.');
    }

    // Admin methods
    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.events.add_events', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'category_id' => 'required|exists:salti_categories,id',
            'location_id' => 'required|exists:salti_locations,id',
            'organizer' => 'nullable|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $validatedData['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $validatedData['status'] = 'approved'; // Event admin langsung tampil

        Event::create($validatedData);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.events.edit_events', compact('event', 'categories', 'locations'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'category_id' => 'required|exists:salti_categories,id',
            'location_id' => 'required|exists:salti_locations,id',
            'organizer' => 'nullable|string|max:255',
            'max_participants' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $validatedData['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($validatedData);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy(Event $event)
    {
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Halaman admin: daftar event pending approval
     */
    public function adminPendingEvents()
    {
        $events = \App\Models\Event::with(['category', 'location'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.events.submit', compact('events'));
    }

    /**
     * Admin: Approve event
     */
    public function approveEvent($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        $event->status = 'approved';
        $event->save();
        return redirect()->back()->with('success', 'Event berhasil disetujui!');
    }

    /**
     * Admin: Reject event
     */
    public function rejectEvent($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        $event->status = 'rejected';
        $event->save();
        return redirect()->back()->with('success', 'Event berhasil ditolak.');
    }
}