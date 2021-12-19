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
                                        <input type="text" v-model="form.nama" placeholder="Nama" class="input bg-white dark:text-black">
                                    </div>
                                     <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Tanggal Lahir</span>
                                        </label> 
                                        <input type="date" v-model="form.tgl_lahir" placeholder="tanggal" class="input bg-white dark:text-black">
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Profil</span>
                                        </label>
                                        <div class="avatar">
                                            <div class="mb-4 rounded-btn w-24 h-24">
                                            <img :src="showImage() + profile.image"/>
                                            </div>
                                        </div>
                                         <input type="file" @change="previewImage" ref="profileImage"/>
                                         <div class="avatar">
                                             <div class="rounded-btn w-24 h-24">
                                                 <img v-if="url" :src="url" />
                                             </div>
                                         </div>
                                    </div><br>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Agama</span>
                                        </label>
                                        <select class="select select-bordered w-full max-w-xs text-black dark:text-white" v-model="form.agama">
                                            <option disabled="disabled" selected="selected">Agama</option> 
                                            <option value="Islam">Islam</option> 
                                            <option value="Kristen">Kristen</option> 
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                        </select>
                                         <!-- <Multiselect v-model="form.agama" :options="Elements" class="dark:text-black"/> -->
                                    </div><br>
                                    <div class="form-control">
                                        <label class="label">
                                        <span class="label-text text-black dark:text-white">Jenis Kelamin</span>
                                        </label>
                                         <select class="select select-bordered w-full max-w-xs" v-model="form.jenis_kelamin">
                                            <option disabled="disabled" selected="selected">Jenis Kelamin</option> 
                                            <option value="Laki-laki">Laki-Laki</option> 
                                            <option value="Perempuan">Perempuan</option> 
                                        </select>
                                         <!-- <Multiselect v-model="form.jenis_kelamin" :options="Rarity" class="dark:text-black"/> -->
                                    </div><br>
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
            profile: Object,
        },
        setup(props) {
            const form = useForm({
                _method: 'put',
                nama: props.profile.nama,
                image: props.profile.image,
                tgl_lahir: props.profile.tgl_lahir,
                agama: props.profile.agama,
                jenis_kelamin: props.profile.jenis_kelamin,
            });
            return {
                form
            };
        },
        methods: {
            update(){
                 if (this.$refs.profileImage) {
                    this.form.image = this.$refs.profileImage.files[0];
                }
                this.$inertia.post(route("profile.update", this.profile.id), this.form);
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
