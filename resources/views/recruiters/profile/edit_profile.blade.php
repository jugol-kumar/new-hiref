@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Edit Profile")
@section('recruiter_content')

    <div class="col-lg-9 col-md-8 col-12">
        <div class="bg-light-primary py-lg-2 bg-cover">
        <div class="container">
            <div class="row">
                <div class="print-error-msg text-danger text-center">
                    <ul></ul>
                </div>
                <div class="col-12 mx-auto">
                    <form id="personal_details">
                        @csrf
                        <div class="card mb-3 ">
                            <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">Edit Here</h4>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-4 mb-lg-0 justify-content-between">
                                        <div class="ms-3">
                                            <h4 class="mb-0">Click Image For Change Your avatar</h4>
                                            <p class="mb-0">
                                                Choose PNG or JPG file picture for set your profile picture.
                                            </p>
                                        </div>
                                        <div class="logoSection pe-13">
                                            <div class="icon-shape icon-xxl border rounded-circle position-relative">
                                                <span class="position-absolute imageShow"> <i class="bi bi-image fs-3  text-muted"></i></span>
                                                <input name="profile_pic" class="form-control border-0 opacity-0 uploadFile" type="file" >
                                                @error('profile_pic')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-4 mb-lg-0 justify-content-between">
                                        <div class="ms-3">
                                            <h4 class="mb-0">My gender</h4>
                                        </div>
                                        <div class="">
                                            <label>
                                                <input type="radio" checked name="gender" value="male">
                                                <div  class="maleFemale btn-sık">
                                                    <span>Male</span>
                                                </div>
                                            </label>
                                            <label>
                                                <input  type="radio"  name="gender" value="female">
                                                <div class="maleFemale btn-sık">
                                                    <span>Female</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                               @if($user->first_name != null)
                                                   value="{{ $user->first_name }}"
                                               @else
                                                placeholder="Enter First Name">
                                               @endif
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                               @if($user->last_name != null)
                                               value="{{ $user->last_name }}"
                                               @else
                                               placeholder="Enter Last Name"
                                               @endif
                                        >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                               @if($user->email != null)
                                                   value="{{ $user->email }}"
                                               @else
                                               placeholder="Enter Last Name"
                                               @endif>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Division</label>
                                        <select id="designation" class="selectpicker" data-width="100%" name="designation">
                                            <option selected disabled value="">Select Your Position On Your Company</option>
                                            <option value="COO" {{ $user->recruiter->designation ==  'COO' ? 'selected' : '' }}>COO</option>
                                            <option value="CMO" {{ $user->recruiter->designation ==  'CMO' ? 'selected' : '' }}>CMO</option>
                                            <option value="CTO"  {{ $user->recruiter->designation ==  'CTO' ? 'selected' : '' }}>CTO</option>
                                            <option value="Founder/CEO"  {{ $user->recruiter->designation ==  'Founder/CEO' ? 'selected' : '' }}>Founder/CEO</option>
                                            <option value="HR"  {{ $user->recruiter->designation ==  'HR' ? 'selected' : '' }}>HR</option>
                                            <option value="OTHER"  {{ $user->recruiter->designation ==  'OTHER' ? 'selected' : '' }}>OTHER</option>
                                        </select>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Company Full Name</label>
                                        <input type="text" name="c_full_name" class="form-control"
                                               @if($user->recruiter->company_name != null)
                                               value="{{ $user->recruiter->company_name }}"
                                               @else
                                               placeholder="Company Full Name"
                                               @endif>
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Company Short Name</label>
                                        <input type="text" name="c_short_name" class="form-control"
                                               @if($user->recruiter->company_sname != null)
                                               value="{{ $user->recruiter->company_sname }}"
                                               @else
                                               placeholder="Company Short Name"
                                               @endif>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Hot Industry</label>
                                        <input type="text" name="hot_industry" class="form-control"
                                               @if($user->recruiter->hot_industry != null)
                                               value="{{ $user->recruiter->hot_industry }}"
                                               @else
                                               placeholder="Hot Industry"
                                               @endif>
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Employee Size</label>
                                        <input type="text" name="employee_size" class="form-control"
                                               @if($user->recruiter->emp_size != null)
                                               value="{{ $user->recruiter->emp_size }}"
                                               @else
                                               placeholder="Employee Size"
                                               @endif>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Company Full Address</label>
                                    <textarea name="full_address" class="form-control">
                                         {{ $user->recruiter->company_address }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Button -->
                        <button type="submit" class="btn btn-primary">
                            Update Details
                        </button>
                    </form>
                </div>
            </div>


        </div>
    </div>
    </div>
@endsection


@push('js')
    <script>
        $('#personal_details').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('recruiter.updateBio') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    Toast.fire({
                        icon: 'success',
                        title: "Details Update Successfuly Done..."
                    })
                },
                error:function (res){
                    Toast.fire({
                        icon: 'error',
                        title: res.responseJSON.message,
                    })
                    $(".print-error-msg").find("ul").empty();
                    $.each(res.responseJSON.errors,function(field_name,error){
                        $(".print-error-msg").find("ul").append('<li>'+error+'</li>');
                    })
                }
            })
        });



        $(function() {
            $(".uploadFile").closest(".logoSection").find("i").remove();
            $(".uploadFile").closest(".logoSection").find('.imageShow').css({
                "background-image": "url('{{ config('app.url').Auth::user()->photo }}')",
                "width": "100%",
                "height": "100%",
                "background-position": "center center",
                "background-size": "cover",
                "border-radius": "5px"
            });
            $(document).on("change", ".uploadFile", function () {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file
                    reader.onloadend = function () { // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        console.log(this.result)
                        uploadFile.closest(".logoSection").find("i").remove();
                        uploadFile.closest(".logoSection").find('.imageShow').css({
                            "background-image": "url(" + this.result ?? "{{ config('app.url').Auth::user()->photo }}" + ")",
                            "width": "100%",
                            "height": "100%",
                            "background-position": "center center",
                            "background-size": "cover",
                            "border-radius": "5px"
                        });
                    }
                }

            });
        });
    </script>

@endpush
