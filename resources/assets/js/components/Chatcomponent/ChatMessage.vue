<template>
    <div>
        <hr>
        <div v-if="user === message.user.name" class="direct-chat-msg">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name float-left">
                    Saya
                </span>
                <span class="direct-chat-timestamp float-right">{{message.created_at}}</span>
            </div>
            <img src="/img/profile.png" class=" direct-chat-img">
            <div class="direct-chat-text">
                {{message.message}}
            </div>
        </div>
        <div v-else class="direct-chat-msg right">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name float-right">{{message.user.name}}</span>
                <span class="direct-chat-timestamp float-left">{{message.created_at}}</span>
            </div>
            <img class="direct-chat-img" src="/img/logo.png" alt="Message User Image">

            <div class="direct-chat-text">
               {{message.message}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['message','user'],
    }
</script>

<style lang="css">

</style>
