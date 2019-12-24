<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="/">
                        <i class="si si-fire text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="javascript:void(0)">
                    <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="javascript:void(0)">J. Smiths</a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="{{ url('/logout') }}">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('admin/dashboard') ? ' active' : '' }}" href="{{ url('admin/dashboard') }}">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Category</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('admin/allcategory') ? ' active' : '' }}" href="/admin/allcategory">All Category</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/addcategory') ? ' active' : '' }}" href="{{ url('/admin/addcategory') }}">Add Category</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/blank') ? ' active' : '' }}" href="/examples/blank">Blank</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">Various</span>
                </li>
                <li class="{{ request()->is('examples/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Examples</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('examples/plugin-helper') ? ' active' : '' }}" href="/examples/plugin-helper">Plugin with JS Helper</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('examples/plugin-init') ? ' active' : '' }}" href="/examples/plugin-init">Plugin with JS Init</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('examples/blank') ? ' active' : '' }}" href="/examples/blank">Blank</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">More</span>
                </li>
                <li>
                    <a href="/">
                        <i class="si si-globe"></i><span class="sidebar-mini-hide">Landing</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
