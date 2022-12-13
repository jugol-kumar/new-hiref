@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Companies")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Card -->
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-0">Company</h3>
                    <span>Manage your company and its update.</span>
                </div>
                <a href="#"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" class="btn btn-primary btn-sm">Add new company</a>
            </div>
            {{--
            <!-- Card body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                        <input type="search" class="form-control" placeholder="Search Your Jobs" />
                    </div>
                    <div class="col-lg-3 col-md-5 col-12">
                        <select class="selectpicker" data-width="100%">
                            <option value="">Date Created</option>
                            <option value="Newest">Newest</option>
                            <option value="High Rated">High Rated</option>
                            <option value="Law Rated">Law Rated</option>
                            <option value="High Earned">High Earned</option>
                        </select>
                    </div>
                </form>
            </div>
            --}}
            <!-- Table -->
            <div class="table-responsive table-striped border-0 overflow-hidden">
                <table class="table mb-0 text-nowrap">
                    <thead class="table-light">
                    <tr>
                        <th scope="col" class="border-0">Name</th>
                        <th scope="col" class="border-0">Emp-Size</th>
                        <th scope="col" class="border-0">Contact</th>
                        <th scope="col" class="border-0">Jobs</th>
                        <th scope="col" class="border-0"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $key => $company)
                        <tr>
                            <td class="border-bottom-0">
                                <div class="d-lg-flex">
                                    <div>
                                        <a href="#" target="_blank">
                                            <img src="{{ config("app.url")."/storage/".$company->photos[0]->filename}}"
                                                 height="70"
                                                 alt="{{ config("app.name") }}" class="rounded img-4by3-lg">
                                        </a>
                                    </div>
                                    <div class="ms-lg-3 mt-2 mt-lg-0">
                                        <h4 class="mb-1 h5">
                                            <a href="#" class="text-inherit" target="_blank">{{ $company->name }}</a>
                                        </h4>
                                        <span class="badge bg-light-primary text-primary">{{ $company->starting_date->format('F-Y') }}</span>
<!--                                        <ul class="list-inline fs-6 mb-0">
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-clock-time-four-outline text-muted me-1"></i>1h 30m
                                            </li>
                                            <li class="list-inline-item">
                                                <svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                    <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9"></rect>
                                                    <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
                                                </svg>Beginner
                                            </li>
                                        </ul>-->
                                    </div>
                                </div>
                            </td>
                            <td class="border-bottom-0">{{ $company->employee_size }}</td>
                            <td class="d-flex flex-column border-bottom-0">
                                <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                <span>{{ $company->phone }}</span>
                            </td>
                            <td class="border-bottom-0">
                                <span class="badge bg-light-primary">{{ $company->jobs_count }}</span>
                            </td>
                            <td class="text-muted border-bottom-0">
                                <span class="dropdown dropstart">
                                    <a class="btn-icon btn btn-ghost btn-sm rounded-circle " href="#" role="button" id="courseDropdown"
                                       data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                                        <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <span class="dropdown-menu" aria-labelledby="courseDropdown">
                                        <span class="dropdown-header">Setting </span>
                                        <a class="dropdown-item" href=""><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>

                                        <button  class="dropdown-item" type="button"
                                                         onclick="deleteData({{ $company->id }})"
                                                >
                                            <i class="fe fe-trash  dropdown-item-icon"></i>  <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $company->id }}"
                                              method="POST"
                                              action="{{ route('recruiter.deleteCompany', $company->id) }}"
                                              style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </span>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $companies->links() }}
            </div>
        </div>
    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar >
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">Create new company</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form action="{{ route('recruiter.saveCompany') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" >
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Company Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter company name" required>

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Company Type<span class="text-danger">*</span></label>
                            <input type="text" name="type" class="form-control" placeholder="Enter company type" required>

                            @error('type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Company Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="example@companyname.domain" required>

                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Company Phone<span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" placeholder="+8801*-********" required>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-md-6 col-12">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <div class="input-group me-3">
                                <input name="starting_date" class="form-control flatpickr" type="text" placeholder="Select Date"
                                       aria-describedby="basic-addon2">
                                @error('starting_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <span class="input-group-text text-muted" id="basic-addon2"><i
                                        class="fe fe-calendar"></i></span>

                            </div>
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Employee Size<span class="text-danger">*</span></label>
                            <input type="text" name="employee_size" class="form-control" placeholder="Employee size" required>
                            @error('employee_size')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Employee Size<span class="text-danger">*</span></label>
                            <input name="city" type="text" class="form-control" placeholder="Employee size" required>
                            @error('city')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-6">
                            <label class="form-label">Website<span class="text-danger">*</span></label>
                            <input type="text" name="website" class="form-control" placeholder="https://www.example.info" required>
                            @error('website')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control"
                                   placeholder="The Imperial Irish Kingdom, Mo-03 (3rd Floor), Merul Badda, Dhaka 1212" required>
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">Description</label>
                            <textarea name="details" class="form-control" placeholder="Enter simple descriptions......" rows="3"></textarea>
                            @error('details')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12 mb-4">
                            <div class="logoSection">
                                <!-- logo -->
                                <h5 class="mb-3">Company Logo </h5>
                                <div class="icon-shape icon-xxl border rounded position-relative">
                                    <span class="position-absolute imageShow"> <i class="bi bi-image fs-3  text-muted"></i></span>
                                    <input name="logo" class="form-control border-0 opacity-0 uploadFile" type="file" >
                                    @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-12 mb-4">
                            <div class="logoSection">
                                <!-- logo -->
                                <h5 class="mb-3">Background Image </h5>
                                <div class="icon-shape border rounded position-relative h-10rem">
                                    <span class="position-absolute imageShow"> <i class="bi bi-image fs-1  text-muted"></i></span>
                                    <input name="cover" class="form-control border-0 opacity-0 uploadFile" type="file" >
                                    @error('cover')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8"></div>
                        <!-- button -->
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>

        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
        });

        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file
                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        console.log(this.result)
                        uploadFile.closest(".logoSection").find("i").remove();
                        uploadFile.closest(".logoSection").find('.imageShow').css({
                            "background-image": "url("+this.result+")",
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
