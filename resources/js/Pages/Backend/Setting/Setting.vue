<template>
    <Head title="Dashboard" />
    <section class="app-dashboard">
        <div class="card">
            <div class="card-body border-bottom">
                <div class="card card-statistics">
                    <div class="card-header">
                        <vue-notification-list></vue-notification-list>
                        <h4 class="card-title">Settings</h4>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills me-3 border" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <Link class="nav-link active"
                                          id="v-pills-home-tab"
                                          data-bs-toggle="pill"
                                          data-bs-target="#v-pills-home"
                                          type="button" role="tab"
                                          aria-controls="v-pills-home"
                                          aria-selected="true">Frontend Setting</Link>

                                    <button class="nav-link" id="v-pills-profile-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile"
                                            type="button" role="tab"
                                            aria-controls="v-pills-profile"
                                            aria-selected="false">Profile</button>
                                    <button class="nav-link" id="v-pills-socials-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-socials"
                                            type="button" role="tab"
                                            aria-controls="v-pills-socials"
                                            aria-selected="false">Social Links</button>

                                    <button class="nav-link"
                                            id="v-pills-messages-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-messages"
                                            type="button" role="tab"
                                            aria-controls="v-pills-messages"
                                            aria-selected="false">Apprience</button>

                                    <button class="nav-link"
                                            id="v-pills-sms_api-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#v-pills-sms_api"
                                            type="button" role="tab"
                                            aria-controls="v-pills-sms_api"
                                            aria-selected="false">API Setup</button>
                                    <Link class="nav-link" :href="`${this.$page.props.ADMIN_URL}/admin-profile`">Profile Settings</Link>

                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="card">
                                            <h2>Frontend Setup</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <Text v-model="createForm.name" label="App Name" placeholder="App Name" />
                                                        </div>
                                                        <div class="col-12">
                                                            <Textarea v-model="createForm.app_details" label="App About" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Select Timezone</label>
                                                            <v-select
                                                                v-model="createForm.timezone"
                                                                dir="ltr"
                                                                label="tz"
                                                                :options="options"
                                                                placeholder="~~ Select Timezone ~~"/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Select Country</label>
                                                            <v-select
                                                                v-model="createForm.country"
                                                                dir="ltr"
                                                                label="name"
                                                                :options="countries"
                                                                placeholder="~~ Select Timezone ~~"/>
                                                        </div>


                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>


                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="card">
                                            <h2>App Profile</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.address" label="App Address" placeholder="App Address" />
                                                        </div>

                                                        <div class="col-12">
                                                            <Text type="email" v-model="createForm.email" label="App Email" placeholder="example@yourdomain.com" />
                                                        </div>

                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.phone" label="App Number" placeholder="+8801*-******" />
                                                        </div>

                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>


                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-socials" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <div class="card">
                                            <h2>App Profile</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.facebook_profile" label="Facebook" placeholder="fb.com/me" />
                                                        </div>

                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.google_drive" label="Google Drive" placeholder="drive.google.com/me" />
                                                        </div>

                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.youtube" label="Youtube" placeholder="chanel.youtube.com/my-changel" />
                                                        </div>


                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.linkedin_profile" label="Linkedin" placeholder="linkedin.com/me" />
                                                        </div>


                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.twitter_profile" label="Twitter" placeholder="twitter.com/me" />
                                                        </div>

                                                        <div class="col-12">
                                                            <Text type="text" v-model="createForm.instagram_profile" label="Instagram" placeholder="instagram.com/me" />
                                                        </div>


                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">

                                                            <!--                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">-->
                                                            <!--                                                                <div class="spinner-border text-white me-1"  role="status"></div>-->
                                                            <!--                                                                <span>Submit</span>-->
                                                            <!--                                                            </button>-->


                                                            <button class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="card">
                                            <h2>Frontend Setup</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateLogo()">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <Image v-model="logoForm.header_logo" :showFile="props.bSettings.header_logo" label="Header Logo"/>
                                                        </div>
                                                        <div class="col-12">
                                                            <Image v-model="logoForm.footer_logo" :showFile="props.bSettings.footer_logo" label="Footer Logo"/>
                                                        </div>
                                                        <div class="col-12">
                                                            <Image v-model="logoForm.fevicon_logo" :showFile="props.bSettings.fevicon_logo" label="Favicon"/>
                                                        </div>

