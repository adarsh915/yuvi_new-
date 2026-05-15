<!-- HERO -->
@extends('frontend.layouts.app')

@section('title', 'Home Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

@section('content')
  <!-- TOP BANNER SLIDER -->
  <section class="top-banner-slider-con reveal">
    <div class="top-banner-track" id="topBannerTrack">
      @forelse($sliders as $slider)
        <div class="top-banner-slide @if($loop->first) active @endif">
          <img src="{{ asset('storage/' . $slider->image) }}" alt="Homepage slider {{ $loop->iteration }}">
        </div>
      @empty
        <div class="top-banner-slide active">
          <img src="{{ asset('storage/banner/banner1.avif') }}" alt="Medical Excellence">
        </div>
        <div class="top-banner-slide">
          <img src="{{ asset('storage/banner/banner2.avif') }}" alt="Advanced Care">
        </div>
        <div class="top-banner-slide">
          <img src="{{ asset('storage/banner/banner3.avif') }}" alt="Patient Support">
        </div>
      @endforelse
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

    <!-- Dots Indicators -->
    <div class="top-banner-dots" id="topBannerDots"></div>
  </section>

  <section class="value-marquee-section reveal">
    <div class="value-marquee-inner">
      <div class="value-marquee-wrapper">
        <div class="value-marquee-track" id="valueMarqueeTrack">
          <!-- Card 1 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
            </div>
            <h3 class="v-card-title">ETHICAL PRACTICE</h3>
          </div>

          <!-- Card 2 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </div>
            <h3 class="v-card-title">DIAGNOSIS FIRST</h3>
          </div>

          <!-- Card 3 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                  d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                </path>
              </svg>
            </div>
            <h3 class="v-card-title">HOLISTIC SUPPORT</h3>
          </div>

          <!-- Card 4 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
              </svg>
            </div>
            <h3 class="v-card-title">EVIDENCE BASED</h3>
          </div>

          <!-- Card 5 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
            <h3 class="v-card-title">PATIENT FIRST</h3>
          </div>

          <!-- Card 6 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                <line x1="8" y1="21" x2="16" y2="21"></line>
                <line x1="12" y1="17" x2="12" y2="21"></line>
              </svg>
            </div>
            <h3 class="v-card-title">ADVANCED LAB</h3>
          </div>

          <!-- Card 7 -->
          <div class="value-marquee-card">
            <div class="v-card-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <h3 class="v-card-title">24x7 SUPPORT</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
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

    .top-banner-dots {
      position: absolute;
      bottom: 24px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 10px;
      z-index: 10;
    }

    .banner-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      cursor: pointer;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .banner-dot.active {
      background: #fff;
      width: 30px;
      border-radius: 10px;
    }

    /* Tablets (Landscape & Portrait) */
    @media (min-width: 601px) and (max-width: 991px) {
      .top-banner-slider-con {
        height: 34vh;
      }

      .top-banner-nav {
        padding: 0 1.5rem;
      }

      .top-banner-btn {
        width: 45px;
        height: 45px;
      }
    }

    /* Mobile Devices */
    @media (max-width: 600px) {
      .top-banner-slider-con {
        height: 21vh;
      }

      .top-banner-nav {
        padding: 0 1rem;
      }

      .top-banner-btn {
        width: 36px;
        height: 36px;
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

      const dotsContainer = document.getElementById('topBannerDots');
      if (dotsContainer) {
        originalSlides.forEach((_, idx) => {
          const dot = document.createElement('div');
          dot.classList.add('banner-dot');
          if (idx === 0) dot.classList.add('active');
          dot.addEventListener('click', () => {
            if (isTransitioning) return;
            showSlide(idx + 1);
            resetAutoSlide();
          });
          dotsContainer.appendChild(dot);
        });
      }

      function updateDots(index) {
        if (!dotsContainer) return;
        const dots = dotsContainer.querySelectorAll('.banner-dot');
        dots.forEach(dot => dot.classList.remove('active'));

        let realIdx = index - 1;
        if (index === 0) realIdx = originalSlides.length - 1;
        if (index === allSlides.length - 1) realIdx = 0;

        if (dots[realIdx]) dots[realIdx].classList.add('active');
      }

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
        updateDots(index);
      }

      track.addEventListener('transitionend', () => {
        isTransitioning = false;
        // If at last clone, jump to first real slide
        if (currentIdx === allSlides.length - 1) {
          track.style.transition = 'none';
          currentIdx = 1;
          track.style.transform = `translateX(-100%)`;
          updateDots(1);
        }
        // If at first clone, jump to last real slide
        if (currentIdx === 0) {
          track.style.transition = 'none';
          currentIdx = allSlides.length - 2;
          track.style.transform = `translateX(-${currentIdx * 100}%)`;
          updateDots(currentIdx);
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

  <!-- <section class="hero-box5">
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
                                                      <div class="hero-trust-box5">
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
                                                                                      </div>
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
                                                </section> -->

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
    /* Value Marquee Styling */
    .value-marquee-section {
      background: var(--gold-light);
      /* Theme cream background */
      padding: 1.5rem 0;
      width: 100%;
      overflow: hidden;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .value-marquee-inner {
      width: 100%;
    }

    .value-marquee-wrapper {
      width: 100%;
      overflow: hidden;
      mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }

    .value-marquee-track {
      display: flex;
      gap: 5rem;
      width: max-content;
      animation: value-marquee-scroll 40s linear infinite;
    }

    .value-marquee-track:hover {
      animation-play-state: paused;
    }

    @keyframes value-marquee-scroll {
      from {
        transform: translateX(0);
      }

      to {
        transform: translateX(-50%);
      }
    }

    .value-marquee-card {
      display: flex;
      align-items: center;
      gap: 1.2rem;
      flex-shrink: 0;
      background: transparent;
      padding: 0;
      border: none;
      position: relative;
    }

    .v-card-icon {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .v-card-icon svg {
      width: 24px;
      height: 24px;
      stroke: var(--crimson, #db454e);
      /* Theme crimson for icons */
    }

    .v-card-title {
      font-family: 'DM Sans', sans-serif;
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--midnight, #121212);
      /* Theme midnight for titles on light background */
      margin: 0;
      white-space: nowrap;
      text-transform: uppercase;
    }

    @media (max-width: 768px) {
      .value-marquee-track {
        gap: 3rem;
        animation-duration: 25s;
      }

      .v-card-title {
        font-size: 0.9rem;
      }
    }
  </style>
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const track = document.getElementById('valueMarqueeTrack');
      if (!track) return;

      // Duplicate cards for seamless marquee
      const cards = Array.from(track.children);
      cards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
      });
    });
  </script>

  <!-- DIFFERENTIATOR -->
  <section class="diff-section reveal">
    <div class="diff-inner">
      <div class="custom-diff-grid-img">

        <!-- Left Side: Image -->
        <div class="diff-left-image reveal">
          <div class="doc-image-wrapper">
            <img src="{{ asset('storage/about/MinistryOfMemories_Headshots-13_websize-1-min-1665749722.webp') }}"
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
        grid-template-columns: 4.5fr 5.5fr;
        /* Balanced ratio */
        gap: 4rem;
        align-items: center;
      }

      /* Doctor Image Styles */
      .diff-left-image {
        height: 100%;
      }

      .doc-image-wrapper {
        position: relative;
        border-radius: 16px;
        z-index: 1;
        height: 100%;
      }

      .doc-image-wrapper img {
        width: 100%;
        height: 100%;
        border-radius: 16px;
        display: block;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
        aspect-ratio: 0.85 / 1;
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
        font-size: 1.1rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 100%;
      }

      /* Premium Timeline Profile Design */
      .profile-timeline {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 1.8rem;
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
        left: -4px;
        top: -4px;
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

      /* Mobile View */
      @media (max-width: 767px) {
        .value-marquee-section {
          padding: 0.5rem 0;
        }
      }
    </style>
  </section>

  <!-- SERVICES -->
  <section class="services-section reveal">
    <div class="section-wrap-2">
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
      <div class="process-header-con reveal">
        <h2>The Journey<br>to <em>Clarity.</em></h2>
        <p>A clear, step-by-step process so you always know what to expect — no surprises, no pressure.</p>
      </div>
      <div class="process-steps-con reveal">
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
  <section class="stories-section reveal">
    <div class="section-wrap">
      <div class="section-header with-eyebrow reveal">
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
                <span class="hp-treatment-tag">{{ $story->treatmentType->name ?? 'Success Story' }}</span>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <style>
        .hp-stories-grid {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
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
  <section class="blog-list-section reveal">
    <div class="blog-list-inner">
      <div class="section-header with-eyebrow reveal">
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
          <article
            class="blog-list-card reveal {{ $index % 4 == 1 ? 'delay-1' : ($index % 4 == 2 ? 'delay-2' : ($index % 4 == 3 ? 'delay-3' : '')) }}">
            <div class="blog-list-img-wrap">
              <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-list-img">
              <span class="blog-list-badge">{{ $blog->category_rel->name ?? 'Article' }}</span>
            </div>
            <div class="blog-list-content">
              <div class="blog-list-meta">{{ $blog->created_at->format('M d, Y') }} · 5 min read</div>
              <h3 class="blog-list-title">{{ $blog->title }}</h3>
              <p class="blog-list-excerpt">{{ Str::limit($blog->excerpt, 100) }}</p>
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

  <!-- TESTIMONIALS -->
  <section class="testimonials-section reveal" style="padding: 4rem 0; background: var(--bg-light);">
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

        <div class="testimonials-carousel-inner" style="overflow: hidden;">
          <div class="testimonials-carousel" id="testiCarousel">
            @foreach($testimonials as $testimonial)
              <div class="testimonial-card">
                <div class="stars">
                  @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                  @endfor
                </div>
                <div class="review-content">
                  <p class="testimonial-text">"{{ $testimonial->review }}"</p>
                  <button class="read-more-btn" style="display: none;">Read More</button>
                </div>
                <div class="author">— {{ $testimonial->name }}</div>
              </div>
            @endforeach
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
    </div>

    <style>
      .testimonials-carousel-wrapper {
        position: relative;
        padding: 0 50px;
      }

      .testimonials-carousel-inner {
        overflow: hidden;
        width: 100%;
      }

      .testimonials-carousel {
        display: flex;
        gap: 2rem;
        transition: transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1);
        padding: 1rem 0 2rem;
      }

      .testimonial-card {
        flex: 0 0 calc(33.333% - 1.35rem);
        flex-shrink: 0;
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
        margin-top: auto;
      }

      .review-content {
        position: relative;
        margin-bottom: 1.5rem;
      }

      .testimonial-text {
        font-size: 1.05rem;
        color: var(--text-dark);
        line-height: 1.7;
        font-style: italic;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: all 0.3s ease;
      }

      .testimonial-text.expanded {
        display: block;
        overflow: visible;
        -webkit-line-clamp: unset;
      }

      .read-more-btn {
        background: none;
        border: none;
        color: var(--crimson);
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        padding: 0;
        margin-top: 0.5rem;
        display: inline-block;
        transition: color 0.3s ease;
      }

      .read-more-btn:hover {
        color: var(--crimson-dark);
      }

      .testi-btn {
        position: absolute;
        top: 50%;
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
      }

      .testi-prev {
        left: -15px;
      }

      .testi-next {
        right: -15px;
      }

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
          const cardCount = originalCards.length;
          let currentIndex = 3;
          let isTransitioning = false;
          let testiAutoSlide;

          // Cloning 3 cards at each end for multi-column seamlessness
          for (let i = 0; i < 3; i++) {
            const firstClone = originalCards[i].cloneNode(true);
            const lastClone = originalCards[cardCount - 1 - i].cloneNode(true);
            carousel.appendChild(firstClone);
            carousel.insertBefore(lastClone, carousel.firstChild);
          }

          const allCards = carousel.querySelectorAll('.testimonial-card');

          function getStep() {
            const cardWidth = originalCards[0].offsetWidth;
            const gap = parseFloat(window.getComputedStyle(carousel).gap) || 32;
            return cardWidth + gap;
          }

          function updatePosition(animate = true) {
            const step = getStep();
            if (animate) {
              carousel.style.transition = 'transform 0.6s cubic-bezier(0.645, 0.045, 0.355, 1)';
            } else {
              carousel.style.transition = 'none';
            }
            carousel.style.transform = `translateX(-${currentIndex * step}px)`;
          }

          setTimeout(() => updatePosition(false), 50);

          function scrollToIndex(index) {
            if (isTransitioning) return;
            isTransitioning = true;
            currentIndex = index;
            updatePosition(true);
            syncDots();
          }

          carousel.addEventListener('transitionend', () => {
            isTransitioning = false;
            if (currentIndex >= allCards.length - 3) {
              currentIndex = 3;
              updatePosition(false);
            }
            if (currentIndex <= 0) {
              currentIndex = allCards.length - 6;
              updatePosition(false);
            }
          });

          function syncDots() {
            const dots = dotsContainer.querySelectorAll('.testi-dot');
            let realIdx = (currentIndex - 3) % cardCount;
            if (realIdx < 0) realIdx += cardCount;
            dots.forEach((dot, i) => {
              dot.classList.toggle('active', i === realIdx);
            });
          }

          function renderDots() {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < cardCount; i++) {
              const dot = document.createElement('button');
              dot.classList.add('testi-dot');
              if (i === 0) dot.classList.add('active');
              dot.addEventListener('click', () => {
                stopAutoSlide();
                scrollToIndex(i + 3);
                setTimeout(startAutoSlide, 5000);
              });
              dotsContainer.appendChild(dot);
            }
          }

          function startAutoSlide() {
            stopAutoSlide();
            testiAutoSlide = setInterval(() => {
              scrollToIndex(currentIndex + 1);
            }, 5000);
          }

          function stopAutoSlide() {
            if (testiAutoSlide) clearInterval(testiAutoSlide);
          }

          renderDots();
          startAutoSlide();
          window.addEventListener('resize', () => updatePosition(false));

          prevBtn.addEventListener('click', () => {
            stopAutoSlide();
            scrollToIndex(currentIndex - 1);
            setTimeout(startAutoSlide, 5000);
          });

          nextBtn.addEventListener('click', () => {
            stopAutoSlide();
            scrollToIndex(currentIndex + 1);
            setTimeout(startAutoSlide, 5000);
          });

          carousel.addEventListener('mouseenter', stopAutoSlide);
          carousel.addEventListener('mouseleave', startAutoSlide);

          // Read More / Read Less Functionality
          const checkReadMore = () => {
            const texts = document.querySelectorAll('.testimonial-text');
            texts.forEach(text => {
              const button = text.nextElementSibling;
              if (text.scrollHeight > text.offsetHeight) {
                button.style.display = 'inline-block';
              } else if (!text.classList.contains('expanded')) {
                button.style.display = 'none';
              }
            });
          };

          document.querySelectorAll('.read-more-btn').forEach(btn => {
            btn.addEventListener('click', function () {
              const text = this.previousElementSibling;
              const isExpanded = text.classList.toggle('expanded');
              this.textContent = isExpanded ? 'Read Less' : 'Read More';

              // Recalculate carousel position if needed, or just let it be
              // The card height might change, which could affect the layout
              // For simplicity, we just toggle.
            });
          });

          // Run check on load and resize
          setTimeout(checkReadMore, 100);
          window.addEventListener('resize', checkReadMore);
        }
      });
    </script>
  </section>

  <style>
    /* Global Section Styles for Index Page */
    .section-wrap {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 0rem;
    }

    .section-wrap-2 {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 0rem;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 4rem;
      margin-bottom: 4rem;
    }

    .section-header.with-eyebrow .section-header-right {
      margin-top: 2.2rem;
    }

    .section-header-right {
      max-width: 500px;
    }

    .section-header-right p {
      color: #555;
      font-size: 1.1rem;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    @media (max-width: 991px) {
      .section-header {
        flex-direction: row;
        align-items: flex-start;
        gap: 1.5rem;
      }

      .section-header-right {
        max-width: 100%;
      }
    }

    @media (max-width: 768px) {

      .section-header {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>

  <!-- CTA -->
  <section class="cta-section reveal">
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
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['footer_phone'] ?? '919999999999') }}"
          target="_blank" rel="noopener" class="btn-outline"><svg width="15" height="15" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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