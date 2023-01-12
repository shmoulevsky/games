<template>
    <label for="">{{ field.title }}</label>
    <textarea
        class="form-control"
        :class="field.er ? 'is-invalid': ''"
        rows="3"
        :placeholder="$t('Input value')"
        @input="$emit('update:modelValue', $event.target.value)"
    >{{modelValue}}</textarea>
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
</template>

<script>
export default {
    name: "TextArea",
    props: ['field', 'modelValue'],

}
</script>

<style scoped>

</style>
