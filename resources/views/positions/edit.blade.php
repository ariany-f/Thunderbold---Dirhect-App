<!-- resources/views/positions/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Position') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('positions.update', $position->id) }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $position->name }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Base Salary -->
                    <div class="mt-4">
                        <x-input-label for="base_salary" :value="__('base_salary')" />
                        <x-text-input id="base_salary" class="block mt-1 w-full" type="number" name="base_salary" :value="$position->base_salary" required />
                        <x-input-error :messages="$errors->get('base_salary')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-secondary-button>
                            <a href="{{ route('positions.index') }}">{{ __('Cancel') }}</a>
                        </x-secondary-button>
                        <x-primary-button type="submit">{{ __('Update') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
