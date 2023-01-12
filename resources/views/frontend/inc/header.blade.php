<nav class="navbar navbar-expand-lg navbar-default p-0 px-8 w-100 position-fixed zindex-4" style="z-index: 111; box-shadow: 0 20px 20px 0 #e3e3e340">
    <div class="container-fluid px-0 py-2 mb-n2">
        <a class="navbar-brand" href="/">
            <img src="{{ config('app.url')."/storage/".get_setting(\App\Properties::$hLogo) }}" alt="" style="max-width: 150px; min-width: 150px;"/>
{{--            <img src="{{ asset('frontend/assets/images/blogo/blogo-black.jpg') }}" alt="" style="max-width: 150px; min-width: 150px;"/>--}}
        </a>
        <!-- Button -->
        <button
            class="navbar-toggler collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-default"
            aria-controls="navbar-default"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="icon-bar top-bar mt-0"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbar-default">
            <ul class="navbar-nav ms-auto left-header d-flex align-items-center">
                @if(!auth()->check() || auth()->user()->role == 'admin' || !auth()->user()->is_active)
                    <li class="nav-item {{ Route::is('client.home') ? 'menu_active' : ''}}">
                        <a class="nav-link p-4" href="/">Home</a>
                    </li>
                    <li class="nav-item {{ Route::is('client.jobs') ? 'menu_active' : ''}}">
                        <a class="nav-link py-4" href="{{ route('client.jobs') }}">Jobs</a>
                    </li>
                    <li class="nav-item {{ Route::is('client.allCompanies') ? 'menu_active' : ''}}">
                        <a class="nav-link py-4" href="{{ route('client.allCompanies') }}">Companies</a>
                    </li>
                    <li class="nav-item {{ Route::is('client.recruiter') ? 'menu_active' : ''}}">
                        <a class="nav-link p-4" href="{{ route("client.recruiter") }}">Recruiters</a>
                    </li>
                    <li class="nav-item {{ Route::is('client.seekers') ? 'menu_active' : ''}}">
                        <a class="nav-link p-4" href="{{ route('client.seekers') }}">Job Seekers</a>
                    </li>
                    <div class="ms-2 mt-3 mt-lg-0 d-flex align-items-end">
                        <a href="{{ route('login') }}" class="bg-success rounded-pill px-5 py-2 text-black fw-bold me-3">Download app</a>
                        <div class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarListing"
                                data-bs-toggle="dropdown"
                                aria-haspopup="false"
                                aria-expanded="false"
                            >
                                <i class="fe fe-menu"></i>
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-arrow"
                                aria-labelledby="navbarListing"
                            >
                                <li>
                                    <a class="dropdown-item" href="/about">
                                        About
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/blog">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @elseif(auth()->check())
                    <ul class="navbar-nav navbar-right-wrap ms-auto d-none d-lg-block">
                            {{--
                    <li class="dropdown d-inline-block stopevent">
                        <a
                            class="btn btn-light btn-icon rounded-circle text-muted indicator indicator-primary"
                            href="#"
                            role="button"
                            id="dropdownNotificationSecond"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="fe fe-bell"> </i>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-lg"
                            aria-labelledby="dropdownNotificationSecond"
                        >
                            <div>
                                <div
                                    class="border-bottom px-3 pb-3 d-flex justify-content-between align-items-center"
                                >
                                    <span class="h5 mb-0">Notifications</span>
                                    <a href="# " class="text-muted"
                                    ><span class="align-middle"
                                        ><i class="fe fe-settings me-1"></i></span
                                        ></a>
                                </div>
                                <ul class="list-group list-group-flush  "  style="height: 300px;" data-simplebar>
                                    <li class="list-group-item bg-light">
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-body" href="#">
                                                    <div class="d-flex">
                                                        <img
                                                            src="{{ asset("frontend") }}/assets/images/avatar/avatar-1.jpg"
                                                            alt=""
                                                            class="avatar-md rounded-circle"
                                                        />
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Kristin Watson:</h5>
                                                            <p class="mb-3 text-body">
                                                                Krisitn Watsan like your comment on course
                                                                Javascript Introduction!
                                                            </p>
                                                            <span class="fs-6 text-muted">
                                                        <span
                                                        ><span
                                                                class="fe fe-thumbs-up text-success me-1"
                                                            ></span
                                                            >2 hours ago,</span
                                                        >
                                                        <span class="ms-1">2:19 PM</span>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-auto text-center me-2">

                                                <a
                                                    href="#"
                                                    class="badge-dot bg-info"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"

                                                    title="Mark as read"
                                                >
                                                </a>
                                                <div>
                                                    <a
                                                        href="#"
                                                        class="bg-transparent"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"

                                                        title="Remove"
                                                    >
                                                        <i class="fe fe-x text-muted"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-body" href="#">
                                                    <div class="d-flex">
                                                        <img
                                                            src="{{ asset("frontend") }}/assets/images/avatar/avatar-2.jpg"
                                                            alt=""
                                                            class="avatar-md rounded-circle"
                                                        />
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Brooklyn Simmons</h5>
                                                            <p class="mb-3 text-body">
                                                                Just launched a new Courses React for Beginner.
                                                            </p>
                                                            <span class="fs-6 text-muted">
                                                        <span
                                                        ><span
                                                                class="fe fe-thumbs-up text-success me-1"
                                                            ></span
                                                            >Oct 9,</span
                                                        >
                                                        <span class="ms-1">1:20 PM</span>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-auto text-center me-2">
                                                <a
                                                    href="#"
                                                    class="badge-dot bg-secondary"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"

                                                    title="Mark as unread"
                                                >
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-body" href="#">
                                                    <div class="d-flex">
                                                        <img
                                                            src="{{ asset("frontend") }}/assets/images/avatar/avatar-3.jpg"
                                                            alt=""
                                                            class="avatar-md rounded-circle"
                                                        />
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Jenny Wilson</h5>
                                                            <p class="mb-3 text-body">
                                                                Krisitn Watsan like your comment on course
                                                                Javascript Introduction!
                                                            </p>
                                                            <span class="fs-6 text-muted">
                                                        <span
                                                        ><span
                                                                class="fe fe-thumbs-up text-info me-1"
                                                            ></span
                                                            >Oct 9,</span
                                                        >
                                                        <span class="ms-1">1:56 PM</span>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-auto text-center me-2">
                                                <a
                                                    href="#"
                                                    class="badge-dot bg-secondary"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"

                                                    title="Mark as unread"
                                                >
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col">
                                                <a class="text-body" href="#">
                                                    <div class="d-flex">
                                                        <img
                                                            src="{{ asset("frontend") }}/assets/images/avatar/avatar-4.jpg"
                                                            alt=""
                                                            class="avatar-md rounded-circle"
                                                        />
                                                        <div class="ms-3">
                                                            <h5 class="fw-bold mb-1">Sina Ray</h5>
                                                            <p class="mb-3 text-body">
                                                                You earn new certificate for complete the Javascript
                                                                Beginner course.
                                                            </p>
                                                            <span class="fs-6 text-muted">
                                                        <span
                                                        ><span
                                                                class="fe fe-award text-warning me-1"
                                                            ></span
                                                            >Oct 9,</span
                                                        >
                                                        <span class="ms-1">1:56 PM</span>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-auto text-center me-2">
                                                <a
                                                    href="#"
                                                    class="badge-dot bg-secondary"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"

                                                    title="Mark as unread"
                                                >
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border-top px-3 pt-3 pb-0">
                                    <a
                                        href="dashboard/notification-history.html"
                                        class="text-link fw-semi-bold"
                                    >See all Notifications</a
                                    >
                                </div>
                            </div>
                        </div>
                    </li>
                            --}}
                            <li class="dropdown ms-2 d-inline-block">
                                <a
                                    class="rounded-circle"
                                    href="#"
                                    data-bs-toggle="dropdown"
                                    data-bs-display="static"
                                    aria-expanded="false"
                                >
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img
                                            alt="avatar"
                                            src="{{ auth()->user()->photo }}"
                                            class="rounded-circle"
                                        />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="dropdown-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                                <img
                                                    alt="avatar"
                                                    src="{{ auth()->user()->photo }}"
                                                    class="rounded-circle"
                                                />
                                            </div>
                                            @if(auth()->user()->role=='admin' )
                                                <a href="{{route('admin.dashboard') }}" class="ms-3 lh-1">
                                                    <h5 class="mb-1 text-capitalize">{{ Str::limit(auth()->user()->name, 10) }}</h5>
                                                    <p class="mb-0 text-muted text-capitalize">{{ auth()->user()->role }}</p>
                                                </a>
                                            @elseif(auth()->user()->role=='recruiters')
                                                <a href="{{route('recruiter.dashboard') }}" class="ms-3 lh-1">
                                                    <h5 class="mb-1 text-capitalize">{{ Str::limit(auth()->user()->name, 10) }}</h5>
                                                    <p class="mb-0 text-muted text-capitalize">{{ auth()->user()->role }}</p>
                                                </a>
                                            @else
                                                <a href="{{route('seeker.dashboard') }}" class="ms-3 lh-1">
                                                    <h5 class="mb-1 text-capitalize">{{ Str::limit(auth()->user()->name, 10) }}</h5>
                                                    <p class="mb-0 text-muted text-capitalize">{{ auth()->user()->role }}</p>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>
                                    @if(Auth::check() && Auth::user()->role == 'admin')
                                        <ul class="list-unstyled">
                                            {{--
                                                <li class="dropdown-submenu dropstart-lg">
                                                <a
                                                    class="dropdown-item dropdown-list-group-item dropdown-toggle"
                                                    href="#"
                                                >
                                                    <i class="fe fe-circle me-2"></i>Status
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <span class="badge-dot bg-success me-2"></span>Online
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <span class="badge-dot bg-secondary me-2"></span>Offline
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <span class="badge-dot bg-warning me-2"></span>Away
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <span class="badge-dot bg-danger me-2"></span>Busy
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            --}}
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                                    <i class="fe fe-user me-2"></i>Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('setting.index') }}">
                                                    <i class="fe fe-settings me-2"></i>Settings
                                                </a>
                                            </li>
                                        </ul>
                                    @elseif(Auth::check() && Auth::user()->role == 'recruiters')
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="{{ route('recruiter.dashboard') }}" class="dropdown-item">
                                                    <i class="fe fe-monitor me-2"></i>Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('recruiter.editProfile') }}" class="dropdown-item">
                                                    <i class="fe fe-user me-2"></i>Profile
                                                </a>
                                            </li>
