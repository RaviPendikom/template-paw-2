<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\News;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users            = User::count();
        $teachers           = Teacher::count();
        $extracurriculars   = Extracurricular::count();
        $news               = News::count();

        $widget = [
            'users'            => $users,
            'teachers'         => $teachers,
            'extracurriculars' => $extracurriculars,
            'news'             => $news,
        ];

        return view('home', compact('widget'));
    }
}
