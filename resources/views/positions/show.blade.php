<!-- resources/views/positions/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Position Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mt-6">
                    <div class="px-6 py-4">
                        <x-label for="name" :value="__('Name')" />
                        <p class="mt-2 text-gray-900 dark:text-gray-200">{{ $position->name }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <x-secondary-button>
                        <a href="{{ route('positions.index') }}">{{ __('Back to Positions') }}</a>
                    </x-secondary-button>
                    <x-primary-button>
                        <a href="{{ route('positions.edit', $position->id) }}">{{ __('Edit') }}</a>
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
