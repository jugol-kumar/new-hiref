<template>

    <Head title="Create Question" />
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Create Job</h2>
                </div>
            </div>
        </div>
    </div>
    <section class="question-create-form">
        <form class="row pt-75" @submit.prevent="newItem">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Job Basic Details</h2>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <Text v-model="createForm.title" label="Job Title" placeholder="Enter job title" :error="props.errors.title"/>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label>Job Type</label>
                                <v-select
                                    class="form-control"
                                    v-model="createForm.types"
                                    label="type"
                                    :options="allTypes"
                                    :reduce="type => type.type"
                                    placeholder="~~Select Job Type~~"></v-select>
                                <span class="error text-danger" v-if="props.errors.types">{{ props.errors.types }}</span>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label>Label</label>
                                <v-select
                                    class="form-control"
                                    v-model="createForm.label"
                                    label="label"
                                    :options="allLabels"
                                    :reduce="label => label.label"
                                    placeholder="~~Select Label~~"></v-select>
                                <span class="error text-danger" v-if="props.errors.label">{{ props.errors.label }}</span>
                            </div>
                            <div class="row pe-0">
                                <div class="col pe-0">
                                    <div class="mb-1">
                                        <label class="form-label">Select a Category</label>
                                        <v-select v-model="createForm.category_id"
                                                  @update:modelValue="categorySelected"
                                                  label="name"
                                                  class="form-control"
                                                  :options="categories"
                                                  placeholder="~~Select Category~~"
                                                  :reduce="category => category.id">
                                        </v-select>
                                        <span class="error text-danger" v-if="props.errors.category_id">{{ props.errors.category_id }}</span>

                                    </div>
                                </div>
                                <div class="col" v-if="sub_categories.length > 0">
                                    <div class="mb-1">
                                        <label class="form-label">Select a Sub Category</label>
                                        <v-select v-model="createForm.sub_category_id"
                                                  @update:modelValue="subCategorySelected"
                                                  label="name"
                                                  class="form-control"
                                                  :options="sub_categories"
                                                  placeholder="~~Select Sub Category~~"
                                                  :reduce="category => category.id"></v-select>
                                    </div>
                                </div>
                                <div class="col" v-if="child_categories.length > 0">
                                    <div class="mb-1">
                                        <label class="form-label">Select a Child Category</label>
                                        <v-select v-model="createForm.child_category_id"
                                                  label="name"
                                                  class="form-control"
                                                  placeholder="Select Child Category"
                                                  :options="child_categories"
                                                  :reduce="category => category.id"></v-select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Hash Tag</label>
                                <v-select
                                    class="form-control"
                                    multiple
                                    taggable
                                    v-model="createForm.tags"
                                    label="key"
                                    :options="allHasTags"
                                    :reduce="tag => tag.key"
                                    placeholder="~~Select Or Input New Hash Tags~~"></v-select>
                                <span class="error text-danger" v-if="props.errors.tags">{{ props.errors.tags }}</span>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-1">
                                    <label class="form-label">Required Skills</label>
                                    <v-select
                                        class="form-control"
                                        multiple
                                        taggable
                                        v-model="createForm.skills"
                                        label="key"
                                        :options="allSkills"
                                        :reduce="skill => skill.key"
                                        placeholder="~~ Select Or Input New Skills ~~"></v-select>
                                    <span class="error text-danger" v-if="props.errors.skills">{{ props.errors.skills }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Job Compensation</h2>
                        <div class="row">
                            <div class="col mb-2">
                                <label>Select Currency</label>
                                <v-select
                                    v-model="createForm.currency"
                                    :options="countries"
                                    placeholder="Search Country Name"
                                    :reduce="country => country.id"
                                    class="form-control"
                                    label="currency_name">
                                    <template v-slot:option="option">
                                        {{ option.currency }} / {{ option.currency_symbol }}
                                    </template>
                                </v-select>
                                <span class="error text-danger" v-if="props.errors.currency">{{ props.errors.currency }}</span>
                            </div>
                            <div class="row pe-0">
                                <div class="col pe-0">
                                    <Text type="number" v-model="createForm.min_salary" label="Min Salary" placeholder="Minimum salary"/>
                                </div>
                                <div class="col pe-0">
                                    <Text type="number" v-model="createForm.max_salary" label="Max Salary" placeholder="Maximum salary"/>
                                </div>
                            </div>

                            <div class="col-12">
                                <label>Experience</label>
                                <fieldset>
                                    <div class="input-group">
                                        <input type="number" class="form-control" v-model="createForm.min_experience" placeholder="Minimum Work Exprience" aria-label="Amount">
                                        <input type="number" class="form-control" v-model="createForm.max_experience" placeholder="Maximum Work Exprience" aria-label="Amount">
                                        <select class="form-control" v-model="createForm.experience_type" placeholder="Chose Exprience Type">
                                            <option selected value="" disabled>~~ Chose Experience Type ~~</option>
                                            <option value="year">Year</option>
                                            <option value="month">Month</option>
                                            <option value="days">Days</option>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Company Details</h2>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label>Company</label>
                                <v-select
                                    v-model="createForm.company"
                                    :options="props.companies"
                                    placeholder="Search Country Name"
                                    :reduce="company => company.id"
                                    class="form-control"
                                    label="name">
                                    <template v-slot:option="option">
                                        <li class="list-group-item d-flex align-items-start px-0">
                                            <div class="avatar me-75">
                                                <img :src="`${this.$page.props.MAIN_URL}/storage/${option.photos[0].filename}`" alt="" width="38" height="38">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <div class="me-1 d-flex flex-column">
                                                    <strong class="mb-25">{{ option.name }}</strong>
                                                    <span >pe@vogeiz.net</span>
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                </v-select>
                                <span class="error text-danger" v-if="props.errors.company">{{ props.errors.company }}</span>

                            </div>

                            <div class="col-12 col-md-6">
                                <label>Recruiter / Creator</label>
                                <v-select
                                    v-model="createForm.creator"
                                    :options="props.companies"
                                    placeholder="Search Creator"
                                    :reduce="company => company.id"
                                    class="form-control"
                                    label="name">
                                    <template v-slot:option="option">
                                        <li class="list-group-item d-flex align-items-start px-0">
                                            <div class="avatar me-75">
                                                <img :src="`${this.$page.props.MAIN_URL}/storage/${option.photos[0].filename}`" alt="" width="38" height="38">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <div class="me-1 d-flex flex-column">
                                                    <strong class="mb-25">{{ option.name }}</strong>
                                                    <span >pe@vogeiz.net</span>
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                </v-select>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                                <label>Application Declined Date</label>
                                <Datepicker v-model="createForm.declined_date" class="form-control" placeholder="Select Declined Date"/>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                                <Text type="url" v-model="createForm.web_address" label="Application target" placeholder="https://www.example.com.bd"/>
                            </div>
                            <div class="col-12 col-md-12">
                                <Textarea label="Full address" v-model="createForm.location" placeholder="The Imperial Irish Kingdom, Mo-03 (3rd Floor), Merul Badda, Dhaka 121"/>
                            </div>
                            <div class="col-12 col-md-3">
                                <Switch v-model="createForm.is_remote" label="Is Remote"/>
                            </div>
                            <div class="col-12 col-md-3">
                                <Switch  v-model="createForm.fultime_remote"  label="Is Full-time Remote"/>
                            </div>
                            <div class="col-12 col-md-3">
                                <Switch v-model="createForm.is_published" label="Publication Status"/>
                            </div>
                            <div class="col-12 col-md-3">
                                <Switch  v-model="createForm.is_featured"  label="Featured Status"/>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Company Details</h2>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <label>Job Descriptions</label>
                                <TextEditor v-model="createForm.job_details"/>
                            </div>
                        </div>
                    </div>
                </div>



                <button v-if="isShow" class="btn btn-outline-primary me-1" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="ms-25 align-middle">Loading...</span>
                </button>
                <button type="submit" v-else class="btn btn-primary me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Discard
                </button>
            </div>
        </form>

    </section>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import axios from 'axios';
import Icon from '@/components/Icon';
import Text from '@/components/form/Text';
import Image from '@/components/form/Image';
import Textarea from '@/components/form/Textarea';
import TextEditor from '@/components/TextEditor';
import Radio from '@/components/form/Radio.vue';
import Video from '@/components/form/Video';
import BusinessCard from '@/components/modules/BusinessCard';
import Datepicker from 'vue3-datepicker'
import types from '@/Store/timezone.js'
import Switch from "../../../components/form/Switch2";
import InputTag from "../../../components/form/InputTag";

let allTypes = types.types;
let allLabels = types.labels;
let allHasTags = [{'key':'Laravel'},{'key':'Vue js'}, {'key':'Javascript'}, {'key':'Html'}, {'key':'Css'}];
let allSkills = [{'key':'Laravel'},{'key':'Vue js'}, {'key':'Javascript'}, {'key':'Html'}, {'key':'Css'}];

let props = defineProps({
    categories: Object,
    url: String,
    subbycat_url: String,
    childbysubcat_url: String,
    create_url:String,
    countries:[],
    companies:Object,
    errors:Object
});


let createForm = useForm({
    title:'',
    types:'',
    label:'',
    category_id: '',
    sub_category_id: '',
    child_category_id: '',
    tags:[],
    skills:[],
    currency:19,
    min_salary:'',
    max_salary:'',
    min_experience:'',
    max_experience:'',
    experience_type: '',
    company:'',
    creator:'',
    declined_date:'',
    web_address:'',
    location:'',
    is_remote:false,
    fultime_remote:false,
    is_published:false,
    is_featured:false,
    job_details:'',
});

const sub_categories = ref([])
const child_categories = ref([])
const isShow = ref(false);

let categorySelected = (e) => {
    axios.post(props.subbycat_url, { category: e })
        .then(res => {
            sub_categories.value = res.data
            createForm.sub_category_id = null
            createForm.child_category_id = null
        })
        .catch(error => {
            console.log(error)
        });
}
let subCategorySelected = (e) => {
    axios.post(props.childbysubcat_url, { subcategory: e })
        .then(res => {
            child_categories.value = res.data
            createForm.child_category_id = null
        })
        .catch(error => {
            console.log(error)
        });
}


let newItem = () =>{
    createForm.post(props.create_url, {
        onStart:()=>{
            isShow.value = true;
        },
        onSuccess: () =>{
            isShow.value = false;
            createForm.reset();
            $sToast.fire({
                icon: 'success',
                text: 'Job Created Successfully Done.... 🙂'
            });
        },
        onError: () =>{
            $sToast.fire({
                icon: 'error',
                text: 'Have An Error. Try Again Later...... 🙂'
            })
        }
    });
}

</script>

<style scopt>
.vs__dropdown-toggle{
    border:none !important;
    /*--vs-selected-color: #eeeeee;*/
    /*--vs-dropdown-option--active-color: #eeeeee;*/

}
.vs--single .vs__selected{
    --vs-dropdown-option--active-color: #000;
}
.vs--multiple .vs__selected{
    color: #fff;
}
.vs__deselect{
    fill: #fff !important;
}

</style>
