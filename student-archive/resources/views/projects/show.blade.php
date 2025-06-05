<x-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-extrabold tracking-wide text-gray-900 dark:text-gray-100">{{ $project->title }}</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12 px-8 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg shadow-lg">
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300"><span class="font-bold">Category:</span> {{ $project->category->name }}</p>
        <p class="mt-6 whitespace-pre-wrap text-gray-800 dark:text-gray-200 leading-relaxed">{{ $project->description }}</p>
        <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">Year: {{ $project->year }}</p>

        @if($project->file_path)
            <p class="mt-6">
                <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800 transition">Download Project File</a>
            </p>
        @endif

        <div class="mt-8">
            <a href="{{ route('projects.index') }}" class="text-blue-500 hover:underline font-semibold">&larr; Back to Projects</a>
        </div>
    </div>
</x-layout>
