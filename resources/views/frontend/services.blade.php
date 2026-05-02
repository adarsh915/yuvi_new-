@extends('frontend.layouts.app')

@section('title', 'service Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

<!-- HERO -->
@section('content')
  <!-- TOP BANNER WITH LAB IMAGE -->
  <section class="services-hero-banner reveal">
    <div class="services-hero-overlay"></div>
    <div class="custom-banner-inner">
      <div class="custom-banner-text">
        <div class="custom-banner-eyebrow">Clinical Excellence</div>
        <h1>Specialized <br><em>Fertility Pathways.</em></h1>
        <p>Every journey is unique. Our services are built on advanced embryology, surgical precision, and ethical transparency — tailored entirely around you.</p>
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
  <section class="process-section-wide">
    <div class="process-wide-inner">
      <div class="custom-process-header reveal">
        <h2>How your <em>journey</em><br>unfolds with us.</h2>
        <p>A clear, step-by-step process so you always know what to expect — no surprises, no pressure. We believe in taking the time to explain every detail, giving you all the information you need to feel completely comfortable and confident moving forward.</p>
      </div>
      <div class="process-steps-wide reveal delay-1">
        <div class="step-wide">
          <div class="step-num-wide">01</div>
          <div class="step-content-wide">
            <h3 class="step-title-wide">Consultation</h3>
            <p class="step-desc-wide">Your journey begins with a comprehensive, pressure-free discussion. We take the time to deeply understand your medical history, personal goals, and emotional needs. This is a safe space for you to express all your concerns and ask as many questions as you need without ever feeling rushed.</p>
          </div>
        </div>
        <div class="step-wide">
          <div class="step-num-wide">02</div>
          <div class="step-content-wide">
            <h3 class="step-title-wide">Diagnosis</h3>
            <p class="step-desc-wide">We conduct thorough, state-of-the-art investigations including hormonal, ultrasound, and genetic profiling. We practice strictly ethical medicine — which means we only recommend tests that are absolutely necessary for your specific case, completely avoiding any redundant or unnecessary procedures.</p>
          </div>
        </div>
        <div class="step-wide">
          <div class="step-num-wide">03</div>
          <div class="step-content-wide">
            <h3 class="step-title-wide">Treatment</h3>
            <p class="step-desc-wide">Based on your diagnosis, we design a highly tailored treatment protocol specifically around your age and family goals. We discuss the scientific rationale behind each clinical step, transparently outline the success probabilities, and meticulously guide you through the actual treatment phase with the utmost precision and care.</p>
          </div>
        </div>
        <div class="step-wide">
          <div class="step-num-wide">04</div>
          <div class="step-content-wide">
            <h3 class="step-title-wide">Recovery</h3>
            <p class="step-desc-wide">Our care doesn't end when the procedure does. We provide continuous monitoring, dedicated medical follow-ups, and emotional support during your recovery period. Our clinical team and coordinators remain accessible to you 24/7, ensuring you have guidance and reassurance at every moment until your goal is fully achieved.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES LIST -->
  <section class="services-section">
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
          <span class="card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($services->count(), 2, '0', STR_PAD_LEFT) }}</span>
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
  <section class="trust-band">
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
  </section>

  <!-- CTA -->
  <section class="cta-section">
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
        <a href="https://wa.me/919999999999" target="_blank" rel="noopener" class="btn-outline">
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
      background: url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=2000&auto=format&fit=crop') center center / cover no-repeat;
      padding: 140px 0 100px;
      color: #fff;
      overflow: hidden;
    }
    .services-hero-overlay {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: linear-gradient(135deg, rgba(12, 17, 33, 0.95) 0%, rgba(12, 17, 33, 0.7) 100%);
      z-index: 1;
    }
    .custom-banner-inner {
      position: relative;
      z-index: 2;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      flex-direction: column;
      gap: 4rem;
    }
    .custom-banner-text {
      max-width: 800px;
    }
    .custom-banner-eyebrow {
      display: inline-block;
      padding: 0.35rem 1rem;
      border-radius: 50px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      font-size: 0.8rem;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 1.5rem;
    }
    .custom-banner-text h1 {
      font-family: 'DM Serif Display', serif;
      color: #fff;
      font-size: clamp(3rem, 6vw, 4.5rem);
      margin-bottom: 1.5rem;
      line-height: 1.1;
    }
    .custom-banner-text p {
      color: rgba(255,255,255,0.9);
      font-size: 1.2rem;
      line-height: 1.6;
    }
    .custom-banner-stats {
      display: flex;
      gap: 4rem;
      flex-wrap: wrap;
    }
    .custom-stat {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    .custom-stat-num {
      font-family: 'DM Serif Display', serif;
      font-size: 3.5rem;
      color: var(--gold, #d4af37);
      line-height: 1;
    }
    .custom-stat-label {
      font-size: 1.1rem;
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.7);
    }

    /* Process Section - Horizontal Journey */
    .process-section-wide {
      padding: 6rem 2rem;
      background: var(--bg-light, #fcfcfc);
    }
    .process-wide-inner {
      max-width: 1300px;
      margin: 0 auto;
    }
    .custom-process-header {
      text-align: center;
      margin-bottom: 4rem;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }
    .custom-process-header h2 {
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      margin-bottom: 1rem;
      color: #111; /* Explicit dark color */
      line-height: 1.2;
    }
    .custom-process-header h2 em {
      color: var(--gold, #d4af37);
      font-style: italic;
    }
    .custom-process-header p {
      font-size: 1.15rem;
      color: #555; /* Explicit dark color */
      margin: 0 auto;
      line-height: 1.6;
    }
    .process-steps-wide {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2rem;
      position: relative;
    }
    /* Horizontal connecting line */
    .process-steps-wide::before {
      content: '';
      position: absolute;
      top: 30px; /* Center of the 60px number circles */
      left: 30px;
      right: 30px;
      height: 2px;
      background: rgba(188, 43, 61, 0.2); /* crimson light */
      z-index: 1;
    }
    .step-wide {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      align-items: center; /* Center the number over the card */
      position: relative;
      z-index: 2;
    }
    .step-num-wide {
      font-family: 'DM Serif Display', serif;
      font-size: 2rem;
      color: var(--crimson);
      background: #fff;
      min-width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      border: 2px solid var(--crimson);
      box-shadow: 0 4px 10px rgba(188, 43, 61, 0.1);
      z-index: 3;
    }
    .step-content-wide {
      background: #fff;
      padding: 2.5rem 1.5rem;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.04);
      height: 100%;
      width: 100%;
      text-align: center;
      border-top: 4px solid var(--crimson);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .step-content-wide:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .step-title-wide {
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 1rem;
    }
    .step-desc-wide {
      font-size: 1.05rem;
      color: var(--text-muted);
      line-height: 1.6;
      margin-bottom: 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .process-steps-wide {
        grid-template-columns: repeat(2, 1fr);
        gap: 3rem 2rem;
      }
      .process-steps-wide::before {
        display: none; /* Hide horizontal line when wrapping into rows */
      }
    }
    @media (max-width: 768px) {
      .services-hero-banner {
        padding: 100px 0 80px;
      }
      .custom-banner-stats {
        flex-wrap: wrap;
        gap: 2rem;
      }
      .custom-stat-num {
        font-size: 2.5rem;
      }
      .process-steps-wide {
        grid-template-columns: 1fr;
        gap: 2.5rem;
      }
      .step-wide {
        flex-direction: column;
        align-items: center;
      }
      .step-num-wide {
        font-size: 2rem;
        min-width: 60px;
        height: 60px;
      }
    }
  </style>
@endsection