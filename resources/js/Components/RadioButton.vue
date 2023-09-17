<template>
    <div>
        <label class="text-base font-semibold text-gray-900" v-text="label"></label>
        <p class="text-sm text-gray-500" v-text="hint"></p>
        <fieldset class="mt-4">
            <legend class="sr-only" v-text="label"></legend>
            <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                <div v-for="option in options" :key="option.id" class="flex items-center">
                    <input :id="option.id"
                           type="radio"
                           :value="option.id"
                           :checked="option.id === selectedOption"
                           v-model="selectedOption"
                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"/>
                    <label :for="option.id" class="ml-3 block text-sm font-medium leading-6 text-gray-900">{{ option.title }}</label>
                </div>
            </div>
        </fieldset>
    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
    modelValue: String,
    label: String,
    hint: String,
    options: {
        type: Array,
        required: true
    }
})
const emit = defineEmits(['update:modelValue'])
const selectedOption = computed({
    get() {
        return props.modelValue
    },
    // setter
    set(newValue) {
        emit('update:modelValue', newValue)
    }
})

</script>

<style scoped>

</style>
