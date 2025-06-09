<script setup>
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
    company: {
        type: Object,
        default: () => ({
            name: '',
            cuit: '',
            created_by_user_id: null,
        }),
    },
    isEdit: {
        type: Boolean,
        default: false,
    },
    errors: {
        type: Object,
        default: () => ({})
    },
});
// Init form
const form = useForm({
    name: props.company.name,
    cuit: props.company.cuit,
    created_by_user_id: props.company.created_by_user_id,
});

watch(() => props.company, (newCompany) =>{
    form.name;
    form.cuit;
    form.created_by_user_id;
}, { deep: true });

const emit = defineEmits(['formSubmitted']);

const submitForm = () => {
    emit('formSubmitted', form);
}
</script>

<template>
    <form @submit.prevent="submitForm">
        <div class="mb-4">
            <InputLabel for="name" value="Company name" />
            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />
            <InputError class="mt-2" :message="form.errors.name || props.errors.name" />
        </div>

        <div class="mb-4">
            <InputLabel for="cuit" value="CUIT" />
            <TextInput
                id="cuit"
                type="text"
                class="mt-1 block w-full"
                v-model="form.cuit"
                autocomplete="cuit"
            />
            <InputError class="mt-2" :message="form.errors.cuit || props.errors.cuit" />
        </div>

        <div class="mb-4" v-if="!isEdit">
            <InputLabel for="created_by_user_id" value="Created by" />
            <TextInput
                id="created_by_user_id"
                type="number"
                class="mt-1 block w-full"
                v-model="form.created_by_user_id"
                autocomplete="created_by_user_id"
            />
            <InputError class="mt-2" :message="form.errors.created_by_user_id || props.errors.created_by_user_id" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ isEdit ? 'Update company' : 'Create company' }}
            </PrimaryButton>
        </div>
    </form>
</template>