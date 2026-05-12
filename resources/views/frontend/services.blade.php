@extends('frontend.layouts.app')

@section('title', 'Fertility Services & Treatments | Dr. Yuvraj Jadeja')
@section('meta_description', 'Comprehensive fertility care including IVF, ICSI, IUI, and specialized women\'s health services by Dr. Yuvraj Jadeja in Ahmedabad.')
@section('meta_keywords', 'IVF treatment, fertility clinic Ahmedabad, PCOS management, male infertility, Dr. Yuvraj Jadeja')

<!-- HERO -->
@section('content')
  <!-- TOP BANNER WITH LAB IMAGE -->
  <section class="services-hero-banner reveal">
    <div class="services-hero-overlay"></div>
    <div class="custom-banner-inner">
      <div class="custom-banner-text">
        <div class="custom-banner-eyebrow">
          <span class="hero-eyebrow-dot"></span> Clinical Excellence
        </div>
        <h1>Specialized <br><em>Fertility Pathways.</em></h1>
        <p>Every journey is unique. Our services are built on advanced embryology, surgical precision, and ethical
          transparency — tailored entirely around you.</p>
      </div>
      <div class="custom-banner-stats">
        <div class="custom-stat">
          <span class="custom-stat-num">10,000+</span>
          <span class="custom-stat-label">Patients Treated</span>
        </div>
        <div class="custom-stat">
          <span class="custom-stat-num">95%</span>
          <span class="custom-stat-label">Success Rate</span>
        </div>
        <div class="custom-stat">
          <span class="custom-stat-num">20+</span>
          <span class="custom-stat-label">Years Experience</span>
        </div>
      </div>
    </div>
  </section>

  <!-- PROCESS SECTION (HOW YOUR JOURNEY UNFOLDS) -->
  <section class="process-section-grid reveal">
    <div class="process-grid-inner">
      <div class="section-header reveal" style="text-align: center; margin-bottom: 5rem;">
        <h2 style="font-size: clamp(2.5rem, 5vw, 2.5rem); color: var(--midnight);">How your <em>journey</em><br>unfolds
          with us.</h2>
        <p style="max-width: 800px; margin: 0 auto; color: var(--muted); font-size: 1.15rem;">A clear, step-by-step
          process so you always know what to expect — no surprises, no pressure. We believe in taking the time to explain
          every detail, giving you all the information you need to feel completely comfortable and confident moving
          forward.</p>
      </div>

      <div class="journey-grid">
        <!-- Step 1 -->
        <div class="journey-card reveal">
          <div class="journey-num">01</div>
          <div class="journey-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
          </div>
          <h3 class="journey-title">Consultation</h3>
          <p class="journey-desc">Your journey begins with a comprehensive, pressure-free discussion. We take the time
            to deeply understand your medical history, personal goals, and emotional needs. This is a safe space for you
            to express all your concerns and ask as many questions as you need without ever feeling rushed.</p>
        </div>

        <!-- Step 2 -->
        <div class="journey-card reveal delay-1">
          <div class="journey-num">02</div>
          <div class="journey-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </div>
          <h3 class="journey-title">Diagnosis</h3>
          <p class="journey-desc">We conduct thorough, state-of-the-art investigations including hormonal, ultrasound,
            and genetic profiling. We practice strictly ethical medicine — which means we only recommend tests that are
            absolutely necessary for your specific case, completely avoiding any redundant or unnecessary procedures.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="journey-card reveal delay-2">
          <div class="journey-num">03</div>
          <div class="journey-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
            </svg>
          </div>
          <h3 class="journey-title">Treatment</h3>
          <p class="journey-desc">Based on your diagnosis, we design a highly tailored treatment protocol specifically
            around your age and family goals. We discuss the scientific rationale behind each clinical step,
            transparently outline the success probabilities, and meticulously guide you through the actual treatment
            phase with the utmost precision and care.</p>
        </div>

        <!-- Step 4 -->
        <div class="journey-card reveal delay-3">
          <div class="journey-num">04</div>
          <div class="journey-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
          </div>
          <h3 class="journey-title">Recovery</h3>
          <p class="journey-desc">Our care doesn't end when the procedure does. We provide continuous monitoring,
            dedicated medical follow-ups, and emotional support during your recovery period. Our clinical team and
            coordinators remain accessible to you 24/7, ensuring you have guidance and reassurance at every moment until
            your goal is fully achieved.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES LIST -->
  <section class="services-section reveal">
    <div class="section-header reveal">
      <h2>All the treatment options<br><em>Dr Yuvi</em> offers.</h2>
      <p>From first consultation to new beginnings, our specialized teams guide you through every step with honesty and
        expertise.</p>
    </div>

    <div class="services-grid">

      @forelse($services as $service)
        <article class="service-card reveal" data-category="{{ $service->accent_class }}">
          <div class="card-img">
            <div class="card-accent {{ $service->accent_class }}"></div>
            <img src="{{ asset('storage/' . $service->listing_image) }}" alt="{{ $service->title }}">
            <div class="card-img-overlay"></div>
            <span class="card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} /
              {{ str_pad($services->count(), 2, '0', STR_PAD_LEFT) }}</span>
          </div>
          <div class="card-body">
            <span class="card-tag">{{ $service->category_tag }}</span>
            <h3 class="card-title">{{ $service->title }}</h3>
            <p class="card-desc">{{ $service->short_description }}</p>
            <div class="card-pills">
              @if($service->hero_pills && is_array($service->hero_pills))
                @foreach($service->hero_pills as $pill)
                  <span class="pill">{{ $pill }}</span>
                @endforeach
              @endif
            </div>
            <div class="card-footer">
              <a href="{{ route('frontend.serviceDetail', $service->slug) }}" class="card-link">
                Learn More
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
              </a>
              <span class="availability"><span class="availability-dot"></span>Accepting</span>
            </div>
          </div>
        </article>
      @empty
        <div class="col-12 text-center py-5">
          <p>No services found at the moment. Please check back later.</p>
        </div>
      @endforelse

    </div>
  </section>

  <!-- TRUST BAND -->
  <!-- <section class="trust-band">
      <div class="trust-inner">
        <div class="trust-item">
          <div class="trust-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
          </div>
          <div class="trust-text">
            <strong>Ethical Practice</strong>
            <span>No unnecessary procedures</span>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
          </div>
          <div class="trust-text">
            <strong>Patient-First Care</strong>
            <span>Compassionate every step</span>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 11 12 14 22 4" />
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
            </svg>
          </div>
          <div class="trust-text">
            <strong>Evidence-Based</strong>
            <span>Latest clinical protocols</span>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <polyline points="12 6 12 12 16 14" />
            </svg>
          </div>
          <div class="trust-text">
            <strong>24/7 Support</strong>
            <span>Always here when you need us</span>
          </div>
        </div>
      </div>
    </section> -->

  <!-- CTA -->
  <section class="cta-section reveal">
    <div class="cta-inner reveal">
      <div class="cta-eyebrow">Still Unsure?</div>
      <h2>Let's find the right <em>pathway</em> for you.</h2>
      <p>Our patient coordinators are here to listen without judgment and guide you toward the most appropriate care —
        at no pressure, whatsoever.</p>
      <div class="cta-btns">
        <a href="{{ route('frontend.contact') }}" class="btn-primary-dark">
          Book Consultation
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['footer_phone'] ?? '919999999999') }}" target="_blank" rel="noopener" class="btn-outline">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>
          WhatsApp Inquiry
        </a>
      </div>
    </div>
  </section>

  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>

  <!-- UNIQUE SCOPED CSS FOR SERVICES PAGE -->
  <style>
    /* Hero Banner with Lab Image */
    .services-hero-banner {
      position: relative;
      height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      overflow: hidden;
      background: #000;
    }

    .services-hero-banner::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('{{ asset('storage/banner/banner1.avif') }}') center center / cover no-repeat;
      z-index: 1;
      animation: heroZoom 20s infinite alternate linear;
    }

    @keyframes heroZoom {
      from { transform: scale(1); }
      to { transform: scale(1.1); }
    }

    .services-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(12, 17, 33, 0.85) 0%, rgba(12, 17, 33, 0.6) 40%, rgba(12, 17, 33, 0.9) 100%);
      z-index: 2;
    }

    .custom-banner-inner {
      position: relative;
      z-index: 10;
      max-width: 1000px;
      margin: 0 auto;
      padding: 0 2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 3.5rem;
    }

    .custom-banner-text {
      max-width: 800px;
    }

    .custom-banner-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      margin-bottom: 2rem;
      color: #fff;
    }

    .hero-eyebrow-dot {
      width: 6px;
      height: 6px;
      background: var(--gold, #f9a215);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--gold);
    }

    .custom-banner-text h1 {
      font-family: 'DM Serif Display', serif;
      color: #fff;
      font-size: clamp(2.5rem, 8vw, 4.5rem);
      margin-bottom: 1.5rem;
      line-height: 1.05;
      letter-spacing: -1px;
    }

    .custom-banner-text h1 em {
      font-style: italic;
      color: #fff;
    }

    .custom-banner-text p {
      color: rgba(255, 255, 255, 0.85);
      font-size: clamp(1rem, 1.5vw, 1.25rem);
      line-height: 1.7;
      max-width: 700px;
      margin: 0 auto;
    }

    .custom-banner-stats {
      display: flex;
      gap: clamp(2rem, 5vw, 4rem);
      flex-wrap: wrap;
      justify-content: center;
    }

    .custom-stat {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      min-width: 120px;
    }

    .custom-stat-num {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      color: var(--gold, #f9a215);
      line-height: 1;
    }

    .custom-stat-label {
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.6);
    }

    @media (max-width: 600px) {
      .services-hero-banner {
        min-height: 500px;
      }
      .custom-banner-inner {
        gap: 2.5rem;
      }
      .custom-banner-text h1 {
        font-size: 3rem;
      }
    }

    /* Process Section - Modern Grid Cards */
    .process-section-grid {
      padding: 6rem 2rem;
      background: #fff;
      overflow: hidden;
    }

    .process-grid-inner {
      max-width: 1200px;
      margin: 0 auto;
    }

    .journey-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 3rem;
      margin-top: 2rem;
    }

    .journey-card {
      background: var(--cream, #faf8f6);
      padding: 3.5rem;
      border-radius: 32px;
      position: relative;
      border: 1px solid rgba(0, 0, 0, 0.04);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      overflow: hidden;
    }

    .journey-card:hover {
      background: #fff;
      transform: translateY(-10px);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
      border-color: var(--crimson-mid, #f0b4b8);
    }

    .journey-num {
      position: absolute;
      top: 1rem;
      right: 2rem;
      font-family: 'DM Serif Display', serif;
      font-size: 6rem;
      line-height: 1;
      color: var(--crimson);
      opacity: 0.05;
      pointer-events: none;
      transition: opacity 0.4s ease, transform 0.4s ease;
    }

    .journey-card:hover .journey-num {
      opacity: 0.1;
      transform: scale(1.1);
    }

    .journey-icon {
      width: 56px;
      height: 56px;
      background: #fff;
      color: var(--crimson);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2rem;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
      transition: all 0.3s ease;
    }

    .journey-card:hover .journey-icon {
      background: var(--crimson);
      color: #fff;
      transform: rotate(-5deg) scale(1.05);
    }

    .journey-title {
      font-family: 'DM Serif Display', serif;
      font-size: 1.8rem;
      color: var(--midnight);
      margin-bottom: 1.2rem;
    }

    .journey-desc {
      font-size: 1.05rem;
      color: var(--slate);
      line-height: 1.8;
      margin: 0;
    }

    @media (max-width: 900px) {
      .journey-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .journey-card {
        padding: 2.5rem;
      }

      .journey-num {
        font-size: 4rem;
        top: 0.5rem;
        right: 1.5rem;
      }
    }
  </style>
@endsection