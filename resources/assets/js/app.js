
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import {Form, HasError, AlertError} from 'vform';
import moment from 'moment';

window.form  = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VoerroTagsInput from '@voerro/vue-tagsinput';
Vue.component('tags-input', VoerroTagsInput);

// import VueTagsInput from '@johmun/vue-tags-input';
// Vue.component('vue-tags-input',VueTagsInput);

// import InputTag from 'vue-input-tag';
// Vue.component('input-tag',InputTag);

//vue router
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import * as VueGoogleMaps from 'vue2-google-maps';


Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDWeatNtStditZRPU06FvgF2Ha5_-FoCxk',
        //libraries: 'places',  // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)
    
        //// If you want to set the version, you can do so:
        // v: '3.26',
      },
    
      //// If you intend to programmatically custom event listener code
      //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
      //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
      //// you might need to turn this on.
      // autobindAllEvents: false,
    
      //// If you want to manually install components, e.g.
      //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
      //// Vue.component('GmapMarker', GmapMarker)
      //// then disable the following:
      // installComponents: true,
})

Vue.component('GmapMarker',require('vue2-google-maps/dist/components/marker'));

import swal from 'sweetalert2';
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

let routes = [

    { path: '/admin/home', component: require('./components/Dashboard.vue') },
    { path: '/admin/profile', component: require('./components/Profile.vue') },
    { path: '/admin/users', component: require('./components/Users.vue') },
    { path: '/admin/produk', component: require('./components/Produk.vue') },
    { path: '/admin/kategori', component: require('./components/Kategori.vue') },
    { path: '/admin/galeri', component: require('./components/Galeri.vue') },
    { path: '/admin/artikel', component: require('./components/Artikel.vue') },
    { path: '/admin/chat', component: require('./components/Chat.vue') },
    { path: '/admin/developer', component: require('./components/Developer.vue')},
    { path: '/admin/filemanager', component: require('./components/FileManager.vue') },
    { path: '/admin/mailing', component: require('./components/Mailing.vue') },
    { path: '/admin/maps', component: require('./components/Maps.vue') },
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})



//global filter vue
Vue.filter('upText',function(text){
    return text.toUpperCase();
});

Vue.filter('mataUang',function(text){
    //misalnya ada uang 1.000.000 ambil nilai ratusnya;
    let sisa,rupiah,ribuan;
    if (isNaN(text) || text==''){ rupiah = 0;}else{
        let	number_string = text.toString();
	    sisa 	= number_string.length % 3;
	    rupiah 	= number_string.substr(0, sisa);
	    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
    }
    return "Rp"+rupiah;
});

Vue.filter('mydate',function(test){
    return moment(test).format('Do MMMM YYYY');
});

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('example-component', require('./components/ExampleComponent.vue'));
//chat component
Vue.component('chat-message', require('./components/Chatcomponent/ChatMessage.vue'));
Vue.component('chat-log', require('./components/Chatcomponent/Chatlog.vue'));
Vue.component('chat-composer', require('./components/Chatcomponent/ChatComposer.vue'));
// Maps COmponent
//Vue.component('GmapMarker', require('vue2-google-maps/dist/components/marker'));
const app = new Vue({
    el: '#app',
    router
});
