# Yuvi Website Modernization & Navigation Updates

This document contains all the recent code changes made to modernize the website's visual identity and navigation structure. You can copy these snippets directly to your live server.

---

## 1. Header Navigation & Submenu Updates
**Files affected:** 
- `resources/views/frontend/layouts/header.blade.php`
- `public/assets/frontend/css/style.css`

### A. Header HTML (`header.blade.php`)
Replace the mobile drawer links and the desktop `nav-center` list with the following:

```html
<!-- Drawer Links (Approx line 30-95) -->
<a href="{{ route('frontend.about') }}" class="drawer-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}">
    About Dr. Yuvi
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
</a>
<a href="{{ route('frontend.team') }}" class="drawer-link {{ request()->routeIs('frontend.team') ? 'active' : '' }}" style="padding-left: 2.8rem; font-size: 0.95rem; opacity: 0.85;">
    Meet Our Team
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
</a>
<!-- ... other links ... -->
<a href="{{ route('frontend.faq') }}" class="drawer-link {{ request()->routeIs('frontend.faq') ? 'active' : '' }}">
    FAQ
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
</a>

<!-- Desktop Nav (Approx line 184-207) -->
<ul class="nav-center">
    <li><a href="{{ route('frontend.index') }}" class="{{ request()->requestUri === '/' ? 'active' : '' }}">Home</a></li>
    <li class="has-submenu">
        <a href="javascript:void(0)" class="{{ request()->routeIs('frontend.about', 'frontend.team') ? 'active' : '' }}">About</a>
        <ul class="nav-submenu">
            <li><a href="{{ route('frontend.about') }}">About Dr. Yuvi</a></li>
            <li><a href="{{ route('frontend.team') }}">Meet Our Team</a></li>
        </ul>
    </li>
    <li><a href="{{ route('frontend.services') }}" class="{{ request()->routeIs('frontend.services', 'frontend.serviceDetail') ? 'active' : '' }}">Treatment & Care</a></li>
    <li><a href="{{ route('frontend.gallery') }}" class="{{ request()->routeIs('frontend.gallery') ? 'active' : '' }}">Gallery</a></li>
    <li><a href="{{ route('frontend.successStories') }}" class="{{ request()->routeIs('frontend.successStories') ? 'active' : '' }}">Stories</a></li>
    <li><a href="{{ route('frontend.media') }}" class="{{ request()->routeIs('frontend.media') ? 'active' : '' }}">Media</a></li>
    <li><a href="{{ route('frontend.faq') }}" class="{{ request()->routeIs('frontend.faq') ? 'active' : '' }}">FAQ</a></li>
    <li><a href="{{ route('frontend.contact') }}" class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}">Contact</a></li>
</ul>
```

### B. Header CSS (`style.css`)
Add these styles at the end of your navigation section:

```css
/* ── NAV SUBMENU ── */
.nav-center li { position: relative; }
.nav-submenu {
    position: absolute; top: 100%; left: -20px; width: 220px;
    background: #fff; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    border-radius: 12px; list-style: none; padding: 0.8rem 0;
    opacity: 0; visibility: hidden; transform: translateY(15px);
    transition: all 0.35s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border: 1px solid rgba(0, 0, 0, 0.05); z-index: 100;
}
.nav-center li:hover .nav-submenu { opacity: 1; visibility: visible; transform: translateY(0); }
.nav-submenu li { width: 100%; }
.nav-submenu li a {
    display: block; padding: 0.75rem 1.5rem; font-size: 0.92rem;
    color: var(--slate); font-weight: 500; transition: all 0.25s ease; border: none;
}
.nav-submenu li a::after { display: none !important; }
.nav-submenu li a:hover { background: var(--crimson-light); color: var(--crimson); padding-left: 1.8rem; }
```

---

## 2. Homepage Modernization (100vh Slider)
**File affected:** `resources/views/frontend/index.blade.php`

Replace the old hero section with this high-end slider:

```html
<!-- TOP BANNER SLIDER -->
<section class="top-banner-slider-con">
    <div class="top-banner-track" id="topBannerTrack">
        <!-- Slide 1 -->
        <div class="top-banner-slide active">
            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&q=80&w=2000" alt="Advanced Fertility Clinic">
        </div>
        <!-- Slide 2 -->
        <div class="top-banner-slide">
            <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?auto=format&fit=crop&q=80&w=2000" alt="Expert Embryology Lab">
        </div>
        <!-- Slide 3 -->
        <div class="top-banner-slide">
            <img src="https://images.unsplash.com/photo-1551601651-094191337042?auto=format&fit=crop&q=80&w=2000" alt="Compassionate Care">
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="top-banner-nav">
        <button class="top-banner-btn prev" id="topBannerPrev" aria-label="Previous">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button class="top-banner-btn next" id="topBannerNext" aria-label="Next">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
    </div>

    <!-- Content Overlay -->
    <div class="hero-inner-box5 reveal">
        <div class="hero-left-box5">
            <div class="hero-eyebrow-box5">
                <span class="hero-eyebrow-dot-box5"></span>
                Leading Fertility Specialist in India
            </div>
            <h1>Your Journey to <br>Parenthood Begins <em>Here</em></h1>
            <p>Combining world-class clinical expertise with compassionate care to turn your dreams of a family into reality.</p>
            <div class="hero-actions-box5">
                <a href="{{ route('frontend.contact') }}" class="btn-hero-primary">
                    Consult Dr. Yuvi
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                </a>
            </div>
        </div>
    </div>
</section>
```

