<template>

    <Head>
        <title>{{title}}</title>
    </Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{title}}
                </h2>


            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex   justify-center min-h-screen pt-4 px-4 pb-20 text-center ">
                <div class="transform transition-all sm:align-middle max-w-screen-lg sm:w-full"
                    card>
                    <form @submit.prevent="update">
                        <div class="bg-white  dark:bg-dark-eval-3 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                <div class="mb-4">
                                   <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Nama</span>
                                        </label>
                                         <select class="select select-bordered w-full max-w-xs" v-model="form.profile_id">
                                            <option selected="selected" :value="form.profile_id"> {{corrupter.profile.nama}} </option> 
                                        </select>
                                    </div>
                                     <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Tanggal Kasus</span>
                                        </label> 
                                        <input type="date" v-model="form.case_date" placeholder="tanggal" class="input bg-white dark:text-black">
                                    </div>
                                     <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Jabatan</span>
                                        </label> 
                                        <input type="text" v-model="form.jabatan" placeholder="Jabatan" class="input bg-white dark:text-black" >
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Partai</span>
                                        </label> 
                                        <input type="text" v-model="form.partai" placeholder="partai" class="input bg-white dark:text-black" >
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Kasus</span>
                                        </label> 
                                        <input type="text" v-model="form.kasus" placeholder="kasus" class="input bg-white dark:text-black" >
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">uang</span>
                                        </label> 
                                        <input type="number" v-model="form.uang" placeholder="uang" class="input bg-white dark:text-black" >
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Hukuman</span>
                                        </label> 
                                        <input type="text" v-model="form.hukuman" placeholder="hukuman" class="input bg-white dark:text-black" >
                                    </div>
                                    <button class="shadow bg-green-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
            
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import {Head,useForm, Link} from '@inertiajs/inertia-vue3'
    import Pagination from '@/Components/Pagination'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Head,
            Pagination,
            Link,
        },
        props: {
            title: String,
            corrupter: Object,
        },
        setup(props) {
            const form = useForm({
                _method: 'put',
                profile_id: props.corrupter.profile_id,
                case_date: props.corrupter.case_date,
                jabatan: props.corrupter.jabatan,
                partai: props.corrupter.partai,
                kasus: props.corrupter.kasus,
                uang: props.corrupter.uang,
                hukuman: props.corrupter.hukuman,
            });
            return {
                form
            };
        },
        methods: {
            update(){
                this.$inertia.post(route("koruptor.update", this.corrupter.id), this.form);
            },
            previewImage(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
                console.log(file);
            },
            showImage() {
                return "/storage/images/profile/";
            },
        },
    }

</script>



 