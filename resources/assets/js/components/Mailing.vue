<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                     <form @submit.prevent="sendemail">
                    <div class="card-header">
                        <h3 class="card-title">Mengirimkan Email</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                             <input placeholder="To ..." v-model="form.to" type="text" name="to" class="form-control" :class="{ 'is-invalid': form.errors.has('to') }">
                        </div>
                        <div class="form-group">
                            <input placeholder="From dandy.stg8899@gmail.com" v-model="form.from" type="text" name="from" class="form-control" :class="{ 'is-invalid': form.errors.has('from') }">
                        </div>
                        <div class="form-group">
                            <textarea id="compose-textarea" class="form-control" v-model="form.message"  style="height: 300px" name="message" :class="{ 'is-invalid': form.errors.has('message') }">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max.32MB</p>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="float-right">

                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Kirimkan</button>
                        </div>

                    </div>
                    <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /. box -->
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform';
    export default {
        data(){
            return{
               form : new Form({
                   to:'',
                   from:'',
                   message:'',
                   mode:''
               })
            }
        },
        methods:{
            sendemail(){
                this.form.post('sendemail').then(
                   ()=>{
                       //console.log(data);
                        toast({
                            type: 'success',
                            title: 'Telah telah ditambah'
                        })

                   }
                );
            }
        }
    }
</script>
