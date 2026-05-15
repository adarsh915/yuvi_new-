@foreach($highlights as $highlight)
    <div class="h-gallery-item" @if($highlight->type == 'image') onclick="openImageLightbox(this)" @else onclick="window.open('{{ $highlight->video_url }}', '_blank')" @endif style="cursor: pointer;">
        <img src="{{ asset('storage/' . ($highlight->image ?? 'media/img6.avif')) }}" alt="{{ $highlight->title }}">
        <div class="h-gallery-overlay">
        <span>{{ $highlight->title }}</span>
        @if($highlight->type == 'video')
            <iconify-icon icon="solar:play-circle-bold" class="ms-2" style="font-size: 20px; vertical-align: middle;"></iconify-icon>
        @endif
        </div>
    </div>
@endforeach
