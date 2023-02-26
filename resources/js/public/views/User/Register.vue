<template>
    <div class="col">
        <form class="reg-form">
            <h5 class="mb-5 title">{{$t('Registration')}}</h5>
            <error-text :text="this.errors ?? ''"></error-text>
            <div>
                <label>{{$t('Name')}}:</label>
                <input v-model="name.value" type="text" class="form-control"  :placeholder="$t('Please enter name...')">
            </div>
            <div>
                <label>{{$t('E-mail')}}:</label>
                <input v-model="email.value" type="email" class="form-control"  :placeholder="$t('Please enter e-mail...')">
            </div>
            <div>
                <label>{{$t('Password')}}:</label>
                <input v-model="password.value" type="password" class="form-control"  :placeholder="$t('Please enter password...')">
            </div>

            <div class="d-flex justify-content-around align-items-center mt-4 mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" v-model="this.agree.value" id=""  />
                    <label class="form-check-label" for=""> Agree with terms </label>
                </div>
                <a class="link" href="#!">{{$t('Have an account?')}}</a>
            </div>
            <div class="form-group mt-3">
                <div class="row">
                    <div class="col">
                        <a href="#" @click="register()" class="btn main">{{$t('Sign up')}}</a>
                    </div>
                    <div class="col">
                        <OAuthLinks/>
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
import ErrorText from "../../../admin/views/Components/Form/ErrorText.vue";
import OAuthLinks from "./OAuthLinks.vue";

export default {
    name: "Register",
    components: {OAuthLinks, ErrorText},
    data() {
        return {
            errors : '',
            isError : false,
            name : {value : "", er : false, message : "Please enter name"},
            email : {value : "", er : false, message : "Please enter e-mail"},
            password : {value : "", er : false, message : "Please enter password"},
            agree : {value : true, er : false, message : "Please check agree"},
        }
    },
    methods :{
        register(){

            let form = new FormData();
            form.append('email', this.email.value);
            form.append('name', this.name.value);
            form.append('password', this.password.value);
            form.append('agree', this.agree.value);
            this.$store.dispatch('register', form).catch(error => {
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

.reg-form input[type='text'],.reg-form input[type='email'],.reg-form input[type='password']{
    border: 1px solid #C4C4C4;
    border-radius: 10px;
    margin-bottom: 15px;
    padding: 12px 10px;
    height: 45px;
}

.reg-form .form-check-input:checked {
    background-color: #6e41e2;
    border-color: #6e41e2;
}

.reg-form a.link{
    color: #111;
    text-decoration: none;
    display: inline-block;
    border-bottom: 1px solid #555;
    padding-bottom: 2px;
}

.reg-form label{
    font-family: 'Montserrat';
    color: #111;
    font-size: 14px;
    margin-bottom: 5px;
}

</style>
