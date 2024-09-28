@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Partner</h4>
                        <form class="forms-sample" method="POST" action="{{ route('registered-partner.editPost', ['im3_outlet_id' => $partner->im3_outlet_id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="im3_outlet_id">Outlet ID IM3</label>
                                <input value="{{ $partner->im3_outlet_id }}" name="im3_outlet_id" type="text" class="form-control" id="im3_outlet_id" placeholder="Masukkan Outlet ID IM3">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_name">Nama Outlet IM3</label>
                                <input value="{{ $partner->im3_outlet_name }}" name="im3_outlet_name" type="text" class="form-control" id="im3_outlet_name" placeholder="Masukkan Nama Outlet IM3">
                            </div>
                            <div class="form-group">
                                <label for="submission_date">Tanggal Pengajuan</label>
                                <input value="{{ $partner->submission_date }}" name="submission_date" type="date" class="form-control" id="submission_date" placeholder="Pilih Tanggal Pengajuan">
                            </div>
                            <div class="form-group">
                                <label for="circle">Lingkaran</label>
                                <input value="{{ $partner->circle }}" name="circle" type="text" class="form-control" id="circle" placeholder="Masukkan Lingkaran">
                            </div>
                            <div class="form-group">
                                <label for="region">Wilayah</label>
                                <input value="{{ $partner->region }}" name="region" type="text" class="form-control" id="region" placeholder="Masukkan Wilayah">
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input value="{{ $partner->kecamatan }}" name="kecamatan" type="text" class="form-control" id="kecamatan" placeholder="Masukkan Kecamatan">
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <input value="{{ $partner->kabupaten }}" name="kabupaten" type="text" class="form-control" id="kabupaten" placeholder="Masukkan Kabupaten">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Garis Lintang</label>
                                <input value="{{ $partner->longitude }}" name="longitude" type="text" class="form-control" id="longitude" placeholder="Masukkan Garis Lintang">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Garis Bujur</label>
                                <input value="{{ $partner->latitude }}" name="latitude" type="text" class="form-control" id="latitude" placeholder="Masukkan Garis Bujur">
                            </div>
                            <div class="form-group">
                                <label for="qr_code">QR Code</label>
                                <input value="{{ $partner->qr_code }}" name="qr_code" type="text" class="form-control" id="qr_code" placeholder="Masukkan QR Code">
                            </div>
                            <div class="form-group">
                                <label for="outlet_name">Nama Outlet</label>
                                <input value="{{ $partner->outlet_name }}" name="outlet_name" type="text" class="form-control" id="outlet_name" placeholder="Masukkan Nama Outlet">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('registered-partner') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Mengambil elemen input file dan preview
    const imageUpload = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');

    // Fungsi untuk menampilkan preview image
    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            // Saat file sudah dibaca, tampilkan preview
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Menampilkan elemen img
            }

            reader.readAsDataURL(file); // Membaca file sebagai Data URL
        }
    });
</script>

@include('sweetalert::alert')
@endsection
