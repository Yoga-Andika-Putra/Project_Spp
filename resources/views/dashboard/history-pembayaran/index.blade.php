@extends('layouts.dashboard')

@section('breadcrumb')
   <li class="breadcrumb-item">Dashboard</li>
   <li class="breadcrumb-item active">Histori</li>
@endsection

@section('content')

   <div class="row">
      <div class="col-md-12">

         <div class="card">
            <div class="card-body">
               <div class="card-title">Histori Pembayaran</div>

                  @foreach($pembayaran as $value)
                     <div class="border-top">
                        <div class="float-right">
                           <i class="mdi mdi-check text-success"></i> {{ $value->created_at->format('d M, Y') }}
                        </div>
                        <div class="mt-4 text-uppercase">
                           {{ $value->siswa->nama .' - '. $value->siswa->kelas->nama_kelas }}
                        </div>
                            <div>NISN {{$value->siswa->nisn }}</div>
                           <div>SPP Bulan <b class="text-capitalize">{{ $value->spp->bulan.' ' .$value->spp->tahun }}</b></div>
                           <div>Nominal SPP Rp.{{ $spp = $value->spp->nominal }}</div>
                           <div>Bayar Rp.{{ $bayar = $value->jumlah_bayar +  $value->transaksi}}</div>
                           <div>Status <b class="text-capitalize">{{ $status = $value->status }}</b></div>
                           <div>Tunggakan Rp.{{ $spp - $bayar }}</div>
                     </div>
                  @endforeach
                         <!-- Pagination -->
					@if($pembayaran->lastPage() != 1)
						<div class="btn-group float-right">
						   <a href="{{ $pembayaran->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $pembayaran->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $pembayaran->currentPage() ? 'active' : '' }}" href="{{ $pembayaran->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $pembayaran->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->

                  @if(count($pembayaran) == 0)
                      <div class="text-center">Tidak ada histori pembayaran</div>
                  @endif

            </div>
         </div>

      </div>
   </div>

@endsection
