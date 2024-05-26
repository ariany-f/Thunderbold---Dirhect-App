<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Company') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <button type="submit">Create</button>
        </form></form>
    </div>
</x-app-layout>
