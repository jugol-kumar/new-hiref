<template>

    <Head title="Create Blog" />
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Blog Create Form</h2>
                </div>
            </div>
        </div>
    </div>
    <section class="Blog-create-form">
        <div class="card">
            <div class="card-body">
                <form class="form form-vertical" @submit.prevent="createNewBlog">
                    <div class="row">
                        <div class="col-12">
                            <Text v-model="createForm.title" :error="props.errors.title" label="Blog Title" placeholder="Blog title" />
                        </div>
                        <div class="col-12 col-md-6">
                            <Image v-model="createForm.cover" :error="props.errors.cover" label="Cover Pic"/>
                        </div>

                        <div class="col-12 col-md-6">
                            <label>Category</label>
                            <v-select
                                v-model="createForm.category_id"
                                :options="props.categories"
                                placeholder="Search Category"
                                :reduce="category => category.id"
                                class="form-control"
                                style="padding: 3px"
                                label="name">
                            </v-select>
                            <span class="error text-danger" v-if="props.errors.category_id">{{ props.errors.category_id }}</span>
                        </div>

                        <div class="col-12">
                            <Textarea v-model="createForm.description" :error="props.errors.description" label="Blog Short Description- max(300)" />
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Blog content</label>
                                <TextEditor v-model="createForm.content" />
                                <span class="error text-danger" v-if="props.errors.content">{{ props.errors.content }}</span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-2">
                            <label class="form-label">Hash Tag</label>
                            <v-select
                                class="form-control"
                                multiple
                                taggable
                                v-model="createForm.tags"
                                :options="props.tags"
                                :reduce="tag => tag.name"
                                label="name"
                                style="padding: 3px"
                                placeholder="~~Select Or Input New Hash Tags~~"></v-select>
                            <span class="error text-danger" v-if="props.errors.tags">{{ props.errors.tags }}</span>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <Switch2 v-model="createForm.p_status" label="Publication Status"/>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <Switch2 v-model="createForm.s_status" label="Featured Status"/>
                        </div>

                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import Text from '@/components/form/Text';
import Image from '@/components/form/Image';
import Textarea from '@/components/form/Textarea';
import TextEditor from '@/components/TextEditor';
import { computed } from 'vue';
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import Datepicker from 'vue3-datepicker'
import Radio from '@/components/form/Radio.vue';
import Video from '@/components/form/Video';
import Switch from "@/components/form/Switch";
import Switch2 from "@/components/form/Switch2";

let props = defineProps({
    categories: Object,
    tags:Object,
    url: String,
    //   can: Object,
    errors:Object,
})

let createForm = useForm({
    title: '',
    category_id: '',
    cover: '',
    description: '',
    content: null,
    p_status:false,
    s_status:false,
    tags:[],
})

let createNewBlog = () => {
    createForm.post(props.url, {
        onSuccess: () => {
            createForm.reset()
            alert("created");
        }
    })
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
    color: #000;
}
.vs__deselect{
    fill: #000 !important;
}

</style>
