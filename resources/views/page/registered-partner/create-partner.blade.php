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
                                <label for="submission_date">Submition Date</label>
                                <input required name="submission_date" type="date" class="form-control" id="submission_date" placeholder="Pilih Tanggal Pengajuan">
                            </div>
                            <div class="form-group">
                                <label for="circle">Circle</label>
                                <input required name="circle" type="text" class="form-control" id="circle" placeholder="Masukkan Lingkaran">
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input required name="region" value="{{ Auth::user()->level == 'User' ? Auth::user()->region : '' }}" type="text" class="form-control" id="region" placeholder="Masukkan Wilayah" {{ Auth::user()->level == 'User' ? 'readonly' : '' }}>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input required name="kecamatan" type="text" class="form-control" id="kecamatan" placeholder="Masukkan Kecamatan">
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <input required name="kabupaten" type="text" class="form-control" id="kabupaten" placeholder="Masukkan Kabupaten">
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kecamatan Unik</label>
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
                                <label for="im3_outlet_id">IM3 Outlet ID</label>
                                <input required name="im3_outlet_id" type="text" class="form-control" id="im3_outlet_id" placeholder="Masukkan Outlet ID IM3">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_name">IM3 Outlet Name</label>
                                <input required name="im3_outlet_name" type="text" class="form-control" id="im3_outlet_name" placeholder="Masukkan Nama Outlet IM3">
                            </div>
                            <div class="form-group">
                                <label for="qr_code">3ID QR Code</label>
                                <input required name="qr_code" type="text" class="form-control" id="qr_code" placeholder="Masukkan QR Code">
                            </div>
                            <div class="form-group">
                                <label for="outlet_name">3ID Outlet Name</label>
                                <input required name="outlet_name" type="text" class="form-control" id="outlet_name" placeholder="Masukkan Nama Outlet">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Service</label>
                                <select name="service" class="form-control" id="service">
                                    <option>Select</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Branding</label>
                                <select name="status_branding" class="form-control" id="status_branding">
                                    <option>Select</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">PostPaid</label>
                                <select name="postpaid" class="form-control" id="postpaid">
                                    <option>Select</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="upload_pks">Upload PKS</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="upload_pks">
                                    <label class="custom-file-label" for="upload_pks">Pilih File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upload_branding">Upload Branding</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="upload_branding">
                                    <label class="custom-file-label" for="upload_branding">Pilih File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_owner">Name Owner</label>
                                <input required name="name_owner" type="text" class="form-control" id="#" placeholder="Masukkan Nama Owner">
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK Owner</label>
                                <input required name="nik" type="text" class="form-control" id="#" placeholder="Masukkan NIK Owner">
                            </div>
                            <div class="form-group">
                                <label for="npwp">NPWP Owner</label>
                                <input required name="npwp" type="text" class="form-control" id="#" placeholder="Masukkan NPWP">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Owner</label>
                                <input required name="email" type="text" class="form-control" id="#" placeholder="Masukkan Email">
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