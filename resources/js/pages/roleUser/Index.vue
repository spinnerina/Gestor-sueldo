<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    roleUser: {
        type: Array,
        required: true
    }
});

const roleUser = ref(props.roleUser);
const form = useForm({});

const deleteRoleUser = (user_id, role_id) => {
    if( confirm('Are you sure you want to delete this role user?')) {
        form.delete(route('roleUser.destroy', { user_id, role_id }), {
            preserveScroll: true,
            onSuccess: () => {
                alert('Role user deleted successfully');
                roleUser.value = roleUser.value.filter(role => role.user.id !== user_id && role.role.id !== role_id);
            },
            onError: () => {
                alert('Error deleting role user');
            }
        });
    };
}
</script>

<template>
    <Head title="Role User"></Head>

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Role User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-end mb-4">
                            <!-- <Link :href="route('roleUser.create')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create new role user
                            </Link> -->
                        </div>

                        <div v-if="roleUser.length > 0" class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="role in roleUser" :key="role.id">
                                        <template v-if="role.user && role.role">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ role.user.name + ' ' + role.user.last_name  }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ role.user.email || '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ role.role.name || '-' }}
                                            </td>
                                        </template>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <!-- <Link :href="route('companies.show', company.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver</Link>
                                            <Link :href="route('companies.edit', company.id)" class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</Link> -->
                                            <button @click="deleteRoleUser(role.user.id, role.role.id)"
                                                class="text-red-600 hover:text-red-900 focus:outline-none">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>