@extends('frontend.layouts.app')

@section('title', 'FAQs | Dr. Yuvraj Jadeja')
@section('meta_description', 'Find answers to common questions about fertility treatments, IVF, clinic procedures, and more.')

@section('content')
  <section class="faq-hero">
    <div class="faq-hero-inner">
      <div class="breadcrumb"><a href="{{ route('frontend.index') }}">Home</a> / FAQ</div>
      <h1>Clear Answers for Your<br><em>Family Journey</em></h1>
      <p>Empowering you with transparent information. If your question isn't answered here, we're just a message away.</p>
    </div>
  </section>

  <main class="faq-container">
    <section class="faq-category">
      <div class="faq-list">
        @forelse($faqs as $faq)
        <div class="faq-item">
          <button class="faq-question">{{ $faq->question }}
            <div class="faq-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
              </svg></div>
          </button>
          <div class="faq-answer">
            <p>{{ $faq->answer }}</p>
          </div>
        </div>
        @empty
        <div class="empty-state">
            <p>No questions added yet. Please check back later.</p>
        </div>
        @endforelse
      </div>
    </section>
  </main>

  <section class="cta-section">
    <div class="cta-inner">
      <h2>Still have questions?</h2>
      <p>We're here to provide the clarity you need to move forward with peace of mind.</p>
      <a href="{{ route('frontend.contact') }}" class="btn-primary">
        Speak with a Consultant
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
          stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12" />
          <polyline points="12 5 19 12 12 19" />
        </svg>
      </a>
    </div>
  </section>

  <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>
@endsection