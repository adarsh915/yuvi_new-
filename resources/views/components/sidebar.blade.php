<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('frontend.index') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/asset/logo.png') }}?v={{ time() }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/asset/logo.png') }}?v={{ time() }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/asset/logo.png') }}?v={{ time() }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <!-- Main Dashboard -->
            <li class="sidebar-menu-group-title">MAIN</li>
            <li>
                <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Leads & Inquiries -->
            <li class="sidebar-menu-group-title">LEADS & INQUIRIES</li>
            <li>
                <a href="{{ route('admin.notifications') }}"
                    class="{{ request()->routeIs('admin.notifications') ? 'active' : '' }}">
                    <iconify-icon icon="solar:bell-outline" class="menu-icon"></iconify-icon>
                    <span>Notifications</span>
                    @php $unreadCount = \App\Http\Controllers\NotificationController::getUnreadCount(); @endphp
                    @if($unreadCount > 0)
                        <span class="badge bg-danger ms-auto radius-20"
                            style="padding: 2px 8px; font-size: 10px;">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.leads') }}" class="{{ request()->routeIs('admin.leads*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:users-group-rounded-outline" class="menu-icon"></iconify-icon>
                    <span>Contact Leads</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contact.fields') }}"
                    class="{{ request()->routeIs('admin.contact.fields') ? 'active' : '' }}">
                    <iconify-icon icon="solar:widget-add-outline" class="menu-icon"></iconify-icon>
                    <span>Form Builder</span>
                </a>
            </li>

            <!-- Content Management -->
            <li class="sidebar-menu-group-title">CONTENT MANAGEMENT</li>
            <li>
                <a href="{{ route('admin.sliders') }}"
                    class="{{ request()->routeIs('admin.sliders*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:gallery-wide-outline" class="menu-icon"></iconify-icon>
                    <span>Homepage Sliders</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.gallery') }}"
                    class="{{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                    <iconify-icon icon="solar:gallery-outline" class="menu-icon"></iconify-icon>
                    <span>Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blogs') }}" class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                    <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                    <span>Manage Blogs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories') }}"
                    class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <iconify-icon icon="solar:folder-with-files-outline" class="menu-icon"></iconify-icon>
                    <span>Blog Categories</span>
                </a>
            </li>

            <!-- Media Management -->
            <li class="sidebar-menu-group-title">MEDIA MANAGEMENT</li>
            <li>
                <a href="{{ route('admin.media-podcasts') }}"
                    class="{{ request()->routeIs('admin.media-podcasts*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:play-circle-outline" class="menu-icon"></iconify-icon>
                    <span>Podcasts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.media-events') }}"
                    class="{{ request()->routeIs('admin.media-events*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Feel Good Events</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.media-highlights') }}"
                    class="{{ request()->routeIs('admin.media-highlights*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:videocamera-record-outline" class="menu-icon"></iconify-icon>
                    <span>Media Highlights</span>
                </a>
            </li>

            <!-- Services & Stories -->
            <li class="sidebar-menu-group-title">SERVICES & TESTIMONIALS</li>
            <li>
                <a href="{{ route('admin.services') }}"
                    class="{{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:medical-kit-outline" class="menu-icon"></iconify-icon>
                    <span>Manage Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.service.categories') }}"
                    class="{{ request()->routeIs('admin.service.categories*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:folder-with-files-outline" class="menu-icon"></iconify-icon>
                    <span>Service Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.treatment-types') }}"
                    class="{{ request()->routeIs('admin.treatment-types') ? 'active' : '' }}">
                    <iconify-icon icon="solar:tag-outline" class="menu-icon"></iconify-icon>
                    <span>Treatment Types</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.stories') }}"
                    class="{{ request()->routeIs('admin.stories') ? 'active' : '' }}">
                    <iconify-icon icon="solar:clapperboard-edit-outline" class="menu-icon"></iconify-icon>
                    <span>Video Stories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials') }}"
                    class="{{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
                    <iconify-icon icon="solar:chat-round-dots-outline" class="menu-icon"></iconify-icon>
                    <span>Customer Reviews</span>
                </a>
            </li>

            <!-- FAQs & Info -->
            <li class="sidebar-menu-group-title">INFORMATION</li>
            <li>
                <a href="{{ route('admin.faqs') }}" class="{{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
                    <iconify-icon icon="solar:question-circle-outline" class="menu-icon"></iconify-icon>
                    <span>Manage FAQs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.faq.categories') }}"
                    class="{{ request()->routeIs('admin.faq.categories') ? 'active' : '' }}">
                    <iconify-icon icon="solar:folder-with-files-outline" class="menu-icon"></iconify-icon>
                    <span>FAQ Categories</span>
                </a>
            </li>

            <!-- Quiz -->
            <li class="sidebar-menu-group-title">QUIZ & ENGAGEMENT</li>
            <li>
                <a href="{{ route('admin.quiz.questions') }}"
                    class="{{ request()->routeIs('admin.quiz.questions') ? 'active' : '' }}">
                    <iconify-icon icon="solar:clipboard-list-outline" class="menu-icon"></iconify-icon>
                    <span>Quiz Questions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.quiz.submissions') }}"
                    class="{{ request()->routeIs('admin.quiz.submissions*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:user-speak-outline" class="menu-icon"></iconify-icon>
                    <span>User Submissions</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="sidebar-menu-group-title">SETTINGS</li>
            <li>
                <a href="{{ route('admin.settings') }}"
                    class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <iconify-icon icon="solar:settings-outline" class="menu-icon"></iconify-icon>
                    <span>Site Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.seo.index') }}"
                    class="{{ request()->routeIs('admin.seo.index') ? 'active' : '' }}">
                    <iconify-icon icon="solar:global-outline" class="menu-icon"></iconify-icon>
                    <span>SEO Settings</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="sidebar-menu-group-title">ACCOUNT</li>
            <li>
                <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <iconify-icon icon="solar:user-circle-outline" class="menu-icon"></iconify-icon>
                    <span>My Profile</span>
                </a>
            </li>
            <li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="javascript:void(0)"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <iconify-icon icon="lucide:power" class="menu-icon"></iconify-icon>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>