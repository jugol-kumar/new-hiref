<template>

    <Head title="Category List" />
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Messages List</h2>
                </div>
            </div>
        </div>
    </div>
    <section class="app-user-list">
        <!-- list and filter start -->
        <div class="card">
            <div  v-if="messages.length > 0 || search != null"  class="card-datatable table-responsive pt-0" >
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
                </div>


                <table  class="user-list-table table">
                    <thead class="table-light">
                    <tr class="">
                        <th class="sorting">Recruiters</th>
                        <th class="sorting">Seekers</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="message in messages" :key="message.id">
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar  me-1">
                                        <img :src="message.recruter.photo"
                                             :alt="message.recruter.name" height="32" width="32">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="admin_name text-truncate text-body">
                                        <span class="fw-bolder">{{ message.recruter.name }}</span>
                                    </div>
                                    <small class="emp_post text-muted">{{ message.recruter.email }}</small>
                                    <small class="text-muted">{{ message.recruter.phone }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar  me-1">
                                        <img :src="message.seeker.photo"
                                             :alt="message.seeker.name" height="32" width="32">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="admin_name text-truncate text-body">
                                        <span class="fw-bolder">{{ message.seeker.name }}</span>
                                    </div>
                                    <small class="emp_post text-muted">{{message.seeker.email }}</small>
                                    <small class="text-muted">{{ message.seeker.phone }}</small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-body d-flex align-items-center justify-content-center" v-else>
                <img src="../../../images/No-data.gif" alt="">
            </div>
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
    messages: "",
});

</script>
