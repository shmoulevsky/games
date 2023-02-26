<template>
    <div class="col">
        <form>
            <error-text :text="this.errors ?? ''"></error-text>
            <span class="form-title">Быстрая регистрация</span>
            <div>
                <input v-model="email.value" type="email" class="form-control"  :placeholder="$t('E-mail')+'...'">
            </div>
            <div>
                <input v-model="password.value" type="password" class="form-control"  :placeholder="$t('Password')+'...'">
            </div>
            <div>
                <a @click="register()" class="btn main" href="#">{{$t('Sign up')}}</a>
            </div>
        </form>

    </div>
</template>

<script>
import ErrorText from "../../../admin/views/Components/Form/ErrorText.vue";

export default {
    name: "QuickRegister",
    components: {ErrorText},
    data() {
        return {
            errors : '',
            isError : false,
            email : {value : "", er : false, message : "Please enter e-mail"},
            password : {value : "", er : false, message : "Please enter password"},
        }
    },
    methods :{
        register(){

            let form = new FormData();
            form.append('email', this.email.value);
            form.append('password', this.password.value);

            this.$store.dispatch('quickRegister', form).catch(error => {
                this.errors = error;
            })

        },
    }
}
</script>

<style scoped>

.form-title{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    display: block;
    margin-bottom: 28px;
}

input{
    border: 1px solid #C4C4C4;
    border-radius: 10px;
    margin-bottom: 24px;
    height: 36px;
    padding: 5px 10px;
}

.btn.main{
    margin-top: 20px;
}
</style>
