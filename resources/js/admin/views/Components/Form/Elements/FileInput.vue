<template>
    <div class="row">
        <div class="col-9">
            <input
                :value="this.image"
                type="text"
                class="form-control"
                :id="'ThumbFormControlInput'"
                @input="$emit('update:modelValue', $event.target.value)"
            >
        </div>
        <div class="col-3">
            <button type="button"
                    data-input="ThumbFormControlInput"
                    id="addFile_btn"
                    @click="showManager"
                    class="btn btn-primary">
                {{ $t('Add file') }}
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <img :src="this.image" :style="style" />
        </div>
    </div>
</template>

<script>
import $ from "jquery";

export default {
    name: "FileInput",
    props: ['modelValue', 'width'],
    computed: {
        image: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        },
        style(){
            return `max-width:${this.width}px;`
        }
    },
    methods: {
        showManager: function () {
            $('#addFile_btn').filemanager('image', {prefix: "/api/laravel-filemanager"});
            $('#ThumbFormControlInput').on('change', () => {
                this.image = $('#ThumbFormControlInput').val();
            })
        }
    },
    mounted() {
        window.$ = window.jQuery = require('jquery');
        let newScript = document.createElement('script');
        newScript.src = '/vendor/laravel-filemanager/js/stand-alone-button.js';
        document.head.appendChild(newScript);
    },
}
</script>

<style scoped>

</style>
