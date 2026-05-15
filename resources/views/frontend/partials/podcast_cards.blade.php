@foreach($podcasts as $podcast)
    <div class="podcast-row-card">
        <div class="podcast-img">
            <img src="{{ asset('storage/' . ($podcast->image ?? 'media/img1.avif')) }}" alt="{{ $podcast->title }}">
            @if($podcast->spotify_link || $podcast->apple_link)
            <a href="{{ $podcast->spotify_link ?? $podcast->apple_link }}" target="_blank" class="play-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 5v14l11-7z" />
                </svg>
            </a>
            @endif
        </div>
        <div class="podcast-info">
            <div class="podcast-meta-top">
                <span class="media-tag">{{ $podcast->episode_no }}</span>
                <span class="media-duration" style="display: inline-flex; align-items: center; gap: 5px;">
                <iconify-icon icon="solar:clock-circle-outline" style="font-size: 16px;"></iconify-icon>
                {{ is_numeric($podcast->duration) ? $podcast->duration . ' mins' : $podcast->duration }}
                </span>
            </div>
            <h3>{{ $podcast->title }}</h3>
            <div class="podcast-description-wrap">
                <p class="podcast-desc" data-full-text="{{ $podcast->description }}">
                {{ Str::limit($podcast->description, 120) }}
                </p>
                @if(strlen($podcast->description) > 120)
                <button class="read-more-btn" onclick="toggleReadMore(this)">Read More</button>
                @endif
            </div>

        </div>
    </div>
@endforeach
