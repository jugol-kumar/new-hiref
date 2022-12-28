<template>

    <Head title="recruiter List" />
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">recruiter List</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <button class="dt-button add-new btn btn-primary" tabindex="0" type="button" data-bs-toggle="modal"
                        data-bs-target="#createNewrecruiter"><span>Add New recruiter</span></button>
            </div>
        </div>
    </div>
    <section class="app-user-list">
        <!-- list and filter start -->
        <div class="card">
            <div  v-if="recruiters.data.length > 0 || search != null"  class="card-datatable table-responsive pt-0" >
                <div class="d-flex justify-content-between align-items-center header-actions mx-0 row mt-75">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                        <div class="select-search-area">
                            <label>Show <select class="form-select" v-model="perPage">
                                <option :value="undefined">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                        <div
                            class="d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                            <div class="select-search-area">
                                <label>Search:<input v-model="search" type="search" class="form-control"
                                                     placeholder="Type here for search"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <table  class="user-list-table table">
                    <thead class="table-light">
                    <tr class="">
                        <th class="sorting">About</th>
                        <th class="sorting">Status</th>
                        <th class="sorting">Join Date</th>
                        <th class="sorting">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="recruiter in recruiters.data" :key="recruiter.id">
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar  me-1">
                                        <img :src="recruiter.photo"
                                             :alt="recruiter.name" height="32" width="32">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="admin_name text-truncate text-body">
                                        <span class="fw-bolder">{{ recruiter.name }}</span>
                                    </div>
                                    <small class="emp_post text-muted">{{recruiter.email }}</small>
                                    <small class="text-muted">{{ recruiter.phone }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="d-flex align-items-center">
                                    A/S:
                                    <div class="form-check form-check-success" v-if="recruiter.a_status">
                                        <input type="radio" :id="`customColorRadio ${recruiter.id}`" class="form-check-input" checked="">
                                        <label class="form-check-label" :for="`customColorRadio${recruiter.id}`">Active</label>
                                    </div>
                                    <div class="form-check form-check-danger" v-else>
                                        <input type="radio" :id="`customColorRadio ${recruiter.id}`" class="form-check-input" checked="">
                                        <label class="form-check-label" :for="`customColorRadio${recruiter.id}`">Inactive</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    V/S:
                                    <div class="form-check form-check-primary" v-if="recruiter.v_status">
                                        <input type="radio" :id="`customColorRadio ${recruiter.id}`" class="form-check-input" checked="">
                                        <label class="form-check-label" :for="`customColorRadio${recruiter.id}`">Verified</label>
                                    </div>
                                    <div class="form-check form-check-danger" v-else>
                                        <input type="radio" :id="`customColorRadio ${recruiter.id}`" class="form-check-input" checked="">
                                        <label class="form-check-label" :for="`customColorRadio${recruiter.id}`">Not-Verified</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ recruiter.created_at }}</td>
                        <td>
                            <div class="btn-group dropup dropdown-icon-wrapper">
                                <div type="button"
                                     class="dropdown-toggle dropdown-toggle-split waves-effect waves-float waves-light"
                                     data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-start">
                                    <a class="dropdown-item" :href="`${recruiter.show_rec}`" target="_blank">
                                        <Icon title="eye"/>
                                        <span class="ms-1">Show</span>
                                    </a>
                                    <span class="dropdown-item"
                                          @click="deleteItemModal(recruiter.delete_url)">
                                <Icon title="trash"/>
                               <span class="ms-1">Delete</span>
                            </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination :links="recruiters.links" :from="recruiters.from" :to="recruiters.to"
                            :total="recruiters.total" />
            </div>

            <div class="card-body d-flex align-items-center justify-content-center" v-else>
                <img src="../../../images/No-data.gif" alt="">
            </div>
        </div>
        <!-- list and filter end -->
    </section>

</template>

<script setup>
import Pagination from '@/components/Pagination';
import Modal from '@/components/Modal';
import Icon from '@/components/Icon';
import Text from '@/components/form/Text';
import Image from '@/components/form/Image';
import NotfoundSvg from "@/components/NotfoundSvg";
import axios from 'axios';
import { ref, watch, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3'
import debounce from "lodash/debounce";
import Swal from 'sweetalert2'

let props = defineProps({
    recruiters: [],
    filters: Object,
    url: String,
});


let deleteItemModal = (delete_url) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete(delete_url,{
                preserveState: true, replace: true, onSuccess: page => {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                },
                onError: errors => {
                    Swal.fire(
                        'Oops...',
                        'Something went wrong!',
                        'error'
                    )
                }
            })
        }
    })
};
let createForm = useForm({
    name: '',
    photo: null,
});

let createNewrecruiter = () => {
    createForm.post(props.url, {
        onSuccess: () => {
            document.getElementById('createNewrecruiter').$vb.modal.hide()
            createForm.reset()
            $sToast.fire({
                icon: 'success',
                text: 'recruiter Save Successfully done. 🙂'
            })
        }
    });
}

let showData = ref([])
let showItem = (slug) => {
    axios.get('recruiters/'+slug).then(res =>{
        showData.value = res.data;
        document.getElementById('showItem').$vb.modal.show()
    }).catch(err => {
        console.log(err)
    })
}


let search = ref(props.filters.search);
let perPage = ref(props.filters.perPage);

watch([search, perPage], debounce(function ([val, val2]) {
    Inertia.get(props.url, { search: val, perPage: val2 }, { preserveState: true, replace: true });
}, 300));

</script>
