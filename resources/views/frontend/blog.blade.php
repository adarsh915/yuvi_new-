@extends('frontend.layouts.app')

@section('title', 'Health Blog | Dr. Yuvraj Jadeja')
@section('meta_description', 'Stay updated with the latest in fertility science, women\'s health tips, and clinical insights from Dr. Yuvraj Jadeja.')
@section('meta_keywords', 'fertility blog, women\'s health Ahmedabad, IVF updates, Dr. Yuvraj Jadeja blog')

@section('content')
  <!-- HERO -->
  <section class="hero_box2 reveal">
    <div class="hero-eyebrow">Health Blog</div>
    <h1>Latest <em>Health &amp; Fertility</em> Articles</h1>
    <p>Deep dives into reproductive health, wellness tips, and the latest clinical advancements from Dr. Yuvraj Jadeja.
    </p>
    <div class="hero-stats-box">
      <div class="stat-box">
        <span class="stat-num-box">150+</span>
        <span class="stat-label-box">Articles Published</span>
      </div>
      <div class="stat-box">
        <span class="stat-num-box">15 Yrs</span>
        <span class="stat-label-box">Clinical Experience</span>
      </div>
      <div class="stat-box">
        <span class="stat-num-box">10k+</span>
        <span class="stat-label-box">Monthly Readers</span>
      </div>
    </div>
  </section>

  <!-- MAIN LAYOUT -->
  <div class="blog_main reveal">

    <!-- SIDEBAR -->
    <aside class="sidebar reveal">
      <p class="sidebar-title">Article Categories</p>
      <div class="filter-group">
        <button class="filter-btn active" data-filter="all">
          <span class="dot"></span> All Articles
          <span class="filter-count" id="count-all">{{ $blogs->count() }}</span>
        </button>
        @foreach($categories as $cat)
          <button class="filter-btn" data-filter="{{ $cat->slug }}">
            <span class="dot"></span> {{ $cat->name }}
            <span class="filter-count">{{ $cat->blogs_count }}</span>
          </button>
        @endforeach
      </div>
      <hr class="sidebar-divider">
      <div class="sidebar-note">
        <strong>Stay Updated.</strong><br>
        Explore our collection of expert-led articles on women's health, fertility treatments, and modern reproductive
        science.
      </div>
    </aside>

    <!-- VIDEO GRID -->
    <div>
      <div class="grid-header reveal">
        <h2>Recent Articles</h2>
        <span id="visibleCount">Showing {{ $blogs->count() }} articles</span>
      </div>

      <div class="grid" id="blogGrid">

        @forelse($blogs as $blog)
          <article class="card reveal" data-category="{{ $blog->category_rel->slug ?? 'uncategorized' }}">
            <div class="card-img">
              @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
              @else
                <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&q=80&w=700"
                  alt="{{ $blog->title }}">
              @endif
            </div>
            <div class="card-body">
              <span class="card-tag" style="color:var(--crimson);">{{ strtoupper($blog->category_rel->name ?? 'UNCATEGORIZED') }}</span>
              <h3 class="card-title">{{ $blog->title }}</h3>
              <p style="color:var(--slate); font-size:0.9rem; margin-bottom:1rem; line-height:1.6;">{{ Str::limit($blog->excerpt, 120) }}</p>
              <div class="card-hashtags">
                @if($blog->tags)
                  @foreach(explode(',', $blog->tags) as $tag)
                    <span>{{ trim($tag) }}</span>
                  @endforeach
                @endif
              </div>
              <div class="card-meta"
                style="justify-content:space-between; border-top:1px solid rgba(184,36,48,0.1); padding-top:1.2rem; margin-top:auto;">
                <span class="card-meta-item">{{ $blog->created_at->format('M d, Y') }}</span>
                <a href="{{ route('frontend.blogDetails', $blog->slug) }}"
                  style="text-decoration:none; color:var(--blue); font-weight:600; font-size:0.85rem; display:flex; align-items:center; gap:0.4rem;">Read
                  Article &rarr;</a>
              </div>
            </div>
          </article>
        @empty
          <div class="empty-state" style="display: flex;" id="emptyState">
            <div class="empty-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4f84ae" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2a9 9 0 1 0 0 18A9 9 0 0 0 12 2z" />
                <path d="M12 8v4" />
                <path d="M12 16h.01" />
              </svg>
            </div>
            <h3>No articles found</h3>
            <p>We haven't published any articles yet. Please check back later!</p>
          </div>
        @endforelse

      </div>
    </div>
  </div>

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

  <!-- QUOTE / CTA -->
  <section class="quote-section reveal">
    <div class="quote-inner">
      <span class="quote-mark">"</span>
      <p class="quote-text">Empowering your health journey through expert knowledge. Knowledge is the first step toward
        a healthy journey. Read, learn, and empower your reproductive health.</p>
      <span class="quote-author">— Dr. Yuvraj Jadeja, Medical Director</span>
      <br>
      <a href="{{ route('frontend.contact') }}" class="quote-cta">
        Subscribe to Blog
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M12 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </section>

  <style>
    .grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    @media (max-width: 1100px) {
      .sidebar-divider,
      .sidebar-note {
        display: none !important;
      }

      .blog_main {
        grid-template-columns: 1fr;
        gap: 2rem;
      }
      .grid {
        grid-template-columns: repeat(2, 1fr) !important;
      }
    }
    @media (max-width: 768px) {
      .grid {
        grid-template-columns: 1fr !important;
      }
    }
  </style>


  <!-- FOOTER -->




  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection