<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Dependent') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('dependents.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    <!-- Hidden Field for Employee ID -->
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                    <!-- Employee Name (Display Only) -->
                    <div class="mt-4">
                        <x-input-label :value="__('Employee')" />
                        <x-text-input class="block mt-1 w-full bg-gray-100 px-4 py-2 rounded-md" type="text" name="employee_name" value="{{ $employee->name }}" disabled />
                    </div>

                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Relationship -->
                    <div class="mt-4">
                        <x-input-label for="relationship" :value="__('Relationship')" />
                        <x-text-input id="relationship" class="block mt-1 w-full" type="text" name="relationship" :value="old('relationship')" required autocomplete="relationship" />
                        <x-input-error :messages="$errors->get('relationship')" class="mt-2" />
                    </div>

                    <!-- Birthdate -->
                    <div class="mt-4">
                        <x-input-label for="birthdate" :value="__('Birthdate')" />
                        <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required autocomplete="birthdate" />
                        <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button type="submit">{{ __('Create') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
