@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New Partner</h4>
                        <form class="forms-sample" method="POST" action="{{ route('registered-partner.createPost') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="submission_date">Submission Date</label>
                                <input required name="submission_date" type="date" class="form-control" id="submission_date" placeholder="Pilih Tanggal Pengajuan">
                            </div>
                            <div class="form-group">
                                <label for="circle">Circle</label>
                                <select required name="circle" class="form-control" id="circle">
                                    <option value="" disabled selected>Pilih Circle</option>
                                    @foreach ($circle as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <select
                                    required
                                    name="region"
                                    class="form-control"
                                    id="region"
                                    {{ Auth::user()->level == 'User' ? 'readonly disabled' : '' }}>
                                    @if(Auth::user()->level == 'User')
                                    <option value="{{ Auth::user()->region }}">{{ Auth::user()->region }}</option>
                                    @else
                                    <option value="" disabled selected></option>
                                    @foreach ($region as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select required name="kecamatan" class="form-control" id="kecamatan">
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                    @foreach ($sales_area as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select required name="kabupaten" class="form-control" id="kabupaten">
                                    <option value="" disabled selected>Pilih Kabupaten</option>
                                    @foreach ($area as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan_unik">Kecamatan Unik ( *Format Pengisian Kecamatan|Kabupaten)</label>
                                <input required name="kecamatan_unik" type="text" class="form-control" id="kecamatan_unik" placeholder="Masukkan Kecamatan Unik">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude (*Contoh Pengisian Longitude 100.1234590)</label>
                                <input required name="longitude" type="text" class="form-control" id="longitude" placeholder="Masukkan Garis Lintang">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude (*Contoh Pengisian Latitude 100.1234590)</label>
                                <input required name="latitude" type="text" class="form-control" id="latitude" placeholder="Masukkan Garis Bujur">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_id">IM3 Outlet ID</label>
                                <input name="im3_outlet_id" type="text" class="form-control" id="im3_outlet_id" placeholder="Masukkan Outlet ID IM3">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_name">IM3 Outlet Name</label>
                                <input required name="im3_outlet_name" type="text" class="form-control" id="im3_outlet_name" placeholder="Masukkan Nama Outlet IM3">
                            </div>
                            <div class="form-group">
                                <label for="3id_qr_code">3ID QR Code</label>
                                <input name="3id_qr_code" type="text" class="form-control" id="3id_qr_code" placeholder="Masukkan QR Code">
                            </div>
                            <div class="form-group">
                                <label for="3id_outlet_name">3ID Outlet Name</label>
                                <input name="3id_outlet_name" type="text" class="form-control" id="3id_outlet_name" placeholder="Masukkan Nama Outlet">
                            </div>
                            <div class="form-group">
                                <label for="service">Service</label>
                                <select required name="service" class="form-control" id="service">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branding">Branding</label>
                                <select required name="branding" class="form-control" id="branding">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_pks">PKS</label>
                                <select required name="status_pks" class="form-control" id="status_pks">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post_paid">PostPaid</label>
                                <select required name="post_paid" class="form-control" id="post_paid">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="1">Done</option>
                                    <option value="0">Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="upload_pks">Upload PKS</label>
                                <div class="custom-file">
                                    <input type="file" name="pks" class="custom-file-input" id="upload_pks" required>
                                    <label class="custom-file-label" for="upload_pks">Pilih File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upload_branding">Upload Branding</label>
                                <div class="custom-file">
                                    <input type="file" name="upload_branding" class="custom-file-input" id="upload_branding" required>
                                    <label class="custom-file-label" for="upload_branding">Pilih File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_owner">Name Owner</label>
                                <input required name="name_owner" type="text" class="form-control" id="name_owner" placeholder="Masukkan Nama Owner">
                            </div>
                            <div class="form-group">
                                <label for="nik_owner">NIK Owner</label>
                                <input required name="nik_owner" type="text" class="form-control" id="nik_owner" placeholder="Masukkan NIK Owner">
                            </div>
                            <div class="form-group">
                                <label for="npwp_owner">NPWP Owner</label>
                                <input required name="npwp_owner" type="text" class="form-control" id="npwp_owner" placeholder="Masukkan NPWP">
                            </div>
                            <div class="form-group">
                                <label for="email_owner">Email Owner</label>
                                <input required name="email_owner" type="email" class="form-control" id="email_owner" placeholder="Masukkan Email">
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

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const selectElement = $('#region');
        selectElement.select2({
            placeholder: "Masukkan Region",
            allowClear: true,
            width: '100%'
        });

        // Nonaktifkan select2 jika user level adalah 'User'
        @if(Auth::user()->level == 'User')
            selectElement.prop('disabled', true);
        @endif
    });
</script>

<script>
    $(document).ready(function() {
        $('#kabupaten').select2({
            placeholder: "Masukkan Wilayah",
            allowClear: true,
            width: '100%' // Ini penting agar Select2 menyesuaikan dengan lebar form-control Bootstrap
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#kecamatan').select2({
            placeholder: "Masukkan Wilayah",
            allowClear: true,
            width: '100%' // Ini penting agar Select2 menyesuaikan dengan lebar form-control Bootstrap
        });
    });
</script>



@include('sweetalert::alert')
@endsection