---

## 3. Team Page Modernization (Full-Viewport)
**File affected:** `resources/views/frontend/team.blade.php`

Update the hero section to match the homepage slider:

```html
<section class="top-banner-slider-con">
    <div class="top-banner-track" id="topBannerTrack">
        <div class="top-banner-slide active">
            <img src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?auto=format&fit=crop&q=80&w=2000" alt="Team Excellence">
        </div>
        <!-- ... add more slides as needed ... -->
    </div>
    <div class="team-banner-overlay">
        <div class="team-hero-content reveal">
            <div class="team-hero-eyebrow">
                <span class="hero-eyebrow-dot"></span> Clinical Excellence · Expert Care
            </div>
            <h1>The Dedicated Team<br>Behind <em>Dr. Yuvi</em></h1>
            <p>A collective of brilliant minds and compassionate hearts, dedicated to guiding you toward your dream of parenthood.</p>
            <div class="team-hero-actions">
                <a href="{{ route('frontend.contact') }}" class="btn-hero-primary">Join Our Journey</a>
            </div>
        </div>
    </div>
</section>
```

---

## 4. Media Page Modernization (100vh Centered)
**File affected:** `resources/views/frontend/media.blade.php`

Replace the hero section with this centered design:

```html
<section class="media-hero-section">
    <img src="https://images.unsplash.com/photo-1551818255-e6e10975bc17?auto=format&fit=crop&q=80&w=2000" class="media-hero-bg" alt="Media and Events">
    <div class="media-hero-overlay"></div>
    <div class="media-hero-content reveal">
        <div class="media-hero-eyebrow">
            <span class="hero-eyebrow-dot"></span> In The Spotlight
        </div>
        <h1>Media & <br><em>Events</em></h1>
        <p>Dive into our world of expert podcasts and heartwarming community events. <br>Discover the stories beyond the clinic walls.</p>
    </div>
</section>
```

---

## 5. Success Stories Modernization (Left Sidebar & Filters)
**File affected:** `resources/views/frontend/success-stories.blade.php`

Update the layout to place the sidebar on the left and add the filtering script. **Note:** We use unique classes like `story-filter-btn` to avoid conflicts with global blog scripts.

```html
<!-- PAGE BODY -->
<div class="page-body">
    @php $categories = $stories->pluck('treatment_type')->unique(); @endphp
    
    <aside class="filter-sidebar">
        <span class="fs-title">Filter Journeys</span>
        <div class="fs-filters">
            <button class="filter-btn story-filter-btn active" data-filter="all">All Journeys</button>
            @foreach($categories as $cat)
                <button class="filter-btn story-filter-btn" data-filter="{{ strtolower(str_replace(' ', '-', $cat)) }}">{{ $cat }}</button>
            @endforeach
        </div>
    </aside>

    <div class="story-content-main">
        <div class="grid-header reveal">
            <h2>Patient Success Stories</h2>
            <span id="storyVisibleCount">Showing {{ $stories->count() }} stories</span>
        </div>
        <div class="story-page-grid" id="storyPageGrid">
            @foreach($stories as $story)
                <div class="story-page-card reveal" data-category="{{ strtolower(str_replace(' ', '-', $story->treatment_type)) }}">
                    <!-- Card content ... -->
                </div>
            @endforeach
        </div>
        <div class="empty-state" id="storyEmptyState" style="display:none;">
            <h3>No stories found</h3>
        </div>
    </div>
</div>

<!-- Filtering Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const storyFilterBtns = document.querySelectorAll('.story-filter-btn');
        const storyCards = document.querySelectorAll('.story-page-card');
        const storyVisibleCountText = document.getElementById('storyVisibleCount');
        const storyEmptyState = document.getElementById('storyEmptyState');

        function filterStories(category) {
            let count = 0;
            storyCards.forEach(card => {
                const cardCat = card.getAttribute('data-category');
                if (category === 'all' || cardCat === category) {
                    card.style.display = 'block';
                    count++;
                } else {
                    card.style.display = 'none';
                }
            });
            if (storyVisibleCountText) storyVisibleCountText.textContent = `Showing ${count} stories`;
            if (storyEmptyState) storyEmptyState.style.display = count === 0 ? 'block' : 'none';
        }

        storyFilterBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                storyFilterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                filterStories(btn.getAttribute('data-filter'));
            });
        });
        filterStories('all');
    });
</script>
```

---

## Important Notice for Admin
All `gold` accents (`#d4af37`) have been updated to **Crimson Dark** (`#b92f38`) across these sections for a more premium, unified branding feel. Ensure your global CSS supports `var(--crimson-dark)`.
