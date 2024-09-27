@extends('layouts.template')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit User</h4>
                        <form id="form" class="forms-sample" action="{{ route('management-user.editPost', ['user_id' => $user->user_id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputName1">User ID/NIK</label>
                                <input value="{{ $user->user_id }}" type="text" class="form-control" id="user_id" name="user_id" placeholder="ID/NIK">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Full Name</label>
                                <input value="{{ $user->full_name }}" type="text" class="form-control" id="full_name" name="full_name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Type</label>
                                <input value="{{ $user->type }}" type="text" class="form-control" id="type" name="type" placeholder="Type">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Roles</label>
                                <input value="{{ $user->roles }}" type="text" class="form-control" id="roles" name="roles" placeholder="Type">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Region</label>
                                <input value="{{ $user->region }}" type="text" class="form-control" id="region" name="region" placeholder="Region">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Teritory</label>
                                <input value="{{ $user->teritory }}" type="text" class="form-control" id="teritory" name="teritory" placeholder="Teritor">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">User Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option>Select Status</option>
                                    <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Non Active" {{ $user->status == 'Non Active' ? 'selected' : '' }}>Non Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">User Level</label>
                                <select name="level" class="form-control" id="level">
                                    <option>Select Level</option>
                                    <option value="Admin" {{ $user->level == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="User" {{ $user->level == 'User' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <button type="submit" id="btn-submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="#" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('sweetalert::alert')
@endsection
