@extends('frontend.layouts.app')

@section('title', 'Meet Our Team | Dr. Yuvi')
@section('meta_description', 'Meet the dedicated doctors, nurses, and supporting staff working alongside Dr. Yuvraj Jadeja to provide exceptional fertility care.')

@section('content')

  <!-- TOP BANNER SLIDER (TEAM VERSION) -->
  <section class="top-banner-slider-con reveal">
    <div class="top-banner-track" id="topBannerTrack">
      <div class="top-banner-slide active">
        <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Team Excellence">
      </div>
      <div class="top-banner-slide">
        <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Clinical Specialists">
      </div>
      <div class="top-banner-slide">
        <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Compassionate Care">
      </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="top-banner-nav">
      <button class="top-banner-btn prev" id="topBannerPrev" aria-label="Previous">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
      </button>
      <button class="top-banner-btn next" id="topBannerNext" aria-label="Next">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </button>
    </div>

    <!-- Hero Content Overlay -->
    <div class="team-banner-overlay">
      <div class="team-hero-content reveal">
        <div class="team-hero-eyebrow">
          <span class="hero-eyebrow-dot"></span>
          Clinical Excellence · Expert Care
        </div>
        <h1>The Dedicated Team<br>Behind <em>Dr. Yuvi</em></h1>
        <p>A collective of brilliant minds and compassionate hearts, dedicated to guiding you toward your dream of
          parenthood.</p>
        <div class="team-hero-actions">
          <a href="{{ route('frontend.contact') }}" class="btn-hero-primary">
            Join Our Journey
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. DOCTORS SECTION -->
  <section class="team-category-section reveal" style="background: var(--bg-light, #fcfcfc);">
    <div class="section-wrap">
      <div class="team-category-header reveal">
        <h2>Our <em>Doctors</em></h2>
        <p>Expert specialists leading the way in evidence-based reproductive medicine.</p>
      </div>

      <div class="premium-team-grid reveal delay-1">
        <!-- Doctor Card 1 -->
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Dr. Aditi Sharma</h3>
            <span class="pt-role">Senior IVF Consultant</span>
            <p>M.S. (Ob/Gyn), Fellowship in Reproductive Medicine.</p>
          </div>
        </div>
        <!-- Doctor Card 2 -->
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Dr. Rohan Desai</h3>
            <span class="pt-role">Clinical Embryologist</span>
            <p>Ph.D. in Clinical Embryology. Specializes in advanced ICSI.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. NURSES SECTION -->
  <section class="team-category-section reveal">
    <div class="section-wrap">
      <div class="team-category-header reveal">
        <h2>Compassionate <em>Nurses</em></h2>
        <p>The backbone of our patient care, offering emotional and medical support round the clock.</p>
      </div>

      <div class="premium-team-grid reveal delay-1">
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Priya Verma</h3>
            <span class="pt-role">Head Fertility Nurse</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Meera Patel</h3>
            <span class="pt-role">Patient Coordinator & Nurse</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Sneha Rao</h3>
            <span class="pt-role">OT Charge Nurse</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. SUPPORTING STAFF SECTION -->
  <section class="team-category-section reveal" style="background: var(--bg-light, #fcfcfc);">
    <div class="section-wrap">
      <div class="team-category-header reveal">
        <h2>Supporting <em>Staff</em></h2>
        <p>Ensuring a seamless, comfortable, and organized experience for every patient.</p>
      </div>

      <div class="premium-team-grid support-grid reveal delay-1">
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Amit Joshi</h3>
            <span class="pt-role">Clinic Manager</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Kavya Singh</h3>
            <span class="pt-role">Front Desk Executive</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Rahul Mehta</h3>
            <span class="pt-role">Financial Counselor</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="{{ asset('storage/placeholder/placeholder.png') }}" alt="Placeholder">
          </div>
          <div class="pt-info">
            <h3>Deepa Nair</h3>
            <span class="pt-role">Wellness & Diet Counselor</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. JOIN US (Fellowship & Openings) -->
  <section class="team-join-section reveal">
    <div class="section-wrap">
      <div class="join-grid">

        <!-- Fellowship Program -->
        <div class="join-box reveal">
          <div class="join-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--gold, #d4af37)" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
              <path d="M6 12v5c3 3 9 3 12 0v-5" />
            </svg>
          </div>
          <h2>Fellowship <br><em>Program</em></h2>
          <p>We are committed to shaping the future of reproductive medicine. Our prestigious fellowship program offers
            hands-on training in ART, endoscopy, and clinical embryology under the direct mentorship of Dr. Yuvi.</p>
          <a href="{{ route('frontend.contact') }}" class="btn-primary-dark">Apply for Fellowship &rarr;</a>
        </div>

        <!-- New Openings -->
        <div class="join-box reveal delay-1">
          <div class="join-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--crimson, #bc2b3d)" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <line x1="19" y1="8" x2="19" y2="14" />
              <line x1="22" y1="11" x2="16" y2="11" />
            </svg>
          </div>
          <h2>New <br><em>Openings</em></h2>
          <p>Join a workplace that values ethics, science, and empathy. We are always looking for passionate nurses,
            coordinators, and medical professionals to expand our family.</p>
          <a href="{{ route('frontend.contact') }}" class="btn-outline-dark">View Open Roles &rarr;</a>
        </div>

      </div>
    </div>
  </section>

  <style>
    /* Top Banner Slider Scoped Styles */
    .top-banner-slider-con {
      width: 100%;
      height: 80vh;
      position: relative;
      overflow: hidden;
      background: #000;
    }

    .top-banner-track {
      width: 100%;
      height: 100%;
      position: relative;
      display: flex;
      transition: transform 1s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    .top-banner-slide {
      flex: 0 0 100%;
      width: 100%;
      height: 100%;
      position: relative;
    }

    .top-banner-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    .top-banner-nav {
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      transform: translateY(-50%);
      z-index: 10;
      display: flex;
      justify-content: space-between;
      padding: 0 2rem;
      pointer-events: none;
    }

    .top-banner-btn {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      pointer-events: auto;
    }

    .top-banner-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.1);
    }

    /* Content Overlay */
    .team-banner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.7) 100%);
      z-index: 5;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .team-hero-content {
      position: relative;
      z-index: 6;
      color: #fff;
      max-width: 850px;
      padding: 0 5%;
    }

    .team-hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255, 255, 255, 0.07);
      color: #fff;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 0.4rem 1.2rem;
      border-radius: 50px;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-eyebrow-dot {
      width: 6px;
      height: 6px;
      background: #fff;
      border-radius: 50%;
    }

    .team-hero-content h1 {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(3.5rem, 6vw, 4rem);
      line-height: 1.1;
      margin-bottom: 1.5rem;

    }

    .team-hero-content h1 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--crimson-dark, #b92f38);
    }

    .team-hero-content p {
      font-size: 1.25rem;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.9);
      max-width: 650px;
      margin: 0 auto 2.5rem;
    }

    .team-hero-actions {
      display: flex;
      justify-content: center;
    }

    /* Primary Button Style from Style.css */
    .btn-hero-primary {
      background: var(--crimson, #db454e);
      color: #fff;
      padding: 1.1rem 2.2rem;
      border-radius: 50px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
      text-decoration: none;
      box-shadow: 0 10px 30px rgba(219, 69, 78, 0.3);
    }

    .btn-hero-primary:hover {
      background: var(--crimson-dark, #b92f38);
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(219, 69, 78, 0.4);
      color: #fff;
    }

    /* Category Sections */
    .team-category-section {
      padding: 6rem 0;
    }

    .section-wrap {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .team-category-header {
      text-align: center;
      margin-bottom: 4rem;
    }

    .team-category-header h2 {
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      color: #111;
      margin-bottom: 1rem;
    }

    .team-category-header h2 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--gold, #d4af37);
    }

    .team-category-header p {
      font-size: 1.1rem;
      color: #555;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Premium Team Grids & Cards */
    .premium-team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 3rem 2rem;
    }

    .support-grid {
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }

    .premium-team-card {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .pt-img-wrap {
      width: 100%;
      aspect-ratio: 3/4;
      overflow: hidden;
      border-radius: 12px;
      background: #eaeaea;
      position: relative;
    }

    .pt-img-wrap::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 30%;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.05), transparent);
      pointer-events: none;
    }

    .pt-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .premium-team-card:hover .pt-img-wrap img {
      transform: scale(1.05);
    }

    .pt-info {
      text-align: center;
    }

    .pt-info h3 {
      font-size: 1.4rem;
      font-family: 'DM Serif Display', serif;
      color: #111;
      margin-bottom: 0.3rem;
    }

    .pt-role {
      display: block;
      font-size: 0.85rem;
      color: var(--crimson, #bc2b3d);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 600;
      margin-bottom: 0.8rem;
    }

    .pt-info p {
      font-size: 0.95rem;
      color: #666;
      line-height: 1.5;
      margin: 0;
    }

    /* Join Us Section */
    .team-join-section {
      padding: 6rem 0;
      background: #111;
      color: #fff;
    }

    .join-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
    }

    .join-box {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 4rem 3rem;
      border-radius: 16px;
      transition: background 0.3s ease;
    }

    .join-box:hover {
      background: rgba(255, 255, 255, 0.06);
    }

    .join-icon {
      margin-bottom: 2rem;
    }

    .join-box h2 {
      font-size: 2.5rem;
      line-height: 1.1;
      margin-bottom: 1.5rem;
      color: #fff;
    }

    .join-box h2 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--gold, #d4af37);
    }

    .join-box p {
      font-size: 1.1rem;
      color: #bbb;
      line-height: 1.6;
      margin-bottom: 2.5rem;
    }

    .btn-outline-dark {
      display: inline-block;
      padding: 0.8rem 2rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-outline-dark:hover {
      background: #fff;
      color: #111;
    }

    /* Responsive */
    /* Tablets (Landscape & Portrait) */
    @media (min-width: 601px) and (max-width: 991px) {
      .join-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .join-box {
        padding: 3rem 2rem;
      }

      .join-box h2 {
        font-size: 2.2rem;
      }

      .top-banner-slider-con {
        height: 60vh;
      }

      .top-banner-nav {
        padding: 0 1rem;
      }

      .top-banner-btn {
        width: 40px;
        height: 40px;
      }
    }

    /* Mobile Devices */
    @media (max-width: 600px) {
      .join-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .join-box {
        padding: 2.5rem 1.5rem;
      }

      .join-box h2 {
        font-size: 1.8rem;
      }

      .join-box p {
        font-size: 1rem;
      }

      .team-category-section {
        padding: 4rem 0;
      }

      .premium-team-grid {
        gap: 2rem;
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const track = document.getElementById('topBannerTrack');
      const originalSlides = Array.from(document.querySelectorAll('#topBannerTrack .top-banner-slide'));
      const prevBtn = document.getElementById('topBannerPrev');
      const nextBtn = document.getElementById('topBannerNext');
      if (!track || originalSlides.length < 2) return;

      // Clone first and last for infinite effect
      const firstClone = originalSlides[0].cloneNode(true);
      const lastClone = originalSlides[originalSlides.length - 1].cloneNode(true);
      track.appendChild(firstClone);
      track.insertBefore(lastClone, originalSlides[0]);

      const allSlides = document.querySelectorAll('#topBannerTrack .top-banner-slide');
      let currentIdx = 1; // Start at first original slide
      let isTransitioning = false;

      // Initialize position
      track.style.transition = 'none';
      track.style.transform = `translateX(-100%)`;

      function showSlide(index, animate = true) {
        if (isTransitioning) return;
        isTransitioning = true;

        if (animate) {
          track.style.transition = 'transform 1s cubic-bezier(0.645, 0.045, 0.355, 1)';
        } else {
          track.style.transition = 'none';
        }

        track.style.transform = `translateX(-${index * 100}%)`;
        currentIdx = index;
      }

      track.addEventListener('transitionend', () => {
        isTransitioning = false;
        // If at last clone, jump to first real slide
        if (currentIdx === allSlides.length - 1) {
          track.style.transition = 'none';
          currentIdx = 1;
          track.style.transform = `translateX(-100%)`;
        }
        // If at first clone, jump to last real slide
        if (currentIdx === 0) {
          track.style.transition = 'none';
          currentIdx = allSlides.length - 2;
          track.style.transform = `translateX(-${currentIdx * 100}%)`;
        }
      });

      function nextSlide() {
        if (isTransitioning) return;
        showSlide(currentIdx + 1);
      }

      function prevSlide() {
        if (isTransitioning) return;
        showSlide(currentIdx - 1);
      }

      let slideInterval = setInterval(nextSlide, 5000);

      function resetAutoSlide() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
          nextSlide();
          resetAutoSlide();
        });
      }

      if (prevBtn) {
        prevBtn.addEventListener('click', () => {
          prevSlide();
          resetAutoSlide();
        });
      }
    });
  </script>

@endsection