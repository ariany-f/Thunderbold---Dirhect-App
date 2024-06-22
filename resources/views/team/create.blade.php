<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Team Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Add Team Member</h3>
 
                    <!-- Formulário para adicionar membro à equipe -->
                    <form action="{{ route('team.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Hidden Field for Employee ID -->
                        <input type="hidden" name="manager_id" value="{{ $employee->id }}">

                        <!-- Employee Name (Display Only) -->
                        <div class="mt-4">
                            <x-input-label :value="__('Manager')" />
                            <x-text-input class="block mt-1 w-full bg-gray-100 px-4 py-2 rounded-md" type="text" name="employee_name" value="{{ $employee->name }}" disabled />
                        </div>

                        <div>
                            <label for="employee_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Select Employee:</label>
                            <select name="employee_id" id="employee_id" class="form-select block w-full mt-1">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-primary-button type="submit">
                                Add Employee
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
