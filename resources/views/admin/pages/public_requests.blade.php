@extends('admin.layouts.app')
@section('title','Packages Management')
@section('content')
@push('styles')
<link href="{{ asset('css/admin/partials/package_detail.css') }}" rel="stylesheet" />

@endpush
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Public Requests Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="table-responsive p-0" id="packages-table">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            ID <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        <a href="#">
                                            Package <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            User <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Status <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Created Date <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $request->id }}</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $request->package->title }}</h6>
                                                <p class="text-xs text-secondary mb-0">ID_Package: {{ $request->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-sm"> {{ $request->user->name }}</h6>
                                        <p class="text-xs text-secondary mb-0">ID_User: {{ $request->user->id }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ ucfirst($request->status) }}</span>

                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $request->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0);" data-id="{{ $request->id }} " class="btn btn-show-package" data-toggle="tooltip" data-original-title="Check">Check</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="pagination-container m-2 mt-4">
                            {{ $requests->links('pagination::bootstrap-5') }}
                        </div>



                    </div>


                </div>
            </div>
            <div id="package-details">
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-show-package').on('click', function() {
            var packageId = $(this).data('id'); // Lấy ID của package

            $('#package-details').html('<p>Loading...</p>');
            // Gửi AJAX request tới server
            $.ajax({
                url: '/get-package-details', // Đường dẫn xử lý trên server
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    package_id: packageId
                },

                success: function(response) {
                    $('#package-details').html(response.html);
                },


                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

@endsection