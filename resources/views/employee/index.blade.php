<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <x-primary-button class="ms-4">
                        <a href="{{ route('employee.create') }}">{{ __('Create New Employee') }}</a>
                    </x-primary-button>
                </div>
                <div>
                    @foreach ($employees as $employee)
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('employee.show', $employee->id) }}">{{ $employee->name }}</a>
                            <x-primary-button class="ms-4"><a href="{{ route('employee.edit', $employee->id) }}">Edit</a></x-primary-button>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit" class="ms-4">{{ __('Delete') }}</x-primary-button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
