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
                <li class="nav-item {{ Route::is("recruiter.dashboard") ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route("recruiter.dashboard") }}"><i class="fe fe-home nav-icon"></i>My
                        Dashboard</a>
                </li>
            </ul>
            <span class="navbar-header">Operations</span>
            <ul class="list-unstyled ms-n2 mb-4">
                <!-- Nav item -->
                <li class="nav-item {{ Route::is("recruiter.allJobs") || Route::is("recruiter.createJob") ? "active" : '' }}">
                    <a class="nav-link" href="{{ route("recruiter.allJobs") }}"><i class="fe fe-book nav-icon"></i>My Jobs</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item {{ Route::is("recruiter.allCompanies") ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route("recruiter.allCompanies") }}"><i class="fe fe-cloud nav-icon"></i>My
                        Companies</a>
                </li>
            </ul>
            <!-- Navbar header -->
            <span class="navbar-header">Account Settings</span>
            <ul class="list-unstyled ms-n2 mb-0">
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('recruiter.editProfile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('recruiter.editProfile') }}"><i class="fe fe-settings nav-icon"></i>Edit Profile</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('recruiter.security') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('recruiter.security') }}"><i class="fe fe-user nav-icon"></i>Security</a>
                </li>
                <!-- Nav item -->
                <li class="nav-item {{ Route::is('recruiter.socialProfile') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('recruiter.socialProfile') }}"><i class="fe fe-refresh-cw nav-icon"></i>Social
                        Profiles</a>
                </li>
                {{--
                <li class="nav-item">
                    <a class="nav-link" href="delete-profile.html"><i class="fe fe-trash nav-icon"></i>Delete
                        Profile</a>
                </li>
                --}}
                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"><i class="fe fe-power nav-icon"></i>Sign Out</a>
                </li>
                {{--
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
