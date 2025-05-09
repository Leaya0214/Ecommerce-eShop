<?php

namespace App\Http\Controllers;

use App\Models\Section;  // Import the Section model
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::paginate(10);
        return view('section.index',compact('sections'));
    }

    // Store a new section
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Create a new section record
        $section = Section::create([
            'name' => $request->name,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        // Return the newly created section as a JSON response with a 201 status
        return response()->json($section, 201);
    }

    // Update an existing section by ID
    public function update(Request $request, $id)
    {
        // Find the section by its ID, or return an error if not found
        $section = Section::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Update the section's data
        $section->update([
            'name' => $request->name,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        // Return the updated section as a JSON response
        return response()->json($section);
    }

    // Update the status of a section
    public function statusUpdate(Request $request, $id)
    {
        // Find the section by its ID
        $section = Section::findOrFail($id);

        // Validate the incoming request data (status only)
        $request->validate([
            'status' => 'required|integer',
        ]);

        // Update only the status of the section
        $section->update([
            'status' => $request->status,
        ]);

        // Return the updated section as a JSON response
        return response()->json($section);
    }
}
