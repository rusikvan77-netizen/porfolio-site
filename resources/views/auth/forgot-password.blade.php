@extends('layouts.app')
@section('content')

    <x-guest-layout>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Забыли пароль? Напишите свою почту, которая привязана к аккаунту. На выбранную почту придёт ссылка для сброса пароля.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('отправить ссылку') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>
@endsection