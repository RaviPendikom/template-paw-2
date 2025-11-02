<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest('date')->latest('created_at')->get();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }
        $validated['author'] = Auth::user()->name ?? 'Administrator';
        
        News::create($validated);

        return redirect()->route('news.index')->with('success', 'Berita Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(news $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(news $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, news $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'Berita Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(news $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita Berhasil dihapus');

    }
}
