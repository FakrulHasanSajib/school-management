<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
 public function index()
    {
        $classes = SchoolClass::all();
        return response()->json($classes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = SchoolClass::create(['name' => $request->name]);
        return response()->json($class, 201);
    }

    public function show(SchoolClass $class)
    {
        return response()->json($class);
    }

    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update(['name' => $request->name]);
        return response()->json($class);
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();
        return response()->json(null, 204);
    }
}