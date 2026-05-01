<!-- HERO -->
@extends('frontend.layouts.app')

@section('title', 'Home Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

@section('content')
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
  </section>

  <!-- TRUST BAND -->
  <div class="trust-band-1">
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
  </div>

  <!-- DIFFERENTIATOR -->
  <section class="diff-section">
    <div class="diff-inner">
      <div class="diff-grid">
        <div class="diff-left reveal">
          <h2>A Different Kind<br>of <em>Practice</em></h2>
          <p>We believe fertility is personal, not a protocol. Discover a space where rigorous science meets deep
            compassion — where every decision is made for you, not just about you.</p>
          <a href="{{ route('frontend.about') }}" class="btn-crimson-outline">About Dr. Yuvi <svg width="13" height="13"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg></a>
        </div>
        <div class="diff-features reveal delay-1">
          <div class="diff-feature">
            <div class="diff-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg></div>
            <h4>Diagnosis First</h4>
            <p>No assumptions. Full clarity before moving forward.</p>
          </div>
          <div class="diff-feature">
            <div class="diff-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                  d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
              </svg></div>
            <h4>Holistic Support</h4>
            <p>Science, technology, and emotional support unified.</p>
          </div>
          <div class="diff-feature">
            <div class="diff-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg></div>
            <h4>Ethics-Led</h4>
            <p>Transparent, patient-aligned clinical decisions always.</p>
          </div>
          <div class="diff-feature">
            <div class="diff-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="3" width="20" height="14" rx="2" />
                <line x1="8" y1="21" x2="16" y2="21" />
                <line x1="12" y1="17" x2="12" y2="21" />
              </svg></div>
            <h4>Advanced Lab</h4>
            <p>State-of-the-art embryology and surgical setups.</p>
          </div>
        </div>
      </div>
    </div>
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
        <a href="{{ route('frontend.serviceDetail', $service->slug) }}" class="svc-row reveal {{ $index % 3 == 1 ? 'delay-1' : ($index % 3 == 2 ? 'delay-2' : '') }}">
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
          <svg class="svc-arrow" width="18" height="18" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
              style="font-family:'DM Serif Display',serif;font-style:italic;color:var(--gold);">Reimagined.</em></h2>
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
            <iframe src="{{ $story->video_url }}" 
              loading="lazy" allow="autoplay; encrypted-media" allowfullscreen
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
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
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
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
            .hp-stories-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .hp-stories-grid { grid-template-columns: 1fr; }
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
            <img src="{{ asset('storage/' . $blog->image) }}"
              alt="{{ $blog->title }}" class="blog-list-img">
            <span class="blog-list-badge">{{ $blog->category_rel->name ?? 'Article' }}</span>
          </div>
          <div class="blog-list-content">
            <div class="blog-list-meta">{{ $blog->created_at->format('M d, Y') }} · 5 min read</div>
            <h3 class="blog-list-title">{{ $blog->title }}</h3>
            <p class="blog-list-excerpt">{{ $blog->excerpt }}</p>
            <a href="{{ route('frontend.blogDetails', $blog->slug) }}" class="blog-list-link">Read Article <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
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

  <!-- FAQ -->
  <section class="faq-section">
    <div class="faq-inner">
      <div class="faq-left reveal">
        <h2>Common Patient<br><em>Questions</em></h2>
        <p>Seeking treatment can feel overwhelming. We believe in absolute transparency — no question is too small, and no
          concern goes unanswered.</p>
        <a href="{{ route('frontend.contact') }}" class="btn-outline-dark">Ask a Coordinator <svg width="13" height="13"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg></a>
      </div>
      <div class="faq-list reveal delay-1">
        @foreach($faqs as $faq)
        <div class="faq-item"><button class="faq-question">{{ $faq->question }}<div
              class="faq-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--crimson)"
                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
              </svg></div></button>
          <div class="faq-answer">
            <p>{{ $faq->answer }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
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
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '919999999999' }}" target="_blank" rel="noopener" class="btn-outline"><svg width="15"
            height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
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