@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Partner</h4>
                        <form class="forms-sample" method="POST" action="{{ route('registered-partner.editPost', ['im3_outlet_id' => $partner->im3_outlet_id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="submission_date">Submission Date</label>
                                <input value="{{ $partner->submission_date }}" name="submission_date" type="date" class="form-control" id="submission_date" placeholder="Choose Submission Date">
                            </div>
                            <div class="form-group">
                                <label for="circle">Circle</label>
                                <select required name="circle" class="form-control" id="circle">
                                    <option value="" disabled selected>Pilih Circle</option>
                                    @foreach ($circle as $item)
                                    <option value="{{ $item }}" {{ $item == $partner->circle ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
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
                                    <!-- Jika level user adalah 'User', maka hanya ada satu opsi yang dipilih -->
                                    <option value="{{ Auth::user()->region }}" selected>{{ Auth::user()->region }}</option>
                                    @else
                                    <!-- Jika level user bukan 'User', tampilkan semua opsi dari database -->
                                    <option value="" disabled selected>Pilih Region</option>
                                    @foreach ($region as $item)
                                    <option value="{{ $item }}" {{ $item == $partner->region ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select required name="kecamatan" class="form-control" id="kecamatan">
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                    @foreach ($sales_area as $item)
                                    <option value="{{ $item }}" {{ $item == $partner->kecamatan ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select required name="kabupaten" class="form-control" id="kabupaten">
                                    <option value="" disabled selected>Pilih Kabupaten</option>
                                    @foreach ($area as $item)
                                    <option value="{{ $item }}" {{ $item == $partner->kabupaten ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan_unik">Kecamatan Unik</label>
                                <select required name="kecamatan_unik" class="form-control" id="kecamatan_unik">
                                    <option value="" disabled selected>Pilih Kabupaten</option>
                                    @foreach ($kecamatan_unik as $item)
                                    <option value="{{ $item }}" {{ $item == $partner->kecamatan_unik ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="kecamatan_unik">Kecamatan Unik</label>
                                <input value="{{ $partner->kecamatan_unik }}" name="kecamatan_unik" type="text" class="form-control" id="kecamatan_unik" placeholder="Enter Unique Kecamatan">
                            </div> -->
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input value="{{ $partner->longitude }}" name="longitude" type="text" class="form-control" id="longitude" placeholder="Enter Longitude">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input value="{{ $partner->latitude }}" name="latitude" type="text" class="form-control" id="latitude" placeholder="Enter Latitude">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_id">IM3 Outlet ID</label>
                                <input value="{{ $partner->im3_outlet_id }}" name="im3_outlet_id" type="text" class="form-control" id="im3_outlet_id" placeholder="Enter IM3 Outlet ID">
                            </div>
                            <div class="form-group">
                                <label for="im3_outlet_name">IM3 Outlet Name</label>
                                <input value="{{ $partner->im3_outlet_name }}" name="im3_outlet_name" type="text" class="form-control" id="im3_outlet_name" placeholder="Enter IM3 Outlet Name">
                            </div>
                            <div class="form-group">
                                <label for="3id_qr_code">3ID QR Code</label>
                                <input value="{{ $partner->{'3id_qr_code'} }}" name="3id_qr_code" type="text" class="form-control" id="3id_qr_code" placeholder="Enter 3ID QR Code">
                            </div>
                            <div class="form-group">
                                <label for="3id_outlet_name">3ID Outlet Name</label>
                                <input value="{{ $partner->{'3id_outlet_name'} }}" name="3id_outlet_name" type="text" class="form-control" id="3id_outlet_name" placeholder="Enter 3ID Outlet Name">
                            </div>
                            <div class="form-group">
                                <label for="service">Service</label>
                                <select name="service" class="form-control" id="service">
                                    <option value="1" {{ $partner->service === '1' ? 'selected' : '' }}>Done</option>
                                    <option value="0" {{ $partner->service !== '1' ? 'selected' : '' }}>Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branding">Branding</label>
                                <select name="branding" class="form-control" id="branding">
                                    <option value="1" {{ $partner->branding === '1' ? 'selected' : '' }}>Done</option>
                                    <option value="0" {{ $partner->branding !== '1' ? 'selected' : '' }}>Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_pks">PKS</label>
                                <select name="status_pks" class="form-control" id="status_pks">
                                    <option value="1" {{ $partner->status_pks === '1' ? 'selected' : '' }}>Done</option>
                                    <option value="0" {{ $partner->status_pks !== '1' ? 'selected' : '' }}>Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post_paid">Post Paid</label>
                                <select name="post_paid" class="form-control" id="post_paid">
                                    <option value="1" {{ $partner->post_paid === '1' ? 'selected' : '' }}>Done</option>
                                    <option value="0" {{ $partner->post_paid !== '1' ? 'selected' : '' }}>Not</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pks">Upload PKS</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pks" name="pks">
                                    <label class="custom-file-label" for="pks">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upload_branding">Upload Branding</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="upload_branding" name="upload_branding">
                                    <label class="custom-file-label" for="upload_branding">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_owner">Name Owner</label>
                                <input value="{{ $partner->name_owner }}" name="name_owner" type="text" class="form-control" id="name_owner" placeholder="Enter Owner Name" required>
                            </div>
                            <div class="form-group">
                                <label for="nik_owner">NIK Owner</label>
                                <input value="{{ $partner->nik_owner }}" name="nik_owner" type="text" class="form-control" id="nik_owner" placeholder="Enter Owner NIK" required>
                            </div>
                            <div class="form-group">
                                <label for="npwp_owner">NPWP Owner</label>
                                <input value="{{ $partner->npwp_owner }}" name="npwp_owner" type="text" class="form-control" id="npwp_owner" placeholder="Enter Owner NPWP" required>
                            </div>
                            <div class="form-group">
                                <label for="email_owner">Email Owner</label>
                                <input value="{{ $partner->email_owner }}" name="email_owner" type="email" class="form-control" id="email_owner" placeholder="Enter Owner Email" required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('registered-partner') }}" class="btn btn-light">Cancel</a>
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
        @if(Auth::user()-> level == 'User')
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

<script>
    $(document).ready(function() {
        $('#kecamatan_unik').select2({
            placeholder: "Pilih Kecamatan Unik",
            allowClear: true,
            width: '100%' // Ini penting agar Select2 menyesuaikan dengan lebar form-control Bootstrap
        });
    });
</script>

@include('sweetalert::alert')
@endsection