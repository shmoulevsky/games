<template>
    <div class="col-3 offset-1">
        <form>
            <h5 class="mb-5">Registration</h5>
            <div class="row">
                <div class="col">
                    <label for="">Name</label>
                    <input
                        v-model="email.value"
                        type="text"
                        class="form-control"
                        :class="email.er ? 'is-invalid': ''"
                        :placeholder="$t('Input value')"
                    />
                    <span v-show="email.er" class="invalid-feedback">{{ email.message }}</span>
                </div>
                <div class="col">
                    <label for="">Last name</label>
                    <input
                        v-model="email.value"
                        type="text"
                        class="form-control"
                        :class="email.er ? 'is-invalid': ''"
                        :placeholder="$t('Input value')"
                    />
                    <span v-show="email.er" class="invalid-feedback">{{ email.message }}</span>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="">Phone</label>
                <input
                    v-model="password.value"
                    type="text"
                    class="form-control"
                    :class="password.er ? 'is-invalid': ''"
                    :placeholder="$t('Input value')"
                />
                <span v-show="password.er" class="invalid-feedback">{{ password.message }}</span>
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
            <div class="form-group mt-3">
                <label for="">Password confirm</label>
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
                    <label class="form-check-label" for="form1Example3"> Agree with terms </label>
                </div>
                <a href="#!">Have an account?</a>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary btn-block">Sign up</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            email : {value : "", er : false, message : "Please enter e-mail"},
            password : {value : "", er : false, message : "Please enter password"}
        }
    }
}
</script>

<style scoped>

</style>
