<!-- FOOTER -->
<footer class="footer">
    <div class="footer-inner">
        <div>
            <span class="footer-brand">
                @php 
                    $fLogo = $siteSettings['footer_logo'] ?? 'assets/frontend/img/logo.png';
                    $fLogoPath = str_contains($fLogo, 'settings/') ? asset('storage/'.$fLogo) : asset($fLogo);
                @endphp
                <img src="{{ $fLogoPath }}" alt="Dr Yuvraj Jadeja Logo" style="max-height: 70px; width: auto; object-fit: contain;">
            </span>
            <p class="footer-desc">{{ $siteSettings['footer_description'] ?? 'Ethical, evidence-based fertility and women\'s health care in Ahmedabad.' }}</p>
            <div class="footer-social">
                @if(isset($siteSettings['instagram_url']))
                <a href="{{ $siteSettings['instagram_url'] }}" class="social-btn" aria-label="Instagram"><svg width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg></a>
                @endif
                @if(isset($siteSettings['youtube_url']))
                <a href="{{ $siteSettings['youtube_url'] }}" class="social-btn" aria-label="YouTube"><svg width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z" />
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" />
                    </svg></a>
                @endif
            </div>
        </div>
        <div>
            <h5>Explore</h5>
            <ul>
                <li><a href="{{ route('frontend.services') }}">Services Overview</a></li>
                <li><a href="{{ route('frontend.about') }}">About Dr. Yuvi</a></li>
                <li><a href="{{ route('frontend.blog') }}">Health Blog</a></li>
                <li><a href="{{ route('frontend.successStories') }}">Success Stories</a></li>
            </ul>
        </div>
        <div>
            <h5>Patient</h5>
            <ul>
                <li><a href="{{ route('frontend.contact') }}">Book Appointment</a></li>
                <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>
                <li><a href="{{ route('frontend.privacyPolicy') }}">Clinic Policies</a></li>
                <li><a href="{{ route('frontend.privacyPolicy') }}">Privacy Policy</a></li>
            </ul>
        </div>
        <div>
            <h5>Connect</h5>
            <ul>
                @if(isset($siteSettings['footer_email']))
                <li><a href="mailto:{{ $siteSettings['footer_email'] }}">{{ $siteSettings['footer_email'] }}</a></li>
                @endif
                @if(isset($siteSettings['footer_phone']))
                <li><a href="tel:{{ str_replace(' ', '', $siteSettings['footer_phone']) }}">{{ $siteSettings['footer_phone'] }}</a></li>
                @endif
                @if(!empty($siteSettings['footer_address']))
                <li style="margin-top: 10px;">
                    <p style="font-size: 0.88rem; color: #fff; opacity: 0.85; line-height: 1.5; margin: 0;">
                        {{ $siteSettings['footer_address'] }}
                    </p>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2026 Dr. Yuvraj Jadeja. All Rights Reserved.</p>
        <p>Designed with care · Ahmedabad, India</p>
    </div>
</footer>