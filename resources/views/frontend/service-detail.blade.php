@extends('frontend.layouts.app')

@section('title', 'service-details Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

@section('content')
  <!-- HERO -->
  <div class="hero-accent {{ $service->accent_class }}" id="heroAccent"></div>
  <section class="hero reveal">
    <div class="hero-inner">
      <div class="hero-text">
        <div class="hero-breadcrumb">
          <a href="{{ route('frontend.services') }}">Services</a>
          <span class="hero-breadcrumb-sep">/</span>
          <span id="heroTag">{{ $service->category_tag }}</span>
        </div>
        <div class="hero-eyebrow" id="heroEyebrow">{{ $service->hero_eyebrow }}</div>
        <h1 id="heroTitle">{!! str_replace(' ', ' <em>', $service->title) . '</em>' !!}</h1>
        <p class="hero-lead" id="heroLead">{{ $service->hero_lead }}</p>
        <div class="hero-pills" id="heroPills">
          @if($service->hero_pills && is_array($service->hero_pills))
            @foreach($service->hero_pills as $pill)
                <span class="hero-pill">{{ $pill }}</span>
            @endforeach
          @endif
        </div>
      </div>
      <div class="hero-img-wrap">
        <img id="heroImg"
          src="{{ asset('storage/' . $service->hero_image) }}"
          alt="{{ $service->title }}">
      </div>
    </div>
  </section>

  <!-- MAIN -->
  <div class="main-wrap">

    <!-- ── LEFT CONTENT ── -->
    <div class="content-col">

      <!-- Stats -->
      <div class="stats-row reveal" id="statsRow">
        @if($service->stat1_num)
        <div class="stat-card"><span class="stat-num">{{ $service->stat1_num }}</span><span class="stat-label">{{ $service->stat1_label }}</span></div>
        @endif
        @if($service->stat2_num)
        <div class="stat-card"><span class="stat-num">{{ $service->stat2_num }}</span><span class="stat-label">{{ $service->stat2_label }}</span></div>
        @endif
        @if($service->stat3_num)
        <div class="stat-card"><span class="stat-num">{{ $service->stat3_num }}</span><span class="stat-label">{{ $service->stat3_label }}</span></div>
        @endif
      </div>

      <!-- Approach -->
      <div class="content-section reveal">
        <h2>{{ $service->approach_title }}</h2>
        <div class="bd-article__body">
            {!! $service->approach_text !!}
        </div>
      </div>

      <!-- Protocol -->
      @if($service->protocol_json)
      <div class="protocol-block reveal">
        <h3>{{ $service->protocol_title }}</h3>
        <ul class="protocol-steps" id="protocolSteps">
          @foreach($service->protocol_json as $index => $step)
          <li class="protocol-step">
            <span class="protocol-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            <div class="protocol-step-body">
              <div class="protocol-step-title">{{ $step['title'] ?? '' }}</div>
              <div class="protocol-step-desc">{{ $step['desc'] ?? '' }}</div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- What to Expect -->
      @if($service->expect_json)
      <div class="content-section reveal">
        <h2>{{ $service->expect_title }}</h2>
        <ul class="expect-list" id="expectList">
          @foreach($service->expect_json as $item)
          <li class="expect-item">
            <div class="expect-icon"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--crimson)"
                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 11 12 14 22 4" />
              </svg></div>
            {{ $item }}
          </li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Safety -->
      <div class="content-section reveal">
        <h2>{{ $service->safety_title }}</h2>
        <div class="bd-article__body">
            {!! $service->safety_text !!}
        </div>
      </div>

    </div>

    <!-- SIDEBAR COMPONENT -->

    <aside class="sidebar" id="sidebar">

      <!-- CTA -->
      <div class="sidebar-cta reveal">
        <h4>Ready to consult?</h4>
        <p>Speak with a coordinator or book a direct appointment — no pressure, just clarity.</p>
        <a href="{{ route('frontend.contact') }}" class="btn-cta-white">Book Appointment</a>
        <a href="https://wa.me/919999999999" target="_blank" rel="noopener" class="btn-cta-outline">WhatsApp Us</a>
      </div>

      <!-- Availability -->
      <div class="sidebar-card reveal delay-1">
        <div class="avail-badge">
          <span class="avail-dot"></span>
          Currently accepting new patients
        </div>
      </div>

      <!-- Related Pathways -->
      <div class="sidebar-card reveal delay-1">
        <h4>Related Pathways</h4>
        <ul class="related-list" id="relatedList">
          @foreach($allServices as $related)
          <li class="related-item">
              <a href="{{ route('frontend.serviceDetail', $related->slug) }}" class="related-link">
                  {{ $related->title }}
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                  </svg>
              </a>
          </li>
          @endforeach
        </ul>
      </div>

      <!-- Trust -->
      <div class="sidebar-card reveal delay-2">
        <h4>Our Promise</h4>
        <div class="trust-pills">
          <div class="trust-pill">
            <div class="trust-pill-icon">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--crimson)" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
            </div>
            Ethical — no unnecessary procedures
          </div>
          <div class="trust-pill">
            <div class="trust-pill-icon">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--crimson)" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 11 12 14 22 4" />
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
              </svg>
            </div>
            Evidence-based clinical protocols
          </div>
          <div class="trust-pill">
            <div class="trust-pill-icon">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--crimson)" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
            </div>
            24/7 support throughout your journey
          </div>
        </div>
      </div>

      <!-- Quick Contact -->
      <div class="quick-card"
        style="background: var(--midnight); color: #fff; padding:1.5rem; border-radius:12px; margin-top:1rem;">
        <p
          style="font-size:0.65rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--blue-mid); margin-bottom:1rem;">
          Quick Support</p>
        <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:1rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--blue-mid)" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>
          <div style="font-size:0.8rem;">
            <strong style="display:block;">WhatsApp</strong>
            <a href="https://wa.me/919999999999" style="color:var(--blue-mid); text-decoration:none;">+91 999 999
              9999</a>
          </div>
        </div>
        <div style="display:flex; align-items:center; gap:0.75rem;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--blue-mid)" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
            <polyline points="22,6 12,13 2,6" />
          </svg>
          <div style="font-size:0.8rem;">
            <strong style="display:block;">Email</strong>
            <a href="mailto:doctoryuvi@nimaaya.com"
              style="color:var(--blue-mid); text-decoration:none;">doctoryuvi@nimaaya.com</a>
          </div>
        </div>
      </div>
    </aside>

    <!-- Sidebar Toggle Trigger -->
    <!-- <div class="sidebar-toggle-btn" id="sidebarToggle">
        Explore Info
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 18l-6-6 6-6" />
        </svg>
      </div> -->
  </div>

  <!-- PROCESS -->
  <section class="process-section">
    <div class="process-inner">
      <div class="process-header reveal">
        <h2>How your <em>journey</em><br>unfolds with us.</h2>
        <p>A clear, step-by-step process so you always know what to expect — no surprises, no pressure.</p>
      </div>
      <div class="process-steps reveal">
        <div class="step">
          <div class="step-num">01</div>
          <p class="step-title">Initial Consultation</p>
          <p class="step-desc">Meet Dr. Yuvi for a comprehensive first discussion about your history, goals, and the
            best path forward.</p>
        </div>
        <div class="step">
          <div class="step-num">02</div>
          <p class="step-title">Diagnostic Workup</p>
          <p class="step-desc">Thorough investigations for both partners including hormonal, ultrasound, and genetic
            profiling as needed.</p>
        </div>
        <div class="step">
          <div class="step-num">03</div>
          <p class="step-title">Personalised Protocol</p>
          <p class="step-desc">A tailored treatment plan designed specifically around your diagnosis, age, and family
            goals.</p>
        </div>
        <div class="step">
          <div class="step-num">04</div>
          <p class="step-title">Ongoing Support</p>
          <p class="step-desc">Continuous monitoring and emotional support at every cycle, every step, until your goal
            is achieved.</p>
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

  <!-- FOOTER -->






  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection