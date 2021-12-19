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
            <div class="flex justify-between md:justify-between">
                    <button @click="openModal()"
                    class="btn bg-green-500">Create </button>
            <div class="form-control">
                <input type="text" v-model="params.search" placeholder="Search"
                class="block ml-auto rounded-md mb-4 dark:bg-dark-eval-1">
            </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-dark-eval-2 ">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">
                                            Agama
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">
                                            Tanggal Lahir
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-dark-eval-3">
                                    <tr v-for="profile in profiles.data" :key="profile.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img :src="showImage() + profile.image"
                                                        class="h-10 w-10 rounded-full" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ profile.nama }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ profile.jenis_kelamin }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ profile.agama }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-white">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ profile.tgl_lahir }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div v-if="profile.corrupter == null">
                                            <Link :href="route('addCase', { id: profile.id })" 
                                                class="btn bg-green-500 text-indigo-600 hover:text-indigo-900 dark:text-white">Tambah Kasus
                                            </Link>
                                            </div>
                                            <Link :href="route('profile.edit', { id: profile.id })"
                                                class="btn bg-yellow-500 text-indigo-600 hover:text-indigo-900 dark:text-white">Ubah
                                            </Link>
                                            <Link @click="destroy(profile.id)"
                                                class="btn bg-red-500 text-indigo-600 hover:text-indigo-900 dark:text-white">Hapus
                                            </Link>
                                            <!-- <Link href="#" class="text-indigo-600 hover:text-indigo-900">Edit</Link> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination class="mt-6" :links="profiles.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
            <div class="flex items-end  justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle max-w-screen-lg sm:w-full"
                    card>
                    <form>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-dark-eval-3 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="store()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                    v-show="!editMode" @click="save(form)">
                                    Save
                                </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                <button @click="closeModal()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancel
                                </button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import {Head,useForm, Link} from '@inertiajs/inertia-vue3'
    import Pagination from '@/Components/Pagination'
    import pickBy from 'lodash/pickBy'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Head,
            Pagination,
            Link,
        },
        props: {
            title: String,
            profiles: Object,
        },
        data() {
            return {
                isOpen: false,
                params: {
                    search: null,
                }
            }
        },
        setup() {
            const form = useForm({
                nama: '',
                image: null,
                tgl_lahir: '',
                agama: '',
                jenis_kelamin: '',
            });
            return {
                form
            };
        },
        watch: {
            params: {
                handler() {
                    this.$inertia.get(this.route('profile.index'), pickBy(this.params), {
                        replace: true,
                        preserveState: true
                    });
                },
                deep: true,
            },
        },
        methods: {
            destroy(id) {
            this.$inertia.delete(route("profile.destroy", id));
            console.log(id);
            },
            previewImage(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
                console.log(file);
            },
            showImage() {
                return "/storage/images/profile/";
            },
            openModal: function () {
                this.isOpen = true;
            },
            closeModal: function () {
                this.isOpen = false;
                this.reset();
                this.editMode = false;
            },
            reset: function () {
                this.form = {
                    nama: null,
                image: null,
                tgl_lahir: null,
                agama: null,
                jenis_kelamin: null,
                }
            },
            save: function (data) {
                if (this.$refs.profileImage) {
                    this.form.image = this.$refs.profileImage.files[0];
                }
                this.form.post(route("profile.store"));
                this.reset();
                this.closeModal();
                this.editMode = false;
                console.log(data);
            },
        },
    }

</script>
