@extends('layouts.template')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Deleted Partner</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Partner ID</th>
                                            <th class="text-center">Alasan</th>
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
                                            <th class="text-center">Post Paid</th>
                                            @if (Auth::user()->level == 'Admin')
                                                <th class="text-center">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $item->partner_id }}</td>
                                                <td class="text-center line-clamp-2 max-w-max">{{ $item->alasan }}</td>
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
                                                    <td class="text-center"><label class="badge {{ $item->post_paid === '1' ? 'badge-success' : 'badge-danger' }}">{{ $item->post_paid == '1' ? 'Done' : 'Not' }}</td>
                                                @if (Auth::user()->level == 'Admin')
                                                    <td class="text-center">
                                                        <form id="form"
                                                            action="{{ route('deleted-partner.restore', ['id' => Crypt::encrypt($item->partner_id)]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="button" class="btn btn-success delete-button">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                                Restore
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    {{ $data->appends(request()->input())->links('pagination::bootstrap-5') }}
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
                const form = e.target.closest('form'); // Menemukan form terdekat
                Swal.fire({
                    title: 'Apakah yakin?',
                    text: "Data akan kembali ke table Partner!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Restore it!',
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
