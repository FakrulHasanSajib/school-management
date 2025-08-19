<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function index()
    {
        $assignedSubjects = AssignSubject::with('class', 'subject')->get();
        return response()->json($assignedSubjects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $assignedSubject = AssignSubject::create($request->all());
        return response()->json($assignedSubject, 201);
    }

    public function show(AssignSubject $assignSubject)
    {
        $assignSubject->load('class', 'subject');
        return response()->json($assignSubject);
    }

    public function update(Request $request, AssignSubject $assignSubject)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $assignSubject->update($request->all());
        return response()->json($assignSubject);
    }

    public function destroy(AssignSubject $assignSubject)
    {
        $assignSubject->delete();
        return response()->json(null, 204);
    }
}