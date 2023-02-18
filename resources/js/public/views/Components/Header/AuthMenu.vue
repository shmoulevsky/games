<template>
    <div class="top-auth">
        <template v-if="!isAuth">
            <div @click="hidePopup()" ref="bg" class="bg"></div>
            <div ref="popup" class="popup-wrap">
                <div class="popup-inner">
                    <component :params="this.params" :is="this.name"/>
                </div>
            </div>
            <a @click="showPopup('Login', 500)" href="#">{{$t('Login')}}</a>
            <a @click="showPopup('Register', 500)" href="#">{{$t('Register')}}</a>
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

export default {
    name: "AuthMenu",
    components: {Register, Login},
    data(){
        return {
            name : null,
            params : null,
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
            return this.$store.getters.isPanelAccess == 1
        }
    },
    methods : {
        logout(){
            this.$store.dispatch('logout', '');
        },
        showPopup(name, width = 600){
            this.name = name;
            this.params = [];
            this.$refs.bg.style.display = 'block';
            this.$refs.popup.style.width = width + 'px';
            this.$refs.popup.style.marginLeft = -(width/2) + 'px';
            this.$refs.popup.style.display = 'block';
        },
        hidePopup(){
            this.$refs.bg.style.display = 'none';
            this.$refs.popup.style.display = 'none';
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

.bg{
    display: none;
    background-color: rgba(0,0,0,0.75);
    position: fixed;
    top:0px;
    left: 0px;
    bottom: 0px;
    right: 0px;
    z-index: 10;
}

.popup-wrap{
    display: none;
    position: absolute;
    top: 100px;
    left: 50%;
    z-index: 11;
    width: 600px;
    margin-left: -300px;
    background: #fff;
    border-radius: 30px;
    padding: 20px 40px 30px;
}

.popup-inner{

}

</style>
