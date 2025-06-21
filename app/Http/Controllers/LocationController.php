<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255|unique:salti_locations,location_name',
            'address' => 'nullable|string|max:500', // Dibuat nullable agar tidak wajib diisi
        ]);
        
        Location::create($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    // Penyempurnaan: Menggunakan Route Model Binding (Location $location)
    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    // Penyempurnaan: Menggunakan Route Model Binding (Location $location)
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255|unique:salti_locations,location_name,' . $location->id,
            'address' => 'nullable|string|max:500', // Dibuat nullable agar tidak wajib diisi
        ]);
        
        $location->update($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil diupdate!');
    }

    // Penyempurnaan: Menggunakan Route Model Binding (Location $location)
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}