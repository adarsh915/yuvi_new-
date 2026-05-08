@extends('frontend.layouts.app')

@section('title', 'Contact Us | Dr. Yuvraj Jadeja')
@section('meta_description', 'Get in touch with Dr. Yuvraj Jadeja\'s team for ethical fertility treatments and women\'s health consultations.')

@section('content')
  <!-- HERO -->
  <section class="hero_box4 reveal">
    <div class="hero-inner_2">
      <div class="hero-eyebrow_2">Connect With Us</div>
      <h1>Begin with <em>Clarity.</em></h1>
      <p>Your journey to parenthood starts with a single conversation. We're here to listen, guide, and walk every step alongside you.</p>
    </div>
  </section>

  <!-- MAIN TWO-COLUMN LAYOUT -->
  <div class="main reveal">

    <!-- LEFT: FORM COLUMN -->
    <div class="form-col reveal">

      <div class="consult-tabs" role="tablist">
        <button class="tab-btn active" data-tab="clinic" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>
          In-Clinic Visit
        </button>
        <button class="tab-btn" data-tab="online" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
            <line x1="8" y1="21" x2="16" y2="21" />
            <line x1="12" y1="17" x2="12" y2="21" />
          </svg>
          Online Consultation
        </button>
        <button class="tab-btn" data-tab="whatsapp" role="tab">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>
          WhatsApp
        </button>
      </div>

      <p class="form-section-title" id="formTitle">Request a Consultation</p>
      <p class="form-section-sub" id="formSub">Fill in your details and we'll reach out within 24 hours to confirm your appointment.</p>

      <form id="contactForm" novalidate action="{{ route('frontend.contact.submit') }}" method="POST">
        @csrf
        <div class="form-grid">
          @foreach($dynamicFields as $field)
            <div class="form-group {{ $field->type == 'textarea' ? 'full-width' : '' }}">
                <label for="{{ $field->name }}">{{ $field->label }} @if($field->is_required)<span class="text-danger">*</span>@endif</label>
                
                @if($field->type == 'textarea')
                    <textarea name="{{ $field->name }}" id="{{ $field->name }}" placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }}></textarea>
                @elseif($field->type == 'select')
                    <select name="{{ $field->name }}" id="{{ $field->name }}" {{ $field->is_required ? 'required' : '' }}>
                        <option value="" disabled selected>{{ $field->placeholder ?? 'Select option' }}</option>
                        @foreach(explode(',', $field->options) as $opt)
                            <option value="{{ trim($opt) }}">{{ trim($opt) }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="{{ $field->type }}" name="{{ $field->name }}" id="{{ $field->name }}" placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }}>
                @endif
                <span class="error-text" id="error-{{ $field->name }}"></span>
            </div>
          @endforeach
        </div>

        <div class="form-row" style="grid-template-columns: 1fr; margin-top: 1rem; margin-bottom: 0;">
          <div class="form-group full">
            <div class="checkbox-group">
              <input type="checkbox" id="consent" required>
              <label for="consent">I consent to Dr. Yuvi's team contacting me regarding my inquiry. My information will be kept strictly confidential.</label>
            </div>
          </div>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
          <span>Send Consultation Request</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </button>
      </form>

      <div class="success-msg" id="successMsg">
        <div class="success-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12" />
          </svg>
        </div>
        <h3>Request Received!</h3>
        <p>Thank you for reaching out. Our team will contact you within 24 hours to confirm your consultation details.</p>
      </div>
    </div>

    <!-- RIGHT: INFO COLUMN -->
    <aside class="info-col reveal">
      <div class="info-col-grid">
        <div class="location-card">
          <span class="location-tag">Gujarat</span>
          <h3 class="location-name">Vadodara</h3>
          <p class="location-addr">5th floor, Yash complex, Gotri Road, Vadodara, Gujarat — 390021</p>
          <a href="https://maps.google.com" target="_blank" rel="noopener" class="location-link">Open in Maps &rarr;</a>
        </div>

        <div class="quick-card">
          <p class="quick-title">Quick Support</p>
          <div class="quick-item">
            <div class="quick-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
            </div>
            <div class="quick-item-text">
              <strong>WhatsApp</strong>
              @if(isset($siteSettings['whatsapp_number']))
                <a href="https://wa.me/{{ $siteSettings['whatsapp_number'] }}">{{ $siteSettings['whatsapp_number'] }}</a>
              @else
                <a href="#">Chat Now</a>
              @endif
            </div>
          </div>
          <div class="quick-item">
            <div class="quick-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </div>
            <div class="quick-item-text">
              <strong>Email</strong>
              @if(isset($siteSettings['email_address']))
                <a href="mailto:{{ $siteSettings['email_address'] }}">{{ $siteSettings['email_address'] }}</a>
              @else
                <a href="#">Email Us</a>
              @endif
            </div>
          </div>
        </div>

        <div class="hours-card">
          <p class="hours-title">Clinic Hours</p>
          <div class="hours-row"><span>Mon – Sat</span><span>9:00 AM – 7:00 PM</span></div>
          <div class="hours-row"><span>Sunday</span><span style="color:var(--muted);">Closed</span></div>
        </div>
      </div>
    </aside>

  </div>

  <style>
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .form-group.full-width {
        grid-column: span 2;
    }
    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-group.full-width {
            grid-column: span 1;
        }
    }
    .error-text {
        color: #e24b4a;
        font-size: 0.75rem;
        margin-top: 4px;
        display: block;
    }
    .text-danger { color: #e24b4a; }
  </style>

  <script>
    const tabBtns = document.querySelectorAll('.tab-btn');
    const formTitle = document.getElementById('formTitle');
    const formSub = document.getElementById('formSub');
    const tabMeta = {
      clinic: { title: 'Request a Clinic Visit', sub: "Fill in your details and we'll reach out within 24 hours to confirm your appointment." },
      online: { title: 'Book an Online Consultation', sub: 'Consult Dr. Yuvi from the comfort of your home via a secure video call.' },
      whatsapp: { title: 'Connect on WhatsApp', sub: "Send us a message and we'll respond within a few hours on WhatsApp." }
    };

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        tabBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const meta = tabMeta[btn.dataset.tab];
        if (meta) { formTitle.textContent = meta.title; formSub.textContent = meta.sub; }
      });
    });

    const form = document.getElementById('contactForm');
    const successMsg = document.getElementById('successMsg');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', e => {
      e.preventDefault();
      
      // Clear previous errors
      document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
      
      const consent = document.getElementById('consent');
      if (!consent.checked) {
        consent.style.outline = '2px solid #e24b4a';
        setTimeout(() => consent.style.outline = '', 2000);
        return;
      }

      submitBtn.disabled = true;
      submitBtn.querySelector('span').textContent = 'Sending...';

      const formData = new FormData(form);
      
      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          form.style.opacity = '0';
          form.style.transition = 'all 0.4s ease';
          setTimeout(() => {
            form.style.display = 'none';
            successMsg.classList.add('show');
          }, 400);
        } else if (data.errors) {
            submitBtn.disabled = false;
            submitBtn.querySelector('span').textContent = 'Send Consultation Request';
            Object.keys(data.errors).forEach(key => {
                const errorEl = document.getElementById('error-' + key);
                if (errorEl) errorEl.textContent = data.errors[key][0];
            });
        } else {
          alert('Something went wrong. Please try again.');
          submitBtn.disabled = false;
          submitBtn.querySelector('span').textContent = 'Send Consultation Request';
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        submitBtn.disabled = false;
        submitBtn.querySelector('span').textContent = 'Send Consultation Request';
      });
    });
  </script>
@endsection