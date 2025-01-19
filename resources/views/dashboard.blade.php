<x-app-layout>
    <x-banner />

    <div class="min-h-screen bg-white dark:bg-gray-900 flex flex-col h-full">
        {{-- @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div>
        <div>
            <div>
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
