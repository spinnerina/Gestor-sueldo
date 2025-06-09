<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CompanyForm from './partials/CompanyForm.vue';

const props = defineProps({
    company: Object,
    errors: Object,
});

const handleFormSubmitted = (form) => {
    form.put(route('companies.update', props.company.id), {
        preserveScroll: true,
        onSuccess: () => {
            alert('Company updated succesfull');
        },
        onError: (errors) => {
            alert('Error to update the company');
        }
    });
};
</script>

<template>
    <Head :title="`Edit ${props.company.name}`"/>

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit company: {{ props.company.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <CompanyForm
                            :company="props.company"
                            :isEdit="true"
                            @formSubmitted="handleFormSubmitted"
                            :errors="props.errors"
                        />

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