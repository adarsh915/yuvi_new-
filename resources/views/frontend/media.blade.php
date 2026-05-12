@extends('frontend.layouts.app')

@section('title', 'Media & Events | Dr. Yuvi')
@section('meta_description', 'Explore our latest podcast episodes, and feel-good community events at Dr. Yuvi.')

@section('content')

  <section class="media-hero-section reveal">
    <div class="media-hero-bg-wrap">
      <img src="{{ asset('storage/media/banner.avif') }}" class="media-hero-bg" alt="Media and Events">
      <div class="media-hero-overlay"></div>
    </div>
    <div class="media-hero-content reveal">
      <div class="media-hero-eyebrow">
        <span class="hero-eyebrow-dot"></span> In The Spotlight
      </div>
      <h1>Stories, Science & <br><em>Clinical Insights</em></h1>
      <p>Exploring the intersection of modern reproductive medicine, community advocacy, and heartwarming patient journeys
        beyond the clinic walls.</p>
      <div class="media-hero-actions">
        <a href="#podcasts" class="btn-hero-primary">Listen to Podcasts</a>
        <a href="#events" class="btn-hero-outline">View Events</a>
      </div>
    </div>
    <!-- <div class="media-scroll-down">
                      <span class="scroll-text">Scroll to explore</span>
                      <div class="scroll-line"></div>
                    </div> -->
  </section>

  <!-- 2. PODCASTS SECTION -->
  <section id="podcasts" class="media-section bg-light-section reveal">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Expert <em>Podcasts</em></h2>
        <p>Tune in to insightful conversations on fertility, wellness, and medical breakthroughs.</p>
      </div>

      <div class="podcast-grid reveal delay-1">
        <!-- Podcast Item 1 -->
        <div class="podcast-row-card">
          <div class="podcast-img">
            <img src="{{ asset('storage/media/img1.avif') }}" alt="Podcast Episode">
            <div class="play-btn">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 5v14l11-7z" />
              </svg>
            </div>
          </div>
          <div class="podcast-info">
            <div class="podcast-meta-top">
              <span class="media-tag">Episode 12</span>
              <span class="media-duration">45 mins</span>
            </div>
            <h3>Navigating IVF: Myths vs Facts</h3>
            <p>An in-depth conversation unraveling common misconceptions about IVF, embryo freezing, and success rates.
            </p>
            <a href="#" class="listen-link">Listen on Spotify &rarr;</a>
          </div>
        </div>

        <!-- Podcast Item 2 -->
        <div class="podcast-row-card">
          <div class="podcast-img">
            <img src="{{ asset('storage/media/img2.avif') }}" alt="Podcast Episode">
            <div class="play-btn">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 5v14l11-7z" />
              </svg>
            </div>
          </div>
          <div class="podcast-info">
            <div class="podcast-meta-top">
              <span class="media-tag">Episode 11</span>
              <span class="media-duration">38 mins</span>
            </div>
            <h3>PCOS and Fertility Outcomes</h3>
            <p>Dr. Yuvi explains the impact of PCOS on conception and actionable lifestyle changes to improve fertility.
            </p>
            <a href="#" class="listen-link">Listen on Apple Podcasts &rarr;</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. FEEL GOOD EVENTS -->
  <section id="events" class="media-section reveal">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Feel Good <em>Events</em></h2>
        <p>Celebrating motherhood, patient milestones, and our dedicated team's outreach programs.</p>
      </div>

      <div class="events-gallery reveal delay-1">
        <a href="#" class="event-gallery-item">
          <img src="{{ asset('storage/media/img3.avif') }}" alt="Mother's Day Meetup">
          <div class="event-gallery-overlay">
            <div class="event-gallery-content">
              <span class="event-date">March 2026</span>
              <h3>Annual Mother's Day Meetup</h3>
              <p>A beautiful gathering of our successful IVF mothers sharing their journeys.</p>
            </div>
          </div>
        </a>

        <a href="#" class="event-gallery-item">
          <img src="{{ asset('storage/media/img4.avif') }}" alt="Community Camp">
          <div class="event-gallery-overlay">
            <div class="event-gallery-content">
              <span class="event-date">Feb 2026</span>
              <h3>Community Health Camp</h3>
              <p>Providing free fertility consultations and awareness in rural areas.</p>
            </div>
          </div>
        </a>

        <a href="#" class="event-gallery-item">
          <img src="{{ asset('storage/media/img6.avif') }}" alt="Team Awards">
          <div class="event-gallery-overlay">
            <div class="event-gallery-content">
              <span class="event-date">Jan 2026</span>
              <h3>Team Excellence Awards</h3>
              <p>Celebrating the hard work and dedication of our incredible clinic staff.</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- 5. MEDIA HIGHLIGHTS (GALLERY) -->
  <section class="media-section reveal" style="padding-top: 0;">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Media <em>Highlights</em></h2>
        <p>A visual collection of clinical recognitions, press releases, and news appearances.</p>
      </div>

      <div class="highlights-gallery reveal delay-1">
        <!-- Item 1: Image -->
        <div class="h-gallery-item" onclick="openImageLightbox(this)" style="cursor: pointer;">
          <img src="{{ asset('storage/media/img6.avif') }}" alt="News Feature">
          <div class="h-gallery-overlay">
            <span>Press Clipping: Health Times</span>
          </div>
        </div>

        <!-- Item 2: Video -->
        <div class="h-gallery-item" onclick="openImageLightbox(this)" style="cursor: pointer;">
          <img src="{{ asset('storage/media/img6.avif') }}" alt="Press Release">
          <div class="h-gallery-overlay">
            <span>Global Medical Journal Feature</span>
          </div>
        </div>

        <!-- Item 3: Image -->
        <div class="h-gallery-item" onclick="openImageLightbox(this)" style="cursor: pointer;">
          <img src="{{ asset('storage/media/img6.avif') }}" alt="Press Release">
          <div class="h-gallery-overlay">
            <span>Global Medical Journal Feature</span>
          </div>
        </div>

        <!-- Item 4: Image -->
        <div class="h-gallery-item" onclick="openImageLightbox(this)" style="cursor: pointer;">
          <img src="{{ asset('storage/media/img6.avif') }}" alt="Clinic News">
          <div class="h-gallery-overlay">
            <span>National Health Network</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  
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
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
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

    /* Scroll Down Indicator */
    .media-scroll-down {
      position: absolute;
      bottom: 3rem;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .scroll-text {
      font-size: 0.65rem;
      color: rgba(255, 255, 255, 0.5);
      text-transform: uppercase;
      letter-spacing: 3px;
      font-weight: 700;
    }

    .scroll-line {
      width: 1px;
      height: 60px;
      background: linear-gradient(to bottom, #fff, transparent);
      animation: scrollLine 2s infinite;
    }

    @keyframes scrollLine {
      0% {
        transform: scaleY(0);
        transform-origin: top;
      }

      50% {
        transform: scaleY(1);
        transform-origin: top;
      }

      50.1% {
        transform: scaleY(1);
        transform-origin: bottom;
      }

      100% {
        transform: scaleY(0);
        transform-origin: bottom;
      }
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
      grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
      gap: 2.5rem;
    }

    .podcast-row-card {
      display: flex;
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      min-height: 320px;
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
      font-size: 1.6rem;
      font-family: 'DM Serif Display', serif;
      margin-bottom: 0.8rem;
      color: #111;
      line-height: 1.3;
    }

    .podcast-info p {
      color: #666;
      line-height: 1.5;
      font-size: 0.95rem;
      margin-bottom: 1.5rem;
    }

    .listen-link {
      font-size: 0.95rem;
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
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 2rem;
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
    /* Large Tablets & Small Laptops */
    @media (min-width: 992px) and (max-width: 1199px) {
      .podcast-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
      }
    }

    /* Standard Tablets (Landscape & Portrait) */
    @media (min-width: 601px) and (max-width: 991px) {
      .podcast-grid {
        grid-template-columns: 1fr;
      }

      .events-gallery {
        grid-template-columns: 1fr 1fr;
      }

      .media-hero-section {
        min-height: 60vh;
      }

    }

    /* Mobile Devices */
    @media (max-width: 600px) {
      .media-hero-section {
        min-height: 450px;
      }

      .media-section {
        padding: 4rem 0;
      }

      .podcast-row-card {
        flex-direction: column;
        min-height: auto;
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
        gap: 1.5rem;
      }

      .event-gallery-item {
        aspect-ratio: 1/1;
        /* Square aspect ratio on mobile for more vertical space */
      }

      .event-gallery-overlay {
        padding: 1.5rem;
        /* Reduced padding on mobile */
      }

      .event-gallery-content h3 {
        font-size: 1.4rem;
        /* Smaller heading on mobile */
      }

      .event-gallery-content p {
        font-size: 0.85rem;
        /* Smaller description on mobile */
        opacity: 0.9;
      }

      .event-date {
        padding: 0.3rem 0.8rem;
        font-size: 0.65rem;
        margin-bottom: 0.75rem;
      }

      /* Highlights Gallery Mobile Fix */
      .h-gallery-item {
        aspect-ratio: 3/2;
        /* Taller aspect ratio on mobile */
      }

      .h-gallery-overlay {
        padding: 1.2rem;
        font-size: 0.85rem;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
      }

      .highlights-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
      }

      .podcast-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
        gap: 2.5rem;
      }

    }
  </style>

@endsection