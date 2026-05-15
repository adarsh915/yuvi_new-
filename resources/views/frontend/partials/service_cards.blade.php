@foreach($services as $service)
    <article class="service-card reveal" data-category="{{ $service->accent_class }}">
        <div class="card-img">
        <div class="card-accent {{ $service->accent_class }}"></div>
        <img src="{{ asset('storage/' . $service->listing_image) }}" alt="{{ $service->title }}">
        <div class="card-img-overlay"></div>
        <span class="card-num">{{ str_pad($services->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }} /
            {{ str_pad($services->total(), 2, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="card-body" style="display: flex; flex-direction: column;">
            <div>
                <span class="card-tag">{{ $service->category_tag }}</span>
                <h3 class="card-title">{{ $service->title }}</h3>
                <p class="card-desc">{{ $service->hero_lead }}</p>
            </div>
            
            <div style="margin-top: auto;">
                <div class="card-pills">
                    @if($service->hero_pills && is_array($service->hero_pills))
                    @foreach($service->hero_pills as $pill)
                        <span class="pill">{{ $pill }}</span>
                    @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('frontend.serviceDetail', $service->slug) }}" class="card-link">
                    Learn More
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                    </a>
                    <span class="availability"><span class="availability-dot"></span>Accepting</span>
                </div>
            </div>
        </div>
    </article>
@endforeach
