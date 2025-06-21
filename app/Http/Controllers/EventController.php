<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use App\Models\Registration;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function welcome()
    {
        $events = Event::with(['category', 'location'])
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(6)
            ->get();

        $categories = Category::withCount(['events' => function ($query) {
            $query->where('event_date', '>=', now());
        }])->get();

        return view('welcome', compact('events', 'categories'));
    }

    public function index()
    {
        $events = Event::with(['category', 'location', 'registrations'])->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with(['category', 'location'])->findOrFail($id);
        return view('events.detail_event', compact('event'));
    }

    public function showByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $events = Event::where('category_id', $categoryId)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->paginate(12);
        return view('categories.lihat_perkategori', compact('events', 'category'));
    }

    public function showRegistrationForm($id)
    {
        $event = Event::findOrFail($id);
        if (Registration::where('user_id', auth()->id())->where('event_id', $id)->exists()) {
            return redirect()->route('events.detail', $id)->with('error', 'Anda sudah terdaftar di event ini!');
        }
        return view('events.form_pendaftaran', compact('event'));
    }

    public function register(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'email' => 'required|email', 'phone' => 'nullable']);
        $registrationData = $request->only(['name', 'email', 'phone']);
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
        return view('events.konfirmasi', compact('event', 'registrationData'));
    }

    public function confirmRegistration(Request $request, $id)
    {
        $registrationData = session('registration_data');
        if (!$registrationData) {
            return redirect()->route('events.register', $id)->with('error', 'Data pendaftaran tidak ditemukan.');
        }
        Registration::create(['user_id' => auth()->id(), 'event_id' => $id, 'phone' => $registrationData['phone'] ?? null, 'status' => 'confirmed']);
        $request->session()->forget('registration_data');
        return redirect()->route('events.detail', $id)->with('success', 'Selamat! Anda berhasil terdaftar.');
    }

    // Admin methods
    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.events.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'event_date' => 'required|date', 'event_time' => 'required', 'category_id' => 'required', 'location_id' => 'required']);
        Event::create($request->all());
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.events.edit', compact('event', 'categories', 'locations'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate(['title' => 'required', 'event_date' => 'required|date', 'event_time' => 'required', 'category_id' => 'required', 'location_id' => 'required']);
        $event->update($request->all());
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}