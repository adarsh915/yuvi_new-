@extends('frontend.layouts.app')

@section('title', 'Contact Us | Dr. Yuvraj Jadeja')
@section('meta_description', 'Get in touch with Dr. Yuvraj Jadeja\'s team for ethical fertility treatments and women\'s health consultations.')

@section('content')
  <!-- HERO -->
  <section class="hero_box4 reveal">
    <div class="hero-inner_2">
      <div class="hero-eyebrow_2">Connect With Us</div>
      <div class="hero-split-wrap">
        <div class="hero-split-left">
          <h1>Begin with <em>Clarity.</em></h1>
        </div>
        <div class="hero-split-right">
          <p>Your journey to parenthood starts with a single conversation. We're here to listen, guide, and walk every
            step alongside you.</p>
        </div>
      </div>
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
            <path
              d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>
          NRI Patients
        </button>
      </div>

      <p class="form-section-title" id="formTitle">Request a Consultation</p>
      <p class="form-section-sub" id="formSub">Fill in your details and we'll reach out within 24 hours to confirm your
        appointment.</p>

      <form id="contactForm" novalidate action="{{ route('frontend.contact.submit') }}" method="POST">
        @csrf
        <input type="hidden" id="consultationType" name="consultation_type" value="inclinic_visit">
        <div class="error-text mb-12" id="error-global"></div>

        <div class="form-grid">
          <!-- BASE FIELDS (Always shown) -->
          <!-- First Name -->
          <div class="form-group">
            <label for="first_name">First Name <span class="text-danger">*</span></label>
            <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required>
            <span class="error-text" id="error-first_name"></span>
          </div>

          <!-- Last Name -->
          <div class="form-group">
            <label for="last_name">Last Name <span class="text-danger">*</span></label>
            <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required>
            <span class="error-text" id="error-last_name"></span>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email Address <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" placeholder="your.email@example.com" required>
            <span class="error-text" id="error-email"></span>
          </div>

          <!-- Phone -->
          <div class="form-group">
            <label for="phone">Phone / WhatsApp <span class="text-danger">*</span></label>
            <input type="tel" name="phone" id="phone" placeholder="10-digit phone number" maxlength="10" required>
            <span class="error-text" id="error-phone"></span>
          </div>

          <!-- Subject/Concern -->
          <div class="form-group">
            <label for="primary_concern">Primary Concern <span class="text-danger">*</span></label>
            <select name="primary_concern" id="primary_concern" required>
              <option value="" disabled selected>Select a concern</option>
              <option value="IVF / ICSI Treatment">IVF / ICSI Treatment</option>
              <option value="IUI Consultation">IUI Consultation</option>
              <option value="PCOS / Hormonal Issues">PCOS / Hormonal Issues</option>
              <option value="Male Fertility / Andrology">Male Fertility / Andrology</option>
              <option value="Recurrent Pregnancy Loss">Recurrent Pregnancy Loss</option>
              <option value="Fertility Preservation">Fertility Preservation</option>
              <option value="General Women's Health">General Women's Health</option>
              <option value="Other">Other</option>
            </select>
            <span class="error-text" id="error-primary_concern"></span>
          </div>

          <div class="form-group">
            <label for="preferred_location">Preferred Location <span class="text-danger">*</span></label>
            <select name="preferred_location" id="preferred_location" required>
              <option value="" disabled selected>Choose clinic</option>
              <option value="Nimaaya Women's Center (Surat)">Nimaaya Women's Center (Surat)</option>
              <option value="Nimaaya Baroda (Vadodara)">Nimaaya Baroda (Vadodara)</option>
              <option value="Online (Video Call)">Online (Video Call)</option>
            </select>
            <span class="error-text" id="error-preferred_location"></span>
          </div>

          <!-- Message (full width) -->
          <div class="form-group full-width">
            <label for="message">Message <span class="text-danger">*</span></label>
            <textarea name="message" id="message"
              placeholder="Tell us more about your concerns and what you'd like to discuss..." rows="4"
              required></textarea>
            <span class="error-text" id="error-message"></span>
          </div>

          <!-- DYNAMIC FIELDS (filtered by category) -->
          @foreach($dynamicFields->sortBy('order') as $field)
            <div class="form-group dynamic-field {{ $field->type == 'textarea' ? 'full-width' : '' }}"
              data-category="{{ $field->category }}">
              <label for="{{ $field->name }}">{{ $field->label }} @if($field->is_required)<span
              class="text-danger">*</span>@endif</label>

              @if($field->type == 'textarea')
                <textarea name="{{ $field->name }}" id="{{ $field->name }}" placeholder="{{ $field->placeholder }}" 
                  {{ $field->is_required ? 'required' : '' }} data-initial-required="{{ $field->is_required ? '1' : '0' }}" rows="3"></textarea>
              @elseif($field->type == 'select')
                <select name="{{ $field->name }}" id="{{ $field->name }}" 
                  {{ $field->is_required ? 'required' : '' }} data-initial-required="{{ $field->is_required ? '1' : '0' }}">
                  <option value="" disabled selected>{{ $field->placeholder ?? 'Select option' }}</option>
                  @foreach(explode(',', $field->options) as $opt)
                    <option value="{{ trim($opt) }}">{{ trim($opt) }}</option>
                  @endforeach
                </select>
              @else
                <input type="{{ $field->type }}" name="{{ $field->name }}" id="{{ $field->name }}"
                  placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }} 
                  data-initial-required="{{ $field->is_required ? '1' : '0' }}">
              @endif
              <span class="error-text" id="error-{{ $field->name }}"></span>
            </div>
          @endforeach
        </div>

        <div class="form-row" style="grid-template-columns: 1fr; margin-top: 1rem; margin-bottom: 0;">
          <div class="form-group full">
            <div class="checkbox-group">
              <input type="checkbox" id="consent" name="consent" required>
              <label for="consent">I consent to Dr. Yuvi's team contacting me regarding my inquiry. My information will be
                kept strictly confidential.</label>
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
        
        <!-- GUJARAT (VADODARA & ANAND) -->
        <div class="location-card">
          <span class="location-tag">Gujarat</span>
          
          <!-- Vadodara Block -->
          <div class="location-block mb-24">
            <h3 class="location-name">Vadodara</h3>
            <p class="location-addr">5th floor, Yash complex, Gotri Road, Vadodara, Gujarat — 390021</p>
            <div class="location-hours">
              <div class="hour-row">
                <span class="day">Mon, Wed & Sat:</span>
                <span class="time">10:00 AM – 1:00 PM <br> 5:00 PM – 7:00 PM</span>
              </div>
              <div class="hour-row">
                <span class="day">Tue & Fri:</span>
                <span class="time">10:00 AM – 1:00 PM</span>
              </div>
            </div>
            <a href="https://maps.app.goo.gl/3f8HshF9f8HshF9f8" target="_blank" rel="noopener" class="location-link">Open in Maps &rarr;</a>
          </div>

          <!-- Divider -->
          <div style="height: 1px; background: rgba(0,0,0,0.05); margin: 1.5rem 0;"></div>

          <!-- Anand Block -->
          <div class="location-block">
            <h3 class="location-name">Anand</h3>
            <p class="location-addr">Spandan Hospital 17, 100 Feet Rd, Nanikhodiyar, Anand, Gujarat 388001</p>
            <div class="location-hours">
              <div class="hour-row">
                <span class="day">Every Friday:</span>
                <span class="time">5:00 PM – 8:00 PM</span>
              </div>
            </div>
            <div class="location-contact mb-12">
              <a href="tel:9974704288" class="contact-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> 9974704288</a>
            </div>
            <a href="https://maps.google.com/?q=Spandan+Hospital+Anand+Nanikhodiyar" target="_blank" rel="noopener" class="location-link">Open in Maps &rarr;</a>
          </div>
        </div>

        <!-- AHMEDABAD -->
        <div class="location-card">
          <span class="location-tag">Gujarat</span>
          <h3 class="location-name">Ahmedabad</h3>
          <p class="location-addr">Nimaaya Ahmedabad Marina One, Sarkhej - Gandhinagar Hwy, near TGB, Bodakdev, Ahmedabad, Gujarat 380054</p>
          
          <div class="location-hours">
            <div class="hour-row">
              <span class="day">Every Tuesday:</span>
              <span class="time">5:00 PM – 8:00 PM</span>
            </div>
          </div>

          <div class="location-contact">
            <a href="tel:7961199900" class="contact-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> 7961199900</a>
          </div>

          <a href="https://maps.google.com/?q=Nimaaya+Ahmedabad+Marina+One" target="_blank" rel="noopener" class="location-link">Open in Maps &rarr;</a>
        </div>

        <!-- DELHI -->
        <div class="location-card">
          <span class="location-tag">New Delhi</span>
          <h3 class="location-name">Delhi</h3>
          <p class="location-addr">Nandi IVF 1st floor, C3/9, Pocket C 3, Phase 2, Ashok Vihar, New Delhi - 110052</p>
          
          <div class="location-hours">
            <div class="hour-row">
              <span class="day">Scheduled:</span>
              <span class="time">Usually once a month</span>
            </div>
          </div>

          <div class="location-contact">
            <a href="tel:8980770055" class="contact-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> 8980770055</a>
          </div>

          <a href="https://maps.google.com/?q=Nandi+IVF+Ashok+Vihar+Delhi" target="_blank" rel="noopener" class="location-link">Open in Maps &rarr;</a>
        </div>

        <div class="quick-card">
          <p class="quick-title">Support & Queries</p>
          <div class="quick-item">
            <div class="quick-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                  d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                </path>
              </svg>
            </div>
            <div class="quick-item-text">
              <strong>Whatsapp</strong>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['footer_phone'] ?? '919999999999') }}">{{ $siteSettings['footer_phone'] ?? '+91 999 999 9999' }}</a>
            </div>
          </div>
          <div class="quick-item">
            <div class="quick-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </div>
            <div class="quick-item-text">
              <strong>Official Email</strong>
              <a href="mailto:{{ $siteSettings['footer_email'] ?? 'doctoryuvi@nimaaya.com' }}">{{
                $siteSettings['footer_email'] ?? 'doctoryuvi@nimaaya.com' }}</a>
            </div>
          </div>
        </div>
      </div>
    </aside>

  </div>

  <!-- MAP SECTION -->
  <section class="map-section reveal">
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.3121546733!2d73.1362!3d22.305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fc88f5043831b%3A0x6b245a4a58434771!2sYash%20Complex%2C%20Gotri%20Rd%2C%20Vadodara%2C%20Gujarat%20390021!5e0!3m2!1sen!2sin!4v1715510000000!5m2!1sen!2sin"
        width="100%" height="450" style="border:0; display: block;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>

  <style>
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.5rem;
      /* Balanced gap */
    }

    .map-section {
      margin-top: 4rem;
      margin-bottom: 4rem;
      padding: 0 2rem;
    }

    .map-container {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 991px) {
      .map-section {
        padding: 0 1rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
      }
    }

    .form-group {
      margin-bottom: 0;
    }

    .form-group.full-width {
      grid-column: span 2;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.4rem;
      font-size: 0.78rem;
      font-weight: 700;
      color: var(--midnight);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      /* Tightened padding */
      border: 1.5px solid rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      font-size: 0.95rem;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s ease;
      background: #fff;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--crimson);
      box-shadow: 0 0 0 3px rgba(219, 69, 78, 0.1);
    }

    @media (max-width: 600px) {
      .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
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
      min-height: 1rem;
    }

    .text-danger {
      color: #e24b4a;
    }

    .checkbox-group {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      margin-top: 0.5rem;
    }

    .checkbox-group input {
      width: 18px;
      height: 18px;
      margin-top: 3px;
      flex-shrink: 0;
    }

    .checkbox-group label {
      font-size: 0.85rem;
      text-transform: none;
      letter-spacing: 0;
      font-weight: 400;
      line-height: 1.4;
      color: var(--slate);
      cursor: pointer;
    }
  </style>

  <script>
    const tabBtns = document.querySelectorAll('.tab-btn');
    const formTitle = document.getElementById('formTitle');
    const formSub = document.getElementById('formSub');
    const tabMeta = {
      clinic: { title: 'Request a Clinic Visit', sub: "Fill in your details and we'll reach out within 24 hours to confirm your appointment." },
      online: { title: 'Book an Online Consultation', sub: 'Consult Dr. Yuvi from the comfort of your home via a secure video call.' },
      whatsapp: { title: 'Connect for NRI Patients', sub: "Send us a message and we'll respond within a few hours." }
    };

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        tabBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Update consultation type
        const tabType = btn.getAttribute('data-tab');
        const typeMap = { 'clinic': 'inclinic_visit', 'online': 'online_consultation', 'whatsapp': 'whatsapp' };
        document.getElementById('consultationType').value = typeMap[tabType];

        // Update form text
        formTitle.textContent = tabMeta[tabType].title;
        formSub.textContent = tabMeta[tabType].sub;

        // Update dynamic fields visibility
        updateDynamicFields(typeMap[tabType]);
      });
    });

    const form = document.getElementById('contactForm');
    const successMsg = document.getElementById('successMsg');
    const submitBtn = document.getElementById('submitBtn');

    // Phone validation - strict 10 digits only
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function () {
      this.value = this.value.replace(/\D/g, '').slice(0, 10);
      const errorEl = document.getElementById('error-phone');
      if (this.value.length === 10) {
        errorEl.textContent = '';
        this.style.borderColor = '#28a745';
      } else if (this.value.length > 0) {
        errorEl.textContent = 'Phone number must be exactly 10 digits.';
        this.style.borderColor = '#dc3545';
      } else {
        this.style.borderColor = '';
        errorEl.textContent = '';
      }
    });

    // Dynamic fields filtering based on consultation type
    function updateDynamicFields(selectedCategory) {
      const dynamicFields = document.querySelectorAll('.dynamic-field');
      dynamicFields.forEach(field => {
        const fieldCategory = field.getAttribute('data-category');
        const inputs = field.querySelectorAll('input, select, textarea');
        if (fieldCategory === 'all' || fieldCategory === selectedCategory) {
          field.style.display = '';
          inputs.forEach(input => {
            if (input.dataset.initialRequired === '1') {
              input.required = true;
            }
          });
        } else {
          field.style.display = 'none';
          inputs.forEach(input => {
            if (input.required) {
              input.dataset.initialRequired = '1';
            }
            input.required = false;
            input.value = '';
          });
        }
      });
    }

    // Initialize dynamic fields with default category
    updateDynamicFields('inclinic_visit');

    form.addEventListener('submit', e => {
      e.preventDefault();

      // Clear previous errors
      document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
      const globalError = document.getElementById('error-global');
      let hasError = false;

      // Validate required fields
      const requiredInputs = form.querySelectorAll('[required], .dynamic-field:not([style*="display: none"]) [required]');
      
      requiredInputs.forEach(input => {
        // 1. Skip if hidden inside a hidden dynamic-field container
        const dynamicParent = input.closest('.dynamic-field');
        if (dynamicParent && dynamicParent.style.display === 'none') {
          return;
        }

        // 2. Identify error element (fallback to global if name missing)
        const name = input.getAttribute('name') || input.id;
        const errorEl = document.getElementById('error-' + name);
        
        // 3. Check if empty/invalid
        let isInvalid = false;
        if (input.type === 'checkbox') {
          isInvalid = !input.checked;
        } else if (input.tagName === 'SELECT') {
          isInvalid = !input.value || input.value === "" || input.value === "null";
        } else {
          isInvalid = !input.value.trim();
        }

        if (isInvalid) {
          console.warn('Validation failed for field:', name);
          if (errorEl) errorEl.textContent = 'This field is required.';
          input.style.borderColor = '#dc3545';
          hasError = true;
        } else {
          input.style.borderColor = '';
        }
      });
      
      // Extra validation for specific types
      if (!hasError) {
        // Email validation
        const emailInput = document.getElementById('email');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput.value.trim() && !emailPattern.test(emailInput.value.trim())) {
          document.getElementById('error-email').textContent = 'Please enter a valid email address.';
          emailInput.style.borderColor = '#dc3545';
          hasError = true;
        }

        // Phone validation
        const phoneInput = document.getElementById('phone');
        if (phoneInput && phoneInput.value.length !== 10) {
          document.getElementById('error-phone').textContent = 'Phone number must be exactly 10 digits.';
          phoneInput.style.borderColor = '#dc3545';
          hasError = true;
        }
      }

      if (hasError) {
        globalError.textContent = 'Please fill in all required fields correctly.';
        const firstError = form.querySelector('.error-text:not(:empty)');
        if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
      }

      submitBtn.disabled = true;
      submitBtn.querySelector('span').textContent = 'Sending...';

      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
      })
        .then(response => response.json().then(data => ({ ok: response.ok, status: response.status, data })))
        .then(res => {
          const data = res.data;
          if (res.ok && data.success) {
            form.style.opacity = '0';
            form.style.transition = 'all 0.4s ease';
            setTimeout(() => {
              form.style.display = 'none';
              successMsg.classList.add('show');
            }, 400);
          } else if (data && data.errors) {
            submitBtn.disabled = false;
            submitBtn.querySelector('span').textContent = 'Send Consultation Request';
            Object.keys(data.errors).forEach(key => {
              const errorEl = document.getElementById('error-' + key);
              if (errorEl) {
                errorEl.textContent = data.errors[key][0];
              } else {
                globalError.textContent = data.errors[key][0];
              }
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