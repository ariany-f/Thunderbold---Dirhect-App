<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $company->name }}">
            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
