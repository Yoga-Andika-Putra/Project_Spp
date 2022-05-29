@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item">SPP</li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
   <div class="row">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Edit SPP') }}</div>

                        <form method="post" action="{{ url('/dashboard/data-spp', $edit->id) }}">
                           @csrf
                           @method('put')

                           <div class="form-group">
                              <label>Tahun</label>
                              <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ $edit->tahun }}">
                              <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                           </div>

                           <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan">

                                    <option value="Januari" {{  $edit->bulan == 'Januari' ? 'selected' : '' }}>Januari</option>
                                    <option value="Februari" {{  $edit->bulan == 'Februari' ? 'selected' : '' }}>Februari</option>
                                    <option value="Maret" {{  $edit->bulan == 'Maret' ? 'selected' : '' }}>Maret</option>
                                    <option value="April" {{  $edit->jbulank == 'April' ? 'selected' : '' }}>April</option>
                                    <option value="Mei" {{  $edit->bulan == 'Mei' ? 'selected' : '' }}>Mei</option>
                                    <option value="Juni" {{  $edit->bulan == 'Juni' ? 'selected' : '' }}>Juni</option>
                                    <option value="Juli" {{  $edit->bulan == 'Juli' ? 'selected' : '' }}>Juli</option>
                                    <option value="Agustus" {{  $edit->bulan == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                    <option value="September" {{  $edit->bulan == 'September' ? 'selected' : '' }}>September</option>
                                    <option value="Oktober" {{  $edit->bulan == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                    <option value="November" {{  $edit->bulan == 'November' ? 'selected' : '' }}>November</option>
                                    <option value="Desember" {{  $edit->bulan == 'Desember' ? 'selected' : '' }}>Desember</option>

                                </select>
                         </div>
                         <span class="text-danger">@error('bulan') {{ $message }} @enderror</span>

                           <div class="form-group">
                              <label>Nominal</label>
                              <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ $edit->nominal }}">
                              <span class="text-danger">@error('nominal') {{ $message }} @enderror</span>
                           </div>

                           <a href="{{ url('dashboard/data-spp') }}" class="btn btn-primary btn-rounded">
                              <i class="mdi mdi-chevron-left"></i> Kembali
                           </a>

                           <button type="submit" class="btn btn-success btn-rounded  float-right">
                                 <i class="mdi mdi-check"></i> Simpan
                           </button>

                        </form>
                  </div>
              </div>
            </div>

	</div>
@endsection
