<template>
    <div class="auth-wrap">
        <template v-if="!isAuth">
            <router-link :to="{path : '/login'}">Login</router-link>
            <router-link :to="{path : '/register'}">Register</router-link>
        </template>
        <template v-else>
            <a v-if="isPanelAccess" href="/admin/dashboard">Dashboard</a>
            <router-link :to="{path : '/personal'}">Hello, {{userName}}!</router-link>
            <a @click.prevent="logout" href="#">Log out</a>
        </template>
    </div>
</template>

<script>
export default {
    name: "AuthMenu",
    computed : {
        isAuth(){
            return this.$store.getters.isAuth;
        },
        userName(){
            return this.$store.getters.getUserName ?? ''
        },
        isPanelAccess(){
            return this.$store.getters.isPanelAccess == 1
        }
    },
    methods : {
        logout(){
            this.$store.dispatch('logout', '');
        }
    }
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
