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
                            <form method="GET">
                                <div class="py-3 d-flex align-items-end">
                                    <div class="col-md-4 d-flex flex-column">
                                        <label for="userIdInput1">User ID</label>
                                            <input name="user_id" type="text" id="search" class="form-control" value="{{ request('user_id') }}" placeholder="Pencarian Berdasarkan User Id">
                                    </div>
                                    <div class="col-md-4 d-flex flex-column">
                                        <label for="userIdInput2">Role</label>
                                        <select name="role" class="form-control" id="role" required>
                                            <option value="semua" {{ request('role') == 'semua' ? 'selected' : '' }}>Semua</option>
                                            @foreach ($users_roles as $item)
                                                <option value="{{ $item }}" {{ request('role') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="py-3 d-flex justify-content-end">
                            <form method="GET">
                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                <input type="hidden" name="role" value="{{ request('role') }}">
                                <input type="hidden" name="export" value="true">
                                <button type="submit" class="btn btn-primary btn-spacing" data-toggle="modal" data-target="#insertModal">
                                    <i class="bi bi-upload"></i>
                                    Export Partner
                                </button>
                            </form>

                            <a type="button" class="btn btn-primary btn-spacing" href="{{ url('create-user') }}">
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
                                    @foreach ($users as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->user_id }}</td>
                                        <td class="text-center">{{ $item->full_name }}</td>
                                        <td class="text-center">{{ $item->type }}</td>
                                        <td class="text-center">{{ $item->region }}</td>
                                        <td class="text-center">{{ $item->teritory }}</td>
                                        <td class="text-center">{{ $item->roles }}</td>
                                        <td class="text-center"><label class="badge badge-success">{{ $item->status }}</label></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('management-user.edit', ['user_id' => Crypt::encrypt($item->user_id)]) }}">
                                                    <button class="btn btn-primary mr-2">
                                                        <i class="bi bi-pencil"></i>
                                                        Edit
                                                    </button>
                                                </a>
                                                <form id="form-delete" action="{{ route('management-user.delete', ['user_id' => $item->user_id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger delete-button">
                                                        <i class="bi bi-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Menggunakan event delegation untuk menangani tombol hapus
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-button')) {
            e.preventDefault();
            const form = e.target.closest('form'); // Menemukan form terdekat
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
</script>



@include('sweetalert::alert')
@endsection