<!--                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Text Color</label> <small class="text-info">(Must Be HEXA Color. like #fefefe)</small>
                                                                 <Text type="color" v-model="logoForm.textColor" class="form-control form-control-color"/>
                                                            </div>
                                                            <div class="col">
                                                                <label>Main Color</label> <small class="text-info">(This is rgb color code rgb(255,255,255))</small>
                                                                <Text type="color" v-model="logoForm.mainColor" class="form-control form-control-color"/>
                                                            </div>
                                                            <div class="col">
                                                                <label>Light Color</label> <small class="text-info">(This is rgb color code rgb(255,255,255))</small>
                                                                <Text type="color" v-model="logoForm.lightColor"  class="form-control form-control-color"/>
                                                            </div>
                                                        </div>-->

                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button v-else class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-sms_api" role="tabpanel" aria-labelledby="v-pills-sms_api-tab">
                                        <div class="card">
                                            <h2>SMS API Credentials</h2>
                                            <div class="card-body">
                                                <form class="form form-vertical" @submit.prevent="updateBuisnessSetting()">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <Text type="text" v-model="createForm.api_url" label="API URL" placeholder="http://66.45.237.70/api.php" />
                                                                </div>

                                                                <div class="col-12">
                                                                    <Text type="text" v-model="createForm.api_user_name" label="API User Name" placeholder="e.g user name" />
                                                                </div>

                                                                <div class="col-12">
                                                                    <Text type="text" v-model="createForm.api_user_pass" label="Api User Password" placeholder="e.g password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table class="table table-bordered table-striped">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Status</th>
                                                                        <th>Message</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1101</td>
                                                                        <td>Success</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1000</td>
                                                                        <td>Invalid user or Password</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1002</td>
                                                                        <td>Empty Number</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1003</td>
                                                                        <td>Invalid message or empty message</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1004</td>
                                                                        <td>Invalid number</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1005</td>
                                                                        <td>All Number is Invalid</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1006</td>
                                                                        <td>insufficient Balance</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1009</td>
                                                                        <td> Inactive Account</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1010</td>
                                                                        <td>Max number limit exceeded</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>


                                                        <div class="col-12 mt-2 d-inline-flex align-item-center">
                                                            <button v-if="!isLoding" type="submit" disabled class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                <div class="spinner-border text-white me-1"  role="status"></div>
                                                                <span>Submit</span>
                                                            </button>
                                                            <button class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                                Submit
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
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
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import Text from '@/components/form/Text';
import Image from '@/components/form/Image';
import Textarea from '@/components/form/Textarea';
import TextEditor from '@/components/TextEditor';
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import {ref} from "vue"
import timezons from "../../../Store/timezone";

const APP_URL = usePage().props.value.ADMIN_URL;

let props = defineProps({
    option:[],
    countries:"",
    errors:"",
    bSettings:""
})

let countries = props.countries;
let options = timezons.timesones;
// let createForm = useForm({
//     name        :  '',
//     header_logo :  '',
//     footer_logo :  '',
//     app_details :  '',
//     timezone    :  '',
//     country     :  '',
// })

let createForm = useForm({
    name        : props.bSettings.name ?? '',
    header_logo : '',
    footer_logo : '',
    app_details : props.bSettings.details ?? '',
    timezone    : props.bSettings.timezone?.tz ?? '',
    country     : props.bSettings.country?.name ?? '',

    address     : props.bSettings.address ?? '',
    email       : props.bSettings.email ?? '',
    phone       : props.bSettings.phone ?? '',

    facebook_profile  : props.bSettings.facebook_profile ?? '',
    youtube           : props.bSettings.youtube ?? '',
    google_drive      : props.bSettings.google_drive ?? '',
    linkedin_profile  : props.bSettings.linkedin_profile ?? '',
    twitter_profile   : props.bSettings.twitter_profile ?? '',
    instagram_profile : props.bSettings.instagram_profile ?? '',

    api_url           : props.bSettings.api_url ?? '',
    api_user_name     : props.bSettings.api_user_name ?? '',
    api_user_pass     : props.bSettings.api_user_pass ?? ''
})

let logoForm = useForm({
    header_logo     :   '',
    footer_logo     :   '',
    fevicon_logo    :   '',
    lightColor      : null,
    mainColor       : null,
    textColor       : null

})


let isLoding = ref({});

let updateBuisnessSetting = () =>{
    // isLoding.value = false
    createForm.post(APP_URL+"/settings", {
        onSuccess: (res)=>{
            // isLoding.value = true
            $sToast.fire({
               icon: "success",
               text: "Business Settings Update Successfully Done.:)",
            });
        },
        onError: (res) =>{
            $sToast.fire({
                icon: "error",
                text: "Business Settings Not Update (:",
            });
        }
    });
}
let updateLogo = () =>{
    isLoding.value = false
    logoForm.post(APP_URL+"/settings/update-logo", {
        onSuccess: (res)=>{
            isLoding.value = true
            $sToast.fire({
               icon: "success",
               text: "Business Settings Update Successfully Done.:)",
            });
        },
        onError: (res) =>{
            $sToast.fire({
                icon: "error",
                text: "Business Settings Not Update (:",
            });
        }
    });
}


</script>

<style scoped>
.spinner-border{
    --bs-spinner-width: 1.2rem !important;
    --bs-spinner-height: 1.2rem !important;
}
</style>
