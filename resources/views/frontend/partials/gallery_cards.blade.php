@foreach($galleries as $index => $gallery)
    <div class="gallery-item-sg reveal {{ $index % 3 == 1 ? 'delay-1' : ($index % 3 == 2 ? 'delay-2' : '') }}" onclick="openImageLightbox(this)">
    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" loading="lazy">
    <div class="gallery-overlay-sg">
        <div class="overlay-content-sg">
        <span>{{ $gallery->subtitle }}</span>
        <h3>{{ $gallery->title }}</h3>
        </div>
    </div>
    </div>
@endforeach
