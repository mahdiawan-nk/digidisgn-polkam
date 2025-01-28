{{-- <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
    @if ($getState() != null)
        @foreach ($getState() as $steps)
            <div class="flex flex-col pb-3">
                @if ($steps->note != null)
                    <dt class="mb-1 font-semibold">{{ $steps->role_required }}</dt>
                @endif

                <dd class="text-xs text-gray-500 dark:text-gray-400 whitespace-pre-wrap">{{ $steps->note }}</dd>
            </div>
        @endforeach
    @endif

</dl> --}}


<ol class="relative border-s border-gray-200 dark:border-gray-700 p-2 mb-2">
    @foreach ($getState() as $state)
        @php
            $classStatus = match ($state->status) {
                'pending' => 'bg-yellow-400 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800',
                default => 'bg-blue-100 text-blue-800',
            };
            $classSvg = match ($state->status) {
                'pending'
                    => '<path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9-3a1 1 0 1 0-2 0v6a1 1 0 1 0 2 0V9Zm4 0a1 1 0 1 0-2 0v6a1 1 0 1 0 2 0V9Z" clip-rule="evenodd"/>',
                'approved' => '<path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                        clip-rule="evenodd" />',
                'rejected'
                    => '<path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>',
                default => 'text-blue-800',
            };
            $classSvgStatus = match ($state->status) {
                'pending' => 'text-yellow-400',
                'approved' => 'text-green-800',
                'rejected' => 'text-red-800',
                default => 'text-blue-800',
            };
        @endphp

        <li class="mb-10 ms-6">
            <span
                class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                <svg class="w-[18px] h-[18px] {{ $classSvgStatus }} dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    {!! $classSvg !!}
                </svg>

            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                {{ $state->role_required }}
                <span
                    class="{{ $classStatus }} text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-3">
                    {{ $state->status }}
                </span>
            </h3>
            <time
                class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $state->updated_at }}</time>
            @if ($state->status == 'rejected')
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400 whitespace-normal">
                    {{ $state->note }}</p>
            @endif


        </li>
    @endforeach


</ol>
