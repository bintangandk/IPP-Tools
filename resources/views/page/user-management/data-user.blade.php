@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">User Management</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="py-3 row">
                            <div class="py-3 d-flex align-items-end">
                                <div class="col-md-4 d-flex flex-column">
                                    <label for="userIdInput1">User ID</label>
                                    <input type="text" id="userIdInput1" class="form-control" placeholder="Pencarian Berdasarkan User Id 1">
                                </div>
                                <div class="col-md-4 d-flex flex-column">
                                    <label for="userIdInput2">Role</label>
                                    <select name="role" class="form-control" id="role" required>
                                        <option value="">Pilih Role</option>
                                        <option value="">CSE/RSE</option>
                                        <option value="">CSE/RSE</option>
                                        <option value="">CSE/RSE</option>
                                        <option value="">CSE/RSE</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex">
                                    <button class="btn btn-primary">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-spacing" data-toggle="modal" data-target="#insertModal">
                                <i class="bi bi-upload"></i>
                                Import Partner
                            </button>
                            <a type="button" class="btn btn-primary btn-spacing" href="#">
                                <i class="bi bi-person"></i>
                                <i class="bi bi-plus"></i>
                                Create New User
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Region</th>
                                        <th class="text-center">Teritory</th>
                                        <th class="text-center">Roles</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">53275531</td>
                                        <td class="text-center">Agus</td>
                                        <td class="text-center">Region Team</td>
                                        <td class="text-center">West Java</td>
                                        <td class="text-center">MC-Banjar</td>
                                        <td class="text-center">CSE/RSE</td>
                                        <td class="text-center"><label class="badge badge-success">Active</label></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">53275531</td>
                                        <td class="text-center">Agus</td>
                                        <td class="text-center">Region Team</td>
                                        <td class="text-center">West Java</td>
                                        <td class="text-center">MC-Banjar</td>
                                        <td class="text-center">CSE/RSE</td>
                                        <td class="text-center"><label class="badge badge-success">Active</label></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">53275531</td>
                                        <td class="text-center">Agus</td>
                                        <td class="text-center">Region Team</td>
                                        <td class="text-center">West Java</td>
                                        <td class="text-center">MC-Banjar</td>
                                        <td class="text-center">CSE/RSE</td>
                                        <td class="text-center"><label class="badge badge-success">Active</label></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">53275531</td>
                                        <td class="text-center">Agus</td>
                                        <td class="text-center">Region Team</td>
                                        <td class="text-center">West Java</td>
                                        <td class="text-center">MC-Banjar</td>
                                        <td class="text-center">CSE/RSE</td>
                                        <td class="text-center"><label class="badge badge-success">Active</label></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">53275531</td>
                                        <td class="text-center">Agus</td>
                                        <td class="text-center">Region Team</td>
                                        <td class="text-center">West Java</td>
                                        <td class="text-center">MC-Banjar</td>
                                        <td class="text-center">CSE/RSE</td>
                                        <td class="text-center"><label class="badge badge-success">Active</label></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">53275531</td>
                                        <td class="text-center">Agus</td>
                                        <td class="text-center">Region Team</td>
                                        <td class="text-center">West Java</td>
                                        <td class="text-center">MC-Banjar</td>
                                        <td class="text-center">CSE/RSE</td>
                                        <td class="text-center"><label class="badge badge-success">Active</label></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection
