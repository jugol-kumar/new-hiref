<template>

    <Head title="eduLevel List" />
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Education Label List</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <button class="dt-button add-new btn btn-primary" tabindex="0" type="button" data-bs-toggle="modal"
                        data-bs-target="#createNeweduLevel"><span>Add New Education Label</span></button>
            </div>
        </div>
    </div>
    <section class="app-user-list">
        <!-- list and filter start -->
        <div class="card">
            <div  v-if="edu_lavels.data.length > 0 || search != null"  class="card-datatable table-responsive pt-0" >
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
                        <th class="sorting">Name</th>
                        <th class="sorting">Crated At</th>
                        <th class="sorting">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="eduLevel in edu_lavels.data" :key="eduLevel.id">
                        <td>{{ eduLevel.name }}</td>
                        <td>{{ eduLevel.created_at }}</td>
                        <td>
                            <div class="demo-inline-spacing">
                                <button @click="deleteItemModal(eduLevel.id)" type="button"
                                        class="btn btn-icon btn-icon rounded-circle waves-effect waves-float waves-light bg-light-danger">
                                    <Icon title="trash" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination :links="edu_lavels.links" :from="edu_lavels.from" :to="edu_lavels.to"
                            :total="edu_lavels.total" />
            </div>

            <div class="card-body d-flex align-items-center justify-content-center" v-else>
                <img src="../../../images/No-data.gif" alt="">
            </div>

            <!-- Modal to add new user starts-->
            <Modal id="createNeweduLevel" title="Create New eduLevel" v-vb-is:modal>
                <form @submit.prevent="createNeweduLevel">
                    <div class="modal-body">
                        <Text v-model="createForm.name" label="Edu Label" placeholder="Edu Level" />
                    </div>
                    <div class="modal-footer">
                        <button :disabled="createForm.processing" type="submit"
                                class="btn btn-primary waves-effect waves-float waves-light">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                    </div>
                </form>
            </Modal>
            <!-- Modal to add new user Ends-->
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
    edu_lavels: [],
    filters: Object,
    url: String,
});


let deleteItemModal = (id) => {
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
            Inertia.delete(props.url+"/" + id, {
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
});

let createNeweduLevel = () => {
    createForm.post(props.url, {
        onSuccess: () => {
            document.getElementById('createNeweduLevel').$vb.modal.hide()
            createForm.reset()
            $sToast.fire({
                icon: 'success',
                text: 'eduLevel Save Successfully done. 🙂'
            })
        }
    });
}


let search = ref(props.filters.search);
let perPage = ref(props.filters.perPage);

watch([search, perPage], debounce(function ([val, val2]) {
    Inertia.get(props.url, { search: val, perPage: val2 }, { preserveState: true, replace: true });
}, 300));

</script>
