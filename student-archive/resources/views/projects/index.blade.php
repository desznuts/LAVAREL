<x-layout>
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">All Projects</h1>

            <a href="{{ route('projects.create') }}" class="inline-block bg-teal-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-teal-700 transition duration-300 ease-in-out transform hover:scale-105">
                + Add New Project
            </a>
        </div>

        @if($projects->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                    <div class="border border-gray-200 dark:border-gray-700 p-6 rounded-lg shadow-sm bg-white dark:bg-gray-800">
                        <a href="{{ route('projects.show', $project->id) }}" 
                            class="block text-xl font-semibold text-gray-900 dark:text-white mb-2 hover:underline">
                            {{ $project->title }}
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                            Category: <span class="font-medium">{{ $project->category->name }}</span> | 
                            Year: <span class="font-medium">{{ $project->year }}</span>
                        </p>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ Str::limit($project->description, 100) }}</p>

                        @if(auth()->check() && auth()->id() === $project->user_id)
                            <div class="mt-4 flex space-x-3">
                                <a href="{{ route('projects.edit', $project->id) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                    Edit
                                </a>

                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-400">No projects found.</p>
        @endif

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    </div>
</x-layout>