<!--                                            <li>
                                                <a class="dropdown-item" href="{{ route('recruiter.security') }}">
                                                    <i class="fe fe-settings me-2"></i>Settings
                                                </a>
                                            </li>-->
                                        </ul>
                                    @else
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="{{ route('seeker.dashboard') }}" class="dropdown-item">
                                                    <i class="fe fe-monitor me-2"></i>Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('seeker.showProfile') }}" class="dropdown-item">
                                                    <i class="fe fe-user me-2"></i>Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seeker.security') }}">
                                                    <i class="fe fe-settings me-2"></i>Settings
                                                </a>
                                            </li>
                                        </ul>
                                    @endif




                                    <div class="dropdown-divider"></div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="{{ route("logout") }}">
                                                <i class="fe fe-power me-2"></i>Sign Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                @endif

{{--                here all login profile dropdrown links --}}
            </ul>







            <!--
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="navbarPages"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    Pages
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-arrow dropdown-menu-end"
                    aria-labelledby="navbarPages"
                >

                    <li>
                        <a class="dropdown-item" href="../jobs/company-list.html">
                            Company List
                        </a>
                    </li>
                    <li class="dropdown-submenu dropend">
                        <a
                            class="dropdown-item dropdown-list-group-item dropdown-toggle"
                            href="#"
                        >
                            Company Single
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="../jobs/company-about.html"
                                >
                                    About
                                </a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="../jobs/company-reviews.html"
                                >
                                    Reviews
                                </a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="../jobs/company-jobs.html"
                                >
                                    Jobs
                                </a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="../jobs/company-benefits.html"
                                >
                                    Benifits
                                </a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="../jobs/company-photos.html"
                                >
                                    Photos
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../jobs/post-job.html">
                            Post A Job
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../jobs/upload-resume.html">
                            Upload Resume
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../index.html">Back to Demo</a>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="fe fe-more-horizontal fs-3"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-md dropdown-menu-end "
                    aria-labelledby="navbarDropdown"
                >
                    <div class="list-group">
                        <a
                            class="list-group-item list-group-item-action border-0"
                            href="../../docs/index.html"
                        >
                            <div class="d-flex align-items-center">
                                <i class="fe fe-file-text fs-3 text-primary"></i>
                                <div class="ms-3">
                                    <h5 class="mb-0">Documentations</h5>
                                    <p class="mb-0 fs-6">
                                        Browse the all documentation
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a
                            class="list-group-item list-group-item-action border-0"
                            href="../../docs/changelog.html"
                        >
                            <div class="d-flex align-items-center">
                                <i class="fe fe-layers fs-3 text-primary"></i>
                                <div class="ms-3">
                                    <h5 class="mb-0">
                                        Changelog<span class="text-primary ms-1">v2.6.0</span>
                                    </h5>
                                    <p class="mb-0 fs-6">See what's new</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            -->


        </div>
    </div>
</nav>
