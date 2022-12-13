@extends('seekers.layout.master')
@section('title', get_setting('name')." Security Page")
@section('seeker_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Security</h3>
                <p class="mb-0">
                    Edit your account settings and change your password here.
                </p>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <h4 class="mb-0">Email Address</h4>
                <p>
                    Your current email address is
                    <span class="text-success">{{ Auth::user()->email }}</span>
                </p>
                <form class="row" action="{{ route('seeker.changeEmail') }}" method="post">
                    @csrf
                    <div class="mb-3 col-lg-6 col-md-12 col-12 d-flex flex-column">
                        <label class="form-label" for="email">New email address</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required />
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">
                            Update Email
                        </button>
                    </div>
                </form>
                <hr class="my-5" />
                <div>
                    <h4 class="mb-0">Change Password</h4>
                    <p>
                        We will email you a confirmation when changing your
                        password, so please expect that email after submitting.
                    </p>
                    <!-- Form -->
                    <form class="row" action="{{ route('seeker.changePass') }}" method="post">
                        @csrf
                        <div class="col-lg-6 col-md-12 col-12">
                            <!-- Current password -->
                            <div class="mb-3">
                                <label class="form-label" for="currentpassword">Current password</label>
                                <input id="currentpassword" type="password" name="currentpassword" class="form-control"
                                       placeholder="Current Password" required />
                                @error('currentpassword')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- New password -->
                            <div class="mb-3 password-field">
                                <label class="form-label" for="password">New password</label>
                                <input id="password" type="password" name="password" class="form-control mb-2"
                                       placeholder="New Password" required />
                                <div class="row align-items-center g-0">
                                    <div class="col-6">
                                        <span data-bs-toggle="tooltip" data-placement="right"
                                              title="Test it by typing a password in the field below. To reach full strength, use at least 6 characters, a capital letter and a digit, e.g. 'Test01'">Password
                                            strength
                                            <i class="fe fe-help-circle ms-1"></i></span>
                                    </div>
                                </div>
                                @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <!-- Confirm new password -->
                                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control mb-2"
                                       placeholder="Confirm Password" required />
                                @error('password_confirmation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <!-- Button -->
                            <button type="submit" class="btn btn-primary">
                                Save Password
                            </button>
                            <div class="col-6"></div>
                        </div>
                        <div class="col-12 mt-4">
                            <p class="mb-0">
                                Can't remember your current password?
                                <a href="#">Reset your password via email</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
