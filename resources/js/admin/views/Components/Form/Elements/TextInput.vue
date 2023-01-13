<template>
    <div class="mb-3">
    <label for="">{{ field.title }}</label>
    <input
        :value="modelValue"
        type="text"
        class="form-control"
        :class="field.er ? 'is-invalid': ''"
        :placeholder="$t('Input value')"
        @input="$emit('update:modelValue', $event.target.value)"
    />
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
    </div>
</template>

<script>
export default {
    name: "TextInput",
    props: ['field', 'modelValue'],
}
</script>

<style scoped>

</style>
