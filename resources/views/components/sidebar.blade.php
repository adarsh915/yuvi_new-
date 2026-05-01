<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('frontend.index') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">MAIN MENU</li>
            <li>
                <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.leads') }}" class="{{ request()->routeIs('admin.leads*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:users-group-rounded-outline" class="menu-icon"></iconify-icon>
                    <span>Contact Leads</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contact.fields') }}" class="{{ request()->routeIs('admin.contact.fields') ? 'active' : '' }}">
                    <iconify-icon icon="solar:widget-add-outline" class="menu-icon"></iconify-icon>
                    <span>Form Builder</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.faqs') }}" class="{{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
                    <iconify-icon icon="solar:question-circle-outline" class="menu-icon"></iconify-icon>
                    <span>Manage FAQs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.stories') }}" class="{{ request()->routeIs('admin.stories') ? 'active' : '' }}">
                    <iconify-icon icon="solar:clapperboard-edit-outline" class="menu-icon"></iconify-icon>
                    <span>Success Stories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blogs') }}" class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                    <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                    <span>Manage Blogs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <iconify-icon icon="solar:folder-with-files-outline" class="menu-icon"></iconify-icon>
                    <span>Blog Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.quiz.questions') }}" class="{{ request()->routeIs('admin.quiz.questions') ? 'active' : '' }}">
                    <iconify-icon icon="solar:clipboard-list-outline" class="menu-icon"></iconify-icon>
                    <span>Quiz Questions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.quiz.submissions') }}" class="{{ request()->routeIs('admin.quiz.submissions*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:user-speak-outline" class="menu-icon"></iconify-icon>
                    <span>User Submissions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.services') }}" class="{{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <iconify-icon icon="solar:medical-kit-outline" class="menu-icon"></iconify-icon>
                    <span>Manage Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <iconify-icon icon="solar:settings-outline" class="menu-icon"></iconify-icon>
                    <span>Site Settings</span>
                </a>
            </li>

            <li class="sidebar-menu-group-title">AUTH</li>
            <li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <iconify-icon icon="lucide:power" class="menu-icon"></iconify-icon>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>