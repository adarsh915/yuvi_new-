<!-- HERO -->
@extends('frontend.layouts.app')

@section('title', 'Home Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

@section('content')
  <!-- TOP BANNER SLIDER -->
  <section class="top-banner-slider-con">
    <div class="top-banner-track" id="topBannerTrack">
      <div class="top-banner-slide active">
        <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&q=80&w=2000"
          alt="Medical Excellence">
      </div>
      <div class="top-banner-slide">
        <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&q=80&w=2000"
          alt="Advanced Care">
      </div>
      <div class="top-banner-slide">
        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=2000"
          alt="Patient Support">
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
  </section>

  <section class="value-scroll-section reveal">
    <div class="value-scroll-inner">
      <div class="value-scroll-container" id="valueScrollContainer">

        <!-- Card 1 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
          </div>
          <h3 class="v-card-title">ETHICAL PRACTICE</h3>
          <p class="v-card-text">No unnecessary procedures. Honest and transparent care.</p>
        </div>

        <!-- Card 2 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </div>
          <h3 class="v-card-title">DIAGNOSIS FIRST</h3>
          <p class="v-card-text">No assumptions. Full clarity before moving forward.</p>
        </div>

        <!-- Card 3 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
              </path>
            </svg>
          </div>
          <h3 class="v-card-title">HOLISTIC SUPPORT</h3>
          <p class="v-card-text">Science, technology, and emotional support unified.</p>
        </div>

        <!-- Card 4 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 11 12 14 22 4"></polyline>
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
          </div>
          <h3 class="v-card-title">EVIDENCE BASED</h3>
          <p class="v-card-text">Implementing the latest, globally recognized clinical protocols.</p>
        </div>

        <!-- Card 5 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </div>
          <h3 class="v-card-title">PATIENT FIRST</h3>
          <p class="v-card-text">Compassionate care accompanying you at every step.</p>
        </div>

        <!-- Card 6 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
              <line x1="8" y1="21" x2="16" y2="21"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>
          </div>
          <h3 class="v-card-title">ADVANCED LAB</h3>
          <p class="v-card-text">State-of-the-art embryology and surgical setups.</p>
        </div>

        <!-- Card 7 -->
        <div class="value-scroll-card">
          <div class="v-card-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
          </div>
          <h3 class="v-card-title">24x7 SUPPORT</h3>
          <p class="v-card-text">Always here when needed. Unwavering medical assistance.</p>
        </div>

      </div>

      <!-- Scroll Dots -->
      <div class="value-scroll-dots">
        <button class="value-dot active" onclick="scrollValue(0)" aria-label="Go to slide 1"></button>
        <button class="value-dot" onclick="scrollValue(1)" aria-label="Go to slide 2"></button>
        <button class="value-dot" onclick="scrollValue(2)" aria-label="Go to slide 3"></button>
        <button class="value-dot" onclick="scrollValue(3)" aria-label="Go to slide 4"></button>
        <button class="value-dot" onclick="scrollValue(4)" aria-label="Go to slide 5"></button>
        <button class="value-dot" onclick="scrollValue(5)" aria-label="Go to slide 6"></button>
        <button class="value-dot" onclick="scrollValue(6)" aria-label="Go to slide 7"></button>
      </div>
    </div>
  </section>

  <style>
    .top-banner-slider-con {
      width: 100%;
      height: 100vh;
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

    @media (max-width: 768px) {
      .top-banner-slider-con {
        height: 100vh;
      }

      .top-banner-nav {
        padding: 0 1rem;
      }

      .top-banner-btn {
        width: 40px;
        height: 40px;
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const track = document.getElementById('topBannerTrack');
      const slides = document.querySelectorAll('#topBannerTrack .top-banner-slide');
      const prevBtn = document.getElementById('topBannerPrev');
      const nextBtn = document.getElementById('topBannerNext');
      if (!track || slides.length < 2) return;

      let currentIdx = 0;
      let slideInterval;

      function showSlide(index) {
        track.style.transform = `translateX(-${index * 100}%)`;
        currentIdx = index;
      }

      function nextSlide() {
        let nextIdx = (currentIdx + 1) % slides.length;
        showSlide(nextIdx);
      }

      function prevSlide() {
        let prevIdx = (currentIdx - 1 + slides.length) % slides.length;
        showSlide(prevIdx);
      }

      function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000);
      }

      function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
      }

      // Button listeners
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

      // Initial start
      startAutoSlide();
    });
  </script>

  <section class="hero-box5">
    <div class="hero-glow-1_box5"></div>
    <div class="hero-glow-2_box5"></div>
    <div class="hero-inner-box5">
      <div class="hero-left-box5 reveal-box5 reveal delay-2">
        <div class="hero-eyebrow-box5">
          <span class="hero-eyebrow-dot-box5"></span>
          Ethical Fertility Care · Ahmedabad
        </div>
        <h1>Science, Sensitivity<br>&amp; <em>Ethics</em><br>in Fertility.</h1>
        <p class="hero-lead-box5">Evidence-based fertility and women's health — designed precisely around you, your hopes,
          and your future family.</p>
        <div class="hero-actions-box5">
          <a href="{{ route('frontend.contact') }}" class="btn-hero-primary">
            Book Consultation
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
          <a href="{{ route('frontend.services') }}" class="btn-hero-ghost">
            Explore Services
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>
        <!-- <div class="hero-trust-box5">
                                  <div class="hero-trust-item-box5">
                                    <div class="hero-trust-icon-box5">
                                      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="rgba(79,132,174,0.9)" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                      </svg>
                                    </div>
                                    Ethics-led practice
                                  </div>
                                  <div class="hero-trust-item-box5">
                                    <div class="hero-trust-icon-box5">
                                      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="rgba(79,132,174,0.9)" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 11 12 14 22 4" />
                                      </svg>
                                    </div>
                                    Evidence-based protocols
                                  </div>
                                  <div class="hero-trust-item-box5">
                                    <div class="hero-trust-icon-box5">
                                      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="rgba(79,132,174,0.9)" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                      </svg>
                                    </div>
                                    24/7 patient support
                                  </div>
                                </div> -->
      </div>

      <div class="hero-right-box5 reveal delay-2">
        <div class="doctor-card-box5">
          <img
            src="https://img-cdn.publive.online/filters:format(webp)/english-betterindia/media/post_attachments/uploads/2022/10/MinistryOfMemories_Headshots-13_websize-1-min-1665749722.jpg"
            alt="Dr. Yuvraj Jadeja">
          <div class="doctor-card-overlay-box5"></div>
          <div class="doctor-card-info-box5">
            <div class="doctor-card-name-box5">Dr. Yuvraj Jadeja</div>
            <div class="doctor-card-role-box5">Reproductive Medicine Specialist</div>
          </div>
        </div>
        <div class="hero-stats-row-box5">
          <div class="hero-stat-box5"><span class="hero-stat-num-box5">15+</span><span class="hero-stat-label-box5">Years
              Experience</span></div>
          <div class="hero-stat-box5"><span class="hero-stat-num-box5">98%</span><span
              class="hero-stat-label-box5">Satisfaction</span></div>
          <div class="hero-stat-box5"><span class="hero-stat-num-box5">5K+</span><span
              class="hero-stat-label-box5">Families Helped</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TRUST BAND -->
  <!-- <div class="trust-band-1">
                                  <div class="trust-inner-1">
                                    <div class="trust-item-1">
                                      <div class="trust-icon-1"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        </svg></div>
                                      <div class="trust-text-1"><strong>Ethical Practice</strong><span>No unnecessary procedures</span></div>
                                    </div>
                                    <div class="trust-item-1">
                                      <div class="trust-icon-1"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <polyline points="9 11 12 14 22 4" />
                                          <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                        </svg></div>
                                      <div class="trust-text-1"><strong>Evidence-Based</strong><span>Latest clinical protocols</span></div>
                                    </div>
                                    <div class="trust-item-1">
                                      <div class="trust-icon-1"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                        </svg></div>
                                      <div class="trust-text-1"><strong>Patient-First</strong><span>Compassionate every step</span></div>
                                    </div>
                                    <div class="trust-item-1">
                                      <div class="trust-icon-1"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <circle cx="12" cy="12" r="10" />
                                          <polyline points="12 6 12 12 16 14" />
                                        </svg></div>
                                      <div class="trust-text-1"><strong>24/7 Support</strong><span>Always here when needed</span></div>
                                    </div>
                                  </div>
                                </div> -->

  <!-- VALUE SCROLL SECTION -->


  <style>
    /* Scoped CSS for Value Scroll Section */
    .value-scroll-section {
      background: var(--bg-light, #fcfcfc);
      padding: 5rem 0 3rem 0;
      width: 100%;
      overflow: hidden;
    }

    .value-scroll-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .value-scroll-container {
      display: flex;
      gap: 2rem;
      overflow-x: auto;
      padding-bottom: 2rem;
      scroll-snap-type: x mandatory;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      /* Firefox */
      -ms-overflow-style: none;
      /* IE and Edge */
    }

    .value-scroll-container::-webkit-scrollbar {
      display: none;
      /* Chrome, Safari, Opera */
    }

    .value-scroll-card {
      /* Display three boxes at a time with gap calculation */
      flex: 0 0 calc(33.333% - 1.34rem);
      background: #fff;
      border: 1px solid rgba(0, 0, 0, 0.04);
      border-radius: 20px;
      padding: 3rem;
      scroll-snap-align: start;
      /* box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04); */
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      position: relative;
      overflow: hidden;
    }

    /* Stylish accent bar */
    .value-scroll-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--crimson, #bc2b3d), var(--gold, #d4af37));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .value-scroll-card:hover {
      transform: translateY(-8px);
      /* box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08); */
      border-color: rgba(188, 43, 61, 0.1);
    }

    .value-scroll-card:hover::before {
      transform: scaleX(1);
    }

    .v-card-icon {
      width: 56px;
      height: 56px;
      background: #111;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .value-scroll-card:hover .v-card-icon {
      transform: scale(1.1) rotate(-5deg);
      background: var(--crimson, #bc2b3d);
    }

    .v-card-title {
      font-family: 'DM Serif Display', serif;
      font-size: 1.6rem;
      letter-spacing: 0.5px;
      color: #111;
      margin-bottom: 1rem;
    }

    .v-card-text {
      font-size: 1.05rem;
      color: #555;
      line-height: 1.6;
      margin: 0;
      font-family: 'DM Sans', sans-serif;
    }

    @media (max-width: 900px) {
      .value-scroll-card {
        flex: 0 0 calc(85% - 1rem);
        /* Show 1 full box + peek of the next on mobile */
        padding: 2.5rem 2rem;
      }
    }

    @media (max-width: 600px) {
      .value-scroll-section {
        padding: 3rem 0 1rem 0;
      }

      .value-scroll-inner {
        padding: 0 1rem;
      }

      .value-scroll-card {
        flex: 0 0 85%;
        margin-right: 1rem;
      }

      .v-card-icon {
        margin-bottom: 1.5rem;
      }

      .v-card-title {
        font-size: 1.35rem;
      }
    }

    /* Scroll Dots Styling */
    .value-scroll-dots {
      display: flex;
      justify-content: center;
      gap: 0.8rem;
      margin-top: 2rem;
    }

    .value-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #ddd;
      border: none;
      cursor: pointer;
      padding: 0;
      transition: all 0.3s ease;
    }

    .value-dot.active {
      background: var(--crimson, #bc2b3d);
      transform: scale(1.3);
    }

    .value-dot:hover:not(.active) {
      background: #bbb;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const container = document.getElementById('valueScrollContainer');
      const dotsContainer = document.querySelector('.value-scroll-dots');
      const originalCards = Array.from(container.querySelectorAll('.value-scroll-card'));

      if (!container || !originalCards.length) return;

      // 1. DYNAMIC DOT GENERATION
      function renderDots() {
        dotsContainer.innerHTML = '';
        const itemsVisible = window.innerWidth > 900 ? 3 : 1.2;
        const totalDots = originalCards.length;

        // On desktop, we can only scroll until the last set of 3 is visible
        const maxDots = window.innerWidth > 900 ? totalDots - 2 : totalDots;

        for (let i = 0; i < maxDots; i++) {
          const dot = document.createElement('button');
          dot.classList.add('value-dot');
          if (i === 0) dot.classList.add('active');
          dot.addEventListener('click', () => {
            stopAutoSlide();
            scrollToIndex(i);
            setTimeout(startAutoSlide, 5000);
          });
          dotsContainer.appendChild(dot);
        }
      }

      function scrollToIndex(index) {
        const cardWidth = originalCards[0].offsetWidth;
        const gap = parseFloat(window.getComputedStyle(container).gap) || 0;
        container.scrollTo({
          left: index * (cardWidth + gap),
          behavior: 'smooth'
        });
      }

      // 2. AUTO-SLIDE & LOOP
      let currentIndex = 0;
      let autoSlideInterval;

      function startAutoSlide() {
        stopAutoSlide();
        autoSlideInterval = setInterval(() => {
          const maxDots = dotsContainer.querySelectorAll('.value-dot').length;
          currentIndex++;

          if (currentIndex >= maxDots) {
            // Smoothly jump back to start (for now, without cloning to avoid layout shifts)
            currentIndex = 0;
          }

          scrollToIndex(currentIndex);
        }, 4000);
      }

      function stopAutoSlide() {
        if (autoSlideInterval) clearInterval(autoSlideInterval);
      }

      // 3. SYNC DOTS ON SCROLL
      container.addEventListener('scroll', () => {
        const cardWidth = originalCards[0].offsetWidth;
        const gap = parseFloat(window.getComputedStyle(container).gap) || 0;
        const index = Math.round(container.scrollLeft / (cardWidth + gap));

        const dots = dotsContainer.querySelectorAll('.value-dot');
        dots.forEach((dot, i) => {
          dot.classList.toggle('active', i === index);
        });
        currentIndex = index;
      });

      // Initialize
      renderDots();
      startAutoSlide();
      window.addEventListener('resize', renderDots);

      // Pause on interaction
      container.addEventListener('mouseenter', stopAutoSlide);
      container.addEventListener('mouseleave', startAutoSlide);
      container.addEventListener('touchstart', stopAutoSlide, { passive: true });
    });
  </script>

  <!-- DIFFERENTIATOR -->
  <section class="diff-section">
    <div class="diff-inner">
      <div class="custom-diff-grid-img">

        <!-- Left Side: Image -->
        <div class="diff-left-image reveal">
          <div class="doc-image-wrapper">
            <img
              src="https://img-cdn.publive.online/filters:format(webp)/english-betterindia/media/post_attachments/uploads/2022/10/MinistryOfMemories_Headshots-13_websize-1-min-1665749722.jpg"
              alt="Dr. Yuvraj Jadeja">
            <div class="doc-image-accent"></div>
          </div>
        </div>

        <!-- Right Side: Description & Qualifications -->
        <div class="diff-right-content reveal delay-1">
          <h2>Know<br><em>Dr Yuvraj Jadeja</em></h2>
          <p class="doc-intro-text">We believe fertility is personal, not a protocol. Discover a space where rigorous
            science meets deep compassion — where every decision is made for you, not just about you.</p>

          <div class="profile-timeline">
            <div class="timeline-item">
              <div class="timeline-icon"></div>
              <div class="timeline-content">
                <h4>Qualifications</h4>
                <ul>
                  <li><strong>M.D.</strong> (Obstetrics and Gynecology)</li>
                  <li><strong>DIAGE</strong> (CICE, France), <strong>FRM</strong> (ISAR-ASPIRE, Japan)</li>
                  <li><strong>DRM</strong> (SKUH, Germany)</li>
                </ul>
              </div>
            </div>

            <div class="timeline-item">
              <div class="timeline-icon"></div>
              <div class="timeline-content">
                <h4>Specializations</h4>
                <ul>
                  <li>Infertility Specialist</li>
                  <li>Endoscopic Surgeon</li>
                  <li>Male & Female Wellness Specialist</li>
                </ul>
              </div>
            </div>

            <div class="timeline-item">
              <div class="timeline-icon"></div>
              <div class="timeline-content">
                <h4>Professional Roles</h4>
                <ul>
                  <li><strong>Medical Director</strong> &mdash; Nimaaya Centre for Women's Health (Vadodara | Ahmedabad |
                    Mumbai)</li>
                  <li><strong>Visiting Consultant & Fertility Dept. in Charge</strong> &mdash; Karamsad Medical College,
                    Anand</li>
                  <li><strong>Visiting Consultant</strong> &mdash; Rajkot | Anand | Delhi</li>
                </ul>
              </div>
            </div>
          </div>

          <div style="margin-top: 2.5rem;">
            <a href="{{ route('frontend.about') }}" class="btn-crimson-outline">About Dr. Yuvi <svg width="13" height="13"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7" />
              </svg></a>
          </div>
        </div>

      </div>
    </div>

    <style>
      /* Image + Text Grid Layout */
      .custom-diff-grid-img {
        display: grid;
        grid-template-columns: 4fr 6fr;
        /* 40% Image, 60% Content */
        gap: 5rem;
        align-items: center;
      }

      /* Doctor Image Styles */
      .doc-image-wrapper {
        position: relative;
        border-radius: 16px;
        z-index: 1;
      }

      .doc-image-wrapper img {
        width: 100%;
        height: auto;
        border-radius: 16px;
        display: block;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
        aspect-ratio: 4/5;
        object-fit: cover;
      }

      .doc-image-accent {
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 80%;
        height: 80%;
        background: var(--gold, #d4af37);
        border-radius: 16px;
        z-index: 0;
        opacity: 0.15;
      }

      /* Right Side Content */
      .diff-right-content h2 {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        margin-bottom: 1rem;
        color: #111;
        line-height: 1.1;
      }

      .diff-right-content h2 em {
        color: var(--crimson-dark, #d4af37);
        font-style: italic;
        font-family: 'DM Serif Display', serif;
      }

      .doc-intro-text {
        font-size: 1.15rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 3rem;
        max-width: 90%;
      }

      /* Premium Timeline Profile Design */
      .profile-timeline {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
        padding-top: 0.5rem;
      }

      /* The Vertical Line */
      .profile-timeline::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 5px;
        bottom: 10px;
        width: 2px;
        background: linear-gradient(to bottom, var(--gold, #d4af37), rgba(212, 175, 55, 0.2));
      }

      .timeline-item {
        position: relative;
        padding-left: 35px;
      }

      /* The Timeline Dots */
      .timeline-icon {
        position: absolute;
        left: 0;
        top: 6px;
        width: 16px;
        height: 16px;
        background: #fff;
        border: 3px solid var(--gold, #d4af37);
        border-radius: 50%;
        z-index: 2;
        box-shadow: 0 0 0 5px var(--bg-light, #fcfcfc);
      }

      .timeline-content h4 {
        font-size: 1.3rem;
        font-family: 'DM Serif Display', serif;
        color: var(--crimson, #bc2b3d);
        margin-bottom: 0.8rem;
        line-height: 1.2;
      }

      .timeline-content ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
      }

      .timeline-content li {
        font-size: 0.95rem;
        color: #444;
        line-height: 1.6;
        position: relative;
        padding-left: 18px;
      }

      /* Custom Arrow Bullets */
      .timeline-content li::before {
        content: '→';
        position: absolute;
        left: 0;
        top: 0;
        color: var(--gold, #d4af37);
        font-weight: bold;
        font-size: 1.1rem;
      }

      .timeline-content li strong {
        color: #111;
        font-weight: 600;
      }

      /* Responsiveness */
      @media (max-width: 1024px) {
        .custom-diff-grid-img {
          grid-template-columns: 1fr;
          gap: 4rem;
        }

        .doc-image-wrapper {
          max-width: 500px;
          margin: 0 auto;
        }

        .doc-intro-text {
          max-width: 100%;
        }
      }
    </style>
  </section>

  <!-- SERVICES -->
  <section class="services-section">
    <div class="section-wrap">
      <div class="section-header reveal">
        <h2>Services Designed<br>Around You</h2>
        <div class="section-header-right">
          <p>Every pathway is built with ethical clarity and clinical precision — from first consult to new beginnings.
          </p>
          <a href="{{ route('frontend.services') }}" class="btn-primary-dark">View All Services <svg width="13"
              height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg></a>
        </div>
      </div>
      <div class="services-list">
        @foreach($services as $index => $service)
          <a href="{{ route('frontend.serviceDetail', $service->slug) }}"
            class="svc-row reveal {{ $index % 3 == 1 ? 'delay-1' : ($index % 3 == 2 ? 'delay-2' : '') }}">
            <span class="svc-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            <div class="svc-content">
              <div class="svc-title">{{ $service->title }}</div>
              <div class="svc-desc">{{ $service->excerpt }}</div>
            </div>
            <div class="svc-pills">
              @if($service->hero_pills)
                @foreach($service->hero_pills as $pill)
                  <span class="svc-pill">{{ $pill }}</span>
                @endforeach
              @endif
            </div>
            <svg class="svc-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- PROCESS -->
  <section class="process-section-con">
    <div class="process-inner-con">
      <div class="process-header-con reveal-con">
        <h2>The Journey<br>to <em>Clarity.</em></h2>
        <p>A clear, step-by-step process so you always know what to expect — no surprises, no pressure.</p>
      </div>
      <div class="process-steps-con reveal-con">
        <div class="step-con">
          <div class="step-num-con">I</div>
          <p class="step-title-con">Understanding You</p>
          <p class="step-desc-con">We begin with your story, history, and goals — no assumptions.</p>
        </div>
        <div class="step-con">
          <div class="step-num-con">II</div>
          <p class="step-title-con">Diagnosis</p>
          <p class="step-desc-con">Comprehensive tests with transparent, plain-language explanations.</p>
        </div>
        <div class="step-con">
          <div class="step-num-con">III</div>
          <p class="step-title-con">Your Plan</p>
          <p class="step-desc-con">Options, risks, and probabilities — aligned to your life and goals.</p>
        </div>
        <div class="step-con">
          <div class="step-num-con">IV</div>
          <p class="step-title-con">Treatment</p>
          <p class="step-desc-con">Evidence-based care with continuous monitoring and guidance.</p>
        </div>
        <div class="step-con">
          <div class="step-num-con">V</div>
          <p class="step-title-con">Ongoing Support</p>
          <p class="step-desc-con">Medical follow-ups and emotional support all the way through.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- STORIES -->
  <section class="stories-section">
    <div class="section-wrap">
      <div class="section-header reveal">
        <div>
          <div
            style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--crimson-light);color:var(--crimson);font-size:0.7rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;padding:0.35rem 1rem;border-radius:50px;margin-bottom:0.8rem;">
            Real Results</div>
          <h2>Families <em
              style="font-family:'DM Serif Display',serif;font-style:italic;color:var(--crimson-dark);">Reimagined.</em>
          </h2>
        </div>
        <div class="section-header-right">
          <p>Hear directly from couples who navigated the most complex odds and successfully built their families.</p>
          <a href="{{ route('frontend.successStories') }}" class="btn-primary-dark">Browse All Stories <svg width="13"
              height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg></a>
        </div>
      </div> <!-- Close section-header -->

      <div class="hp-stories-grid" id="hpStoriesGrid">
        @foreach($stories as $story)
          <article class="hp-video-card reveal" data-category="{{ strtolower($story->treatment_type) }}">
            <div class="hp-video-wrap">
              <iframe src="{{ $story->video_url }}" loading="lazy" allow="autoplay; encrypted-media" allowfullscreen
                title="{{ $story->title }}"></iframe>
              <div class="hp-video-overlay">
                <span class="hp-patient-name">{{ $story->patient_name ?? $story->title }}</span>
                <span class="hp-treatment-tag">{{ $story->treatment_type }}</span>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <style>
        .hp-stories-grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 1.5rem;
          margin-top: 2rem;
        }

        .hp-video-card {
          position: relative;
          background: #000;
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
          transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .hp-video-card:hover {
          transform: translateY(-8px);
        }

        .hp-video-wrap {
          aspect-ratio: 9/16;
          position: relative;
          width: 100%;
        }

        .hp-video-wrap iframe {
          width: 100%;
          height: 100%;
          object-fit: cover;
          border: none;
        }

        .hp-video-overlay {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          padding: 40px 20px 20px;
          background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
          color: #fff;
          display: flex;
          flex-direction: column;
          pointer-events: none;
          z-index: 2;
        }

        .hp-patient-name {
          font-size: 1.15rem;
          font-weight: 600;
          letter-spacing: -0.01em;
        }

        .hp-treatment-tag {
          font-size: 0.75rem;
          opacity: 0.8;
          text-transform: uppercase;
          letter-spacing: 0.05em;
          margin-top: 4px;
        }

        @media (max-width: 1024px) {
          .hp-stories-grid {
            grid-template-columns: repeat(2, 1fr);
          }
        }

        @media (max-width: 600px) {
          .hp-stories-grid {
            grid-template-columns: 1fr;
          }
        }
      </style>
    </div>
    </div>
  </section>

  <!-- BLOG PREVIEW -->
  <section class="blog-list-section">
    <div class="blog-list-inner">
      <div class="section-header reveal">
        <div>
          <div
            style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--blue-light);color:var(--blue-dark);font-size:0.7rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;padding:0.35rem 1rem;border-radius:50px;margin-bottom:0.8rem;">
            Health Insights</div>
          <h2>Latest from<br>the <em>Blog.</em></h2>
        </div>
        <div class="section-header-right">
          <p>Evidence-based articles, patient guides, and clinical insights to help you navigate your health journey.</p>
          <a href="{{ route('frontend.blog') }}" class="btn-primary-dark">View All Articles <svg width="13" height="13"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg></a>
        </div>
      </div>
      <div class="blog-list-grid">
        @foreach($blogs as $index => $blog)
          <article class="blog-list-card reveal {{ $index % 3 == 1 ? 'delay-1' : ($index % 3 == 2 ? 'delay-2' : '') }}">
            <div class="blog-list-img-wrap">
              <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-list-img">
              <span class="blog-list-badge">{{ $blog->category_rel->name ?? 'Article' }}</span>
            </div>
            <div class="blog-list-content">
              <div class="blog-list-meta">{{ $blog->created_at->format('M d, Y') }} · 5 min read</div>
              <h3 class="blog-list-title">{{ $blog->title }}</h3>
              <p class="blog-list-excerpt">{{ $blog->excerpt }}</p>
              <a href="{{ route('frontend.blogDetails', $blog->slug) }}" class="blog-list-link">Read Article <svg width="12"
                  height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg></a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials-section" style="padding: 6rem 0; background: var(--bg-light);">
    <div class="section-wrap" style="max-width: 1280px; margin: 0 auto; padding: 0 2rem;">
      <div class="section-header reveal" style="text-align: center; margin-bottom: 3rem;">
        <h2
          style="font-size: clamp(2.5rem, 5vw, 3.5rem); line-height: 1.1; margin-bottom: 1rem; color: var(--text-dark);">
          Patient <em
            style="font-family: 'DM Serif Display', serif; font-style: italic; color: var(--crimson-dark);">Experiences</em>
        </h2>
        <p style="font-size: 1.1rem; color: var(--text-muted); max-width: 600px; margin: 0 auto;">Real stories from
          families who trusted us with their journey. We are honored to be part of their new beginnings.</p>
      </div>

      <div class="testimonials-carousel-wrapper reveal delay-1" style="position: relative;">
        <button class="testi-btn testi-prev" aria-label="Previous">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>

        <div class="testimonials-carousel" id="testiCarousel">
          <!-- Card 1 -->
          <div class="testimonial-card">
            <div class="stars">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
            </div>
            <p>"Dr. Yuvi and his team were a beacon of hope for us. Their ethical approach made us feel completely
              comfortable."</p>
            <div class="author">— Sneha & Rahul D.</div>
          </div>
          <!-- Card 2 -->
          <div class="testimonial-card">
            <div class="stars">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
            </div>
            <p>"After years of disappointment, we finally found the right guidance here. No false promises, just pure
              medical expertise."</p>
            <div class="author">— Anjali M.</div>
          </div>
          <!-- Card 3 -->
          <div class="testimonial-card">
            <div class="stars">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
            </div>
            <p>"The entire staff is incredibly supportive. They walked us through every step, ensuring we fully understood
              our options."</p>
            <div class="author">— Priya & Amit K.</div>
          </div>
          <!-- Card 4 -->
          <div class="testimonial-card">
            <div class="stars">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
            </div>
            <p>"We travelled from another city just for Dr. Yuvi, and it was the best decision. His empathy and expertise
              are unmatched."</p>
            <div class="author">— Neha S.</div>
          </div>
          <!-- Card 5 -->
          <div class="testimonial-card">
            <div class="stars">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
            </div>
            <p>"Transparent, honest, and truly caring. We are blessed with a healthy baby today because of their tireless
              efforts."</p>
            <div class="author">— Rohan & Meera V.</div>
          </div>
        </div>

        <button class="testi-btn testi-next" aria-label="Next">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>

        <!-- Dots Container -->
        <div class="testi-dots" id="testiDots"></div>
      </div>

      <!-- <div style="text-align: center; margin-top: 3rem;" class="reveal delay-2">
                <a href="{{ route('frontend.successStories') }}" class="btn-outline-dark">View All Stories <svg width="13"
                    height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                  </svg></a>
              </div> -->
    </div>

    <style>
      .testimonials-carousel-wrapper {
        position: relative;
        padding: 0 50px;
      }

      .testimonials-carousel {
        display: flex;
        gap: 2rem;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        padding: 1rem 0 2rem;
        scrollbar-width: none;
        /* Firefox */
      }

      .testimonials-carousel::-webkit-scrollbar {
        display: none;
        /* Chrome/Safari */
      }

      .testimonial-card {
        flex: 0 0 calc(33.333% - 1.35rem);
        /* 3 columns */
        scroll-snap-align: start;
        background: #fff;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border-bottom: 4px solid var(--crimson);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
      }

      .testimonial-card .stars {
        display: flex;
        gap: 4px;
        margin-bottom: 1.2rem;
        color: var(--gold);
      }

      .testimonial-card p {
        font-size: 1.05rem;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        line-height: 1.7;
        font-style: italic;
        flex-grow: 1;
      }

      .testimonial-card .author {
        font-weight: 600;
        color: var(--blue-dark);
        letter-spacing: 0.5px;
        font-size: 0.95rem;
      }

      .testi-btn {
        position: absolute;
        top: 45%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fff;
        border: 1px solid #eaeaea;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        z-index: 10;
        transition: all 0.3s ease;
      }

      .testi-btn:hover {
        background: var(--crimson);
        color: #fff;
        border-color: var(--crimson);
      }

      .testi-prev {
        left: 0;
      }

      .testi-next {
        right: 0;
      }

      /* Testimonial Dots */
      .testi-dots {
        display: flex;
        justify-content: center;
        gap: 0.8rem;
        margin-top: 2rem;
      }

      .testi-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #ddd;
        border: none;
        cursor: pointer;
        padding: 0;
        transition: all 0.3s ease;
      }

      .testi-dot.active {
        background: var(--crimson);
        transform: scale(1.3);
      }

      @media (max-width: 1024px) {
        .testimonial-card {
          flex: 0 0 calc(50% - 1rem);
        }
      }

      @media (max-width: 768px) {
        .testimonial-card {
          flex: 0 0 100%;
        }

        .testimonials-carousel-wrapper {
          padding: 0;
        }

        .testi-btn {
          display: none;
        }

        /* Hide buttons on mobile, allow swipe */
      }
    </style>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('testiCarousel');
        const prevBtn = document.querySelector('.testi-prev');
        const nextBtn = document.querySelector('.testi-next');
        const dotsContainer = document.getElementById('testiDots');
        const originalCards = Array.from(carousel.querySelectorAll('.testimonial-card'));

        if (carousel && prevBtn && nextBtn && dotsContainer && originalCards.length) {
          // 1. DYNAMIC DOT GENERATION
          function renderDots() {
            dotsContainer.innerHTML = '';
            const itemsVisible = window.innerWidth > 1024 ? 3 : (window.innerWidth > 768 ? 2 : 1);
            const totalDots = originalCards.length;
            const maxDots = window.innerWidth > 1024 ? totalDots - 2 : (window.innerWidth > 768 ? totalDots - 1 : totalDots);

            for (let i = 0; i < maxDots; i++) {
              const dot = document.createElement('button');
              dot.classList.add('testi-dot');
              if (i === 0) dot.classList.add('active');
              dot.addEventListener('click', () => {
                stopAutoSlide();
                scrollToIndex(i);
                setTimeout(startAutoSlide, 5000);
              });
              dotsContainer.appendChild(dot);
            }
          }

          function getScrollStep() {
            const card = originalCards[0];
            return card.offsetWidth + (parseFloat(window.getComputedStyle(carousel).gap) || 32);
          }

          function scrollToIndex(index) {
            carousel.scrollTo({ left: index * getScrollStep(), behavior: 'smooth' });
          }

          // 2. AUTO-SLIDE & LOOP
          let currentIndex = 0;
          let testiAutoSlide;

          function startAutoSlide() {
            stopAutoSlide();
            testiAutoSlide = setInterval(() => {
              const dots = dotsContainer.querySelectorAll('.testi-dot');
              currentIndex++;
              if (currentIndex >= dots.length) currentIndex = 0;
              scrollToIndex(currentIndex);
            }, 5000);
          }

          function stopAutoSlide() {
            if (testiAutoSlide) clearInterval(testiAutoSlide);
          }

          // 3. SYNC DOTS ON SCROLL
          carousel.addEventListener('scroll', () => {
            const index = Math.round(carousel.scrollLeft / getScrollStep());
            const dots = dotsContainer.querySelectorAll('.testi-dot');
            dots.forEach((dot, i) => {
              dot.classList.toggle('active', i === index);
            });
            currentIndex = index;
          });

          // Initialize
          renderDots();
          startAutoSlide();
          window.addEventListener('resize', renderDots);

          // Buttons
          prevBtn.addEventListener('click', () => {
            stopAutoSlide();
            const dots = dotsContainer.querySelectorAll('.testi-dot');
            currentIndex--;
            if (currentIndex < 0) currentIndex = dots.length - 1;
            scrollToIndex(currentIndex);
            setTimeout(startAutoSlide, 5000);
          });

          nextBtn.addEventListener('click', () => {
            stopAutoSlide();
            const dots = dotsContainer.querySelectorAll('.testi-dot');
            currentIndex++;
            if (currentIndex >= dots.length) currentIndex = 0;
            scrollToIndex(currentIndex);
            setTimeout(startAutoSlide, 5000);
          });

          // Pause on interaction
          carousel.addEventListener('mouseenter', stopAutoSlide);
          carousel.addEventListener('mouseleave', startAutoSlide);
          carousel.addEventListener('touchstart', stopAutoSlide, { passive: true });
        }
      });
    </script>
  </section>

  <!-- CTA -->
  <section class="cta-section">
    <div class="cta-inner reveal">
      <div class="cta-eyebrow">Ready for Clarity?</div>
      <h2>Start Your Family's<br><em>Journey Today.</em></h2>
      <p>Our patient coordinators are here to listen without judgment and guide you toward the most appropriate care — at
        no pressure, whatsoever.</p>
      <div class="cta-btns">
        <a href="{{ route('frontend.contact') }}" class="btn-primary-dark">Schedule Consultation <svg width="15"
            height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg></a>
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '919999999999' }}" target="_blank" rel="noopener"
          class="btn-outline"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>WhatsApp Inquiry</a>
      </div>
    </div>
  </section>


  <!-- LIGHTBOX HTML -->
  <div class="video-lightbox" id="videoLightbox">
    <div class="video-lightbox-content">
      <button class="video-lightbox-close" id="closeLightbox" aria-label="Close video">&times;</button>
      <div class="video-lightbox-iframe-container">
        <iframe id="lightboxIframe" src="" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      </div>
    </div>
  </div>


  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection