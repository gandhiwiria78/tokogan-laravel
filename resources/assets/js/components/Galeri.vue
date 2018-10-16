<template>
   <div class="container">
        <div v-if="status">
            <div class="alert alert-success">
                <strong>Data Telah di Upload</strong>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-default text-center">
                    <div class="card-header">File Upload Component</div>
                    <div class="card-body">
                       <div class="row">
                          <div class="col-md">
                            <div v-if="image" class="align-content-center">
                                <img :src="image" class=" img-thumbnail " height="150" width="150">
                            </div>
                                <div class="text-center" v-else><i class="fa fa-images"></i></div>
                            <br>
                            <input type="file"  v-if="readyupload" v-on:change="onImageChange" title="pilih file" >
                            <hr>
                            <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Gambar</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Deskripsi</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  <tr v-for="img in images" :key="img.id">
                    <td>{{img.id}}</td>
                    <td>{{img.title}}</td>
                    <td>{{img.deskripsi}}</td>
                    <td>
                       <div v-if="img.path" class="align-content-center">
                                <img :src="img.path" class=" img-thumbnail " height="150" width="150">
                        </div>
                    </td>
                    <td>
                        edit/hapus
                    </td>
                  </tr>

                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
</template>

<script>
    export default {
       data(){
            return {
                images:{},
                image: '',
                status :false,
                readyupload: true,
            }
        },
        methods: {
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                this.status = false;
                this.readyupload = true;
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/admin/image/upload',{image: this.image}).then(response => {
                    this.loadimages();
                    //reset form
                    this.readyupload = false;
                    this.$nextTick(() => {
                        this.readyupload = true
                    });
                    this.status = true;
                    this.image = '';
                });
            },
            loadimages(){
                axios.get('/api/galeri').then(
                    ({data}) => ( this.images = data)
                )
            },
        },
        created(){
            this.loadimages();
        }
    }
</script>
