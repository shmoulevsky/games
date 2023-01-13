<template>
    <label for="">{{ field.title }}</label>
    <select
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-select"
        id=""
    >
        <option
            v-for="option in field.options"
            :value="option.value"
            :key="option"
        >
            {{ option.text }}
        </option>
    </select>
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
</template>

<script>
export default {
    name: "SelectList",
    props: ['field', 'modelValue'],

}
</script>

<style scoped>

</style>
