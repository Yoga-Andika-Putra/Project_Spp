<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\User;
use App\Siswa;
use App\Spp;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{

   public function __construct(){
         $this->middleware([
            'auth',
            'privilege:admin&petugas'
         ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pembayaran' => Pembayaran::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id),
            'spp' => Spp::all(),
        ];

        return view('dashboard.entri-pembayaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $req->validate([
            'nisn' => 'required',
            'jumlah_bayar' => 'required|numeric',
            'status'=>'required | string',
            'spp' => 'required',
         ], $message);

         if(Siswa::where('nisn',$req->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
           return back();
            exit;
         endif;


         $siswa = Siswa::where('nisn',$req->nisn)->get();

         foreach($siswa as $val){
            $id_siswa = $val->id;
         }

         $store =  Pembayaran::create([
            'id_petugas' => auth()->user()->id,
            'id_siswa' => $id_siswa,
            'jumlah_bayar' => $req->jumlah_bayar,
            'status' => $req->status,
            'id_spp' => $req->spp,
         ]);

         if($store ) :
            Alert::success('Berhasil!', 'Data Berhasil di Tambahkan');

         else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal di Tambahkan');
         endif;

         return redirect('dashboard/pembayaran');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'edit' => Pembayaran::find($id),
            'user' => User::find(auth()->user()->id),
            'pembayaran' => Pembayaran::find($id),
            'spp' => Spp::all(),
         ];

         return view('dashboard.entri-pembayaran.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
         $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $req->validate([
            'nisn' => 'required',
            'spp' => 'required',
            'jumlah_bayar' => 'required|numeric',
            'status' => 'required',
         ], $message);

         $update = $pembayaran = Pembayaran::find($id);

         $pembayaran->update([
            'nisn' => $req->nisn,
            'id_spp' => $req->spp,
            'jumlah_bayar'=>$req->jumlah_bayar + $req->transaksi,
            'status' => $req->status
         ]);

         if(Siswa::where('nisn',$req->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
           return back();
            exit;
         endif;

         if($req->nisn != $pembayaran->siswa->nisn) :
            $siswa = Siswa::where('nisn',$req->nisn)->get();

            foreach($siswa as $val){
               $id_siswa = $val->id;
            }

             $pembayaran->update([
                'id_siswa' => $id_siswa,
                'jumlah_bayar'=>$req->jumlah_bayar + $req->transaksi,
                'status' => $req->status,
                'id_spp' => $req->spp,
            ]);
         endif;

         if($update) :
            Alert::success('Berhasil!', 'Data Berhasil di Edit');

         else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal di Edit');
         endif;

         return redirect('dashboard/pembayaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Pembayaran::find($id)->delete()) :
            Alert::success('Berhasil!', 'Pembayaran Berhasil di Hapus!');
         else :
            Alert::success('Terjadi Kesalahan!', 'Pembayaran Gagal di Tambahkan!');
         endif;

         return back();
    }
}
