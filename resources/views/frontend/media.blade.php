@extends('frontend.layouts.app')

@section('title', 'Media & Events | Dr. Yuvi')
@section('meta_description', 'Explore our latest podcast episodes, and feel-good community events at Dr. Yuvi.')

@section('content')

  <!-- 1. TOP BANNER -->
  <section class="media-hero-section">
    <!-- Premium lifestyle/media stock image -->
    <img src="https://images.unsplash.com/photo-1551818255-e6e10975bc17?auto=format&fit=crop&q=80&w=2000"
      class="media-hero-bg" alt="Media and Events">
    <div class="media-hero-overlay"></div>
    <div class="media-hero-content reveal">
      <div class="media-hero-eyebrow">
        <span class="hero-eyebrow-dot"></span> In The Spotlight
      </div>
      <h1>Media & <br><em>Events</em></h1>
      <p>Dive into our world of expert podcasts and heartwarming community events. <br>Discover the stories beyond the clinic walls.</p>
    </div>
  </section>

  <!-- 2. PODCASTS SECTION -->
  <section class="media-section bg-light-section">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Expert <em>Podcasts</em></h2>
        <p>Tune in to insightful conversations on fertility, wellness, and medical breakthroughs.</p>
      </div>

      <div class="podcast-grid reveal delay-1">
        <!-- Podcast Item 1 -->
        <div class="podcast-row-card">
          <div class="podcast-img">
            <img src="https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&q=80&w=600"
              alt="Podcast Episode">
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
            <img src="https://images.unsplash.com/photo-1589903308904-1010c2294adc?auto=format&fit=crop&q=80&w=600"
              alt="Podcast Episode">
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
  <section class="media-section">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Feel Good <em>Events</em></h2>
        <p>Celebrating motherhood, patient milestones, and our dedicated team's outreach programs.</p>
      </div>

      <div class="events-gallery reveal delay-1">
        <div class="event-gallery-item">
          <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&q=80&w=800"
            alt="Mother's Day Meetup">
          <div class="event-gallery-overlay">
            <div class="event-gallery-content">
              <span class="event-date">March 2026</span>
              <h3>Annual Mother's Day Meetup</h3>
              <p>A beautiful gathering of our successful IVF mothers sharing their journeys.</p>
            </div>
          </div>
        </div>

        <div class="event-gallery-item">
          <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&q=80&w=600"
            alt="Community Camp">
          <div class="event-gallery-overlay">
            <div class="event-gallery-content">
              <span class="event-date">Feb 2026</span>
              <h3>Community Health Camp</h3>
              <p>Providing free fertility consultations and awareness in rural areas.</p>
            </div>
          </div>
        </div>

        <div class="event-gallery-item">
          <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&q=80&w=600"
            alt="Team Awards">
          <div class="event-gallery-overlay">
            <div class="event-gallery-content">
              <span class="event-date">Jan 2026</span>
              <h3>Team Excellence Awards</h3>
              <p>Celebrating the hard work and dedication of our incredible clinic staff.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. MEDIA HIGHLIGHTS (GALLERY) -->
  <section class="media-section" style="padding-top: 0;">
    <div class="section-wrap">
      <div class="media-header reveal">
        <h2>Media <em>Highlights</em></h2>
        <p>A visual collection of clinical recognitions, press releases, and news appearances.</p>
      </div>

      <div class="highlights-gallery reveal delay-1">
        <!-- Item 1: Image -->
        <div class="h-gallery-item">
          <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=800" alt="News Feature">
          <div class="h-gallery-overlay">
            <span>Press Clipping: Health Times</span>
          </div>
        </div>

        <!-- Item 2: Video -->
        <div class="h-gallery-item">
          <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?controls=0&modestbranding=1&rel=0" allowfullscreen></iframe>
        </div>

        <!-- Item 3: Image -->
        <div class="h-gallery-item">
          <img src="https://images.unsplash.com/photo-1585829365294-4cc046252058?auto=format&fit=crop&q=80&w=800" alt="Press Release">
          <div class="h-gallery-overlay">
            <span>Global Medical Journal Feature</span>
          </div>
        </div>

        <!-- Item 4: Image -->
        <div class="h-gallery-item">
          <img src="https://images.unsplash.com/photo-1557425955-df376b5903c8?auto=format&fit=crop&q=80&w=800" alt="Clinic News">
          <div class="h-gallery-overlay">
            <span>National Health Network</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
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
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
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
      background: linear-gradient(transparent, rgba(0,0,0,0.8));
      color: #fff;
      font-size: 0.9rem;
      font-weight: 500;
      pointer-events: none;
    }
  </style>

  <style>
    /* Hero Banner */
    .media-hero-section {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
    }

    .media-hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      z-index: 1;
      transform: scale(1.02);
    }

    .media-hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.75) 100%);
      z-index: 2;
    }

    .media-hero-content {
      position: relative;
      z-index: 4;
      color: #fff;
      max-width: 850px;
      padding: 0 5%;
    }

    .media-hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(8px);
      color: #fff;
      padding: 0.4rem 1.2rem;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-eyebrow-dot {
      width: 6px;
      height: 6px;
      background: #fff;
      border-radius: 50%;
    }

    .media-hero-content h1 {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(3.5rem, 6vw, 5rem);
      line-height: 1.1;
      margin-bottom: 1.5rem;
      font-weight: 400;
    }

    .media-hero-content h1 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--crimson-dark, #bc2b3d);
    }

    .media-hero-content p {
      font-size: 1.25rem;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.9);
      max-width: 650px;
      margin: 0 auto;
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
    @media (max-width: 900px) {
      .podcast-grid {
        grid-template-columns: 1fr;
      }

      .events-gallery {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 600px) {
      .media-hero-section {
        min-height: 450px;
      }

      .media-section {
        padding: 4rem 0;
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
  </style>

@endsection