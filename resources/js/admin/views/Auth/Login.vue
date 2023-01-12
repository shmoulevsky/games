<template>
            <div class="col-3 auth-wrap">
                <div>
                    <h1 class="auth-title">Log in</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                    <div class="error-title">
                        <span>{{loginErrors ?? ''}}</span>
                    </div>

                    <form>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input v-model="email" type="email" class="form-control form-control-xl" placeholder="E-mail" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input v-model="password" type="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="button" @click="login" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
</template>

<script>

import AuthService from "../../services/AuthService";
import axiosInstance from "../../services/axios";

export default {
    name: "Login",
    data(){
        return{
            email : '',
            password : '',
            isError : false
        }
    },
    components: {

    },
    computed: {
        loginErrors() {
            return this.$store.getters.getLoginErrors;
        }
    },
    methods : {
        login(){

            let form = new FormData();
            form.append('email', this.email);
            form.append('password', this.password);
            this.$store.dispatch('login', form)
        },
        validateEmail(value) {
            // if the field is empty
            if (!value) {
                return 'This field is required';
            }

            // if the field is not a valid email
            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                return 'This field must be a valid email';
            }

            // All is good
            return true;
        },
    }
}
</script>

<style scoped>
.auth-wrap{
    margin: 50px auto;
}
</style>
