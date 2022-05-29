<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
         'id_petugas','id_siswa','jumlah_bayar','status','id_spp','transaksi'
    ];

 /**
   * Belongs To Pembayaran -> User (petugas)
   *
   * @return void
   */
    public function users()
    {
         return $this->belongsTo(User::class,'id_petugas');
    }

    public function spp()
    {
         return $this->belongsTo(Spp::class,'id_spp');
    }
 /**
   * Has Many Pembayaran -> Siswa
   *
   * @return void
   */
    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'id_siswa','id','nisn');
    }

}
