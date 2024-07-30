<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Data Summary</h3>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Count</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Admin Users</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $adminCount }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Regular Users</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $userCount }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Total Sales</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $penjualanCount }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mt-6">Sales Data</h3>
                    <div class="flex justify-between mb-4">
                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <select name="filter" class="form-select" onchange="this.form.submit()">
                                <option value="year" {{ $filter === 'year' ? 'selected' : '' }}>Yearly</option>
                                <option value="month" {{ $filter === 'month' ? 'selected' : '' }}>Monthly</option>
                                <option value="day" {{ $filter === 'day' ? 'selected' : '' }}>Daily</option>
                            </select>
                        </form>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Year</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ $filter === 'year' ? 'Month' : ($filter === 'month' ? 'Day' : 'Hour') }}</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Count</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($penjualanMonthly as $monthly)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $monthly->year }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $filter === 'year' ? $monthly->month : ($filter === 'month' ? $monthly->day : $monthly->hour) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $monthly->count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
