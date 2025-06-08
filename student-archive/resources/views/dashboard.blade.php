<x-layout>
    <div class="mt-6 max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-8">Your Projects</h1>

        @if($projects->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow hover:shadow-md transition duration-300 p-6">
                        <a href="{{ route('projects.show', $project->id) }}"
                            class="text-xl font-bold text-teal-700 dark:text-red-400 hover:underline">
                            {{ $project->title }}
                        </a>

                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            <span class="font-medium">{{ $project->category->name }}</span> • {{ $project->year }}
                        </p>

                        <p class="mt-3 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                            {{ Str::limit($project->description, 100) }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @else
            <p class="text-center text-gray-600 dark:text-gray-400 mt-10 text-lg">You have not uploaded any projects yet.</p>
        @endif
    </div>
</x-layout>