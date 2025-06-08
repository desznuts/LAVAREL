<x-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-bold tracking-wide text-gray-900 dark:text-gray-100">Edit Project</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12 px-8 bg-white dark:bg-gray-900 rounded-lg shadow-lg">
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" id="title" name="title" required value="{{ old('title', $project->title) }}"
                    class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('title')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="category_id" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Category</label>
                <select id="category_id" name="category_id" required
                    class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="description" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('description', $project->description) }}</textarea>
                @error('description')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="year" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Year</label>
                <input type="number" id="year" name="year" min="1900" max="{{ date('Y') }}" required value="{{ old('year', $project->year) }}"
                    class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('year')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="file" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Upload File (optional)</label>
                <input type="file" id="file" name="file" accept=".pdf,.doc,.docx" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('file')<p class="text-red-600 mt-1 text-sm">{{ $message }}</p>@enderror
                @if($project->file_path)
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Current file: <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800 transition">Download</a></p>
                @endif
            </div>

            <div class="flex space-x-4 mt-6">
                <a href="{{ route('projects.show', $project) }}" class="flex-1 bg-gray-400 text-white font-semibold px-6 py-3 rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 transition text-center">
                    Cancel
                </a>
                <button type="submit" class="flex-1 bg-red-600 text-white font-semibold px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition text-center">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</x-layout>