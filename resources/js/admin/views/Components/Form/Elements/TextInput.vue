<template>
    <label for="">{{ field.title }}</label>
    <input
        v-model="field.value"
        type="text"
        class="form-control"
        :class="field.er ? 'is-invalid': ''"
        :placeholder="$t('Input value')"
    />
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
</template>

<script>
export default {
    name: "TextInput",
    props: ['field'],

}
</script>

<style scoped>

</style>
