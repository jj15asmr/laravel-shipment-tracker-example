<div wire:target="trackItem" wire:loading.class.add="animate__fadeOut" class="animate__animated animate__fadeIn animate__slow">
    <div class="card shadow-sm">
        <div class="card-header">Tracking details for <strong>{{ $item->tracking_number }}</strong></div>
        <div class="card-body py-3 px-4">
            {{-- Sender / Receiver Details --}}
            <div class="row mb-4">
                {{-- Sender --}}
                <div class="col text-start">
                    <p class="fw-bold mb-1">Sender:</p>
                    <p class="mb-0 text-muted">
                        {!! nl2br($item->sender->address) !!}
                    </p>
                </div>
    
                {{-- Receiver --}}
                <div class="col text-end">
                    <p class="fw-bold mb-1">Receiver:</p>
                    <p class="mb-0 text-muted">
                        {!! nl2br($item->receiver->address) !!}
                    </p>
                </div>
            </div>
    
            {{-- Item Details --}}
            <div class="row mb-4">
                {{-- Ship Date --}}
                <div class="col text-start">
                    <p class="fw-bold mb-1">Shipped On:</p>
                    <p class="mb-0 text-muted">
                        @if (!is_null($item->shipped_on))
                            {{ $item->shipped_on->format('n/j/Y') }}
                        @else
                            <span class="text-muted">n/a</span>
                        @endif
                    </p>
                </div>
    
                {{-- Type --}}
                <div class="col text-middle">
                    <p class="fw-bold mb-1">Type:</p>
                    <span class="badge rounded-pill bg-primary">{{ str($item->shipment_type->value)->upper() }}</span>
                </div>
    
                <!-- Weight -->
                <div class="col text-end">
                    <p class="fw-bold mb-1">Weight:</p>
                    <p class="mb-0 text-muted">{{ $item->weight['pounds'] }} lbs. {{ $item->weight['ounces'] }} oz.</p>
                </div>
            </div>
    
            <hr style="border-width: 2px;">
    
            {{-- Tracking Events --}}
            <p class="fw-bold mb-3">Events:</p>
            <div class="table-responsive">
                <table class="table table-striped table-borderless table-hover">
                    <tbody>
                        @forelse ($item->events as $event)
                            <tr wire:key="item-tracking-event-{{ $event->id }}">
                                {{-- Date & Time --}}
                                <td scope="row" width="25%">{{ $event->occurred_at->format('n/j/Y - g:ha') }}</td>
    
                                {{-- Location --}}
                                <td width="35%">
                                    <i class="fa-solid fa-location-dot text-secondary me-1"></i>
                                    {{ $event->location }}
                                </td>
    
                                {{-- Details --}}
                                <td>{{ $event->details }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-warning mb-0" role="alert">
                                No tracking events to show.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>