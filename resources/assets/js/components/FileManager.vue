<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">File Manager Komponen </div>
                    <div class="card-body">
                       <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script src="{{ asset('vendor/laravel-filemanager/js/jquery.form.min.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
