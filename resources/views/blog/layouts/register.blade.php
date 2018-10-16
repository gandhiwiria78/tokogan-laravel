@extends('blog.master')
@section('title','Daftar TokoGan')
{{-- @section('navbar')
    @include('blog.component.navbar')
@endsection --}}

@section('artikel_jumbotron')
<div class="col-12 form-center">
    <img src="/img/blog/navbar.png" alt="">
    <hr>
    <h3> Daftar Akun Baru</h3>
    <div class="form-register form-group">

        {!! Form::open(['url' => 'register']) !!}
            {{  Form::text('nama', '',['class' => 'form-control','placeholder'=> 'Nama Lengkap Anda'])}}
            {{  Form::text('email', '',['class' => 'form-control','placeholder'=>'Email Aktif Anda']) }}
            {{  Form::text('hp', '',['class' => 'form-control','type'=>"tel",'placeholder'=>'Nomor Handpone']) }}
            {{  Form::select('gender',[
                'laki'=>'Laki-Laki',
                'perempuan'=>'perempuan'
            ],null,['class'=>'form-control','placeholder' => 'Jenis Gender']) }}
            {{  Form::password('password', ['class' => 'form-control','placeholder'=>'Set Kata Sandi'])}}
            {{  Form::password('repeatPas', ['class' => 'form-control','placeholder'=>'Ulang Kata sandi'])}}
        
            <div class="mb-5 mt-5">
                Dengan klik daftar, kamu telah menyetujui
                <a href="#" class="">Aturan Penggunaan</a>
                dan
                <a href="#">Kebijakan Privasi</a>
                dari Tokogan
            </div>
            {{ Form::submit('Daftar',['class'=>'btn-primary','type'=>'submit' ]) }}
        {!! Form::close() !!}
    </div>
</div>
   

@endsection
