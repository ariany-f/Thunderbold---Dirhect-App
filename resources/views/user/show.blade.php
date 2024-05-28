<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="flex items-center gap-4">
                            <x-primary-button><a href="{{ route('user.index') }}">{{ __('Back to Users') }}</a></x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
