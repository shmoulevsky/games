<template>
    <div class="col-3 offset-1">
        <form>
            <h5 class="mb-5">Please enter phone or email</h5>
            <div class="form-group">
                <label class="mt-2" for="">E-mail/phone</label>
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
                <button @submit="login" type="submit" class="btn btn-primary btn-block">Send</button>
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
    }
}
</script>

<style scoped>

</style>
