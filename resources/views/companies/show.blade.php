<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <a href="{{ route('companies.index') }}">Back to Companies</a>
    </div>
</x-app-layout>
