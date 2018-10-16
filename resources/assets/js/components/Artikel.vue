<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card card-default">
                    <div class="card-header">Artikel Komponen</div>
                    <div class="card-body">
                    <editor name="content" class="form-control my-editor" api-key="b741wld4rghab1f0pnu38laota0vfmpjkxcv3ikchzvfi4cx" :init="editor_config">
                    </editor>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script src="{{ asset('vendor/laravel-filemanager/js/jquery.form.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
import Editor from '@tinymce/tinymce-vue';
    export default {
        data(){
            return {
                editor_config : {
                        path_absolute : "/",
                        selector: "textarea",
                        width: window.innerWidth-350,
                        height: window.innerHeight-200 ,
                        plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor colorpicker textpattern"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                        relative_urls: false,
                        file_browser_callback : function(field_name, url, type, win) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                        var cmsURL ='/laravel-filemanager?field_name=' + field_name;
                        if (type == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.open({
                            file : cmsURL,
                            title : 'Filemanager',
                            width : x * 0.8,
                            height : y * 0.8,
                            resizable : "yes",
                            close_previous : "no"
                        });
                        }
                    }

            }
        },
        components: {
                'editor': Editor // <- Important part
        },
        methods:{
            load (){
                let timerInterval;
                swal({
                    //title: 'Auto close alert!',
                    //html: '<img src="/img/loader.gif" class="img-responsive" height="150" width="200">',
                    //title: 'Custom width, padding, background.',
                    imageUrl: './img/loader.gif',
                    imageWidth: 280,
                    imageHeight: 200,
                    padding: '3em',
                    background:'rgba(0, 0, 0, 0) ',
                    showCancelButton: false,
                    showConfirmButton:false,
                    showLoaderOnConfirm: false,
                    timer: 3000,
                    backdrop: `#fff center `,
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.timer
                    ) {
                       // console.log('I was closed by the timer')
                    }
                })

            },
            delete(id){

            }
        },
        created(){
            this.load();
        }
    }
</script>

<style lang="css">

</style>

