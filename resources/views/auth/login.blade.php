<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-[22px] font-bold text-gray-900">Selamat Datang!</h2>
    <p class="text-sm text-gray-500 mt-1 mb-8">Masuk ke akun EkstraKita</p>

    <form method="POST" action="{{ route('login') }}" class="text-left">
        @csrf

        <!-- Login / NIS -->
        <div>
            <label for="login" class="block font-semibold text-sm text-[#303645] mb-2">{{ __('Username / NIS') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="login" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg focus:ring-[#203a7a] focus:border-[#203a7a] text-sm text-gray-900" type="text" name="login" :value="old('login')" placeholder="123456789" required autofocus />
            </div>
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('nip_nis')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label for="password" class="block font-semibold text-sm text-[#303645] mb-2">{{ __('Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-lg focus:ring-[#203a7a] focus:border-[#203a7a] text-sm text-gray-900"
                                type="password"
                                name="password"
                                placeholder="........"
                                required autocomplete="current-password" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-[#203a7a] hover:bg-[#1a2f63] focus:outline-none transition">
                {{ __('Masuk') }}
            </button>
        </div>

        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a class="text-sm text-[#203a7a] font-semibold hover:underline" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8 border-t border-gray-100 pt-6 text-center">
            <p class="text-sm text-gray-500">
                Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-[#203a7a] hover:underline">Daftar Disini!</a>
            </p>
        </div>
    </form>
</x-guest-layout>
