@extends('frontend.layouts.app')

@section('title', 'blog-details Page')
@section('meta_description', 'Welcome to our website')
@section('meta_keywords', 'home, laravel, website')

@section('content')
  <section class="article-hero reveal">
    <div class="article-inner">
      <div class="breadcrumb">
        <a href="{{ route('frontend.index') }}">Home</a> / <a href="{{ route('frontend.blog') }}">Blog</a> /
        <span>{{ $blog->title }}</span>
      </div>
      <div class="hero-eyebrow">{{ strtoupper($blog->category) }}</div>
      <h1>{!! str_replace(' ', ' <em>', $blog->title) . '</em>' !!}</h1>
      <div class="meta-info">
        <div class="author">
          <div class="author-img"></div>
          <span>{{ $blog->author }}</span>
        </div>
        <span>•</span>
        <span>{{ $blog->created_at->format('F d, Y') }}</span>
        <span>•</span>
        <span>{{ ceil(str_word_count(strip_tags($blog->body)) / 200) }} min read</span>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="bd-layout">

    <article class="bd-article reveal">

      @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}"
          alt="{{ $blog->title }}" class="bd-article__img-full">
      @endif

      <div class="bd-article__body">
          {!! $blog->body !!}
      </div>

      <!-- Tags -->
      <div class="bd-article__tags">
        @if($blog->tags)
            @foreach(explode(',', $blog->tags) as $tag)
                <a href="#" class="bd-tag">{{ trim($tag) }}</a>
            @endforeach
        @endif
      </div>
    </article>

    <!-- RIGHT SIDEBAR -->
    <aside class="bd-sidebar">

      <!-- Logo -->
      <div class="bd-sidebar__brand">
        <img src="{{ asset('assets/frontend/img/63e0fe368fba6.png') }}" alt="Dr Yuvraj Jadeja Logo">
      </div>

      <!-- Categories -->
      <div class="bd-sidebar__card reveal">
        <h4 class="bd-sidebar__card-title">Article Topics</h4>
        <div class="bd-sidebar__tags">
          <span class="bd-sidebar__cat-tag bd-sidebar__cat-tag--primary">Fertility</span>
          <span class="bd-sidebar__cat-tag bd-sidebar__cat-tag--secondary">Clinical Updates</span>
        </div>
      </div>

      <!-- Related Articles -->
      <div class="bd-sidebar__card reveal">
        <h4 class="bd-sidebar__card-title">Related Articles</h4>
        <ul class="bd-related-list">
          @foreach($relatedBlogs as $related)
          <li class="bd-related-item">
            <a href="{{ route('frontend.blogDetails', $related->slug) }}" class="bd-related-link">
              <div class="bd-related-thumb">
                @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                @else
                    <img src="https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&q=80&w=150" alt="{{ $related->title }}">
                @endif
              </div>
              <div class="bd-related-info">
                <h5 class="bd-related-title">{{ $related->title }}</h5>
                <span class="bd-related-meta">{{ $related->created_at->format('M d, Y') }} · {{ ucfirst($related->category) }}</span>
              </div>
            </a>
          </li>
          @endforeach
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="bd-sidebar__card bd-sidebar__card--newsletter reveal">
        <h4 class="bd-sidebar__card-title">Health Blog</h4>
        <p class="bd-sidebar__card-text">Receive the latest health tips and clinical updates directly in your inbox.</p>
        <button class="bd-subscribe-btn">Subscribe to Blog</button>
      </div>

      <!-- Consult CTA -->
      <div class="bd-sidebar__card bd-sidebar__card--consult reveal">
        <h4 class="bd-sidebar__card-title bd-sidebar__card-title--blue">Need Clarity?</h4>
        <p class="bd-sidebar__card-text">Schedule a personalized consultation with Dr. Yuvi to discuss your specific
          journey.</p>
        <a href="{{ route('frontend.contact') }}" class="bd-consult-link">Book an Appointment &rarr;</a>
      </div>

      <!-- Quick Contact -->
      <div class="bd-quick-contact reveal">
        <p class="bd-quick-contact__label">Quick Support</p>
        <div class="bd-quick-contact__item">
          <div class="bd-quick-contact__icon">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path
                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
            </svg>
          </div>
          <div class="bd-quick-contact__detail">
            <strong>WhatsApp</strong>
            <a href="https://wa.me/919999999999">+91 999 999 9999</a>
          </div>
        </div>
        <div class="bd-quick-contact__item">
          <div class="bd-quick-contact__icon">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
          </div>
          <div class="bd-quick-contact__detail">
            <strong>Email</strong>
            <a href="mailto:doctoryuvi@nimaaya.com">doctoryuvi@nimaaya.com</a>
          </div>
        </div>
      </div>

    </aside>
  </main>


  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection