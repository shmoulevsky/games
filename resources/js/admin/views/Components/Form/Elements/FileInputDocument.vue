<template>
    <div class="row">
        <div class="col-9">
            <input
                :value="this.doc"
                type="text"
                class="form-control"
                :id="'ThumbFormControlInput2'"
                @input="$emit('update:modelValue', $event.target.value)"
            >
        </div>
        <div class="col-3">
            <button type="button"
                    data-input="ThumbFormControlInput2"
                    id="addFile_btn2"
                    @click="showManager"
                    class="btn btn-primary">
                {{ $t('Add file') }}
            </button>
        </div>
    </div>
</template>

<script>
import $ from "jquery";

export default {
    name: "FileInputDocument",
    props: ['modelValue'],
    computed: {
        doc: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        },
    },
    methods: {
        showManager: function () {
            $('#addFile_btn2').filemanager('image', {prefix: "/api/laravel-filemanager"});
            $('#ThumbFormControlInput2').on('change', () => {
                this.doc = $('#ThumbFormControlInput2').val();
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
