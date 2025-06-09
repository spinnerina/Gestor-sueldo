<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CompanyForm from './partials/CompanyForm.vue';


const props = defineProps({
    errors: Object,
});

const handleFormSubmitted = (form) => {
    form.post(route('companies.store'), {
        preserveScroll: true,
        onSuccess: () => {
            alert('Company created successfully');
            form.reset();
        },
        onError: (errors) => {
            alert('Faild to create a new company');
        }
    });
};
</script>


<template>
    <Head title="Create company" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <CompanyForm @formSubmitted="handleFormSubmitted" :errors="props.errors" />
                        <div class="mt-4">
                            <Link :href="route('companies.index')" class="text-blue-500 hover:underline">
                                Return to list of the companies
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>