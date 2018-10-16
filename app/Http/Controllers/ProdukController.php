<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Kategori;
use App\Produk;

class ProdukController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function tambah(Request $request){

        $tambah = new Kategori();
        $tambah->judul = $request['title'];
        $tambah->deskripsi = $request['deskripsi'];

        $img = $request['image'];
        $exploded = explode(",",$img);

        if(str_contains($exploded[0], 'gif')){
            $ext = 'gif';
        }else if(str_contains($exploded[0], 'png')){
            $ext = 'png';
        }else{
            $ext = 'jpg';
        }
        $decode = base64_decode($exploded[1]);
        $filename = "/img/galery/" . str_random() . "." . $ext;
        //path of your local folder
        $path = public_path() . $filename;

        //     // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image

        if(file_put_contents($path,$decode)){

        }
        $tambah->image = $filename;
        $tambah->save();

       return 'success';
        //return redirect()->to('/');
    }

    public function update($id){

        return $id;
    }

    function decodeimage($image){

    }
}
