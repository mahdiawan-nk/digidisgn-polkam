{{-- <div class="p-6 bg-gray-100"> --}}
<div class="space-y-4 p-3">
    <!-- In Process -->
    @if ($getState() != null)
        @foreach ($getState() as $steps)
            @php
                $stepsStatusColor = match ($steps->status) {
                    'pending' => 'bg-yellow-400 text-yellow-800',
                    'approved' => 'bg-green-100 text-green-800',
                    'rejected' => 'bg-red-100 text-red-800',
                    default => 'bg-blue-100 text-blue-800',
                };
            @endphp
            <div class="flex items-center space-x-3">
                <span class="text-gray-600 text-xs">{{ $steps->role_required }}:</span>
                <span class="{{ $stepsStatusColor }} text-xs font-semibold px-2 py-1 rounded">
                    {{ $steps->status }}
                </span>
                {{-- <span class="text-gray-500 text-sm">14 Jan 2025, 09:00 AM</span> --}}
            </div>
        @endforeach

    @endif

</div>

