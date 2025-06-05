<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('category', 'user')->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120', // 5MB max
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->year = $request->year;
        $project->category_id = $request->category_id;
        $project->user_id = Auth::id();

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('projects', 'public');
            $project->file_path = $filePath;
        }

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Ensure the project is loaded with its relations
        $project->load('category');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Ensure the project is loaded with its relations
        $categories = Category::all();

        // Check if the authenticated user is the owner of the project
        if (Auth::check() && Auth::id() !== $project->user_id) {
            return redirect()->route('projects.index')->with('error', 'You do not have permission to edit this project.');
        }
        return view('projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120', // 5MB max
        ]);

        if ($request->hasFile('file')) {
            if ($project->file_path && Storage::disk('public')->exists($project->file_path)) {
                Storage::disk('public')->delete($project->file_path);
            }
            $filePath = $request->file('file')->store('projects', 'public');
            $validated['file_path'] = $filePath;
        }

        $project->update($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Check if the authenticated user is the owner of the project
        if (Auth::check() && Auth::id() !== $project->user_id) {
            return redirect()->route('projects.index')->with('error', 'You do not have permission to delete this project.');
        }

        // Delete the file if it exists
        if ($project->file_path && Storage::exists($project->file_path)) {
            Storage::delete($project->file_path);
        }

        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
