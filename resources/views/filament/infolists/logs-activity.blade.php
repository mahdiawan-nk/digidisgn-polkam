<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption
            class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Activity Logs</h3>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
                <th scope="col" class="px-6 py-3">
                    logs
                </th>
                <th scope="col" class="px-6 py-3">
                    Time
                </th>
                <th scope="col" class="px-6 py-3">
                    tanggal
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($record->validation_logs as $log)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $log->user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $log->action }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $log->note }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($log->created_at)->format('H:i:s') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>
