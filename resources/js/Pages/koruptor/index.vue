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
                                            Kasus
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">
                                            Partai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">
                                            Tanggal Kasus
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">
                                            Hukuman
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-dark-eval-3">
                                    <tr v-for="korupter in korupters.data" :key="korupter.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="avatar">
                                                    <div class="w-24 h-24">
                                                    <img :src="showImage() + korupter.profile.image"/>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ korupter.profile.nama }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ korupter.profile.jenis_kelamin }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ korupter.kasus }}</div>
                                            <div class="text-sm text-gray-900 dark:text-white">{{ korupter.uang }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-white">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ korupter.jabatan }}</div>
                                            <div class="text-sm text-gray-900 dark:text-white">{{ korupter.partai }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-white">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ korupter.case_date }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-white">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ korupter.hukuman }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link :href="route('koruptor.edit', { id: korupter.id })" 
                                                class="btn bg-green-500 text-indigo-600 hover:text-indigo-900 dark:text-white">Ubah
                                            </Link>
                                            <Link @click="destroy(koruptor.id)"
                                                class="btn bg-red-500 text-indigo-600 hover:text-indigo-900 dark:text-white">Hapus
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination class="mt-6" :links="korupters.links" />

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import {Head, Link} from '@inertiajs/inertia-vue3'
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
            korupters: Object,
        },
        methods: {
             destroy(id) {
            this.$inertia.delete(route("korupter.destroy", id));
            console.log(id);
            },
           
            showImage() {
                return "/storage/images/profile/";
            },
        }
    }

</script>
