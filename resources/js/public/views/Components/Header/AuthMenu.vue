<template>
    <div class="top-auth">
        <template v-if="!isAuth">
            <simple-popup :isShow="this.isShowPopup" @hidePopup="hidePopup">
                <component :params="this.params" :is="this.name"/>
            </simple-popup>

            <a @click="showPopup('Login')" href="#">{{$t('Login')}}</a>
            <a @click="showPopup('Register')" href="#">{{$t('Register')}}</a>
        </template>
        <template v-else>
            <a v-if="isPanelAccess" href="/admin/dashboard">Dashboard</a>
            <router-link :to="{path : '/personal'}">Hello, {{userName}}!</router-link>
            <a @click.prevent="logout" href="#">Log out</a>
        </template>
    </div>
</template>

<script>
import Register from "../../User/Register.vue";
import Login from "../../User/Login.vue";
import SimplePopup from "../../Popup/SimplePopup.vue";

export default {
    name: "AuthMenu",
    components: {SimplePopup, Register, Login},
    data(){
        return {
            name : null,
            params : null,
            isShowPopup : false,
        }
    },
    computed : {
        isAuth(){
            return this.$store.getters.isAuth;
        },
        userName(){
            return this.$store.getters.getUserName ?? ''
        },
        isPanelAccess(){
            return this.$store.getters.isPanelAccess === 1
        }
    },
    methods : {
        logout(){
            this.$store.dispatch('logout', '');
        },
        showPopup(name){
            this.name = name;
            this.params = [];
            this.isShowPopup = true;
        },
        hidePopup(){
            this.isShowPopup = false;
        }
    }
}
</script>

<style scoped>
.top-auth{
    padding-top: 10px;
    display: flex;
}

.top-auth a{
    font-family: 'Montserrat';
    color: #111;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 170%;
    padding: 5px 5px;
}
</style>
