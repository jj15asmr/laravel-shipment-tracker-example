<div wire:target="trackItem" wire:loading.class.add="animate__fadeOut" class="animate__animated animate__fadeIn">
    @if ($item->status->value != 'in_system')
        <div class="tracking-progress-wrapper">
            {{-- Picked Up --}}
            <div wire:loading.class.remove="animate__fadeInLeft"
                @class([
                'step',
                'active' => $item->status->isCurrentStatus('picked_up') || $item->status->isPreviousStatus('picked_up'),
                'current' => $item->status->isCurrentStatus('picked_up'),
                'animate__animated animate__fadeInLeft' => $item->status->isCurrentStatus('picked_up')
            ])>
                <span class="icon"><i class="fa-solid fa-cart-flatbed"></i></span>
                <span class="text">Picked Up</span>
            </div>

            {{-- In Transit --}}
            <div wire:loading.class.remove="animate__fadeInLeft"
                @class([
                'step',
                'active' => $item->status->isCurrentStatus('in_transit') || $item->status->isPreviousStatus('in_transit'),
                'current' => $item->status->isCurrentStatus('in_transit'),
                'animate__animated animate__fadeInLeft' => $item->status->isCurrentStatus('in_transit')
            ])>
                <span class="icon"><i class="fa-solid fa-truck-ramp-box"></i></span>
                <span class="text">In Transit</span>
            </div>

            {{-- Dispatched --}}
            <div wire:loading.class.remove="animate__fadeInLeft"
                @class([
                'step',
                'active' => $item->status->isCurrentStatus('dispatched') || $item->status->isPreviousStatus('dispatched'),
                'current' => $item->status->isCurrentStatus('dispatched'),
                'animate__animated animate__fadeInLeft' => $item->status->isCurrentStatus('dispatched')
            ])>
                <span class="icon"><i class="fa-solid fa-truck"></i></span>
                <span class="text">Dispatched</span>
            </div>

            {{-- Delivered --}}
            <div wire:loading.class.remove="animate__fadeInLeft"
                @class([
                'step',
                'active current delivered animate__animated animate__fadeInLeft' => $item->status->isCurrentStatus('delivered')
            ])>
                <span class="icon"><i class="fa-solid fa-house-circle-check"></i></span>
                <span class="text">Delivered!</span>
            </div>
        </div>
    @else
        {{-- In System Message --}}
        <div class="alert alert-warning my-4" role="alert">
            This item is in our system but not yet within our custody. More details will be available once it is.
        </div>
    @endif
</div>