<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('category');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $categoryIds = (array) $request->category_id;
            $query->whereIn('category_id', $categoryIds);
        }

        $projects = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120',
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

    public function show(Project $project)
    {
        $project->load('category');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        if (Auth::id() !== $project->user_id) {
            return redirect()->route('projects.index')->with('error', 'You do not have permission to edit this project.');
        }

        $categories = Category::all();
        return view('projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        if (Auth::id() !== $project->user_id) {
            return redirect()->route('projects.index')->with('error', 'You do not have permission to update this project.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($project->file_path && Storage::disk('public')->exists($project->file_path)) {
                Storage::disk('public')->delete($project->file_path);
            }

            $validated['file_path'] = $request->file('file')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if (Auth::id() !== $project->user_id) {
            return redirect()->route('projects.index')->with('error', 'You do not have permission to delete this project.');
        }

        if ($project->file_path && Storage::disk('public')->exists($project->file_path)) {
            Storage::disk('public')->delete($project->file_path);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function download(Project $project)
    {
        if (!$project->file_path || !Storage::disk('public')->exists($project->file_path)) {
            abort(404, 'File not found.');
    }

        return response()->download(storage_path('app/public/' . $project->file_path));
    }


    public function preview(Project $project)
    {
        if (!$project->file_path || !Storage::disk('public')->exists($project->file_path)) {
            abort(404, 'File not found.');
        }

        $fullPath = storage_path('app/public/' . $project->file_path);
        $mimeType = mime_content_type($fullPath);

        if ($mimeType !== 'application/pdf') {
            abort(403, 'Preview only available for PDF files.');
        }

        return response()->file(
            $fullPath,
            [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . basename($project->file_path) . '"',
            ]
        );
    }
}
