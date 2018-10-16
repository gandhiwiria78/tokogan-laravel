<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Maps</div>
                    <div class="card-body">
                        <h1>{{ msg }}</h1>
                        <GmapMap
                            :center="{lat:-0.026330, lng:109.342506}"
                            :zoom="7"
                            style="width: 100%; height: 300px"
                            >
                            
                            </GmapMap>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // map latitude:-0.026330  longtitude:109.342506 pontianak 
    // dan
    export default {
        data () {
            return {
                msg: 'Peta Pontianak'
        }},
        mounted(){
            
        },
        computed:{
            
        }
        
    }
</script>

<style scoped>
    #myMap {
    height:300px;
    width: 100%;
   }
</style>
