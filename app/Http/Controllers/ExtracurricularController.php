<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::with('teacher')->get();
        return view('extracurriculars.index', compact('extracurriculars')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('extracurriculars.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:300',
            'description' => 'nullable|string',
            'schedule' => 'nullable|string|max:100',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Extracurricular::create($validated);

        return redirect()->route('extracurriculars.index')->with('success', 'Kegiatan Ekstrakurikuler berhasil ditambah');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extracurricular $extracurricular)
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('extracurriculars.edit', compact('teachers', 'extracurricular'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extracurricular $extracurricular)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:300',
            'description' => 'nullable|string',
            'schedule' => 'nullable|string|max:100',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $extracurricular->update($validated);

        return redirect()->route('extracurriculars.index')->with('success', 'Kegiatan Ekstrakurikuler berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extracurricular $extracurricular)
    {
        $extracurricular->delete();

        return redirect()->route('extracurriculars.index')->with('success', 'Kegiatan Ekstrakurikuler berhasil dihapus');
    }
}
