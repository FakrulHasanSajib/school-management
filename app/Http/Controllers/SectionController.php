<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('class')->get();
        return response()->json($sections);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        $section = Section::create($request->all());
        return response()->json($section, 201);
    }

    public function show(Section $section)
    {
        $section->load('class');
        return response()->json($section);
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        $section->update($request->all());
        return response()->json($section);
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return response()->json(null, 204);
    }
}