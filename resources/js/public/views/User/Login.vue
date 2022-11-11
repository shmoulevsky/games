<template>
    <div class="col-3 offset-1">
        <form>
            <h5 class="mb-5">Please login to your account</h5>
            <div></div>
            <div class="form-group">
                <label for="">E-mail</label>
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
                <label for="">Password</label>
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
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                </div>
                <router-link :to="{path : '/forgot'}">Forgot password?</router-link>
            </div>
            <div class="form-group mt-3">
                <button @click="login" type="button" class="btn btn-primary btn-block">Sign in</button>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email : {value : "", er : false, message : "Please enter e-mail"},
            password : {value : "", er : false, message : "Please enter password"}
        }
    },
    methods :{
        login(){

            let form = new FormData();
            form.append('email', this.email.value);
            form.append('password', this.password.value);
            this.$store.dispatch('login', form)

        },
    }
}
</script>

<style scoped>

</style>
