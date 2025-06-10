<x-layout>
    <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4 sm:px-8">
            <a href="{{ route('projects.index') }}" class="text-xl font-extrabold text-gray-900 dark:text-gray-100 tracking-wide hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                &larr; Projects
            </a>
        </div>
    </header>

    <main class="bg-white dark:bg-gray-900 min-h-screen py-16 px-6 sm:px-8 mt-6">
        <div class="max-w-[1200px] mx-auto">
            <article
                class="bg-white dark:bg-gray-900 rounded-3xl shadow-md p-10 sm:p-16 max-w-3xl mx-auto"
                aria-label="Project details"
            >
                <h1 class="text-5xl font-extrabold tracking-tight leading-tight text-gray-900 dark:text-gray-100 mb-6 select-text">
                    {{ $project->title }}
                </h1>

                <section class="mb-12">
                    <p class="font-semibold text-lg text-gray-700 dark:text-gray-300 mb-1 select-text">
                        Category: <span class="font-normal">{{ $project->category->name }}</span>
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-400 select-text">
                        Owner: <span class="font-medium">{{ $project->user->name }}</span>
                    </p>
                </section>

                <section class="mb-12" aria-labelledby="project-description">
                    <h2 id="project-description" class="sr-only">Project Description</h2>

                    @php
                        $fullDescription = nl2br(e($project->description));
                        $shortDescription = nl2br(e(Str::limit($project->description, 150)));
                        $isLong = strlen($project->description) > 150;
                    @endphp

                    <div x-data="{ expanded: false }">
                        <div
                            class="relative overflow-hidden transition-[max-height,opacity] duration-300 ease-in-out"
                            :class="expanded ? 'max-h-[1000px] opacity-100' : 'max-h-24 opacity-100'"
                            aria-live="polite"
                            id="description-container"
                        >
                            <p
                                class="whitespace-pre-wrap text-gray-600 dark:text-gray-300 leading-relaxed text-base break-words m-0 select-text"
                                x-html="expanded ? @js($fullDescription) : @js($shortDescription) + '{{ $isLong ? '&#8230;' : '' }}'"
                                id="description-text"
                            ></p>
                        </div>

                        @if($isLong)
                            <button
                                x-on:click="expanded = !expanded"
                                x-text="expanded ? 'Show Less' : 'Show More'"
                                :aria-expanded="expanded"
                                aria-controls="description-container"
                                class="mt-6 px-0 py-2 text-blue-600 dark:text-blue-400 font-semibold text-base hover:text-blue-800 dark:hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl transition-colors"
                                type="button"
                                id="toggle-description"
                            ></button>
                        @endif
                    </div>
                </section>

                <section class="mb-12">
                    <p class="text-sm text-gray-500 dark:text-gray-400 select-text">
                        Year: {{ $project->year }}
                    </p>
                </section>

                @if($project->file_path)
                    <section class="mb-12 space-x-6 flex flex-wrap items-center">
                        <a href="{{ route('projects.download', $project->id) }}"
                           class="inline-block px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-shadow shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                           target="_blank" aria-describedby="download-desc" role="button"
                        >
                            ⬇️ Download Project File
                        </a>
                        <span id="download-desc" class="sr-only">Download the project file</span>

                        @if(Str::endsWith($project->file_path, ['.pdf']))
                            <a href="{{ route('projects.preview', $project->id) }}"
                               class="inline-block px-5 py-3 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600 transition-shadow shadow-md focus:outline-none focus:ring-2 focus:ring-green-400"
                               target="_blank" aria-describedby="preview-desc" role="button"
                            >
                                👁️ Preview PDF
                            </a>
                            <span id="preview-desc" class="sr-only">Preview the PDF file</span>
                        @endif
                    </section>
                @endif

                @if(auth()->check() && auth()->id() === $project->user_id)
                    <section
                        class="mb-8 flex space-x-6"
                        aria-label="Project actions"
                    >
                        <a href="{{ route('projects.edit', $project->id) }}"
                           class="flex-1 text-center px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-shadow shadow-md"
                        >
                            ✏️ Edit
                        </a>

                        <form class="flex-1" action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full px-6 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition-shadow shadow-md"
                            >
                                🗑️ Delete
                            </button>
                        </form>
                    </section>
                @endif
            </article>
        </div>
    </main>
</x-layout>
