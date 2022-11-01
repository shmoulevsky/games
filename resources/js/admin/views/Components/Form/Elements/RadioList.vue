<template>
    <label for="">{{ field.title }}</label>
    <div
        v-for="option in field.options"
        class="form-check"
        :key="option"
    >
        <input
            :name="key + '[]'"
            class="form-check-input"
            type="radio"
            :value="option.value"
            v-model="field.value"
        />
        <label class="form-check-label">{{ option.text }}</label>
    </div>
    <span v-show="field.er" class="error">{{ field.message }}</span>
</template>

<script>
export default {
    name: "RadioList",
    props: ['field'],

}
</script>

<style scoped>

</style>
