@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('content')

   <div class="alert alert-success text-center"><b>Selamat Datang</b> di aplikasi pembayaran SPP Sekolah</div>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="card-title">Pengguna</div>
               <div class="comment-widgets scrollable">

                              <!--  Row -->

    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="alert alert-success text-center">
              <div>
                <li class="sidebar-item">
                    <i class="mdi mdi-account-outline"></i>
                    </a>
                    <p>Jumlah Siswa</p>
                    {{ $siswa->count()}}
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="alert alert-danger text-center">
              <div>
                <li class="sidebar-item">
                    <i class="mdi mdi-account-outline"></i>
                    </a>
                    <p>Jumlah Petugas</p>
                    {{ $user->count()}}
              </div>
            </div>
          </div>
        </div>
        </div>
    </section>
</div>
</div>
</div>
</div>
</div>



    <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-body">
                 <div class="card-title">Histori Terbaru</div>
                    <div class="comment-widgets scrollable">

                              @foreach($pembayaran as $history)
                                <div class="d-flex flex-row comment-row">
                                    <i class="mdi mdi-account display-3"></i>
                                    <div class="comment-text active w-100">
                                    <hr>
                                    <span class="badge badge-success badge-rounded float-right">{{ $history->created_at->diffforHumans() }}</span>
                                        <h6 class="font-medium">{{ $history->siswa->nama }}</h6>
                                        <span class="m-b-15 d-block">
                                             <ul class="list-group list-group-flush">
                                                <li class="list-group-item">NISN {{ $history->siswa->nisn}}</li>
                                                <li class="list-group-item">Kelas {{ $history->siswa->kelas->nama_kelas }}</li>
                                                <li class="list-group-item">Tunggakan Rp.{{$history->spp->nominal - $history->jumlah_bayar - $history->transaksi }}</li>
                                                <li class="list-group-item">SPP Bulan <b  class="text-capitalize text-bold">{{ $history->spp->bulan }} {{ $history->spp->tahun }} {{ $history->status }}</b></li>
                                           </ul>
                                        </span>
                                        <div class="comment-footer ">
                                            <span class="text-muted float-right">{{ $history->created_at->format('M d, Y') }}</span>
                                            <span class="action-icons active">
                                                    <a href="{{ url('dashboard/pembayaran/'. $history->id .'/edit') }}"><i class="ti-pencil-alt"></i></a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @if(count($pembayaran) == 0)
				  			   <div class="text-center"> Tidak ada histori!</div>
					         @endif
                            </div>

         </div>
      </div>
   </div>
</div>

@endsection
