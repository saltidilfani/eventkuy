<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->paginate(10);
        return view('admin.locations.daftar', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255|unique:salti_locations,location_name',
            'address' => 'nullable|string|max:500',
        ]);
        
        Location::create($validated);
        return redirect()->route('admin.locations.daftar')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.ubah', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255|unique:salti_locations,location_name,' . $location->id,
            'address' => 'nullable|string|max:500',
        ]);
        
        $location->update($validated);
        return redirect()->route('admin.locations.daftar')->with('success', 'Lokasi berhasil diupdate!');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.daftar')->with('success', 'Lokasi berhasil dihapus!');
    }
}