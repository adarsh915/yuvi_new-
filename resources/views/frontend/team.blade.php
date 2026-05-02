@extends('frontend.layouts.app')

@section('title', 'Meet Our Team | Dr. Yuvi')
@section('meta_description', 'Meet the dedicated doctors, nurses, and supporting staff working alongside Dr. Yuvraj Jadeja to provide exceptional fertility care.')

@section('content')

  <!-- 1. TOP BANNER -->
  <section class="team-hero-section">
    <!-- Premium medical team stock image -->
    <img src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?auto=format&fit=crop&q=80&w=2000"
      class="team-hero-bg" alt="Dr Yuvi and Team">
    <div class="team-hero-overlay"></div>
    <div class="team-hero-glow"></div>
    <div class="team-hero-content reveal">
      <div class="team-hero-badge">
        <span class="badge-dot"></span> The People Behind The Care
      </div>
      <h1>Meet the Team of <br><em>Dr. Yuvi</em></h1>
      <p>A collective of brilliant minds and compassionate hearts, dedicated to guiding you toward your dream of
        parenthood.</p>
    </div>
  </section>

  <!-- 2. DOCTORS SECTION -->
  <section class="team-category-section" style="background: var(--bg-light, #fcfcfc);">
    <div class="section-wrap">
      <div class="team-category-header reveal">
        <h2>Our <em>Doctors</em></h2>
        <p>Expert specialists leading the way in evidence-based reproductive medicine.</p>
      </div>

      <div class="premium-team-grid reveal delay-1">
        <!-- Doctor Card 1 -->
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Doctor+Portrait" alt="Doctor Placeholder">
          </div>
          <div class="pt-info">
            <h3>Dr. Aditi Sharma</h3>
            <span class="pt-role">Senior IVF Consultant</span>
            <p>M.S. (Ob/Gyn), Fellowship in Reproductive Medicine.</p>
          </div>
        </div>
        <!-- Doctor Card 2 -->
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Doctor+Portrait" alt="Doctor Placeholder">
          </div>
          <div class="pt-info">
            <h3>Dr. Rohan Desai</h3>
            <span class="pt-role">Clinical Embryologist</span>
            <p>Ph.D. in Clinical Embryology. Specializes in advanced ICSI.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. NURSES SECTION -->
  <section class="team-category-section">
    <div class="section-wrap">
      <div class="team-category-header reveal">
        <h2>Compassionate <em>Nurses</em></h2>
        <p>The backbone of our patient care, offering emotional and medical support round the clock.</p>
      </div>

      <div class="premium-team-grid reveal delay-1">
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Nurse+Portrait" alt="Nurse Placeholder">
          </div>
          <div class="pt-info">
            <h3>Priya Verma</h3>
            <span class="pt-role">Head Fertility Nurse</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Nurse+Portrait" alt="Nurse Placeholder">
          </div>
          <div class="pt-info">
            <h3>Meera Patel</h3>
            <span class="pt-role">Patient Coordinator & Nurse</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Nurse+Portrait" alt="Nurse Placeholder">
          </div>
          <div class="pt-info">
            <h3>Sneha Rao</h3>
            <span class="pt-role">OT Charge Nurse</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. SUPPORTING STAFF SECTION -->
  <section class="team-category-section" style="background: var(--bg-light, #fcfcfc);">
    <div class="section-wrap">
      <div class="team-category-header reveal">
        <h2>Supporting <em>Staff</em></h2>
        <p>Ensuring a seamless, comfortable, and organized experience for every patient.</p>
      </div>

      <div class="premium-team-grid support-grid reveal delay-1">
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Staff+Portrait" alt="Staff Placeholder">
          </div>
          <div class="pt-info">
            <h3>Amit Joshi</h3>
            <span class="pt-role">Clinic Manager</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Staff+Portrait" alt="Staff Placeholder">
          </div>
          <div class="pt-info">
            <h3>Kavya Singh</h3>
            <span class="pt-role">Front Desk Executive</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Staff+Portrait" alt="Staff Placeholder">
          </div>
          <div class="pt-info">
            <h3>Rahul Mehta</h3>
            <span class="pt-role">Financial Counselor</span>
          </div>
        </div>
        <div class="premium-team-card">
          <div class="pt-img-wrap">
            <img src="https://dummyimage.com/600x800/eaeaea/888888.png&text=Staff+Portrait" alt="Staff Placeholder">
          </div>
          <div class="pt-info">
            <h3>Deepa Nair</h3>
            <span class="pt-role">Wellness & Diet Counselor</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. JOIN US (Fellowship & Openings) -->
  <section class="team-join-section">
    <div class="section-wrap">
      <div class="join-grid">

        <!-- Fellowship Program -->
        <div class="join-box reveal">
          <div class="join-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--gold, #d4af37)" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
              <path d="M6 12v5c3 3 9 3 12 0v-5" />
            </svg>
          </div>
          <h2>Fellowship <br><em>Program</em></h2>
          <p>We are committed to shaping the future of reproductive medicine. Our prestigious fellowship program offers
            hands-on training in ART, endoscopy, and clinical embryology under the direct mentorship of Dr. Yuvi.</p>
          <a href="{{ route('frontend.contact') }}" class="btn-primary-dark">Apply for Fellowship &rarr;</a>
        </div>

        <!-- New Openings -->
        <div class="join-box reveal delay-1">
          <div class="join-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--crimson, #bc2b3d)" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <line x1="19" y1="8" x2="19" y2="14" />
              <line x1="22" y1="11" x2="16" y2="11" />
            </svg>
          </div>
          <h2>New <br><em>Openings</em></h2>
          <p>Join a workplace that values ethics, science, and empathy. We are always looking for passionate nurses,
            coordinators, and medical professionals to expand our family.</p>
          <a href="{{ route('frontend.contact') }}" class="btn-outline-dark">View Open Roles &rarr;</a>
        </div>

      </div>
    </div>
  </section>

  <style>
    /* Hero Banner Premium Upgrade */
    .team-hero-section {
      position: relative;
      height: 60vh;
      min-height: 550px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      /* Left aligned for editorial feel */
      overflow: hidden;
      /* margin-top: 80px;  */
    }

    .team-hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center 30%;
      /* Better framing of faces */
      z-index: 1;
      transform: scale(1.02);
      /* Slight scale */
    }

    .team-hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* Elegant left-to-right gradient fade */
      background: linear-gradient(90deg, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(0, 0, 0, 0.2) 100%);
      z-index: 2;
    }

    .team-hero-glow {
      position: absolute;
      top: -20%;
      left: -10%;
      width: 50%;
      height: 140%;
      background: radial-gradient(circle, rgba(188, 43, 61, 0.2) 0%, transparent 70%);
      z-index: 3;
      pointer-events: none;
    }

    .team-hero-content {
      position: relative;
      z-index: 4;
      color: #fff;
      max-width: 700px;
      padding: 0 5%;
    }

    .team-hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(5px);
      color: #fff;
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .badge-dot {
      width: 8px;
      height: 8px;
      background: var(--gold, #d4af37);
      border-radius: 50%;
    }

    .team-hero-content h1 {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(3.5rem, 6vw, 4.5rem);
      line-height: 1.1;
      margin-bottom: 1.5rem;
      font-weight: 400;
    }

    .team-hero-content h1 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--gold, #d4af37);
    }

    .team-hero-content p {
      font-size: 1.2rem;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.9);
      max-width: 550px;
    }

    /* Category Sections */
    .team-category-section {
      padding: 6rem 0;
    }

    .section-wrap {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .team-category-header {
      text-align: center;
      margin-bottom: 4rem;
    }

    .team-category-header h2 {
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      color: #111;
      margin-bottom: 1rem;
    }

    .team-category-header h2 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--gold, #d4af37);
    }

    .team-category-header p {
      font-size: 1.1rem;
      color: #555;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Premium Team Grids & Cards */
    .premium-team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 3rem 2rem;
    }

    .support-grid {
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }

    .premium-team-card {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      group: hover;
    }

    .pt-img-wrap {
      width: 100%;
      aspect-ratio: 3/4;
      /* Classic portrait ratio */
      overflow: hidden;
      border-radius: 12px;
      background: #eaeaea;
      position: relative;
    }

    .pt-img-wrap::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 30%;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.05), transparent);
      pointer-events: none;
    }

    .pt-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .premium-team-card:hover .pt-img-wrap img {
      transform: scale(1.05);
    }

    .pt-info {
      text-align: center;
    }

    .pt-info h3 {
      font-size: 1.4rem;
      font-family: 'DM Serif Display', serif;
      color: #111;
      margin-bottom: 0.3rem;
    }

    .pt-role {
      display: block;
      font-size: 0.85rem;
      color: var(--crimson, #bc2b3d);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 600;
      margin-bottom: 0.8rem;
    }

    .pt-info p {
      font-size: 0.95rem;
      color: #666;
      line-height: 1.5;
      margin: 0;
    }

    /* Join Us Section */
    .team-join-section {
      padding: 6rem 0;
      background: #111;
      color: #fff;
    }

    .join-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
    }

    .join-box {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 4rem 3rem;
      border-radius: 16px;
      transition: background 0.3s ease;
    }

    .join-box:hover {
      background: rgba(255, 255, 255, 0.06);
    }

    .join-icon {
      margin-bottom: 2rem;
    }

    .join-box h2 {
      font-size: 2.5rem;
      line-height: 1.1;
      margin-bottom: 1.5rem;
      color: #fff;
    }

    .join-box h2 em {
      font-family: 'DM Serif Display', serif;
      font-style: italic;
      color: var(--gold, #d4af37);
    }

    .join-box p {
      font-size: 1.1rem;
      color: #bbb;
      line-height: 1.6;
      margin-bottom: 2.5rem;
    }

    .btn-outline-dark {
      display: inline-block;
      padding: 0.8rem 2rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-outline-dark:hover {
      background: #fff;
      color: #111;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .join-grid {
        grid-template-columns: 1fr;
      }

      .join-box {
        padding: 3rem 2rem;
      }
    }

    @media (max-width: 600px) {
      .team-hero-section {
        min-height: 400px;
        padding-top: 2rem;
      }

      .team-category-section {
        padding: 4rem 0;
      }

      .premium-team-grid {
        gap: 2rem;
      }
    }
  </style>

@endsection