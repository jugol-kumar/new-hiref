<nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
    <!-- Menu -->
    <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
    <!-- Button -->
    <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button"
            data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="fe fe-menu"></span>
    </button>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav">
        <div class="navbar-nav flex-column">
            <ul class="list-unstyled ms-n2 mb-4">
                <!-- Nav item -->
                <li class="nav-item {{ Route::is("seeker.dashboard") ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route("seeker.dashboard") }}"><i class="fe fe-home nav-icon"></i>My
                        Dashboard</a>
                </li>
            </ul>
            <span class="navbar-header">Operations</span>
            {{--            <ul class="list-unstyled ms-n2 mb-4">
                &lt;!&ndash; Nav item &ndash;&gt;
                <li class="nav-item {{ Route::is("seeker.allJobs") || Route::is("seeker.createJob") ? "active" : '' }}">
                    <a class="nav-link" href="{{ route("seeker.allJobs") }}"><i class="fe fe-book nav-icon"></i>My Jobs</a>
                </li>
                &lt;!&ndash; Nav item &ndash;&gt;
                <li class="nav-item {{ Route::is("seeker.allCompanies") ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route("seeker.allCompanies") }}"><i class="fe fe-cloud nav-icon"></i>My
                        Companies</a>
                </li>
            </ul>--}}
            <!-- Navbar header -->
            <ul class="list-unstyled ms-n2 mb-0">
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('seeker.allSaveJobs') }}">
                    <a class="nav-link" href="{{ route('seeker.allSaveJobs') }}"><i class="fe fe-bookmark nav-icon"></i>Saved Jobs</a>
                </li>
                <!-- Nav item -->
<!--                <li class="nav-item {{ Route::is('seeker.uploadResume') }}">
                    <a class="nav-link " href="{{ route('seeker.uploadResume') }}"><i class="fe fe-file nav-icon"></i>Upload Resume</a>
                </li>-->
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('seeker.greetingChat') }}">
                    <a class="nav-link" href="{{ route('chatify') }}"><i class="fe fe-message-circle nav-icon"></i>Greeting</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('client.contactUs') }}">
                    <a class="nav-link" href="{{ route('client.contactUs') }}"><i class="fe fe-send nav-icon"></i>Contact Us</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"><i class="fe fe-power nav-icon"></i>Sign Out</a>
                </li>
                {{--
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('seeker.switchProfile') }}">
                    <a class="nav-link" href="{{ route('seeker.switchProfile') }}"><i class="fe fe-refresh-ccw nav-icon"></i>Switch</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="notifications.html"><i class="fe fe-bell nav-icon"></i>Notifications</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="profile-privacy.html"><i class="fe fe-lock nav-icon"></i>Profile
                        Privacy</a>
                </li>
                --}}
                <!-- Nav item -->
            </ul>
        </div>
    </div>
</nav>
