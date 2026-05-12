@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header text-white" style="background-color: #002699;">
            <h5 class="mb-0">EDIT DATA PELANGGAN</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label>Nama Pelanggan :</label>
                    <input type="text" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>No Tlp :</label>
                    <input type="text" name="nomor_telepon" value="{{ $pelanggan->nomor_telepon }}" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Jenis Kelamin :</label><br>
                    <input type="radio" name="jenis_kelamin" value="Laki - Laki" {{ $pelanggan->jenis_kelamin == 'Laki - Laki' ? 'checked' : '' }}> Laki - Laki
                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ $pelanggan->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} class="ml-2"> Perempuan
                </div>
                <div class="form-group mb-3">
                    <label>Alamat :</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ $pelanggan->alamat }}</textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">PERBARUI DATA</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary w-100 mt-2">BATAL</a>
            </form>
        </div>
    </div>
</div>
@endsection