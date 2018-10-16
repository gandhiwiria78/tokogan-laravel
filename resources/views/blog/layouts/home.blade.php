@extends('blog.master')
@section('title','TokoGan')

@section('artikel_jumbotron')
<div class="section-title text-center">
        <h2>Dapatkan Segera di sini</h2>
</div>
<div class="btns text-center">
    <span class="ml-3 mr-3"><a href="#"><i class="nav-icon fab fa-apple "></i> App Store</a></span>
    <span class="ml-3 mr-3" ><a href="#"><i class="nav-icon fas fa-play "></i> Google Play</a></span>
</div>
@endsection

@section('navbar')
    @include('blog.component.navbar')
@endsection

@section('jumbotron')
    @include('blog.component.jumbotron')
@endsection


@section('content')
<h3 class="m-4"><span>Flash Deal</span></h3>
<div class="col-12 clearfix mt-0">
<div class="owl-carousel mb-0">
    {{--  foreachkan semua di tabel produk  --}}
    @foreach ($produks as $produk)
    <div class="item"> 
        <a  href="#" class="col-md-3 col-sm-6 col-12 ">
            <div class="card">
                <div class="card-body p-2">
                    <div>
                        <img src="{{ $produk->image }}" class="img-item" alt="">
                        <div class="head-badge">
                            <div class="badge-s badge-large">
                                <div class="badge-content">xx%</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <span class="item-name ">{{ $produk->nama }} </span>
                        <hr>
                        <span class="item-price">Rp {{ formatUang($produk->harga) }}</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    {{--  endeforeach  --}}
</div>
{{--  {{ $produks->links() }}  --}}
    <i class="prevbtn nav-icon fas fa-angle-left"></i>
    <i class="nextbtn nav-icon fas fa-angle-right"></i>
</div>

{{-- Tampilkan Banner dengan 1 box besar di kanan , 1 setengah tinggi dari box besar dan dibawahnya ada 2 box banner kecil --}}
    <div class="row banner">
        <div class="col-md-6 pr-3">
            <img src="{{ asset('img/banner/banner1.jpg') }}"  class="img-fluid big" alt="">
        </div>
        <div class="col-md-4">
            <div class="row">
                <img src="{{ asset('img/banner/banner2.jpg') }}"  class="img-fluid medium" alt="">
                <div class="col-sm-12">
                    <div class="row pt-3">
                        <div class="col-6 p-0">
                            <img src="{{ asset('img/banner/banner3_1.jpg') }}" class="img-fluid small" alt="">
                        </div>
                        <div class="col-6 p-0">
                            <img src="{{ asset('img/banner/banner3_2.jpg') }}"  class="img-fluid small"  alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <img src="{{ asset('img/banner/banner4.jpg') }}" class="img-fluid smallside" alt="">
        </div>
    </div>
    
@endsection

@section('script')
<script src="{{ asset('js/owl.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            stagePadding: 15,
            margin:20,
            nav:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5,
                    nav:false,
                }
            }        
        })
        var owl = $('.owl-carousel');
        
        owl.owlCarousel();
        // Go to the next item
        $('.nextbtn').click(function() {
            owl.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.prevbtn').click(function() {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl.trigger('prev.owl.carousel', [300]);
        })    
    });
</script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
@endsection