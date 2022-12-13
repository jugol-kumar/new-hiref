@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Social Links")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
    <!-- Card -->
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Social Profiles</h3>
            <p class="mb-0">
                Add your social profile links in below social accounts.
            </p>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <form action="{{ route("recruiter.updateSocialLinks") }}" method="post">
                @csrf
                <div class="row mb-5">
                    <!-- Twitter -->
                    <div class="col-lg-3 col-md-4 col-12">
                        <h5>Twitter</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input type="url" class="form-control mb-1" name="twitter" value="{{ Auth::user()->twitter_url }}">
                        <small class="text-muted">Add your Twitter username (e.g. johnsmith).</small>
                    </div>
                </div>
                <!-- Facebook -->
                <div class="row mb-5">
                    <div class="col-lg-3 col-md-4 col-12">
                        <h5>Facebook</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input type="url" class="form-control mb-1" name="facebook" placeholder="Facebook Profile Name">
                        <small class="text-muted">Add your Facebook username (e.g. johnsmith).</small>
                    </div>
                </div>
                <!-- Instagram -->
                <div class="row mb-5">
                    <div class="col-lg-3 col-md-4 col-12">
                        <h5>Instagram</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input type="url" class="form-control mb-1" name="instagram" placeholder="Instagram Profile Name">
                        <small class="text-muted">Add your Instagram username (e.g. johnsmith).</small>
                    </div>
                </div>
                <!-- Linked in -->
                <div class="row mb-5">
                    <div class="col-lg-3 col-md-4 col-12">
                        <h5>LinkedIn Profile URL</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input type="url" class="form-control mb-1" name="linkedin" value="{{ Auth::user()->linkedin_url }}">
                        <small class="text-muted">Add your linkedin profile URL. (
                            https://www.linkedin.com/in/jitu-chauhan-ba004b78)</small>
                    </div>
                </div>
                <!-- Youtube -->
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                        <h5>YouTube</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input type="url" class="form-control mb-1" name="youtube" value="{{ Auth::user()->youtube_url }}">
                        <small class="text-muted">Add your Youtube profile URL.
                        </small>
                    </div>
                </div>
                <!-- Button -->
                <div class="row">
                    <div class="offset-lg-3 col-lg-6 col-12">
                        <button type="submit" class="btn btn-primary">Save Social Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
