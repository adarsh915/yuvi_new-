@foreach($stories as $story)
    <div class="story-page-card reveal" data-category="{{ Str::slug($story->treatmentType->name ?? 'General') }}">
    <div class="story-page-video-wrap">
        @if(Str::endsWith($story->video_url, ['.mp4', '.webm', '.ogg']))
        <video autoplay loop muted playsinline class="story-short-video">
            <source src="{{ $story->video_url }}" type="video/mp4">
        </video>
        @else
        {{-- Append controls=0 to YouTube/Vimeo embeds --}}
        @php
            $url = $story->video_url;
            if (str_contains($url, '?')) {
            if (!str_contains($url, 'controls='))
                $url .= '&controls=0';
            } else {
            $url .= '?controls=0';
            }
            // Force modest branding and no related videos
            $url .= '&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3';
        @endphp
        <iframe src="{{ $url }}" loading="lazy" allow="autoplay; encrypted-media" allowfullscreen
            title="{{ $story->title }}"></iframe>
        @endif
        <div class="story-page-overlay">
        <span class="story-page-patient-name">{{ $story->patient_name ?? $story->title }}</span>
        <span class="story-page-treatment-tag">{{ $story->treatmentType->name ?? 'Success Story' }}</span>
        </div>
    </div>
    </div>
@endforeach
