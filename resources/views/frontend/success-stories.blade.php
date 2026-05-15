@extends('frontend.layouts.app')

@section('title', 'Success Stories | Dr. Yuvraj Jadeja')
@section('meta_description', 'Real stories of hope and healing. Discover patient journeys and clinical success stories at our fertility clinic.')

@section('content')
  <!-- HERO -->
  <section class="hero_box3 reveal">
    <div class="hero-eyebrow">Success Stories</div>
    <h1>Voices of <em>Hope &amp; Healing</em></h1>
    <p>Every family carries a unique story. These are moments of perseverance, clinical precision, and the profound joy
      of new beginnings.</p>
    <div class="hero-stats">
      <div class="stat"><span class="stat-num">1,200+</span><span class="stat-label">Successful Births</span></div>
      <div class="stat"><span class="stat-num">15 Yrs</span><span class="stat-label">Clinical Experience</span></div>
      <div class="stat"><span class="stat-num">98%</span><span class="stat-label">Patient Satisfaction</span></div>
    </div>
  </section>

  <!-- PAGE BODY -->
  <div class="page-body reveal">

    {{-- Sidebar moved to right --}}

    <!-- LEFT FILTER SIDEBAR -->
    <aside class="filter-sidebar">
      <span class="fs-title">Filter Journeys</span>
      <div class="fs-filters">
        <button class="filter-btn story-filter-btn active" data-filter="all"><span class="dot"></span>All Journeys<span
            class="filter-count">{{ $stories->total() }}</span></button>
        @foreach($categories as $cat)
            <button class="filter-btn story-filter-btn" data-filter="{{ Str::slug($cat->name) }}">
              <span class="dot"></span>{{ $cat->name }}
              <span class="filter-count">{{ $cat->stories_count }}</span>
            </button>
        @endforeach
      </div>
      <hr class="fs-divider">
      <div class="fs-note"><strong>Privacy First.</strong><br>All stories are shared with full informed consent. Names may
        be changed to protect privacy.</div>

      <div class="sidebar-cta"
        style="margin-top: 2rem; background: var(--crimson-light); padding: 1.5rem; border-radius: 12px;">
        <h4 style="font-size: 1rem; color: var(--crimson); margin-bottom: 0.5rem;">Start Your Story</h4>
        <p style="font-size: 0.85rem; color: var(--blue-mid); line-height: 1.4; margin-bottom: 1rem;">Let us help you
          achieve your dream of parenthood.</p>
        <a href="{{ route('frontend.quiz') }}"
          style="display: inline-block; color: var(--crimson); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Take
          Fertility Quiz &rarr;</a>
      </div>
    </aside>

    <!-- RIGHT CONTENT AREA -->
    <div class="story-content-main">
      <!-- Mobile filter toggle -->
      {{-- Mobile filter panel removed to use same vertical list as desktop --}}

      <div class="grid-header reveal">
        <h2>Patient Success Stories</h2>
        <span id="storyVisibleCount">Showing {{ $stories->firstItem() }}-{{ $stories->lastItem() }} of {{ $stories->total() }} stories</span>
      </div>

      <div class="story-page-grid" id="storyPageGrid">
        @if($stories->isEmpty())
          <div class="empty-state" id="storyEmptyState">
            <h3>No stories found</h3>
            <p>Try selecting a different category.</p>
          </div>
        @else
          @include('frontend.partials.story_cards', ['stories' => $stories])
        @endif
      </div>

      <div class="empty-state" id="storyEmptyState" style="display:none;">
        <h3>No stories found</h3>
        <p>Try selecting a different category.</p>
      </div>

      <!-- Pagination -> Load More -->
      @if($stories->hasMorePages())
      <div class="story-pagination reveal delay-2" id="storyLoadMoreContainer" style="display: flex; justify-content: center; margin-top: 3rem;">
          <button class="btn-outline load-more-btn" data-target="storyPageGrid" data-container="storyLoadMoreContainer" data-param="page" data-next-page="{{ $stories->currentPage() + 1 }}" style="padding: 12px 30px; font-weight: 600; cursor: pointer;">
              Load More Stories
          </button>
      </div>
      @endif
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

      .story-page-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
      }

      .story-page-card {
        position: relative;
        background: #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      }

      .story-page-card:hover {
        transform: translateY(-8px);
      }

      .story-page-video-wrap {
        aspect-ratio: 9/16;
        position: relative;
        width: 100%;
      }

      .story-page-video-wrap iframe,
      .story-short-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: none;
      }

      .story-page-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 50px 20px 20px;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.95));
        color: #fff;
        display: flex;
        flex-direction: column;
        pointer-events: none;
        z-index: 2;
      }

      .story-page-patient-name {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: -0.01em;
      }

      .story-page-treatment-tag {
        font-size: 0.75rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 4px;
      }



      @media (max-width: 1100px) {
        .page-body {
          grid-template-columns: 1fr;
          padding: 2rem 1.5rem;
          gap: 2rem;
        }

        /* Hide privacy note and CTA on mobile */
        .fs-divider,
        .fs-note,
        .filter-sidebar .sidebar-cta {
          display: none !important;
        }

        .filter-sidebar {
          display: block;
          position: static;
          margin-bottom: 2rem;
        }

        .story-page-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 768px) {
        .story-page-grid {
          grid-template-columns: 1fr;
        }
      }

      /* Pagination Styles */
      .story-pagination {
        margin-top: 50px;
        display: flex;
        justify-content: center;
      }
      .story-pagination .pagination {
        display: flex;
        gap: 10px;
        list-style: none;
        padding: 0;
      }
      .story-pagination .page-item .page-link {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff;
        color: var(--midnight);
        border: 1px solid var(--card-border);
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
      }
      .story-pagination .page-item.active .page-link {
        background: var(--midnight);
        color: #fff;
        border-color: var(--midnight);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }
      .story-pagination .page-item:hover:not(.active):not(.disabled) .page-link {
        background: var(--blue-light);
        transform: translateY(-2px);
      }
      .story-pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
      }
    </style>

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
              btn.addEventListener('click', function() {
                const text = this.previousElementSibling;
                const isExpanded = text.classList.toggle('expanded');
                this.textContent = isExpanded ? 'Read Less' : 'Read More';
                
                // Recalculate layout if needed
              });
            });

            // Run check on load and resize
            setTimeout(checkReadMore, 100);
            window.addEventListener('resize', checkReadMore);
          }
        });
      </script>
    </section>
    <!-- TRUST BAND -->
    <!-- <section class="trust-band">
        <div class="trust-inner">
          <div class="trust-item">
            <div class="trust-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" /></svg></div>
            <div class="trust-text"><strong>Ethical Practice</strong><span>No unnecessary procedures</span></div>
          </div>
          <div class="trust-item">
            <div class="trust-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg></div>
            <div class="trust-text"><strong>Patient-First Care</strong><span>Compassionate every step</span></div>
          </div>
        </div>
      </section> -->

    <a href="{{ route('frontend.quiz') }}" class="mobile-floating-cta">Get Started &rarr;</a>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const storyFilterBtns = document.querySelectorAll('.story-filter-btn');
        const storyCards = document.querySelectorAll('.story-page-card');
        const storyVisibleCountText = document.getElementById('storyVisibleCount');
        const storyEmptyState = document.getElementById('storyEmptyState');

        function filterStories(category) {
          console.log('Filtering stories by:', category);
          let count = 0;

          storyCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            // If category is 'all' or matches the card's category
            if (category === 'all' || cardCat === category) {
              card.style.display = 'block';
              count++;
              card.classList.add('reveal');
            } else {
              card.style.display = 'none';
            }
          });

          // Update the display count text
          if (storyVisibleCountText) {
            storyVisibleCountText.textContent = `Showing ${count} ${count === 1 ? 'story' : 'stories'}`;
          }

          // Toggle empty state visibility
          if (storyEmptyState) {
            if (count === 0) {
              storyEmptyState.style.display = 'block';
            } else {
              storyEmptyState.style.display = 'none';
            }
          }
        }

        storyFilterBtns.forEach(btn => {
          btn.addEventListener('click', (e) => {
            e.preventDefault();
            storyFilterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.getAttribute('data-filter');
            filterStories(filter);
          });
        });

        // Initial filter on page load to sync count and visibility
        filterStories('all');
      });
    </script>
@endsection