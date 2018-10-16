<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Produk;
use App\ProdukDetail;
use App\Kategori;

class ProdukDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //CARA 2: untuk dapat kan banyak kategori untuk 1 judul
        //$metaproduk = DB::select('SELECT `id_produk`,`id_kategori` FROM `produk` group by `id_produk`');
        // $metaproduk=DB::select('SELECT `a`.`id_kategori`, `b`.`id`, `categori`.`judul`
        // FROM `produk` AS `a`, `produk_detail` AS `b`, `categori`
        // GROUP by `a`.`id_kategori`');
        $produk =ProdukDetail::orderBy('id', 'asc')->paginate(20);
        return ['data'=>$produk];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Decode gambar
        $tambah = new ProdukDetail();
        $tambah->nama = $request['title'];
        $tambah->deskripsi = $request['deskripsi'];
        $tambah->harga = $request['harga'];
        //$tambah->kategori = $request['kategori'];

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

        if(file_put_contents($path,$decode)){
            $tambah->image = $filename;
        }
        $tambah->save();

        //insert dengan mengecek terlebih dahulu kategori dan
        $kategori = $request['kategori'];
        $idlast = ProdukDetail::orderBy('created_at', 'desc')->first();
        foreach ($kategori as $value) {
           $idkategori = Kategori::where('judul',$value['judul'])->first();
           Produk::create([
               'id_produk'=> $idlast['id'],
               'id_kategori'=> $idkategori['id']
           ]);
        }



        return ['message'=>'success'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
