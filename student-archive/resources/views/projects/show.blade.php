<x-layout>
    <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4 sm:px-8">
            <a href="{{ route('projects.index') }}" class="text-xl font-extrabold text-gray-900 dark:text-gray-100 tracking-wide hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                &larr; Projects
            </a>
            <!-- <nav aria-label="Primary navigation">
                <ul class="flex space-x-6 text-gray-700 dark:text-gray-300 text-base font-medium">
        
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Home</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Docs</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Support</a></li>
                </ul>
            </nav> -->
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
                </section>

                <section class="mb-12" aria-labelledby="project-description">
                    <h2 id="project-description" class="sr-only">Project Description</h2>

                    <div
                        id="description-container"
                        class="relative overflow-hidden max-h-24 opacity-100 transition-[max-height,opacity] duration-300 ease-in-out"
                        aria-live="polite"
                    >
                        <p
                            id="description-text"
                            class="whitespace-pre-wrap text-gray-600 dark:text-gray-300 leading-relaxed text-base break-words m-0 select-text"
                        >
                            {!! nl2br(e(Str::limit($project->description, 150))) !!}@if(strlen($project->description) > 150)&#8230;@endif
                        </p>
                    </div>

                    @if(strlen($project->description) > 150)
                        <button
                            id="toggle-description"
                            aria-expanded="false"
                            aria-controls="description-container"
                            class="mt-6 px-0 py-2 text-blue-600 dark:text-blue-400 underline font-semibold text-base hover:text-blue-800 dark:hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl transition-colors"
                            type="button"
                        >
                            Show More
                        </button>
                    @endif
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

    @if(strlen($project->description) > 150)
        <style>
            /* Prevent jumpy scroll by animating max-height from fixed value to larger fixed value */
            #description-container.expanded {
                max-height: 1000px; /* large enough to show full text */
                opacity: 1;
            }

            #description-container.collapsing {
                opacity: 0;
            }
        </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const button = document.getElementById('toggle-description');
                        const container = document.getElementById('description-container');
                        const descriptionText = document.getElementById('description-text');
                        // Use JSON string with newlines preserved
                        const fullText = @json(nl2br(e($project->description)));
                        const shortText = fullText.slice(0, 500) + (fullText.length > 500 ? '…' : '');
                        const collapsedMaxHeight = '6rem'; // 24 (6*4) / Tailwind max-h-24 from initial

                        // Initialize collapsed state
                        container.style.maxHeight = collapsedMaxHeight;
                        descriptionText.innerHTML = shortText;

                        let isExpanded = false;

                        button.addEventListener('click', function () {
                            if (!isExpanded) {
                                // Expand: Set full text first, then animate max-height bigger
                                descriptionText.innerHTML = fullText;
                                container.classList.add('expanded');
                                container.style.maxHeight = '1000px'; // large value for smooth expand
                                button.textContent = 'Show Less';
                                button.setAttribute('aria-expanded', 'true');
                            } else {
                                // Collapse: Animate max-height smaller and then set short text
                                container.style.maxHeight = collapsedMaxHeight;
                                button.textContent = 'Show More';
                                button.setAttribute('aria-expanded', 'false');

                                // Wait for transition to finish before switching text to avoid jump
                                container.addEventListener('transitionend', function handler(e) {
                                    if (e.propertyName === 'max-height') {
                                        descriptionText.innerHTML = shortText;
                                        container.classList.remove('expanded');
                                        container.removeEventListener('transitionend', handler);
                                    }
                                });
                            }
                            isExpanded = !isExpanded;
                        });
                    });
                </script>
    @endif
</x-layout>

