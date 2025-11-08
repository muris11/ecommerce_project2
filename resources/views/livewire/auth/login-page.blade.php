<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex h-full items-center">
        <main class="w-full max-w-md mx-auto p-6">
            <div
                class="bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 animate-fade-in-up transform hover:scale-[1.02]">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h1
                            class="block text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Login</h1>
                        <p class="mt-2 text-sm text-gray-600">
                            Belum punya akun?
                            <a wire:navigate
                                class="text-blue-600 decoration-2 hover:underline font-medium transform hover:translate-x-1 inline-block transition-transform duration-300"
                                href="/register">
                                Daftar Disini
                            </a>
                        </p>
                    </div>

                    <hr class="my-5 border-slate-300">

                    <!-- Form -->
                    <form wire:submit.prevent="save">
                        <div class="grid gap-y-4">
                            <!-- Form Group -->
                            <div>
                                <label for="email" class="block text-sm mb-2 font-medium">Alamat
                                    Email</label>
                                <div class="relative">
                                    <input type="email" id="email" wire:model.lazy="email"
                                        class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none transition-all duration-300 transform focus:scale-[1.02]"
                                        aria-describedby="email-error">
                                    @error('email')
                                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                            <svg class="h-5 w-5 text-red-500 animate-bounce" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                                @error('email')
                                    <p class="text-xs text-red-600 mt-2 animate-fade-in" id="email-error">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div>
                                <div class="flex justify-between items-center">
                                    <label for="password" class="block text-sm mb-2 font-medium">Password</label>
                                    <a wire:navigate
                                        class="text-sm text-blue-600 decoration-2 hover:underline font-medium transform hover:translate-x-1 inline-block transition-transform duration-300"
                                        href="/forgot">Lupa Password?</a>
                                </div>
                                <div class="relative">
                                    <input type="password" id="password" wire:model.lazy="password"
                                        class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none transition-all duration-300 transform focus:scale-[1.02]"
                                        required aria-describedby="password-error">
                                    @error('password')
                                        <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                            <svg class="h-5 w-5 text-red-500 animate-bounce" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                                @error('password')
                                    <p class="text-xs text-red-600 mt-2 animate-fade-in" id="email-error">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End Form Group -->
                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 disabled:opacity-50 disabled:pointer-events-none transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">Login</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
    </div>
</div>
