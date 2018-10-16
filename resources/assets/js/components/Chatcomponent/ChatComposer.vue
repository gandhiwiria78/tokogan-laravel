<template>
<div class="card-footer">
    <form action="">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="tuliskan pesan . . . . ." v-model="messageText" @keyup.enter="sendMessage">
            <span class="input-group-append">
                <button class="btn btn-primary" @click="sendMessage">Kirim</button>
            </span>
        </div>
    </form>
</div>

</template>

<script>
import moment from 'moment';
    export default {
        props:['id_user'],
        data(){
            return{
                messageText: '',
                name:'',
                created_at :'',
            }
        },
        methods:{
            sendMessage(){
                //console.log(this.id_user);
               // this.loaduser();
                let tanggal = moment(new Date()).format('YYYY-MM-DD hh:mm:ss');
                //console.log(this.id_user);
                this.$emit('messagesend',{
                    message: this.messageText,
                    user : $('.sidebar .user-panel .info .d-block').text().trim(),
                    created_at:tanggal
                });
                this.messageText = "";
            },
            loaduser(){
                let id = this.id_user;
                axios.get('api/user/'+id).then(response=>{
                    //console.log(response.data.name);
                    this.name= response.data.name;

                })
            }
        }
    }
</script>


