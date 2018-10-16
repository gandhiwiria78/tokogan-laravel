<?php

namespace App\Http\Controllers\blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProdukDetail;
use App\Kategori;

class homeController extends Controller
{
    //
    public function index(){
        // $produks = ProdukDetail::paginate(4);
        $produks = ProdukDetail::all();
        return view('blog.layouts.home',compact('produks'));
    }

    public function flashsale(Request $request){

        return Redirect::with('produk', 'flashValue');
    }

    public function register(){
        return view('blog.layouts.register');
    }
    public function addUsers(Request $request){
        
        return $request;
    }
    public function getprodukall(){
        $produks = ProdukDetail::all();
        return  $produks;
    }
}
