<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::featured()->get();
        $totalProjects = Project::count();
        $galleries = Gallery::orderBy('display_order')->limit(5)->get();
        
        return view('home', [
            'projects' => $projects,
            'totalProjects' => $totalProjects,
            'galleries' => $galleries,
        ]);
    }

    public function gallery()
    {
        $galleries = Gallery::orderBy('display_order')->get();
        
        return view('gallery', [
            'galleries' => $galleries,
        ]);
    }
}
