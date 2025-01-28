<x-filament-widgets::widget>
    @if ($showAndGrid['showStatistikAdmin'])
        <div class="grid grid-cols-4 sm:grid-cols-3 lg:grid-cols-3 gap-4 mb-5">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center">
                <div class="p-3 bg-blue-500 text-white rounded-full">
                    <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-700">Total User</h2>
                    <p class="text-2xl font-bold text-gray-900">{{ $countAdminStatisitik['pengguna'] }} </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center">
                <div class="p-3 bg-green-500 text-white rounded-full">
                    <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-700">Total Role</h2>
                    <p class="text-2xl font-bold text-gray-900">{{ $countAdminStatisitik['roles'] }}</p>

                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center">
                <div class="p-3 bg-red-500 text-white rounded-full">
                    <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z" />
                        <path
                            d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z" />
                    </svg>

                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-700">Total Jabatan</h2>
                    <p class="text-2xl font-bold text-gray-900">{{ $countAdminStatisitik['jabatan'] }}</p>

                </div>
            </div>
        </div>
    @endif


    <div class="grid grid-cols-{{ $showAndGrid['gridStatistikSurat'] }} gap-4">
        @if ($showAndGrid['showStatistikSuratAdminStaff'])
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-white shadow-lg rounded-2xl p-6 py-7 flex items-center">
                        <div class="p-3 bg-blue-500 text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h11M9 21V3m3 3l9 6-9 6v6" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-700">Total Surat Diajukan</h2>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalSurat['diajukan'] }} </p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center">
                        <div class="p-3 bg-green-500 text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-700">total Surat Selesai</h2>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalSurat['finished'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-span-2">
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                <!-- Card for Submitted -->
                <div class="bg-blue-100 border border-blue-300 rounded-2xl shadow-lg p-6 flex items-center">
                    <div class="bg-blue-500 text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-blue-600">Submitted</h2>
                        <p class="text-2xl font-bold text-blue-800">{{ $statistikSuratVerifikasi['submited'] }}</p>
                    </div>
                </div>

                <!-- Card for Re-Submitted -->
                <div class="bg-yellow-100 border border-yellow-300 rounded-2xl shadow-lg p-6 flex items-center ">
                    <div class="bg-yellow-500 text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 9l3 3-3 3M3 12h18M7 3h14a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-yellow-600">Re-Submitted</h2>
                        <p class="text-2xl font-bold text-yellow-800">{{ $statistikSuratVerifikasi['re-submited'] }}</p>
                    </div>
                </div>

                <!-- Card for Approved -->
                <div class="bg-green-100 border border-green-300 rounded-2xl shadow-lg p-6 flex items-center ">
                    <div class="bg-green-500 text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-green-600">Approved</h2>
                        <p class="text-2xl font-bold text-green-800">{{ $statistikSuratVerifikasi['approved'] }}</p>
                    </div>
                </div>

                <!-- Card for Rejected -->
                <div class="bg-red-100 border border-red-300 rounded-2xl shadow-lg p-6 flex items-center ">
                    <div class="bg-red-500 text-white p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-red-600">Rejected</h2>
                        <p class="text-2xl font-bold text-red-800">{{ $statistikSuratVerifikasi['rejected'] }}</p>
                    </div>
                </div>
            </div>

            {{-- <div
                class=" w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                    Statistik Action Logs Surat
                </h5>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Data berdasarkan log activity.
                </p>
                <ul class="my-4 space-y-3">
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-500 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Surat Submited</span>
                            <span
                                class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-sm font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">{{ $statistikSuratVerifikasi['submited'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-500 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Surat Re-submited</span>
                            <span
                                class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-sm font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">{{ $statistikSuratVerifikasi['re-submited'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-green-500 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                                <path fill-rule="evenodd"
                                    d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Surat Approved</span>
                            <span
                                class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-sm font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">{{ $statistikSuratVerifikasi['approved'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-red-500 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Surat Rejected</span>
                            <span
                                class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-sm font-medium text-gray-500 bg-gray-200 rounded-sm dark:bg-gray-700 dark:text-gray-400">{{ $statistikSuratVerifikasi['rejected'] }}</span>
                        </a>
                    </li>
                </ul>
                <div>
                    <a href="#"
                        class="inline-flex items-center text-xs font-normal text-gray-500 hover:underline dark:text-gray-400">
                        <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Why do I need to connect with my wallet?</a>
                </div>
            </div> --}}
        </div>


    </div>




</x-filament-widgets::widget>
