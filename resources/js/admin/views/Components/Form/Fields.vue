<template>
    <div class="form-group" v-if="field.type === 'text'">
        <label for="">{{ field.title }}</label>
        <input
            v-model="field.value"
            type="text"
            class="form-control"
            placeholder="введите поле"
        />
        <span v-show="field.er" class="error">{{ field.message }}</span>
    </div>
    <div class="form-group" v-else-if="field.type === 'textarea'">
        <label for="">{{ field.title }}</label>
        <textarea
            v-model="field.value"
            class="form-control"
            rows="3"
            placeholder="введите текст ..."
        ></textarea>
        <span v-show="field.er" class="error">{{ field.message }}</span>
    </div>
    <div class="form-group" v-else-if="field.type === 'select'">
        <label for="">{{ field.title }}</label>
        <select
            v-model="field.value"
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
        <span v-show="field.er" class="error">{{ field.message }}</span>
    </div>
    <div class="form-group" v-else-if="field.type === 'checkbox'">
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
        <span v-show="field.er" class="error">{{ field.message }}</span>
    </div>
    <div class="form-group" v-else-if="field.type === 'radio'">
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
    </div>
    <div class="form-group" v-else-if="field.type === 'file'">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" />
            <label class="custom-file-label" for="customFile"
            >Выберите файл</label
            >
        </div>
        <span v-show="field.er" class="error">{{ field.message }}</span>
    </div>
    <div v-else>--n/a type--</div>
</template>

<script>
export default {
    name: "AdminFields",
    data(){

    },
    props : ["field"]
}
</script>

<style scoped>

</style>
