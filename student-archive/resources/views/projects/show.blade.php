<x-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-extrabold tracking-wide text-gray-900 dark:text-gray-100">{{ $project->title }}</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-6 sm:py-12 sm:px-8 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg shadow-lg">
        <section aria-labelledby="project-category" class="mb-6">
            <p id="project-category" class="text-lg font-semibold text-gray-700 dark:text-gray-300"><span class="font-bold">Category:</span> {{ $project->category->name }}</p>
        </section>

        <section aria-labelledby="project-description" class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6">
            <p id="project-description" class="whitespace-pre-wrap text-gray-800 dark:text-gray-200 leading-relaxed">{{ $project->description }}</p>
        </section>

        <section aria-labelledby="project-year" class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6">
            <p id="project-year" class="text-sm text-gray-500 dark:text-gray-400">Year: {{ $project->year }}</p>
        </section>

        @if($project->file_path)
            <section aria-label="Project files" class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6 space-x-4">
                <a href="{{ route('projects.download', $project->id) }}"
                    class="inline-block text-blue-600 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded transition-shadow" target="_blank" aria-describedby="download-desc">
                    ⬇️ Download Project File
                </a>
                <span id="download-desc" class="sr-only">Download the project file</span>

                @if(Str::endsWith($project->file_path, ['.pdf']))
                    <a href="{{ route('projects.preview', $project->id) }}"
                        class="inline-block text-green-600 underline hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 rounded transition-shadow" target="_blank" aria-describedby="preview-desc">
                        👁️ Preview PDF
                    </a>
                    <span id="preview-desc" class="sr-only">Preview the PDF file</span>
                @endif
            </section>
        @endif

        @if(auth()->check() && auth()->id() === $project->user_id)
            <section aria-label="Project actions" class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6 flex space-x-3">
                <a href="{{ route('projects.edit', $project->id) }}" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                    ✏️ Edit
                </a>

                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-shadow">
                        🗑️ Delete
                    </button>
                </form>
            </section>
        @endif

        <div class="mt-8">
            <a href="{{ route('projects.index') }}" class="text-blue-500 hover:underline font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">&larr; Back to Projects</a>
        </div>
    </div>
</x-layout>
