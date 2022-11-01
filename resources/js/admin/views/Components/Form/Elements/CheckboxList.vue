<template>
    <label for="">{{ field.title }}</label>
    <div
        v-for="option in field.options"
        class="form-check"
        :key="option"
    >
        <input
            class="form-check-input"
            type="checkbox"
            v-model="option.value"
            :value="option.value"
        />
        <label class="form-check-label">{{ option.text }}</label>
    </div>
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
</template>

<script>
export default {
    name: "CheckboxList",
    props: ['field'],

}
</script>

<style scoped>

</style>
