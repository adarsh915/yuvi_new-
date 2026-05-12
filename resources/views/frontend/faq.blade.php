@extends('frontend.layouts.app')

@section('title', 'FAQs | Dr. Yuvraj Jadeja')
@section('meta_description', 'Find answers to common questions about fertility treatments, IVF procedures, clinic visits, and more.')
@section('meta_keywords', 'IVF FAQs, fertility questions, Dr. Yuvraj Jadeja FAQs, fertility treatment help')

@section('content')
  <section class="faq-hero reveal">
    <div class="faq-hero-inner">
      <div class="breadcrumb"><a href="{{ route('frontend.index') }}">Home</a> / FAQ</div>
      <h1>Clear Answers for Your<br><em>Family Journey</em></h1>
      <p>Empowering you with transparent information. If your question isn't answered here, we're just a message away.</p>
    </div>
  </section>

  <!-- PAGE BODY -->
  <div class="page-body reveal">
    <!-- LEFT FILTER SIDEBAR -->
    <aside class="filter-sidebar">
      <span class="fs-title">Filter FAQs</span>
      <div class="fs-filters">
        <button class="filter-btn active" data-filter="all"><span class="dot"></span>All FAQs<span
            class="filter-count">{{ $faqs->count() }}</span></button>
        @foreach($categories as $cat)
          <button class="filter-btn" data-filter="{{ $cat->id }}">
            <span class="dot"></span>{{ $cat->name }}
            <span class="filter-count">{{ $cat->faqs_count }}</span>
          </button>
        @endforeach

        @php
          $uncategorizedCount = $faqs->whereNull('faq_category_id')->count();
        @endphp
        @if($uncategorizedCount > 0)
          <button class="filter-btn" data-filter="0">
            <span class="dot"></span>General
            <span class="filter-count">{{ $uncategorizedCount }}</span>
          </button>
        @endif
      </div>
    </aside>

    <!-- RIGHT CONTENT AREA -->
    <div class="story-content-main">
      {{-- Mobile filter panel removed to use same vertical list as desktop --}}

      <div class="grid-header reveal"
        style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <h2>Frequently Asked Questions</h2>
        <span id="visibleCount" style="color: var(--muted); font-size: 0.9rem;">Showing {{ $faqs->count() }} FAQs</span>
      </div>

      <main class="faq-container">
        <section class="faq-category">
          <div class="faq-list" id="faqPageGrid">
            @forelse($faqs as $faq)
              <div class="faq-item"
                data-category="{{ $faq->faq_category_id ?? 0 }}">
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
              <div class="empty-state" style="display:block;">
                <p>No questions added yet. Please check back later.</p>
              </div>
            @endforelse

            <div class="empty-state" id="emptyState"
              style="display:none; text-align: center; padding: 3rem 1rem; background: var(--warm-white); border-radius: 12px;">
              <h3 style="margin-bottom: 0.5rem; color: var(--midnight);">No FAQs found</h3>
              <p style="color: var(--muted);">Try selecting a different category.</p>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>

  <style>
    .page-body {
      max-width: 1300px;
      margin: 0 auto;
      padding: 4rem 2rem;
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 3rem;
    }

    /* Tablets & Small Laptops */
    @media (min-width: 601px) and (max-width: 1199px) {
      .page-body {
        grid-template-columns: 1fr;
        padding: 3rem 2rem;
        gap: 2rem;
      }

      .filter-sidebar {
        display: block;
        position: static;
        margin-bottom: 1.5rem;
      }

      .fs-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
      }

      .filter-btn {
        width: auto;
      }

      .grid-header {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
      }

      .faq-hero {
        padding: 4rem 2rem;
      }

      .faq-hero h1 {
        font-size: 2.8rem;
      }

      .faq-container {
        padding: 2rem 0;
      }
    }

    /* Mobile Devices */
    @media (max-width: 600px) {
      .page-body {
        grid-template-columns: 2fr;
        padding: 2rem 1.2rem;
      }

      .filter-sidebar {
        margin-bottom: 1.5rem;
      }

      .fs-filters {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 0.6rem;
        padding-bottom: 1rem;
        -webkit-overflow-scrolling: touch;
      }

      .filter-btn {
        flex: 0 0 auto;
        width: auto;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
      }

      .filter-count {
        display: none;
      }

      .faq-question {
        font-size: 0.95rem;
        padding: 1.2rem 1.5rem;
      }

      .faq-answer p {
        padding: 0 1.5rem 1.2rem;
        font-size: 0.9rem;
      }

      .faq-hero h1 {
        font-size: 2.2rem;
      }

      .faq-hero p {
        font-size: 1rem;
      }
    }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const filterBtns = document.querySelectorAll('.page-body .filter-btn');
      const faqItems = document.querySelectorAll('#faqPageGrid .faq-item');
      const emptyState = document.getElementById('emptyState');
      const visibleCountEl = document.getElementById('visibleCount');

      // --- Filter Logic ---
      filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          filterBtns.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          const filter = btn.getAttribute('data-filter');
          let visible = 0;

          faqItems.forEach(item => {
            const cat = item.getAttribute('data-category');
            if (filter === 'all' || cat === filter) {
              item.style.display = '';
              visible++;
            } else {
              item.style.display = 'none';
              // Close answer if hidden
              item.classList.remove('active');
              const answer = item.querySelector('.faq-answer');
              if(answer) answer.style.maxHeight = null;
            }
          });

          if (emptyState) emptyState.style.display = visible === 0 ? 'block' : 'none';
          if (visibleCountEl) {
            visibleCountEl.textContent = visible === 0 ? "No FAQs found" : `Showing ${visible} FAQ${visible === 1 ? "" : "s"}`;
          }
        });
      });

      // --- Accordion Toggle Logic ---
      faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');

        question.addEventListener('click', () => {
          const isActive = item.classList.contains('active');
          
          // Close others
          faqItems.forEach(other => {
            other.classList.remove('active');
            const otherAns = other.querySelector('.faq-answer');
            if(otherAns) otherAns.style.maxHeight = null;
          });

          // Toggle current
          if (!isActive) {
            item.classList.add('active');
            answer.style.maxHeight = answer.scrollHeight + "px";
          } else {
            item.classList.remove('active');
            answer.style.maxHeight = null;
          }
        });
      });
    });
  </script>

  <section class="cta-section reveal">
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