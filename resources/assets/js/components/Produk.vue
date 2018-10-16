<template>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Produk Smartphone</h3>
                        <div class="card-tools">
                            <div class="pagination pagination  float-right">
                                <div class="page-item" style="margin-right:25px;">
                                    <button type="submit" class="btn" @click="newModal">Tambah Produk
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
                                    <th>nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Image</th>
                                    <th>Kategori</th>
                                    <th></th>
                                </tr>
                                <tr v-for="(produk,index) in produks" :key="produk.id">
                                    <td>{{produk.id}}</td>
                                    <td>{{produk.nama}}</td>
                                    <td>{{produk.deskripsi}}</td>
                                    <td>{{produk.harga | mataUang}}</td>
                                    <td>
                                         <div v-if="produk.image" class="align-content-center">
                                                <img :src="produk.image" class=" img-thumbnail" max-height="60" max-width="60">
                                        </div>
                                    </td>
                                     <td>{{joinkategori[index] }}</td>
                                    <td>
                                        <a @click="editModal(produk.id)"><i class="fa fa-edit blue"></i></a>
                                        /
                                        <a @click="deletedata(produk.id,produk.judul)"><i class="fa fa-trash red"></i></a>
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
                                <label>Harga</label>
                                <input v-model="form.harga" type="text" name="harga" @focus="onSeleted" class="form-control" id="harga" placeholder="harga"
                                    :class="{ 'is-invalid': form.errors.has('harga') }">
                                <has-error :form="form" field="harga"></has-error>
                            </div>
                            <div class="form-group">
                                <div v-if="update">
                                     <label id="inputimagetext" name="inputimagetext"></label>
                                </div>
                                <input type="file" v-on:change="onImageChange"  id="inputmage" name="inputmage">
                                <has-error :form="form" field="image" ></has-error>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <div id="grouplabel">
                                    <div class="card-body p-0" style="display: block;">
                                        <ul class="nav nav-pills flex-row">
                                            <li v-for="(tag,index) in tags" :key="tag.id" class="nav-item">
                                                <a href="#"  v-on:click.prevent="removekategori(index)" class="nav-link label" >
                                                    <i :class="['fa fa-circle ',tag.warna]"></i>
                                                      {{tag.judul}}
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
                                    <input type="text" name="kategori" @focus="changedLabel" placeholder="pilih kategori" class="form-control" id="kategori">
                                </div>
                                <div v-show="showsuggest">
                                <select v-model="selected" class="form-control" multiple id="sugest">
                                    <option v-for="(kategori,index) in kategoris" :value="index" :id="kategori.judul"  @click="changedValue(index)"  :key="kategori.id" >
                                        {{kategori.judul}}
                                    </option>
                                </select>
                                </div>
                                <has-error :form="form" field="kategori"></has-error>
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
    export default {

       data(){
           return{
               update:false,
               showsuggest:false,
               produks:{},
               kategoris:[],
               selected:[],
               joinkategori:[],
               datakategori:[],
               strijoin : '',
               id:'',
               tes :[1,2,3,4,5,6,7,8,9],
               warna:[
                   'blue',
                   'red',
                   'yellow',
                   'green',
                   'purple',
                   'pink',
                   'orange'
               ],
               tags: [],
               form: new form({
                   title:'',
                   deskripsi:'',
                   image:'',
                   harga:'',
                   kategori:[]
               })
           }
       },
       methods:{
           newModal(){
               this.form.reset();
               $('#exampleModal').modal('show');
           },
           editModal(){
               this.form.reset();
               $('#exampleModal').modal('show');
           },
           changedValue: function(value) {
                let p =value;
                let warnas=  this.warna[Math.floor(Math.random()*this.warna.length)]
                //console.log(warnas)
                try {
                   $('#sugest #'+this.kategoris[p].judul).attr("disabled","disabled");
                   // console.log(option);
                    this.tags.push({
                        id: value,
                        judul : this.kategoris[p].judul,
                        warna: warnas
                    });
                    this.showsuggest =false;
                } catch (error) {

                }
                this.form.kategori = this.tags;

            },
            changedLabel:function(){
                  this.showsuggest = true;
                 // console.log(this.showsuggest);
            },
           createdata(){
               this.form.post('/api/produk').then(
                   (data)=>{
                       $(function () {
                            $('#exampleModal').modal('toggle');
                        });

                       toast({
                            type: 'success',
                            title: 'Kategori telah ditambah'
                        })
                        this.loaddata();
                   }
               );
           },
           onImageChange(e){
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                //this.form.image =e.target.files[0].name;
                $('#inputimagetext').change(function(){
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
           onSeleted(){

           },
           removekategori(i){
                 var id ;
                for (let s = 0; s < this.tags.length; s++) {
                    if ( this.tags[i] === this.tags[s]) {
                        id = this.tags[s].id;
                        this.tags.splice(s, 1);

                    }
                }

               this.$delete(this.tags,i);
               if(this.tags.length==0){
                  //console.log('hahererweraha');
                  $('#'+this.kategoris[id].judul).removeAttr("disabled");

               }else{

               }
              //console.log(id);
           },
           loaddata(){

              axios.get('/api/produk').then(
                    ({data}) =>{
                        this.produks = data.data.data;
                        //dapatkan judul dari kategori yg sudah terkait dengan produk dari tabel produk
                        axios.get('/api/kategori').then(
                            (ka)=>{
                                this.kategoris = ka.data;
                                //cara 1: ambil pakai axios datanya ke controller baru lagi
                                //cara 2: gabungkan dengan api produk saat return data

                                for (let i = 0; i < this.produks.length; i++) {
                                    axios.get('/api/produksikategori/'+this.produks[i].id).then(
                                      (ta) =>{
                                          // parsing  penanda saat data bser hasil dan untuk nilai for sebanyak 1 post yang punya bnyak tags
                                            this.datakategori.push(ta.data.data);
                                            console.log(ta.data.data);
                                           // pengabungan tag seperti nama1, nama2, nama3
                                           for (let b = 0; b < ta.data.data.length; b++) {
                                                this.strijoin += ta.data.data[b]['judul']+', ';
                                                //console.log(this.strijoin +'s');
                                           }

                                        }
                                    );
                                }

                            }
                        );


                    }
              )

           }
       },
       created(){
           this.loaddata();
       },
       updated(){

       },
       computed:{

       },
       watch:{
           tags :function(e){
           },
           datakategori :function (e) {
               //saat datakategori di set maka
                this.joinkategori.push(this.strijoin);
                this.strijoin = "";
           }
       }
    }
</script>

<style lang="css">
#sugest{
  position: absolute;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  height: 150px;
  top: 70%;
  left: 0;
  right: 0;
}

</style>

