<template>
    <div class="auth-wrap">
        <router-link :to="{path : '/login'}">Login</router-link>
        <router-link :to="{path : '/register'}">Register</router-link>
    </div>
</template>

<script>
export default {
    name: "AuthMenu"
}
</script>

<style scoped>
    .auth-wrap{
        display: flex;
    }

    .auth-wrap a{
        display: flex;
        margin-right: 10px;
        text-decoration: underline;
        color: #111;
        font-size: 14px;
    }
</style>
