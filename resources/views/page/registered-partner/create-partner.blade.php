@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New Partner</h4>
                        <form class="forms-sample" method="POST" action="{{ route('registered-partner.createPost') }}">
                            @csrf
                            <div class="form-group">
                                <label for="im3_outlet_id">Outlet ID IM3</label>
                                <input required name="im3_outlet_id" type="text" class="form-control" id="im3_outlet_id" placeholder="Masukkan Outlet ID IM3">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_name">Name Outlet IM3</label>
                                <input required name="im3_outlet_name" type="text" class="form-control" id="im3_outlet_name" placeholder="Masukkan Nama Outlet IM3">
                            </div>
                            <div class="form-group">
                                <label for="submission_date">Submition Date</label>
                                <input required name="submission_date" type="date" class="form-control" id="submission_date" placeholder="Pilih Tanggal Pengajuan">
                            </div>
                            <div class="form-group">
                                <label for="circle">Circle</label>
                                <input required name="circle" type="text" class="form-control" id="circle" placeholder="Masukkan Lingkaran">
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input required name="region" value="{{ Auth::user()->level == 'User' ? Auth::user()->region : '' }}" type="text" class="form-control" id="region" placeholder="Masukkan Wilayah" {{ Auth::user()->level == 'User' ? 'readonly' : '' }} >
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Subdistrict</label>
                                <input required name="kecamatan" type="text" class="form-control" id="kecamatan" placeholder="Masukkan Kecamatan">
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Regency</label>
                                <input required name="kabupaten" type="text" class="form-control" id="kabupaten" placeholder="Masukkan Kabupaten">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input required name="longitude" type="text" class="form-control" id="longitude" placeholder="Masukkan Garis Lintang">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input required name="latitude" type="text" class="form-control" id="latitude" placeholder="Masukkan Garis Bujur">
                            </div>
                            <div class="form-group">
                                <label for="qr_code">QR Code</label>
                                <input required name="qr_code" type="text" class="form-control" id="qr_code" placeholder="Masukkan QR Code">
                            </div>
                            <div class="form-group">
                                <label for="outlet_name">Name Outlet</label>
                                <input required name="outlet_name" type="text" class="form-control" id="outlet_name" placeholder="Masukkan Nama Outlet">
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
