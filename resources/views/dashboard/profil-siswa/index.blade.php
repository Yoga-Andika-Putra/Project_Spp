@extends('layouts.dashboard-siswa')

@section('breadcrumb')
   <li class="breadcrumb-item">Dashboard</li>
   <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')

   <div class="row">
      <div class="col-md-12">

         <div class="card">
            <div class="card-body">
               <div class="card-title">Profil Siswa</div>

            </div>

               <!--  Row -->
                              @foreach($siswa as $profil)
                                <div class="d-flex flex-row comment-row">
                                    <i class="mdi mdi-account display-3"></i>
                                    <div class="comment-text active w-100">
                                    <hr>
                                        <span class="m-b-15 d-block">
                                             <ul class="list-group list-group-flush">
                                                <table class="table">
                                                <li class="list-group-item">Nama Peserta Didik  : {{$profil->nama }}</li>
                                                <li class="list-group-item">Kelas : {{ $profil->kelas->nama_kelas }}</li>
                                                <li class="list-group-item">NIS / NISN  : {{ $profil->nisn.' / ' .$profil->nis }}</li>
                                                <li class="list-group-item">Jenis Kelamin  : {{ $profil->jk }}</li>
                                                <li class="list-group-item">Nomor Telepon  : {{ $profil->nomor_telp }}</li>
                                                <li class="list-group-item">Alamat  : {{ $profil->alamat }}</li>
                                                </table>
                                            </ul>
                                        </span>
                                        <div class="comment-footer ">
                                            <span class="text-muted float-right">{{ $profil->created_at->format('M d, Y') }}</span>
                                            <span class="action-icons active">
                                                    <a href="{{ url('dashboard/pembayaran/'. $profil->id .'/edit') }}"><i class="ti-pencil-alt"></i></a>
                                                </span>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                          <!-- Pagination -->
					@if($pembayaran->lastPage() != 1)
						<div class="btn-group float-right mt-4">
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

                            </div>

            </div>


      </div>
   </div>

@endsection
