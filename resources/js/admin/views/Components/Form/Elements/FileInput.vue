<template>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile" />
        <label class="custom-file-label" for="customFile"
        >{{$t('Choose file')}}</label
        >
    </div>
    <span v-show="field.er" class="invalid-feedback">{{ field.message }}</span>
</template>

<script>
export default {
    name: "FileInput",
    props: ['field'],

}
</script>

<style scoped>

</style>
