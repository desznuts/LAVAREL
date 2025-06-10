<x-layout>
    <div class="max-w-full mx-auto py-10 px-4 sm:px-6 lg:px-8 flex flex-col h-screen">
        <div class="flex justify-between items-center mb-8 mt-6">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight">Student Projects</h1>
        
            <a href="{{ route('projects.create') }}"
                class="inline-flex items-center bg-teal-600 text-white px-5 py-2.5 rounded-md shadow-md hover:bg-teal-700 transition duration-200 hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4v16m8-8H4" /></svg>
                Upload Project
            </a>
        </div>

        {{-- Main content with side panels --}}
        <div class="flex flex-1 gap-6">
            <!-- Filter & Search Side Panel -->
            <form method="GET" action="{{ route('projects.index') }}"
                class="w-72 flex flex-col gap-4 bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-sm h-full overflow-y-auto">
                <div class="flex justify-between items-center">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                        Filter
                    </button>
                    <a href="{{ route('projects.index') }}"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:underline ml-4">
                        Clear Filters
                    </a>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Title or Description"
                    class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-0" />

                <div class="pt-4 border-t border-gray-300 dark:border-gray-600 overflow-y-auto" style="max-height: calc(100vh - 250px);">
                    <p class="font-semibold mb-2 text-gray-700 dark:text-gray-300">Categories</p>
                    @foreach($categories as $category)
                        <label class="flex items-center space-x-2 mb-1 text-gray-700 dark:text-gray-300 gap-2">
                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                {{ is_array(request('category_id')) && in_array($category->id, request('category_id')) ? 'checked' : '' }}
                                class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:outline-none focus:ring-0 ml-2" />
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach 
                </div>
            </form>

            {{-- Projects Grid --}}
            <div class="flex-1 pb-4">
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
                @else
                    <p class="text-center text-gray-600 dark:text-gray-400 mt-10 text-lg">No projects found.</p>
                @endif

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
