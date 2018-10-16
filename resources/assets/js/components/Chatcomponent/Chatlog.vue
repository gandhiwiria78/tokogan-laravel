<template>
    <div class="direct-chat-messages">
        <chat-message v-for="message in messages" v-bind:key="message.id" :user="user" :message="message">
        </chat-message>
         <div v-show="messages.length ===0">Tidak ada Chat</div>
    </div>
</template>

<script>
    export default {
       props:['messages','user']
    }
</script>
