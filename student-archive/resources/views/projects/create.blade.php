<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4">
        <div class="max-w-3xl w-full py-10 px-6 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100 text-center mt-4">Add New Project</h2>

            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label for="title" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" id="title" name="title" required
                        class="w-full border border-gray-400 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200" />
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300 mt-2">Category</label>
                    <select id="category_id" name="category_id" required
                        class="w-full border border-gray-400 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300 mt-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full border border-gray-400 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="year" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Year</label>
                    <select id="year" name="year" required
                        class="w-full border border-gray-400 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        <option value="">Select year</option>
                        @for ($y = date('Y'); $y >= 1900; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                    @error('year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="file" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300 mt-2">Upload File (PDF)</label>
                    <input type="file" id="file" name="file" accept=".pdf,application/pdf"
                        class="w-full text-gray-700 dark:text-gray-300 file:border file:border-gray-400 dark:file:border-gray-600 file:rounded px-3 file:py-2 file:bg-white dark:file:bg-gray-700 file:text-sm file:font-semibold file:cursor-pointer hover:file:bg-blue-600 hover:file:text-white transition" />
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold px-6 py-3 rounded hover:bg-blue-700 active:bg-blue-800 transition focus:outline-none focus:ring-4 focus:ring-blue-400 mt-4 mb-2">
                        Save Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
