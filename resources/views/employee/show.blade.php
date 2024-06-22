<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $employee->name }}
        </h2>
    </x-slot>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                <a href="{{ route('employee.index') }}">{{ __('Back to Employees') }}</a>
                            </x-primary-button>
                            <x-primary-button>
                                <a href="{{ route('employee.dependents', $employee->id) }}">{{ __('View Dependents') }}</a>
                            </x-primary-button>
                            @if ($employee->manager)
                                <x-primary-button>
                                    <a href="{{ route('employee.team', $employee->id) }}">{{ __('View Team') }}</a>
                                </x-primary-button>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6">
                        <p><strong>{{ __('Email:') }}</strong> {{ $employee->email }}</p>
                        <p><strong>{{ __('Position:') }}</strong> 
                            @if ($employee->position)
                                {{ $employee->position->name }}
                            @else
                                {{ __('No position assigned') }}
                            @endif
                        </p>
                        <p><strong>{{ __('Group:') }}</strong> 
                            @if ($employee->group)
                                {{ $employee->group->name }}
                            @else
                                {{ __('No group assigned') }}
                            @endif
                        </p>
                        <p><strong>{{ __('Branches:') }}</strong> 
                            @if ($employee->company_branches && $employee->company_branches->isNotEmpty())
                                {{ implode(', ', $employee->company_branches->pluck('name')->toArray()) }}
                            @else
                                {{ __('No branches assigned') }}
                            @endif
                        </p>
                        <p><strong>{{ __('Manager:') }}</strong> {{ $employee->manager ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
