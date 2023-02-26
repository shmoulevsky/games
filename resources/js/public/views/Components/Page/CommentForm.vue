<template>
    <h3 class="subtitle">{{title}}</h3>
    <success-text :is-show="isSuccess" :text="$t('Comment has been send')"></success-text>
    <div class="form-wrap">
        <div class="line">
            <input type="text" :placeholder="$t('Name')" v-model="userName">
        </div>
        <div class="line">
            <input type="text" :placeholder="$t('Email')" v-model="userEmail">
        </div>
        <div class="line">
            <textarea :placeholder="$t('Comment')" v-model="comment"></textarea>
        </div>
        <div>
            <button @click="send()" class="btn main">{{$t('Store comment')}}</button>
        </div>
    </div>
</template>

<script>
import DataService from "../../../services/DataService";
import SuccessText from "../../../../admin/views/Components/Form/SuccessText.vue";

export default {
    name: "CommentForm",
    components: {SuccessText},
    data() {
        return {
            userName : null,
            userEmail : null,
            comment : null,
            isSuccess: false
        }
    },
    props : ['title','entityId', 'entityType'],
    mounted() {
        this.userName = this.$store.getters.getUserName ?? '';
        this.userEmail = this.$store.getters.getUserEmail ?? ''
    },
    methods: {
        send(){

            let data = {
                name : this.userName,
                email : this.userEmail,
                comment : this.comment,
                entity_id : this.entityId,
                entity_type : this.entityType,
            }

            DataService.post('comments', data).then((response) => {
                this.isSuccess = true;
            })
        }
    }
}
</script>

<style scoped>
.line{
    margin-bottom: 10px;
}

input[type='text'], input[type='email'], textarea{
    width: 300px;
}

textarea{
    height: 90px;
}

</style>
