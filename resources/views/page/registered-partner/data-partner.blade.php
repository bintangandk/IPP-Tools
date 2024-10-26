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
                            <form method="GET">
                                @csrf
                                <div class="py-3 d-flex align-items-end">
                                    @if (auth()->user()->level == 'Admin')
                                    <div class="col-md-4 d-flex flex-column">
                                        <label for="userIdInput2">Circle</label>
                                        <select name="circle" class="form-control" id="circle">
                                            <option value="semua"
                                                {{ request('circle') == 'semua' ? 'selected' : '' }}>All</option>
                                            @foreach ($circle as $item)
                                            <option value="{{ $item }}"
                                                {{ request('circle') == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <div class="col-md-4 d-flex flex-column">
                                        <label for="userIdInput1">Region</label>
                                        <select name="region" class="form-control" id="region">
                                            <option value="semua" {{ request('region') == 'semua' ? 'selected' : '' }}>
                                                Semua</option>
                                            @foreach ($region as $item)
                                            <option value="{{ $item }}"
                                                {{ request('region') == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex flex-column">
                                        <label for="userIdInput1">Area</label>
                                        <select name="area" class="form-control" id="area">
                                            <option value="semua" {{ request('area') == 'semua' ? 'selected' : '' }}>Semua</option>
                                            @foreach ($area as $item)
                                            <option value="{{ $item }}"
                                                {{ request('area') == $item ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-2 d-flex flex-column">
                                            <label for="userIdInput1">Sales Area</label>
                                            <select name="sales_area" class="form-control" id="sales_area">
                                                <option value="semua"
                                                    {{ request('sales_area') == 'semua' ? 'selected' : '' }}>All</option>
                                                @foreach ($sales_area as $item)
                                                    <option value="{{ $item }}"
                                                        {{ request('sales_area') == $item ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div> -->
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary">
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="py-3 d-flex justify-content-end">
                            <form id="importForm" action="{{ route('registered-partner.import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" id="fileInput" required
                                    style="opacity: 0; visibility: hidden;" onchange="this.form.submit()">
                                <label for="fileInput" class="btn btn-primary btn-spacing" data-toggle="modal"
                                    data-target="#insertModal">
                                    <i class="bi bi-upload"></i>
                                    Import Partner
                                </label>
                            </form>
                            <form method="GET">
                                @csrf
                                <input type="hidden" name="export" value="true">
                                <input type="hidden" name="circle" value="{{ request('circle') }}">
                                <input type="hidden" name="region" value="{{ request('region') }}">
                                <input type="hidden" name="area" value="{{ request('area') }}">
                                <input type="hidden" name="sales_area" value="{{ request('sales_area') }}">
                                <button type="submit" class="btn btn-primary btn-spacing" data-toggle="modal"
                                    data-target="#insertModal">
                                    <i class="bi bi-download"></i>
                                    Export Partner
                                </button>
                            </form>
                            <a type="button" class="btn btn-primary" href="{{ url('create-partner') }}">
                                <i class="bi bi-person"></i>
                                <i class="bi bi-plus"></i>
                                Create New Partner
                            </a>
                        </div>
                        <div class="py-3 d-flex justify-content-end w-30">
                            <form method="GET" action="{{ route('registered-partner') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" style="margin-left: 15px;">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Submition Date</th>
                                        <th class="text-center">Circle</th>
                                        <th class="text-center">Region</th>
                                        <th class="text-center">Kecamatan</th>
                                        <th class="text-center">Kabupaten</th>
                                        <th class="text-center">Kecamatan Unik</th>
                                        <th class="text-center">Latitude</th>
                                        <th class="text-center">Longitude</th>
                                        <th class="text-center">IM3 Outlet ID</th>
                                        <th class="text-center">IM3 Outlet Name</th>
                                        <th class="text-center">3ID QR Code</th>
                                        <th class="text-center">3ID Outlet Name</th>
                                        <th class="text-center">Status Service</th>
                                        <th class="text-center">Status Branding</th>
                                        <th class="text-center">Status PKS</th>
                                        <th class="text-center">Post Paid</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registered_partner as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->submission_date)->format('d F Y') }}
                                        </td>
                                        <td class="text-center">{{ $item->circle }}</td>
                                        <td class="text-center">{{ $item->region }}</td>
                                        <td class="text-center">{{ $item->kecamatan }}</td>
                                        <td class="text-center">{{ $item->kabupaten }}</td>
                                        <td class="text-center">{{ $item->kecamatan_unik }}</td>
                                        <td class="text-center">{{ $item->longitude }}</td>
                                        <td class="text-center">{{ $item->latitude }}</td>
                                        <td class="text-center">{{ $item->im3_outlet_id }}</td>
                                        <td class="text-center">{{ $item->im3_outlet_name }}</td>
                                        <td class="text-center">{{ $item->{'3id_qr_code'} }}</td>
                                        <td class="text-center">{{ $item->{'3id_outlet_name'} }}</td>
                                        <td class="text-center"><label class="badge {{ $item->service === '1' ? 'badge-success' : 'badge-danger' }}">{{ $item->service == '1' ? 'Done' : 'Not' }}</td>
                                        <td class="text-center"><label class="badge {{ $item->branding === '1' ? 'badge-success' : 'badge-danger' }}">{{ $item->branding == '1' ? 'Done' : 'Not' }}</td>
                                        <!-- <td class="text-center">
                                            <label class="badge {{ $item->pks ? 'badge-success' : 'badge-danger' }}">
                                                {{ $item->pks ? 'Done' : 'Not' }}
                                            </label>
                                        </td> -->
                                        <td class="text-center"><label class="badge {{ $item->status_pks === '1' ? 'badge-success' : 'badge-danger' }}">{{ $item->status_pks == '1' ? 'Done' : 'Not' }}</td>
                                        <td class="text-center"><label class="badge {{ $item->post_paid === '1' ? 'badge-success' : 'badge-danger' }}">{{ $item->post_paid == '1' ? 'Done' : 'Not' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a
                                                    href="{{ route('registered-partner.edit', ['im3_outlet_id' => Crypt::encrypt($item->im3_outlet_id)]) }}">
                                                    <button class="btn btn-primary mr-2">
                                                        <i class="bi bi-pencil"></i>
                                                        Edit
                                                    </button>
                                                </a>
                                                <form id="form"
                                                    action="{{ route('registered-partner.delete', ['im3_outlet_id' => Crypt::encrypt($item->im3_outlet_id)]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-button">
                                                        <i class="bi bi-trash"></i>
                                                        Delete
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
                            <!-- Bootstrap Pagination -->
                            <div>
                                {{ $registered_partner->appends(request()->input())->links('pagination::bootstrap-5') }}
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
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-button')) {
            e.preventDefault();
            const form = e.target.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                input: 'textarea',
                inputPlaceholder: 'Please provide a reason for deletion...',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage('Reason is required');
                    } else {
                        const reasonInput = document.createElement('input');
                        reasonInput.type = 'hidden';
                        reasonInput.name = 'reason';
                        reasonInput.value = reason;
                        form.appendChild(reasonInput);
                    }
                }
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