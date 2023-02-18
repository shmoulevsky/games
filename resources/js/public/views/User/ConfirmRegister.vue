<template>
    <div class="row">
        <h5 class="mb-5 title">{{$t('Success')}}</h5>
        <p>{{$t('Thanks! Your account confirmed!')}}</p>
    </div>
    <div class="row">
    <div class="col-3">
        <form class="auth-form">
            <error-text :text="this.errors ?? ''"></error-text>
            <div class="form-group">
                <label for="">{{$t('Name')}}</label>
                <input
                    disabled
                    v-model="name.value"
                    type="text"
                    class="form-control"
                    :class="name.er ? 'is-invalid': ''"
                />
                <span v-show="name.er" class="invalid-feedback">{{ name.message }}</span>
            </div>
            <div class="form-group">
                <label for="">{{$t('Email')}}</label>
                <input
                    disabled
                    v-model="email.value"
                    type="text"
                    class="form-control"
                    :class="email.er ? 'is-invalid': ''"
                />
                <span v-show="email.er" class="invalid-feedback">{{ email.message }}</span>
            </div>
            <div class="form-group">
                <label for="">{{$t('Phone')}}</label>
                <input
                    v-model="phone.value"
                    type="text"
                    class="form-control"
                    :class="phone.er ? 'is-invalid': ''"
                    :placeholder="$t('Input value')"
                />
                <span v-show="phone.er" class="invalid-feedback">{{ phone.message }}</span>
            </div>


            <div class="form-group mt-3">
                <button @click="finish" type="button" class="btn main">{{$t('Finish registration')}}</button>
            </div>
        </form>
    </div>
    </div>

</template>

<script>
import ErrorText from "../../../admin/views/Components/Form/ErrorText.vue";
import UrlService from "../../services/UrlService";
import AuthService from "../../services/AuthService";
import axiosInstance from "../../services/axios";

export default {
    name: "ConfirmRegister",
    components: {ErrorText},
    data() {
        return {
            errors : '',
            isError : false,
            name : {value : "", er : false, message : "Please enter e-mail"},
            email : {value : "", er : false, message : "Please enter e-mail"},
            phone : {value : "", er : false, message : "Please enter e-mail"},

        }
    },
    mounted() {

        let hash = this.$route.params.hash ?? '';

        AuthService.verify(hash).then(
            (response) => {
                this.name.value = response.data.user.name;
                this.email.value = response.data.user.email;

                this.$store.dispatch('auth', {user : response.data.user, token : response.data.token}).catch(error => {
                    this.errors = error;
                })

            }
        )
    },
    methods :{
        finish(){

            let form = new FormData();
            form.append('hash', this.hash.value);
            form.append('phone', this.phone.value);
            this.$store.dispatch('finish', form).catch(error => {
                this.errors = error;
            })

        },
    }
}
</script>

<style scoped>
.title{
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    display: block;
    margin-bottom: 28px;
}

.auth-form input[type='text'],.auth-form input[type='password']{
    border: 1px solid #C4C4C4;
    border-radius: 10px;
    margin-bottom: 24px;
    height: 40px;
    padding: 5px 10px;
}

.auth-form .form-check-input:checked {
    background-color: #6e41e2;
    border-color: #6e41e2;
}

.auth-form a.link{
    color: #111;
    text-decoration: none;
    display: inline-block;
    border-bottom: 1px solid #555;
    padding-bottom: 2px;
}

</style>
