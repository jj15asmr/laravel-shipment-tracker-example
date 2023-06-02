<div class="container my-4">
    <h2 class="track-item-heading">Track Your Item <i class="fa-solid fa-magnifying-glass fa-flip-horizontal text-muted"></i></h2>
    <p class="track-item-subheading">Enter your item's tracking number below and instantly find out it's status within our network.</p>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            {{-- Track Item Form --}}
            <div class="card py-3 shadow-sm">
                <div class="card-body">
                    <form wire:submit.prevent="trackItem">                            
                        <div class="input-group">
                            <input wire:model.defer="tracking_number" class="form-control" type="text" placeholder="e.g. PL681936433070107DOM" aria-label="Track Item">
                            <button id="track-item-submit" class="btn btn-primary" type="submit">
                                Track
                                <i wire:loading class="fa-solid fa-spinner fa-spin ms-1"></i>
                            </button>
                        </div>

                        @error('tracking_number')
                            @foreach ($errors->get('tracking_number') as $error)
                                {{-- If the error is due to invalid format, show a more detailed error --}}
                                @if ($error == 'The tracking number field format is invalid.')
                                    <div class="alert alert-danger mt-4 mb-0 animate__animated animate__fadeIn" role="alert">
                                        Hmm, that doesn't look like a proper PoŝtaLoĝistiko tracking number. <strong>It should...</strong>

                                        <ul class="mt-2 mb-0">
                                            <li>Start with <samp>"PL"</samp></li>
                                            <li>Contain a 15-digit unique identifier</li>
                                            <li>Be suffixed with a three-letter type code (<samp>"DOM"</samp> for domestic, <samp>"INT"</samp> for international)</li>
                                        </ul>
                                    </div>
                                @else
                                    <div class="invalid-feedback d-block mt-1 animate__animated animate__fadeIn">{{ $error }}</div>
                                @endif
                            @endforeach
                        @enderror
                    </form>
                </div>
            </div>

            {{-- Item Tracking Progress & Details --}}
            @if ($item)
                <div>
                    {{-- Tracking Progress --}}
                    @include('partials.track-item.tracking-progress')

                    {{-- Tracking Details --}}
                    @include('partials.track-item.tracking-details')
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            // If the tracking number exists as query param in the URL programmatically
            // click the "Track" button (as Livewire will fill the input field but not fire the action)
            const url_params = new URLSearchParams(location.search);
        
            if (url_params.has('tn') && url_params.get('tn') != '') {
                document.getElementById('track-item-submit').click();
            }

            // Update the tab title to reflect the item's status once it's details have been fetched
            Livewire.on('trackingDetailsFetched', (tracking_number, item_status) => {
                let new_title = `📦 ${item_status} - ${tracking_number} | PoŝtaLoĝistiko`;
                document.title = new_title;
            });
        });
    </script>
</div>