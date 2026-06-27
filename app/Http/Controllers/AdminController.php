<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        $projectsCount = Project::count();
        $featuredProjectsCount = Project::where('featured', true)->count();
        $galleryCount = Gallery::count();
        
        return view('admin.dashboard', compact('projectsCount', 'featuredProjectsCount', 'galleryCount'));
    }

    // Projects Management
    public function projects()
    {
        $projects = Project::orderBy('display_order')->get();
        return view('admin.projects', compact('projects'));
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'external_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'emoji' => 'nullable|string|max:10',
            'display_order' => 'integer',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['tags'] = $request->tags ? explode(',', $request->tags) : [];
        $validated['featured'] = $request->has('featured');

        Project::create($validated);

        return redirect()->route('admin.projects')->with('success', 'Project created successfully!');
    }

    public function updateProject(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
            'external_url' => 'nullable|url',
            'tags' => 'nullable|string',
            'emoji' => 'nullable|string|max:10',
            'display_order' => 'integer',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['tags'] = $request->tags ? explode(',', $request->tags) : [];
        $validated['featured'] = $request->has('featured');

        $project->update($validated);

        return redirect()->route('admin.projects')->with('success', 'Project updated successfully!');
    }

    public function destroyProject(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects')->with('success', 'Project deleted successfully!');
    }

    // Gallery Management
    public function gallery()
    {
        $galleries = Gallery::orderBy('display_order')->get();
        return view('admin.gallery', compact('galleries'));
    }

    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'display_order' => 'integer',
        ]);

        Gallery::create($validated);

        return redirect()->route('admin.gallery')->with('success', 'Gallery image added successfully!');
    }

    public function updateGallery(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'display_order' => 'integer',
        ]);

        $gallery->update($validated);

        return redirect()->route('admin.gallery')->with('success', 'Gallery image updated successfully!');
    }

    public function destroyGallery(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery')->with('success', 'Gallery image deleted successfully!');
    }
}
