<template>
    <div v-if="isShow === true" class="error-text">
        <span v-html="text"></span>
    </div>
</template>

<script>
export default {
    name: "ErrorText",
    props: ['text'],
    computed:{
        isShow(){
            return this.text.length > 0;
        }
    }
}
</script>

<style scoped>

.error-text{
    color: red;
    font-size: 14px;
    padding: 15px;
    border: 1px solid red;
    display: inline-block;
    border-radius: 10px;
    min-width: 300px;
    margin-bottom: 20px;
}

</style>
