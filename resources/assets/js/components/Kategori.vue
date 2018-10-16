<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kategori Brand Smartphone</h3>
                        <div class="card-tools">
                            <div class="pagination pagination  float-right">
                                <div class="page-item" style="margin-right:25px;">
                                    <button type="submit" class="btn" data-toggle="modal" data-target="#exampleModal">Tambah Kategori
                                         <i class="fa fa-plus fa-fw"></i></button>
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
                                    <th>Title</th>
                                    <th>Deskripsi</th>
                                    <th>Image</th>

                                    <th></th>
                                </tr>
                                <tr v-for="kategori in kategoris" :key="kategori.id">
                                    <td>{{kategori.id}}</td>
                                    <td>{{kategori.judul}}</td>
                                    <td>{{kategori.deskripsi}}</td>
                                    <td>
                                         <div v-if="kategori.image" class="align-content-center">

                                                <img :src="kategori.image" class=" img-thumbnail " height="100" width="100">
                                        </div>
                                    </td>
                                    <td>
                                        <a @click="updatedata(kategori.id)"><i class="fa fa-edit blue"></i></a>
                                        /
                                        <a @click="deletedata(kategori.id,kategori.judul)"><i class="fa fa-trash red"></i></a>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createdata" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul/Slug</label>
                                <input placeholder="Judul Kategori" v-model="form.title" type="text" name="title" id="title"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input v-model="form.deskripsi" type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="deskripsi"
                                    :class="{ 'is-invalid': form.errors.has('deskripsi') }">
                                <has-error :form="form" field="deskripsi"></has-error>
                            </div>
                            <div class="form-group">
                                <div v-if="update">
                                     <label id="inputimagetext" name="inputimagetext"></label>
                                </div>
                                <input type="file" v-on:change="onImageChange" id="inputmage" name="inputmage">
                                <has-error :form="form" field="image" ></has-error>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
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
                kategoris :{},
                id:'',
                image: '',
                update:false,
                form: new Form({
                    title: '',
                    deskripsi: '',
                    image:''
                })
            }
        },
        methods:{
            load(){
                axios.get('/api/kategori').then(
                    ({data}) =>{
                        this.kategoris = data
                    }
                )
            },
            createdata(id){
                if(this.update){
                    this.form.post('kategori/update/'+this.id);
                }else{
                    this.form.post('kategori/tambah').then(()=>{
                        try {
                            $(function () {
                            $('#exampleModal').modal('toggle');
                            });

                            toast({
                                type: 'success',
                                title: 'Kategori telah ditambah'
                            })
                            this.load();
                        } catch (error) {

                        }
                    });
                }
            },
            onImageChange(e){
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                //this.form.image =e.target.files[0].name;
                $('#inputmage').change(function(){
                    readURL(this);
                });
                this.createImage(files[0]);
               // alert(this.form.image);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this.form;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };

                this.form.image =this.image;
                reader.readAsDataURL(file);
            },
            removeImage() {
                this.image = '';
            },
            deletedata(id,judul){
                swal({
                title: 'Hapus Data ini?',
                text:'ID: '+id+' Judul: '+judul,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText:'Batal',
                }).then((result) => {
                if (result.value) {
                    this.form.delete('api/kategori/'+id).then(
                        (data)=>{
                            if(data.message="success"){
                                swal(
                                'Terhapus!',
                                'Data Telah terhapus.',
                                'success'
                                );
                                this.load();
                            }
                        }
                    );
                }
                });
            },
            updatedata(id){
                this.update = true;
                this.id=id;
                axios.get('/api/kategori/'+id).then(
                    ({data}) =>{
                         $(function () {
                            $('#exampleModal').modal('show');
                            $("#title").val(data.judul);
                            $("#deskripsi").val(data.deskripsi);
                            //document.getElementById("#inputimage").value;
                            $("#inputmagetext").innerHTML = data.image;
                        });
                    }
                )
            }
        },
        created(){
           this.load();
        }
    }
</script>
