@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Job Create")
@push('css')
    <style>
        .ql-container{
            min-height: 300px !important;
        }
    </style>
@endpush
@section('recruiter_content')

    <div class="col-lg-9 col-md-8 col-12">
        <!-- Page header-->
        <div class="py-4 py-lg-6 bg-primary">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-1 col-lg-10 col-md-12 col-12">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <!-- Content -->
                            <div class="mb-4 mb-lg-0">
                                <h1 class="text-white mb-1">Add New Job</h1>
                                <p class="mb-0 text-white lead">
                                    Just fill the form and create your courses.
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('recruiter.allJobs') }}" class="btn btn-white btn-sm me-1">Back to List</a>
                                <button type="button" class="btn btn-success btn-sm submitButton">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Content -->
        <div class="pb-12">
            <div class="container">
                <div id="courseForm" class="bs-stepper">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Stepper Button -->
                            <div class="bs-stepper-header shadow-sm" role="tablist">
                                <div class="step" data-target="#test-l-1">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="test-l-1">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Basic Information</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-2">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Job Descriptions</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-3">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger3" aria-controls="test-l-3">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Company Info </span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-4">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4" aria-controls="test-l-4">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Salary & Skills</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Stepper content -->
                            <div class="bs-stepper-content mt-5">
                                <form action="{{ route('recruiter.storeJob') }}" method="post" id="jobOfferForm">
                                    @csrf
                                    <!-- Content one -->
                                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                        <!-- Card -->
                                        <div class="card mb-3 ">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Basic Information</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="courseTitle" class="form-label">Job Title <span class="text-danger">*</span></label>
                                                    <input name="title" id="courseTitle"
                                                           class="form-control" type="text"
                                                           placeholder="e.g full time digital marketing jobs"
                                                           value="{{ old('title') }}"
                                                           required
                                                    />

                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Category <small class="text-info">(Change category for see sub-categories)</small></label>
                                                    <select class="selectpicker" data-width="100%" name="category_id" onchange="subCateory(this)">
                                                        <option selected disabled  value="">Select category</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ (collect(old('category_id'))->contains($cat->id)) ? 'selected':'' }}>{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col" id="subCategory-card" style="display: none">
                                                            <label class="form-label">Sub category <small class="text-info">(Change category for see child-categories)</small></label>
                                                            <select name="sub_category_id" class="selectpicker" data-width="100%"
                                                                    onchange="childCategory(this)"  id="sub_category" >
                                                                <option selected disabled  value="">Select category</option>
                                                            </select>

                                                            @error('sub_category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col" id="childCategory-card" style="display: none">
                                                            <label class="form-label">Job category</label>
                                                            <select name="child_category_id" class="selectpicker" data-width="100%"  id="child_category" >
                                                                <option selected disabled  value="">Select child category</option>
                                                            </select>
                                                            @error('child_category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="form-label">Job Type <span class="text-danger">*</span></label>
                                                            <select name="types" class="selectpicker" required data-width="100%">
                                                                <option value="">Select Type</option>
                                                                <option value="Full Time" {{ old('types') == "Full Time" ? 'selected':'' }}>Full Time</option>
                                                                <option value="Part Time" {{ old('types') == "Part Time" ? 'selected':'' }}>Part Time</option>
                                                                <option value="Freelance" {{ old('types') == "Freelance" ? 'selected':'' }}>Freelance</option>
                                                                <option value="Internship" {{ old('types') == "Internship" ? 'selected':'' }}>Internship</option>
                                                                <option value="Temporary" {{ old('types') == "Temporary" ? 'selected':'' }}>Temporary</option>
                                                                <option value="Contract" {{ old('types') == "Contract" ? 'selected':'' }}>Contract</option>
                                                                <option value="Seasonal" {{ old('types') == "Seasonal" ? 'selected':'' }}>Seasonal</option>
                                                            </select>
                                                            @error('types')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col">
                                                            <label class="form-label">Label <span class="text-danger">*</span></label>
                                                            <select name="label" class="selectpicker" required data-width="100%">
                                                                <option value="" selected disabled>Select level</option>
                                                                <option value="Beginner" {{ old('label') == "Beginner" ? 'selected':'' }}>Beginner</option>
                                                                <option value="Junior" {{ old('label') == "Junior" ? 'selected':'' }}>Junior</option>
                                                                <option value="Mid-level" {{ old('label') == "Mid-level" ? 'selected':'' }}>Mid-level</option>
                                                                <option value="Senior" {{ old('label') == "Senior" ? 'selected':'' }}>Senior</option>
                                                                <option value="Lead" {{ old('label') == "Lead" ? 'selected':'' }}>Lead</option>
                                                                <option value="Manager" {{ old('label') == "Manager" ? 'selected':'' }}>Manager</option>
                                                            </select>
                                                            @error('label')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();courseForm.next()">
                                            Next
                                        </button>
                                    </div>
                                    <!-- Content two -->
                                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                        <!-- Card -->
                                        <div class="card mb-3  border-0">

                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Job Detials</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Job Short Description <small class="text-info" style="font-size: 10px">(Max 200 Char. Describe Main Role About This Job.)</small></label>
                                                    <textarea name="job_disc" id="job_disc" rows="8" placeholder="e.g simple about this job" class="form-control" >{{ old('job_disc') }}</textarea>

                                                    Remanings <small id="remaining" class="text-danger">600</small> Characters Of / <small class="text-success"> 600</small>
                                                    <br>
                                                    @error('job_disc')
                                                     <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Job Full Details  <small class="text-info" style="font-size: 10px">(Min 200 Char. Describe Complete Details About This Job.)</small></label>
                                                    <textarea name="job_details"
                                                              class="form-control quill-editor"
                                                              rows="20">{!! old('job_details') ?? \App\Properties::$jobPlaceholder !!}</textarea>
                                                </div>
                                                @error('job_details')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" onclick="event.preventDefault();courseForm.previous()">
                                                Previous
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="event.preventDefault();courseForm.next()">
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Content three -->
                                    <div id="test-l-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                                        <!-- Card -->
                                        <div class="card mb-3  border-0">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Company Details </h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body ">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Your Company <small class="text-info">(Get Here Your All Added Companies)</small></label>
                                                    <select class="selectpicker" data-width="100%" name="company">
                                                        <option selected disabled  value="">Select Company</option>
                                                        @foreach($companies as $com)
                                                            <option value="{{ $com->id }}" {{ (collect(old('company'))->contains($com->id)) ? 'selected':'' }}>{{ $com->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('selectpicker')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="form-label">Declined Date <span class="text-danger">*</span></label>
                                                            <div class="input-group me-3">
                                                                <input class="form-control flatpickr flatpickr-input active"
                                                                       type="text" placeholder="Select Date"
                                                                       name="declined_date"
                                                                       value="{{ old('declined_date') }}"
                                                                       aria-describedby="basic-addon2" readonly="readonly">
                                                                <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>
                                                            </div>

                                                            @error('declined_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col">
                                                            <label class="form-label">Application target<span class="text-danger">*</span><small class="text-info">(Provide This Company Full Address)</small></label>
                                                            <input name="web_address"
                                                                   value="{{ old('web_address') }}"
                                                                   type="text" class="form-control" placeholder="https://creativetechpark.com">

                                                            @error('web_address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label class="form-label">Preferred State <small class="text-info">(Select State For Batter Response)</small></label>
                                                                <select class="selectpicker"
                                                                        data-live-search="true"
                                                                        name="division_id"
                                                                        onchange="getCityByState(this)" data-width="100%">
                                                                    <option value="">Select Preferred State</option>
                                                                    @foreach($states as $state)
                                                                        <option value="{{ $state->id }}" {{ (collect(old('division_id'))->contains($state->id)) ? 'selected':'' }}>{{ $state->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col" id="city-card" style="display: none">
                                                                <label class="form-label">Preferred City <small class="text-info">(Select City Where You Want To Employee)</small></label>
                                                                <select name="district_id" class="selectpicker"
                                                                        data-live-search="true"
                                                                        data-width="100%"  id="city_id" >
                                                                    <option selected disabled  value="">Select city</option>
                                                                </select>
                                                                @error('child_category_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Full Address <small class="text-info">(Given full address that users will see it.)</small></label>
                                                    <textarea name="location" class="form-control" rows="5" placeholder="e.g {{ get_setting('address') }}">{{ old('location') }}</textarea>

                                                    @error('location')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 d-flex justify-content-between">
                                                    <div class="form-check form-switch"
                                                         data-toggle="tooltip"
                                                         data-placement="top"
                                                         title="If this job is remote position. Then Checked This Option">
                                                        <input name="is_remote"
                                                               {{ old('is_remote') ? 'checked' : '' }}
                                                               class="form-check-input"
                                                               type="checkbox" role="switch">
                                                        <label class="form-check-label">Is Remote</label>

                                                        @error('is_remote')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-check form-switch"
                                                         data-toggle="tooltip"
                                                         data-placement="top"
                                                         title="If this job is full time position. Then Checked This Option">
                                                        <input name="fultime_remote"
                                                               {{ old('fultime_remote') ? 'checked' : '' }}
                                                               class="form-check-input" type="checkbox" role="switch">
                                                        <label class="form-check-label">Is Full-time Remote</label>

                                                        @error('fultime_remote')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-check form-switch"
                                                         data-toggle="tooltip"
                                                         data-placement="top"
                                                         title="If this job published for publickly then chek this option...">
                                                        <input name="is_published"
                                                               {{ old('is_published') ? 'checked' : '' }}
                                                               class="form-check-input" type="checkbox" role="switch">
                                                        <label class="form-check-label">Publication Status</label>

                                                        @error('is_published')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-check form-switch"
                                                         data-toggle="tooltip"
                                                         data-placement="top"
                                                         title="Check this option for featured request this job... ">
                                                        <input name="is_featured"
                                                               {{ old('is_featured') ? 'checked' : '' }}
                                                               class="form-check-input" type="checkbox" role="switch">
                                                        <label class="form-check-label">Featured Status</label>

                                                        @error('is_featured')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" onclick="event.preventDefault();courseForm.previous()">
                                                Previous
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="event.preventDefault();courseForm.next()">
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Content four -->
                                    <div id="test-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                                        <!-- Card -->
                                        <div class="card mb-3  border-0">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Requirements</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">

                                                <div class="mb-3">
                                                    <label>Experience <small class="text-info">(Are you find experienced or not ?.)</small></label>
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control"
                                                                   name="min_experience"
                                                                   value="{{ old('min_experience') }}"
                                                                   placeholder="Minimum Work Exprience" aria-label="Amount">
                                                            <input type="number" class="form-control"
                                                                   name="max_experience"
                                                                   value="{{ old('max_experience') }}"
                                                                   placeholder="Maximum Work Exprience" aria-label="Amount">
                                                            <select name="experience_type"
                                                                    value="{{ old('experience_type') }}"
                                                                    class="selectpicker" placeholder="Chose Exprience Type">
                                                                <option selected value="" disabled>~~ Chose Experience Type ~~</option>
                                                                <option value="year" {{ old('experience_type') == "year" ? 'selected':'' }}>Year</option>
                                                                <option value="month" {{ old('experience_type') == "month" ? 'selected':'' }}>Month</option>
                                                                <option value="days" {{ old('experience_type') == "days" ? 'selected':'' }}>Days</option>
                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                    <div class="d-flex flex-column">
                                                        @error('min_experience')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @error('max_experience')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @error('experience_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="mb-3">
                                                    <label>Expected Salary <small class="text-info">(Change currency for other country job's. It's default bangladesh "TK")</small></label>
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <select name="currency" class="selectpicker" placeholder="Select Currency">
                                                                <option selected value="" disabled>~~ Select Currency ~~</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}"
                                                                            {{ $country->id == 19 ? 'selected' : '' }}
                                                                        {{ (collect(old('currency'))->contains($country->id)) ? 'selected':'' }}>{{ $country->name ."/" . $country->currency_symbol  }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="number" class="form-control"
                                                                   name="min_salary"
                                                                   value="{{ old('min_salary') }}"
                                                                   placeholder="Minimum Work Salary" aria-label="Amount">
                                                            <input type="number" class="form-control"
                                                                   name="max_salary"
                                                                   value="{{ old('max_salary') }}"
                                                                   placeholder="Maximum Work Salary" aria-label="Amount">
                                                        </div>
                                                    </fieldset>

                                                    <div class="d-flex flex-column">
                                                        @error('currency')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        @error('min_salary')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        @error('max_salary')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="row">
                                                       <div class="col">
                                                           <label class="form-label">Hash Tag <small class="text-info">(Enter Job Related Tag's. It's multiple)</small></label>
                                                           <input name='tags' value="{{ old('tags') }}" placeholder="Add has Tags" autofocus>

                                                           @error('tags')
                                                           <span class="text-danger">{{ $message }}</span>
                                                           @enderror
                                                       </div>

                                                       <div class="col">
                                                           <label class="form-label">Required Skills <small class="text-info">(Add some skills for required this job. It's multiple)</small></label>
                                                           <input name='skills' value="{{ old('skills') }}" placeholder="Required Skills" autofocus>

                                                           @error('skills')
                                                            <span class="text-danger">{{ $message }}</span>
                                                           @enderror
                                                       </div>
                                                    </div>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Job Status <small class="text-info">(Select this job status.)</small></label>
                                                    <select class="selectpicker" data-width="100%" name="job_status">
                                                        <option value="lived" selected {{ old('job_status') == "lived" ? 'selected':'' }}>Lived</option>
                                                        <option value="joined" {{ old('job_status') == "joined" ? 'selected':'' }}>Joined</option>
                                                        <option value="draft" {{ old('job_status') == "draft" ? 'selected':'' }}>Draft</option>
                                                        <option value="pending" {{ old('job_status') == "pending" ? 'selected':'' }}>Pending</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-22">
                                            <!-- Button -->
                                            <button type="button" class="btn btn-secondary mt-5" onclick="event.preventDefault();courseForm.previous()">
                                                Previous
                                            </button>
                                            <button type="button" class="btn btn-danger mt-5 submitButton">
                                                Save This Job
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        function subCateory(event){
            let categoryId = event.value;
            if (categoryId){
                $.ajax({
                    url: `{{ route('recruiter.getSubCat', '') }}/${categoryId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function (data) {
                        if (data.length == 0){
                            $('#subCategory-card').hide('slow');
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'error',
                                text:'no have any Sub Category for this Category',
                                showConfirmButton: true,
                            });
                        }
                        else{
                            $('#subCategory-card').show('slow');
                            $('#sub_category').append('<option>Processing.....</option>');
                            $('#sub_category').empty();
                            $('#sub_category').append('<option selected disabled value="">'+'Select sub category'+'</option>');
                            $.each(data.data, function (key, value) {
                                $('#sub_category').append('<option value="'+value.id+'" >'+value.name+'</option>');
                            })
                            $('#sub_category').selectpicker('refresh');
                        }
                    }
                })
            } else{
                $('#sub_category').empty();
            }
        }

        function childCategory(event) {
            let categoryId = event.value;
            if (categoryId){
                $.ajax({
                    url: `{{ route('recruiter.getChildCat', '') }}/${categoryId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function (data) {
                        if (data.length == 0){
                            $('#childCategory-card').hide('slow');
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'error',
                                text:'no have any Sub Category for this Category',
                                showConfirmButton: true,
                            });
                        }
                        else{
                            $('#childCategory-card').show('slow');
                            $('#child_category').append('<option>Processing.....</option>');
                            $('#child_category').empty();
                            $('#child_category').append('<option selected disabled value="">'+'Select sub category'+'</option>');
                            $.each(data.data, function (key, value) {
                                $('#child_category').append('<option value="'+value.id+'" >'+value.name+'</option>');
                            })
                            $('#child_category').selectpicker('refresh');
                        }
                    }
                })
            } else{
                $('#child_category').empty();
            }
        }
        $('.quill-editor').each(function(i, el) {
            var el = $(this), id = 'quilleditor-' + i, val = el.val(), editor_height = 200;
            var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
            el.addClass('d-none');
            el.parent().append(div);

            var quill = new Quill('#' + id, {
                modules: { toolbar: true },
                theme: 'snow',
            });
            quill.on('text-change', function() {
                var comment = document.querySelector('textarea[name=job_details]');
                if (comment){
                    comment.value = quill.container.firstChild.innerHTML;
                }
            });
        });


        $(".submitButton").on("click", function (){
            event.preventDefault();
            $("#jobOfferForm").submit();
        });

        // The DOM element you wish to replace with Tagify
        var input = document.querySelector('input[name=skills]');
        new Tagify(input)


        function getCityByState(event){
            let stateId = event.value;
            let city = $("#city_id");
            if (stateId) {
                $.ajax({
                    url: `<?php echo e(route('seeker.getCities', '')); ?>/${stateId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function(res){
                        city.empty();
                        $("#city-card").show();
                        city.append('<option selected disabled value="">'+'Select Districts'+'</option>');
                        $.each(res.districts, function (key, value) {
                            city.append('<option value="'+value.id+'" >'+value.name+'</option>');
                        })
                        city.selectpicker('refresh');
                    }
                })
            }
        }

        $("#job_disc").keyup(function(){
            $("#remaining").text(600 - $(this).val().length);
        });
    </script>


@endpush
