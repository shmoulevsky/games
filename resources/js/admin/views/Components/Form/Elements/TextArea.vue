<template>
    <label for="">{{ field.title }}</label>
    <textarea
        v-model="field.value"
        class="form-control"
        :class="field.er ? 'is-invalid': ''"
        rows="3"
        :placeholder="$t('Input value')"
    ></textarea>
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
</template>

<script>
export default {
    name: "TextArea",
    props: ['field'],

}
</script>

<style scoped>

</style>
