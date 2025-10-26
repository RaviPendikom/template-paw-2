<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'employee_number' => 'required|string|max:50',
            'email' => 'nullable|email|unique|max:100',
            'position' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Guru berhasil ditambah');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'employee_number' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'position' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Guru berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete($teacher);

        return redirect()->route('teachers.index')->with('success', 'Guru berhasil dihapus');

    }
}
