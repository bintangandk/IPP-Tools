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
                                <label for="exampleInputName1">User ID/NIK</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="ID/NIK">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Full Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Type</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Type">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Region</label>
                                <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Region">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Teritory</label>
                                <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Teritor">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">User Status</label>
                                <select class="form-control" id="exampleSelectGender">
                                    <option>Select Status</option>
                                    <option>Active</option>
                                    <option>Non Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword4">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
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

@endsection