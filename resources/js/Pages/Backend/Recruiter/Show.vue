<template>
    <div class="row match-height">
        <div class="col-md-7 col-lg-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-between flex-column col-xl-6 col-21">
                                <div class="d-flex justify-content-start">
                                                <span class="b-avatar badge-light-danger rounded">
                                                    <img class="rounded me-2"  style="width: 140px;height: 140px;" :src="recruiter.photo" alt="avatar">
                                                </span>
                                    <div class="d-flex flex-column ml-1">
                                        <div class="mb-1">
                                            <h4 class="mb-0"> {{ recruiter.name }} </h4>
                                            <span class="card-text">{{ recruiter.email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <table class="mt-2 mt-xl-0 w-100">
                                    <tr>
                                        <th class="pb-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="mr-75 feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <span class="ms-1 font-weight-bold">Username</span>
                                        </th>
                                        <td class="pb-50"> {{ recruiter.name }} </td>
                                    </tr>
                                    <tr>
                                        <th class="pb-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="mr-75 feather feather-check">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <span class="ms-1 font-weight-bold">Activation Status</span>
                                        </th>
                                        <td class="pb-50 text-capitalize"> <span class="badge" :class="recruiter.is_active ? 'bg-success' : 'bg-danger'">{{ recruiter.is_active ? "Active" : "Inactive"}}</span> </td>
                                    </tr>
                                    <tr>
                                        <th class="pb-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="mr-75 feather feather-star">
                                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                            </svg>
                                            <span class="ms-1 font-weight-bold">Role</span>
                                        </th>
                                        <td class="pb-50 text-capitalize"> {{ recruiter.role }} </td>
                                    </tr>
                                    <tr>
                                        <th class="pb-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="mr-75 feather feather-flag">
                                                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                                                <line x1="4" y1="22" x2="4" y2="15"></line>
                                            </svg>
                                            <span class="ms-1 font-weight-bold">Address</span>
                                        </th>
                                        <td class="pb-50"> </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="mr-75 feather feather-phone">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                            </svg>
                                            <span class="ms-1 font-weight-bold">Contact</span>
                                        </th>
                                        <td>{{ recruiter.phone }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body text-center p-0 counter_card">
                    <h4 class="mt-3">Chats</h4>
                    <p>{{ jobs?.message_details_count ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body text-center p-0 counter_card">
                    <h4 class="mt-3">Total Jobs</h4>
                    <p>{{ t_jobs ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body text-center p-0 counter_card">
                    <h4 class="mt-3">Seved Jobs</h4>
                    <p>{{ save_jobs ?? 0}}</p>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col">
            <div class="card bg-gradient-top bg-gradient-success">
                <div class="card-body">
                    <h2 class="card-title">Date Of Birth</h2>
                    <p class="ms-2 fw-semibold">{{ date(recruiter.recruiter?.end_date)+"-"+date(recruiter.recruiter?.start_date) }} years</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-gradient-top bg-gradient-primary">
                <div class="card-body">
                    <h2 class="card-title">Date Of Birth</h2>
                    <p class="ms-2 fw-semibold">{{ date(recruiter.recruiter?.end_date)+"-"+date(recruiter.recruiter?.start_date) }} years</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-light-gradient-bottom bg-gradient-info">
                <div class="card-body">
                    <h2 class="card-title">Date Of Birth</h2>
                    <p class="ms-2 fw-semibold">{{ date(recruiter.recruiter?.end_date)+"-"+date(recruiter.recruiter?.start_date) }} years</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row match-height">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="d-flex align-items-center text-black-50 mb-1">Job Preference</h2>
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="text-capitalize">{{ recruiter.category }}</h3>
                        <h5>{{ recruiter.recruiter?.exp_min_sal }} LPA- {{ recruiter.recruiter?.exp_max_sal }}LPA</h5>
                    </div>
                    <p class="mb-0 pb-0">{{ recruiter.recruiter?.types }}</p>
                    <p class="my-0 py-0">{{ recruiter.recruiter?.division.name }}, {{ recruiter.recruiter?.district.name }}</p>
                    <hr class="my-1">
                    <div class="d-flex flex-column">
                        <div class="">
                            Job Category : <span class="badge border-success text-success">{{ recruiter.recruiter.category.name }}</span>
                        </div>
                        <div class="">
                            Sub Categories: <span class="badge border-warning text-warning" v-for="cat in subCats">{{ cat.name }}</span>
                        </div>
                        <div>
                            Child Categories: <span class="badge border-danger text-danger" v-for="cat in cCat">{{ cat.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h2 class="d-flex align-items-center text-black-50 mb-1">Working Experience</h2>
                    <div class="d-flex align-items-center justify-content-start">
                        <h3 class="text-capitalize">{{ recruiter.company_name }}</h3>
                        <h5>{{ date(recruiter.recruiter?.start_date) }} - {{ date(recruiter.recruiter?.end_date) }}</h5>
                    </div>
                    <p class="mb-0 pb-0">{{ recruiter.recruiter?.designation }}</p>
                    <p class="mt-1">{{ recruiter.recruiter?.experience }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="d-flex align-items-center text-black-50 mb-1">Education</h2>
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="text-capitalize">{{ recruiter.recruiter?.university }}</h3>
                        <h5>{{ date(recruiter.recruiter?.uni_start_date) }} - {{ date(recruiter.recruiter?.uni_end_date) }}</h5>
                    </div>
                    <p class="mb-0 pb-0">{{ recruiter.recruiter?.education_level?.label }} / {{ recruiter.recruiter?.educaiton?.education_name }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="d-flex align-items-center text-black-50 mb-1">
                        Curriculum Vitae / Resume
                    </h2>
                    <div class="panel panel-default bootcards-file">
                        <div class="list-group">
                            <div class="list-group-item">
                                <a href="#">
                                    <vue-feather type="file-text"/>
                                </a>
                                <h4 class="list-group-item-heading">
                                    <a :href="resume" target="_blank">{{ recruiter.name+"CV-Resume.PDF" }}</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a :href="resume" target="_blank" class="btn btn-primary mt-1">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h2 class="d-flex align-items-center text-black-50 mb-1">
                        Skills
                    </h2>
                    <span class="badge bg-dark text-white" style="margin-right: 2px;" v-for="skill in skills">{{ skill.value }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="d-flex align-items-center text-black-50 mb-1">
                        Protfollue
                    </h2>
                    <a :href="recruiter.portfolio_url" target="_blank">{{ recruiter.portfolio_url }}</a>
                </div>
            </div>
        </div>
    </div>
    -->
</template>
<script setup>
import moment from 'moment'
    let props = defineProps({
        recruiter:Object,
        chat_jobs:'',
        t_jobs:'',
        save_jobs:'',
    });

let date = (date) =>{
    return moment(date).format('YYYY-MM-DD');
}
</script>



<style scoped>
</style>
