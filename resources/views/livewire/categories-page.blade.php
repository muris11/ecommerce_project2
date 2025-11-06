<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="relative flex flex-col items-center animate-fade-in-up">
            <h1 class="text-5xl font-bold dark:text-gray-200 mb-5">
                <span
                    class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent animate-gradient-x">
                    Kategori
                </span>
            </h1>
            <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded-full shadow-md">
                <div class="flex-1 h-2 bg-gradient-to-r from-blue-200 to-blue-300 animate-pulse"></div>
                <div class="flex-1 h-2 bg-gradient-to-r from-blue-400 to-blue-500 animate-pulse animation-delay-200">
                </div>
                <div class="flex-1 h-2 bg-gradient-to-r from-blue-600 to-purple-600 animate-pulse animation-delay-400">
                </div>
            </div>
        </div>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">

            @foreach ($categories as $category)
                <a class="group flex flex-col bg-white border shadow-md rounded-xl hover:shadow-2xl transition-all duration-500 dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 transform hover:-translate-y-2 hover:scale-[1.02] animate-fade-in-up overflow-hidden relative"
                    href="/products?selected_categories[0]={{ $category->id }}" wire:key="{{ $category->id }}"
                    style="animation-delay: {{ $loop->index * 100 }}ms">
                    <!-- Gradient overlay on hover -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="p-4 md:p-5 relative z-10">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 bg-blue-500/20 rounded-full blur-xl group-hover:bg-purple-500/30 transition-all duration-300">
                                    </div>
                                    <img class="h-[5rem] w-[5rem] relative z-10 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 rounded-lg shadow-md"
                                        src="{{ $category->image ? url('storage', $category->image) : url('images/no-image.png') }}"
                                        alt="{{ $category->name }}" loading="lazy" width="80" height="80">
                                </div>
                                <div class="ms-3">
                                    <h3
                                        class="group-hover:text-blue-600 text-2xl font-semibold text-gray-800 dark:group-hover:text-blue-400 dark:text-gray-200 transition-colors duration-300 transform group-hover:translate-x-2">
                                        {{ $category->name }}
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-3">
                                <svg class="flex-shrink-0 w-5 h-5 transform group-hover:translate-x-2 group-hover:scale-125 transition-all duration-300 text-gray-600 group-hover:text-blue-600 dark:text-gray-400 dark:group-hover:text-blue-400"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>
