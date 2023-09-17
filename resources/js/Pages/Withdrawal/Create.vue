<template>
    <Head title="All Transactions"/>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Withdrawals</h2>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-5 rounded-md flow-root">
                    <form @submit.prevent="submit">

                        <div>
                            <InputLabel for="userid" value="User ID"/>
                            <TextInput
                                id="userid"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.user_id"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.user_id"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="amount" value="Amount"/>
                            <TextInput
                                id="amount"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.amount"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.amount"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Add
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    users: Object,
})

const form = useForm({
    user_id: null,
    amount: null
})

function submit() {
    form.post(route('withdrawals.store'))
}
</script>

<style scoped>

</style>
