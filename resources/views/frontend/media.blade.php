@extends('frontend.layouts.app')

@section('title', 'Media & Events | Dr. Yuvi')
@section('meta_description', 'Explore our latest podcast episodes, and feel-good community events at Dr. Yuvi.')

@section('content')

  <section class="media-hero-section reveal">
    <div class="media-hero-bg-wrap">
      @php 
        $bannerImg = $settings['media_banner_image'] ?? 'media/banner.avif';
        $bannerPath = str_contains($bannerImg, 'settings/') ? asset('storage/' . $bannerImg) : asset('assets/images/asset/' . $bannerImg);
        // Fallback to the original path if asset doesn't exist in assets/images
        if(!str_contains($bannerImg, 'settings/') && !file_exists(public_path('assets/images/asset/' . $bannerImg))) {
            $bannerPath = asset('storage/' . $bannerImg);
        }
      @endphp
      <img src="{{ $bannerPath }}" class="media-hero-bg" alt="Media and Events">
      <div class="media-hero-overlay"></div>
    </div>
    <div class="media-hero-content reveal">
      <div class="media-hero-eyebrow">
        <span class="hero-eyebrow-dot"></span> In The Spotlight
      </div>
      <h1>{!! nl2br(e($settings['media_banner_title'] ?? 'Stories, Science & Clinical Insights')) !!}</h1>
      <p>{{ $settings['media_banner_description'] ?? 'Exploring the intersection of modern reproductive medicine, community advocacy, and heartwarming patient journeys beyond the clinic walls.' }}</p>
      <div class="media-hero-actions">
        <a href="#podcasts" class="btn-hero-primary">Listen to Podcasts</a>
        <a href="#events" class="btn-hero-outline">View Events</a>
      </div>
    </div>
  </section>

  <!-- 2. PODCASTS SECTION -->
  <section id="podcasts" class="media-section bg-light-section reveal">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Expert <em>Podcasts</em></h2>
        <p>Tune in to insightful conversations on fertility, wellness, and medical breakthroughs.</p>
      </div>

      <div class="podcast-grid reveal delay-1" id="podcastGrid">
        @if($podcasts->isEmpty())
            <div class="col-12 text-center p-40">
                <p class="text-secondary">No podcast episodes available yet.</p>
            </div>
        @else
            @include('frontend.partials.podcast_cards', ['podcasts' => $podcasts])
        @endif
      </div>

      <!-- Pagination for Podcasts -> Load More -->
      @if($podcasts->hasMorePages())
      <div class="media-pagination reveal delay-2" id="podcastLoadMoreContainer" style="margin-top: 3rem;">
          <button class="btn-outline load-more-btn" data-target="podcastGrid" data-container="podcastLoadMoreContainer" data-param="podcasts_page" data-next-page="{{ $podcasts->currentPage() + 1 }}" style="padding: 12px 30px; font-weight: 600; cursor: pointer;">
              Load More Episodes
          </button>
      </div>
      @endif
    </div>
  </section>

  <!-- 3. FEEL GOOD EVENTS -->
  <section id="events" class="media-section reveal">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Feel Good <em>Events</em></h2>
        <p>Celebrating motherhood, patient milestones, and our dedicated team's outreach programs.</p>
      </div>

      <div class="events-gallery reveal delay-1" id="eventGrid">
        @if($events->isEmpty())
            <div class="col-12 text-center p-40">
                <p class="text-secondary">No events to display at the moment.</p>
            </div>
        @else
            @include('frontend.partials.event_cards', ['events' => $events])
        @endif
      </div>
      
      <!-- Pagination for Events -> Load More -->
      @if($events->hasMorePages())
      <div class="media-pagination reveal delay-2" id="eventLoadMoreContainer" style="margin-top: 3rem;">
          <button class="btn-outline load-more-btn" data-target="eventGrid" data-container="eventLoadMoreContainer" data-param="events_page" data-next-page="{{ $events->currentPage() + 1 }}" style="padding: 12px 30px; font-weight: 600; cursor: pointer;">
              Load More Events
          </button>
      </div>
      @endif
    </div>
  </section>

  <!-- 5. MEDIA HIGHLIGHTS (GALLERY) -->
  <section class="media-section reveal" style="padding-top: 0;">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Media <em>Highlights</em></h2>
        <p>A visual collection of clinical recognitions, press releases, and news appearances.</p>
      </div>

      <div class="highlights-gallery reveal delay-1" id="highlightGrid">
        @if($highlights->isEmpty())
            <div class="col-12 text-center p-40">
                <p class="text-secondary">No media highlights available.</p>
            </div>
        @else
            @include('frontend.partials.highlight_cards', ['highlights' => $highlights])
        @endif
      </div>

      <!-- Pagination -> Load More -->
      @if($highlights->hasMorePages())
      <div class="media-pagination reveal delay-2" id="highlightLoadMoreContainer" style="margin-top: 3rem;">
          <button class="btn-outline load-more-btn" data-target="highlightGrid" data-container="highlightLoadMoreContainer" data-param="highlights_page" data-next-page="{{ $highlights->currentPage() + 1 }}" style="padding: 12px 30px; font-weight: 600; cursor: pointer;">
              Load More Highlights
          </button>
      </div>
      @endif
    </div>
  </section>

  <style>
    /* Pagination Styles */
    .media-pagination {
      margin-top: 4rem;
      display: flex;
      justify-content: center;
    }

    .media-pagination .pagination {
      display: flex;
      gap: 0.8rem;
      list-style: none;
      padding: 0;
    }

    .media-pagination .page-item .page-link {
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: #fff;
      color: var(--midnight);
      border: 1px solid var(--card-border);
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .media-pagination .page-item.active .page-link {
      background: var(--midnight);
      color: #fff;
      border-color: var(--midnight);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .media-pagination .page-item:hover .page-link {
      background: var(--blue-light);
      transform: translateY(-2px);
    }

    .media-pagination .page-item.disabled .page-link {
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
  
  <!-- IMAGE LIGHTBOX (Reusable from Gallery) -->
  <div class="image-lightbox-sg" id="imageLightbox">
    <button class="close-lightbox-sg" onclick="closeImageLightbox()">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
    <div class="lightbox-content-sg">
      <img id="lightboxImg" src="" alt="Enlarged Media Highlight">
      <div class="lightbox-caption-sg">
        <span id="lightboxCategory"></span>
        <h3 id="lightboxTitle"></h3>
      </div>
    </div>
  </div>

  <style>
    html {
      scroll-behavior: smooth;
    }
    /* Gallery Styles */
    .highlights-gallery {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
      margin-top: 2rem;
    }

    @media (max-width: 991px) {
      .highlights-gallery {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .highlights-gallery {
        grid-template-columns: 1fr;
      }
    }

    .h-gallery-item {
      position: relative;
      background: #eee;
      border-radius: 16px;
      overflow: hidden;
      aspect-ratio: 16/9;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .h-gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .h-gallery-item:hover img {
      transform: scale(1.05);
    }

    .h-gallery-item iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .h-gallery-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 1.5rem;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
      color: #fff;
      font-size: 0.9rem;
      font-weight: 500;
      pointer-events: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>

  <style>
    /* Hero Banner Redesign */
    .media-hero-section {
      position: relative;
      height: 80vh;
      min-height: 600px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
      background: #000;
    }

    .media-hero-bg-wrap {
      position: absolute;
      inset: 0;
      z-index: 1;
    }

    .media-hero-bg {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      animation: heroZoom 20s infinite alternate linear;
    }

    @keyframes heroZoom {
      from {
        transform: scale(1);
      }

      to {
        transform: scale(1.1);
      }
    }

    .media-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom,
          rgba(0, 0, 0, 0.4) 0%,
          rgba(0, 0, 0, 0.2) 40%,
          rgba(0, 0, 0, 0.8) 100%);
      z-index: 2;
    }

    .media-hero-content {
      position: relative;
      z-index: 10;
      color: #fff;
      max-width: 900px;
      padding: 0 2rem;
    }

    .media-hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      margin-bottom: 2rem;
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #fff;
    }

    .hero-eyebrow-dot {
      width: 6px;
      height: 6px;
      background: var(--gold, #f9a215);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--gold);
    }

    .media-hero-content h1 {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(3rem, 7vw, 4rem);
      line-height: 1.05;
      margin-bottom: 1.5rem;

    }

    .media-hero-content h1 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: #fff;
      position: relative;
    }

    .media-hero-content p {
      font-family: 'DM Sans', sans-serif;
      font-size: 1.25rem;
      line-height: 1.7;
      color: rgba(255, 255, 255, 0.85);
      max-width: 700px;
      margin: 0 auto 3rem;
    }

    .media-hero-actions {
      display: flex;
      gap: 1.5rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-hero-primary {
      background: #fff;
      color: #000;
      padding: 1rem 2.2rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .btn-hero-primary:hover {
      background: var(--crimson);
      color: #fff;
      transform: translateY(-3px);
    }

    .btn-hero-outline {
      background: transparent;
      color: #fff;
      padding: 1rem 2.2rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s ease;
    }

    .btn-hero-outline:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: #fff;
      transform: translateY(-3px);
    }

    /* Common Section Styles */
    .media-section {
      padding: 6rem 0;
    }

    .bg-light-section {
      background: var(--bg-light, #fcfcfc);
    }

    .section-wrap {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .media-header {
      text-align: center;
      margin-bottom: 4rem;
    }

    .media-header h2 {
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      color: #111;
      margin-bottom: 1rem;
    }

    .media-header h2 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--crimson, #bc2b3d);
    }

    .media-header p {
      font-size: 1.1rem;
      color: #555;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Podcasts Grid / Row Setup */
    .podcast-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2.5rem;
    }

    @media (max-width: 991px) {
      .podcast-grid {
        grid-template-columns: 1fr;
      }
    }

    .podcast-row-card {
      display: flex;
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      min-height: 200px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .podcast-row-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .podcast-img {
      width: 40%;
      position: relative;
    }

    .podcast-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .play-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60px;
      height: 60px;
      background: rgba(255, 255, 255, 0.9);
      color: var(--crimson, #bc2b3d);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .podcast-row-card:hover .play-btn {
      background: var(--crimson, #bc2b3d);
      color: #fff;
      transform: translate(-50%, -50%) scale(1.1);
    }

    .podcast-info {
      width: 60%;
      padding: 2.5rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .podcast-meta-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    .media-tag {
      font-size: 0.8rem;
      color: var(--gold, #d4af37);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 700;
    }

    .media-duration {
      font-size: 0.8rem;
      color: #888;
      font-weight: 600;
    }

    .podcast-info h3 {
      font-size: 1.25rem;
      font-family: 'DM Serif Display', serif;
      margin-bottom: 0.6rem;
      color: #111;
      line-height: 1.3;
    }

    .podcast-info p {
      color: #666;
      line-height: 1.5;
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }

    .read-more-btn {
      background: none;
      border: none;
      color: var(--crimson, #bc2b3d);
      font-size: 0.8rem;
      font-weight: 700;
      padding: 0;
      cursor: pointer;
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .listen-link {
      font-size: 0.85rem;
      color: var(--crimson, #bc2b3d);
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      transition: 0.3s;
    }

    .listen-link:hover {
      transform: translateX(5px);
    }

    /* Events Gallery Upgrade */
    .events-gallery {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
    }

    @media (max-width: 991px) {
      .events-gallery {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .events-gallery {
        grid-template-columns: 1fr;
      }
    }

    .event-gallery-item {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      aspect-ratio: 4/3;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .event-gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
    }

    .event-gallery-item:hover img {
      transform: scale(1.05);
    }

    .event-gallery-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.4) 50%, transparent 100%);
      display: flex;
      align-items: flex-end;
      padding: 2.5rem;
      color: #fff;
      transition: background 0.3s ease;
    }

    .event-gallery-item:hover .event-gallery-overlay {
      background: linear-gradient(to top, rgba(188, 43, 61, 0.95) 0%, rgba(0, 0, 0, 0.5) 50%, transparent 100%);
    }

    .event-gallery-content {
      width: 100%;
    }

    .event-date {
      display: inline-block;
      background: var(--gold, #d4af37);
      color: #111;
      padding: 0.4rem 1rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 1rem;
    }

    .event-gallery-content h3 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
      line-height: 1.2;
    }

    .event-gallery-content p {
      font-size: 0.95rem;
      color: rgba(255, 255, 255, 0.8);
      margin: 0;
      line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .podcast-grid {
        grid-template-columns: 1fr;
      }
      .podcast-row-card {
        flex-direction: column;
      }
      .podcast-img {
        width: 100%;
        height: 250px;
      }
      .podcast-info {
        width: 100%;
        padding: 1.5rem;
      }
      .events-gallery {
        grid-template-columns: 1fr;
      }
    }
    @media (max-width: 767px) {
    .highlights-gallery {
        grid-template-columns: 1fr;
    }
}
  </style>

  <script>
    function openImageLightbox(el) {
        const img = el.querySelector('img').src;
        const caption = el.querySelector('.h-gallery-overlay span').innerText;
        
        document.getElementById('lightboxImg').src = img;
        document.getElementById('lightboxTitle').innerText = caption;
        document.getElementById('imageLightbox').classList.add('active');
    }

    function closeImageLightbox() {
        document.getElementById('imageLightbox').classList.remove('active');
    }

    function toggleReadMore(btn) {
        const wrap = btn.closest('.podcast-description-wrap');
        const desc = wrap.querySelector('.podcast-desc');
        const fullText = desc.getAttribute('data-full-text');
        const isExpanded = btn.innerText === 'READ LESS';

        if (isExpanded) {
            desc.innerText = fullText.substring(0, 120) + '...';
            btn.innerText = 'READ MORE';
        } else {
            desc.innerText = fullText;
            btn.innerText = 'READ LESS';
        }
    }

  </script>

@endsection