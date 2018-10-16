<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pelanggan</h3>
                        <div class="card-tools">
                            <div class="pagination pagination  float-right">
                                <div class="page-item" style="margin-right:25px;">
                                    <button type="submit" class="btn" @click="newModal">Tambah
                                        Pelanggan <i class="fa fa-user-plus fa-fw"></i></button>
                                </div>

                                <div class="input-group input-group-sm page-item" style="width: 200px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn orange"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Catatan</th>
                                    <th>Tipe</th>
                                    <th>Waktu Pendaftaran</th>
                                    <th></th>
                                </tr>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.bio}}</td>
                                    <td>{{user.type | upText}}</td>
                                    <td>{{user.created_at | mydate}}</td>
                                    <td>
                                        <a href="#" @click="editModal(user)"><i class="fa fa-edit blue"></i></a>
                                        /
                                        <a href="#" @click="deleteUser(user)"><i class="fa fa-trash red"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{editMode?'Update User':'Tambah User'}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editMode?updateUser():createUser() " @keydown="form.onKeydown($event)">
                            <div class="form-group">
                                <label>Nama</label>
                                <input placeholder="Sesuaikan Nama dengan KTP" v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="text" name="email" class="form-control" placeholder="Contoh admin@gmail.com"
                                    :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password" type="password" name="password" placeholder="Password Harus 8 karakter"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea placeholder="Catatan Untuk Pengguna" v-model="form.bio" type="textarea" name="bio"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"> </textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Tipe</label>
                                <select v-model="form.type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <option value="Standar">Standar</option>
                                    <option value="Vip">Vip</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">{{editMode? 'Update':'Tambah'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from 'vform';
    export default {
        data() {
            return {
                editMode:false,
                users:{},
                id:'',
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods:{
            loadUser(){
                axios.get('/api/user').then(
                    ({data}) => ( this.users = data.data)
                )
            },
            createUser(){

                this.form.post('/api/user').then(
                   (data)=>{
                        $(function () {
                            $('#exampleModal').modal('toggle');
                         });

                        toast({
                            type: 'success',
                            title: 'Telah telah ditambah'
                        })
                        this.loadUser();
                   }
                );
            },
            updateUser() {
                this.form.put('/api/user/'+this.id).then(
                   ()=>{

                        $(function () {
                            $('#exampleModal').modal('toggle');
                         });
                        toast({
                            type: 'success',
                            title: 'Data telah terupdate'
                        })
                        this.loadUser();
                   }
                ).catch(

                );
            },
            deleteUser(user){
                swal({
                title: 'Hapus Data ini?',
                text:'Nama: '+user.name+' , Email: '+user.email,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText:'Batal',
                }).then((result) => {
                if (result.value) {

                    this.form.delete('api/user/'+user.id).then(
                        (data)=>{
                            if(data.message="success"){
                                swal(
                                'Terhapus!',
                                'Data Telah terhapus.',
                                'success'
                                );
                                this.loadUser();
                            }
                        }
                    );
                }
                });
            },
            newModal(){
                this.form.reset();
                $('#exampleModal').modal('show');
                this.editMode =false;
            },
            editModal(user){
                this.form.reset();
                $('#exampleModal').modal('show');
                this.form.fill(user);
                this.editMode = true;
                this.id = user.id;
                //console.log(this.id)
            }
        },
        created(){
            this.loadUser();
        }
    }
</script>
