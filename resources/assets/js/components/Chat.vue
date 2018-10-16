
<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-md-6">
                <div class="card card-danger direct-chat direct-chat-danger">
                    <div class="card-header"><div class="card-title">ChatRoom Demo</div>
                        <div class="card-tools">
                             <i  class="fa fa-comments fa-2x mt-2"></i>
                             <span class="badge badge-success navbar-badge">3</span>
                        </div>
                    </div>

                    <div class="card-body" >

                        <chat-log id="chatlog" class="chat-log" :messages="messages" :user="user"></chat-log>
                        <hr>
                        <!-- v-on:messagesend adalah v-on berfungsi untuk mendapat nilai balik /return nilai di chatcomposer -->
                        <chat-composer class="chat-composer" v-on:messagesend="addmessage"  ></chat-composer>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    export default {
         data(){
            return{
                messages:[

                ],
                user:"",
                temp:{

                }
            };
        },
        methods:{
            addmessage(message){
                //add in database
                axios.post('/api/chat',{data: message}).then(response=>{
                    //console.log(response)

                });

                this.scrollToEnd();
            },
            scrollToEnd() {
                var chatlog = this.$el.querySelector("#chatlog");
                chatlog.scrollTop = chatlog.scrollHeight;
            },
            loaddata(){
                axios.get('/api/chat').then(response=>{
                    this.messages = response.data;
                    //this.user = this.messages[0].user.name;
                    //console.log(this.messages[0].user.id);
                });
            }
        },
        updated(){
            this.scrollToEnd();
        },
        mounted(){
            this.scrollToEnd();
            this.user = $('.sidebar .user-panel .info .d-block').text().trim();
        },
        created(){
            this.loaddata();
            Echo.join('chatroom')
                .listen('ChatEvent', (e)=>{
                    this.loaddata();
            });

        }
    }
</script>

