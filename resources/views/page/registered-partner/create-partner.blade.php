@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New Partner</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Outlet ID IM3</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="ID/NIK">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Outlet Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Circle</label>
                                <select class="form-control" id="exampleSelectGender">
                                    <option>Select Circle</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Area</label>
                                <select class="form-control" id="exampleSelectGender">
                                    <option>Select Area</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Region</label>
                                <select class="form-control" id="exampleSelectGender">
                                    <option>Select Region</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Sales Area</label>
                                <select class="form-control" id="exampleSelectGender">
                                    <option>Select Sales Area</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Micro Cluster</label>
                                <select class="form-control" id="exampleSelectGender">
                                    <option>Select Circle</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Upload Branding</label>
                                <input class="form-control" type="file" id="image-upload" accept="image/*">
                                <div id="preview-container">
                                    <img id="image-preview" src="#" alt="Image Preview" style="display:none;" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Upload PKS</label>
                                <input class="form-control" type="file" id="image-upload" accept="image/*">
                                <div id="preview-container">
                                    <img id="image-preview" src="#" alt="Image Preview" style="display:none;" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="#" class="btn btn-light">Cancel</a>
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
