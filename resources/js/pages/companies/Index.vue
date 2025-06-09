<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    companies: {
        type: Array,
        required: true
    }
});

const companies = ref(props.companies);
const form = useForm({});
//Function to delete a company
const deleteCompany = (companyId) => {
    if( confirm('Are you sure you want to delete this company?')) {
        form.delete(route('companies.destroy', companyId), {
            preserveScroll: true,
            onSuccess: () => {
                alert('Company deleted successfully');
                companies.value = companies.value.filter(company => company.id !== companyId);
            },
            onError: () => {
                alert('Error deleting company');
            }
        });
    }
}
</script>

<template>
    <Head title="Companies"></Head>

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-end mb-4">
                            <Link :href="route('companies.create')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create new company
                            </Link>
                        </div>

                        <div v-if="companies.length > 0" class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Cuit
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created by
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="company in companies" :key="company.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ company.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ company.cuit || '-' }}
                                        </td>
                                        <td v-if="company.user" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ company.user.name + ' ' + company.user.last_name  || '-' }}
                                        </td>
                                        <td v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Admin
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link :href="route('companies.show', company.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</Link>
                                            <Link :href="route('companies.edit', company.id)" class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</Link>
                                            <button @click="deleteCompany(company.id)"
                                                class="text-red-600 hover:text-red-900 focus:outline-none">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="text-center text-gray-600">
                            Companies not found <Link :href="route('companies.create')" class="text-blue-500 hover:underline">Create a new company</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>