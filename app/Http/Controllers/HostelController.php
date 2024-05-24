<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function create()
    {
        return view('hostels.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'=> 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Hostel::create($validatedData);

        return redirect()->route('hostels.index')->with('success', 'Hostel created successfully.');
    }

    public function index()
    {
        $hostels = Hostel::all();
        return view('hostel', compact('hostels'));
    }

    public function show($id)
    {
        $hostel = Hostel::findOrFail($id);
        return view('hostels.show', compact('hostel'));
    }
}
