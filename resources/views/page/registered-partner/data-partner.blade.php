@extends('layouts.template')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Registered Partner</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="py-3 row">
                            <div class="py-3 d-flex align-items-end">
                                <div class="col-md-2 d-flex flex-column">
                                    <label for="userIdInput2">Circle</label>
                                    <select name="circle" class="form-control" id="circle">
                                        <option value="">Pilih Circle</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <label for="userIdInput1">Region</label>
                                    <select name="region" class="form-control" id="region">
                                        <option value="">Pilih Region</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <label for="userIdInput1">Area</label>
                                    <select name="area" class="form-control" id="area">
                                        <option value="">Pilih Area</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <label for="userIdInput1">Sales Area</label>
                                    <select name="region" class="form-control" id="region">
                                        <option value="">Pilih Sales Area</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <label for="userIdInput1">Micro Cluster</label>
                                    <select name="region" class="form-control" id="region">
                                        <option value="">Pilih Cluster</option>
                                        <option value=""></option>
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
                            <button type="button" class="btn btn-primary btn-spacing" data-toggle="modal" data-target="#insertModal">
                                <i class="bi bi-download"></i>
                                Export Partner
                            </button>
                          @if (Auth::user()->role == 'Admin')
                          <a type="button" class="btn btn-primary" href="#">
                            <i class="bi bi-person"></i>
                            <i class="bi bi-plus"></i>
                            Create New Partner
                        </a>
                          @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Submition Date</th>
                                        <th class="text-center">ID Outlet</th>
                                        <th class="text-center">Branding</th>
                                        <th class="text-center">Dokumen PKS</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-center">19/09/2024</td>
                                        <td class="text-center">84681</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                Show File
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                Show File
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </button>
                                            @if (Auth::user()->role == 'Admin')
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                            @endif
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
