<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    company: Object,
});
</script>

<template>
    <Head :title="company.name" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Details of the company: {{ company.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Name:</h3>
                                <p class="text-gray-600">{{ company.name }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">CUIT:</h3>
                                <p class="text-gray-600">{{ company.cuit || 'N/D' }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Create by:</h3>
                                <p class="text-gray-600">{{ company.created_by_user_id || 'N/D' }}</p>
                            </div>
                            </div>

                        <div class="mt-8 flex justify-between">
                            <Link :href="route('companies.index')" class="text-blue-500 hover:underline">
                                Return to list of the companies
                            </Link>
                            <Link :href="route('companies.edit', company.id)"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit the company
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>