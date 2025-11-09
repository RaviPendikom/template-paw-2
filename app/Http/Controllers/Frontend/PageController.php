<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Extracurricular;
use App\Models\News;

class PageController extends Controller
{
    // Beranda: campuran semua
    public function home()
    {
        $school           = School::first();
        $teachers         = Teacher::orderBy('name')->take(6)->get();
        $extracurriculars = Extracurricular::with('teacher')->latest()->take(6)->get();
        $latestNews       = News::latest('date')->latest('created_at')->take(3)->get();

        return view('front.home', compact('school', 'teachers', 'extracurriculars', 'latestNews'));
    }

    // Halaman profil sekolah
    public function school()
    {
        $school = School::first();
        return view('front.school', compact('school'));
    }

    // Halaman daftar guru
    public function teachers()
    {
        $teachers = Teacher::orderBy('name')->paginate(12);
        return view('front.teachers', compact('teachers'));
    }

    // Halaman daftar ekstrakurikuler
    public function extracurriculars()
    {
        $extracurriculars = Extracurricular::with('teacher')->orderBy('name')->paginate(9);
        return view('front.extracurriculars', compact('extracurriculars'));
    }

    // Halaman daftar berita
    public function newsIndex()
    {
        $news = News::latest('date')->latest('created_at')->paginate(9);
        return view('front.news.index', compact('news'));
    }

    // Halaman detail berita
    public function newsShow(News $news)
    {
        return view('front.news.show', compact('news'));
    }
}
