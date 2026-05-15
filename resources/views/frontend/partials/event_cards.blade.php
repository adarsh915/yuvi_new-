@foreach($events as $event)
    <a href="{{ $event->link ?? '#' }}" class="event-gallery-item">
        <img src="{{ asset('storage/' . ($event->image ?? 'media/img3.avif')) }}" alt="{{ $event->title }}">
        <div class="event-gallery-overlay">
        <div class="event-gallery-content">
            <span class="event-date">{{ $event->date_text }}</span>
            <h3>{{ $event->title }}</h3>
            <p>{{ $event->description }}</p>
        </div>
        </div>
    </a>
@endforeach
