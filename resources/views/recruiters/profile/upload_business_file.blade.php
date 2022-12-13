@extends('frontend.layout.master')

@section('title', 'Profile Complete')
@section('content')
    <div class="bg-light-primary py-lg-14 py-12 bg-cover ">
        <div class="container">
            <div class="col-md-9 mx-auto">
                <div id="courseForm" class="bs-stepper">
                    <div class="row">
                        <div class="print-error-msg text-danger">
                            <ul></ul>
                        </div>
                        <div class="col-lg-12 col-md-8 col-12">
                            <!-- Stepper Button -->
                            <div class="bs-stepper-header shadow-sm" role="tablist">
                                <div class="step" data-target="#test-l-1">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="test-l-1">
                                        <span class="btn bs-stepper-label">Verify Your Compnay Email</span>
                                    </button>
                                </div>
                                <div class="step" data-target="#test-l-2">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                                        <span class="btn bs-stepper-label">Upload Your Company Certificate</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Stepper content -->
                            <div class="bs-stepper-content mt-5">
                                <!-- Content one -->
                                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                    <!-- Card -->
{{--                                    <form id="verify_email_form">--}}
                                    <form action="{{ route('recruiter.verifyWorkEmail') }}" method="post">
                                        @csrf
                                        <div class="card mb-3 ">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Verify your compnay email</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Expacted Salary</label>
                                                    <input type="email" name="work_mail" class="form-control" placeholder="e.g example@workmail.com"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <button type="submit" class="btn btn-primary">
                                            Send mail
                                        </button>
                                    </form>
                                </div>
                                <!-- Content two -->
                                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                    <!-- Card -->
                                    <form action="{{ route('recruiter.verifyBusinessFile') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card mb-3  border-0">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Upload Your Business Details Files</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Offer Letter/Appoint Letter/ID Card/ Visiting Card/ AOD</label>
                                                    <input class="form-control form-control-md"
                                                           name="business_files"
                                                           id="formFileLg"
                                                           placeholder="Upload your reume" type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Upload
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('recruiter.verifyWorkEmail') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    console.log(res);
                }
            })
        });
    </script>

@endpush
