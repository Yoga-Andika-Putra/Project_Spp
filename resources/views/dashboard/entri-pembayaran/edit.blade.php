@extends('layouts.dashboard')

@section('breadcrumb')
   <li class="breadcrumb-item">Dashboard</li>
   <li class="breadcrumb-item">Pembayaran</li>
   <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

   <div class="row">
      <div class="col-md-12">

         <div class="card">
            <div class="card-body">
               <div class="card-title">Edit Pembayaran</div>

                  <form method="post" action="{{ url('dashboard/pembayaran', $pembayaran->id) }}">
                     @csrf
                     @method('put')

                     <div class="form-group">
                        <label>NISN Siswa</label>
                        <input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ $edit->siswa->nisn }}">
                        <span class="text-danger">@error('nisn') {{ $message }} @enderror</span>
                     </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                       <label class="input-group-text">
                          Bulan
                       </label>
                    </div>
                    <select name="spp" class="custom-select @error('spp') is-invalid @enderror" {{ count($spp) == 0 ? 'disabled' : '' }}>
                       @if(count($spp) == 0)
                          <option>Pilihan tidak ada</option>
                       @else
                             @foreach($spp as $value)
                                <option value="{{ $value->id }}" {{ $pembayaran->id_spp == $value->id ? 'selected' : '' }}>{{ $value->tahun.' - '. $value->bulan.' - '. $value->nominal }}</option>
                             @endforeach
                       @endif
                   </select>
                 </div>
                 <span class="text-danger">@error('spp') {{ $message }} @enderror</span>

                 <div class="form-group">
                    <label>Jumlah Bayar</label>
                    <input type="number" class="form-control" @error('jumlah_bayar') is-invalid @enderror name="jumlah_bayar" value="{{ $edit->jumlah_bayar }}" readonly>
                    </li>
                    <span class="text-danger">@error('jumlah_bayar') {{ $message }} @enderror</span>
                 </div>

                 <div class="form-group">
                    <label>Tunggakan Rp.</label>
                    <li class="form-control">Rp. {{ $edit->spp->nominal - $edit->jumlah_bayar }}</li>
                 </div>

                 <div class="form-group">
                    <label>Bayar</label>
                    <input type="number" class="form-control @error('transaksi') is-invalid @enderror" name="transaksi" value="{{old('transaksi') }}" placeholder="Rp. ">
                    <span class="text-danger">@error('transaksi') {{ $message }} @enderror</span>
                 </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <label class="input-group-text">
                              STATUS
                           </label>
                        </div>
                        <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                 <option value="LUNAS" {{ $pembayaran->status == 'LUNAS' ? 'selected' : '' }}>LUNAS</option>
                                 <option value="BELUM-Lunas" {{ $pembayaran->status == 'BELUM-Lunas' ? 'selected' : '' }}>BELUM-Lunas</option>
                       </select>
                     </div>

                   <a href="{{ url('dashboard/pembayaran') }}" class="btn btn-primary btn-rounded">
                     <i class="mdi mdi-chevron-left"></i>Kembali
                   </a>
                    <button type="submit" class="btn btn-success btn-rounded float-right mt-3">
                        <i class="mdi mdi-check"></i> {{ __('Simpan') }}
                    </button>

                </form>

            </div>
         </div>

      </div>
   </div>

@endsection

