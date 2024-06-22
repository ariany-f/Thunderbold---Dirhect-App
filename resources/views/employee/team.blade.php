<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Team of ') . $employee->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <x-primary-button class="ms-4">
                        <a href="{{ route('employee.index') }}">{{ __('Back to Employees') }}</a>
                    </x-primary-button>
                    <!-- Adicionar botão para adicionar member do time, se necessário -->

                    <!-- Botão para adicionar membro do time -->
                    <x-primary-button>
                        <a href="{{ route('team.create', ['employee_id' => $employee->id]) }}">{{ __('Add Team Member') }}</a>
                    </x-primary-button>
                </div>
                <div class="mt-6">
                    @foreach ($teamMembers as $member)
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $member->name }}
                            <!-- Adicionar outras informações relevantes -->
                            <form action="{{ route('team.destroy', ['member_id' => $member->id, 'employee_id' => $employee->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit" class="ms-4">{{ __('Delete') }}</x-primary-button>
                            </form>
                        </div>
                    @endforeach
                    @if ($teamMembers->isEmpty())
                        <p class="text-gray-500 dark:text-gray-300">No team members found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
