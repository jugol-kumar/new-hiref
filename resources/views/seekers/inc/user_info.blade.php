
<div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->
        <div class="pt-16 rounded-top-md" style="
            background: url({{ asset("frontend") }}/assets/images/background/seeker-profile-bg.png) no-repeat;
            background-size: cover;
            "></div>
        <div
            class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none rounded-bottom-md shadow-sm">
            <div class="d-flex align-items-center">
                <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                    <img src="{{ auth()->user()->photo  }}" class="avatar-xl rounded-circle border border-4 border-white position-relative"
                         alt="" />
                    <a href="#" class="position-absolute top-0 end-0" data-bs-toggle="tooltip" data-placement="top"
                       title="Verified">
                        <img src="{{ asset("frontend") }}/assets/images/svg/checked-mark.svg" alt="" height="30" width="30" />
                    </a>
                </div>
                <div class="lh-1">
                    <h2 class="mb-0 text-capitalize">{{ auth()->user()->name }}</h2>
                    <div class="progress" style="height: 10px; font-size: 8px">
                        <div class="progress-bar" role="progressbar" style="width: {{ auth()->user()->profileComplete() }}%;"
                             aria-valuenow="{{ auth()->user()->profileComplete() }}"
                             aria-valuemin="0"
                             aria-valuemax="100">{{ auth()->user()->profileComplete() }}%</div>
                    </div>
                    <p class="mb-0 d-block">{{ auth()->user()->email }}</p>
                </div>
            </div>
            {{--
            <div>
                <a href="#" class="btn btn-primary btn-sm d-none d-md-block"></a>
            </div>
            --}}
        </div>
    </div>
</div>
