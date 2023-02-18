<template>
    <div class="col">
        <form class="auth-form">
            <h5 class="mb-5 title">{{$t('Please login to your account')}}</h5>
            <error-text :text="this.errors ?? ''"></error-text>
            <div class="form-group">
                <label for="">{{$t('E-mail')}}</label>
                <input
                    v-model="email.value"
                    type="text"
                    class="form-control"
                    :class="email.er ? 'is-invalid': ''"
                    :placeholder="$t('Input value')"
                />
                <span v-show="email.er" class="invalid-feedback">{{ email.message }}</span>
            </div>
            <div class="form-group mt-3">
                <label for="">{{$t('Password')}}</label>
                <input
                    v-model="password.value"
                    type="text"
                    class="form-control"
                    :class="password.er ? 'is-invalid': ''"
                    :placeholder="$t('Input value')"
                />
                <span v-show="password.er" class="invalid-feedback">{{ password.message }}</span>
            </div>
            <div class="d-flex justify-content-around align-items-center mt-4 mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3">{{$t('Remember me')}}  </label>
                </div>
                <router-link class="link" :to="{path : '/forgot'}">{{$t('Forgot password?')}}</router-link>
            </div>
            <div class="form-group mt-3">
                <button @click="login" type="button" class="btn main">{{$t('Sign in')}}</button>
            </div>
            <div class="form-group mt-3">
                <a v-for="oauthItem in oauth" :href="oauthItem.link">{{oauthItem.name}}</a>
            </div>
        </form>
    </div>

</template>

<script>
import ErrorText from "../../../admin/views/Components/Form/ErrorText.vue";
import DataService from "../../services/DataService";

export default {
    name: "Login",
    components: {ErrorText},
    data() {
        return {
            errors : '',
            oauth : [],
            isError : false,
            email : {value : "", er : false, message : "Please enter e-mail"},
            password : {value : "", er : false, message : "Please enter password"}
        }
    },
    mounted() {
        DataService.post('oauth/link', {type : 'vk'}).then((response) => {
            this.oauth = response.data.links;
        })
    },
    methods :{
        login(){

            let form = new FormData();
            form.append('email', this.email.value);
            form.append('password', this.password.value);
            this.$store.dispatch('login', form).catch(error => {
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
