@extends('admin.layouts.app')
@section('title','Packages Management')
@section('content')
<link id="pagestyle" href="{{ asset('css/admin/users.css') }}" rel="stylesheet" />
<style>
    /* Overlay styles */
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .overlay-content {
        width: 50%;
        height: 90%;
        background: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .an {
        display: none !important;
    }

    /* Chỉnh sửa khoảng cách giữa các label và input */
    .form-label {
        text-align: left;
        font-weight: bold;
    }

    /* Đảm bảo các input có kích thước đầy đủ */
    .form-control {
        width: 100%;
        border: 1px solid;
    }

    /* Đảm bảo các trường 'Start Date' và 'End Date' cùng dòng */
    .form-group.row {
        display: flex;
        gap: 15px;
    }

    .form-group .col-md-6 {
        flex: 1;
    }

    /* Thêm một chút không gian giữa các trường */
    .form-group {
        margin-bottom: 20px;
    }
</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">User Premium Subcriptions Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="table-responsive p-0" id="packages-table">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center  text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        <a href="#">
                                            Order Code
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        <a href="#">
                                            User
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Payment Amount
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Premium Plan
                                        </a>
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Status
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#">
                                            Time Period
                                        </a>
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1 ?>
                                @foreach($subscriptions as $subscription)
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="mb-0 text-sm">{{$stt}}</p>
                                            <?php $stt++  ?>

                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $subscription->app_trans_id }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $subscription->user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">ID_User: {{ $subscription->user_id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ number_format($subscription->amount, 0, ',', ' ') }} VNĐ</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="mb-0 text-sm text-center"> {{ $subscription->premiumPlan->name}}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold
        {{ $subscription->status === 'pending' ? 'text-warning' : '' }}
        {{ $subscription->status === 'active' ? 'text-success' : '' }}
        {{ $subscription->status === 'expired' ? 'text-danger' : '' }}">
                                            {{ ucfirst($subscription->status) }}
                                        </span>

                                    </td>

                                    <td class="align-middle text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            @if ($subscription->status === 'active')

                                            <h6 class="mb-0 text-sm">End Date: {{ $subscription->end_date->format('d/m/Y') }}</h6>
                                            <p class="text-xs text-secondary mb-0">Start Date: {{ $subscription->start_date->format('d/m/Y') }}</p>
                                            @php
                                            $remainingDays = ceil($subscription->end_date->diffInHours(today(), false) / 24); // Làm tròn ngày
                                            @endphp
                                            <span class="text-success">Remaining: {{ abs($remainingDays) }} days</span>

                                            @elseif ($subscription->status === 'pending')
                                            <p class="text-xs text-secondary mb-0">Start Date: <b> {{ $subscription->start_date->format('d/m/Y') }}</b></p>
                                            @else
                                            <h6 class="mb-0 text-sm">End Date: {{ $subscription->end_date->format('d/m/Y') }}</h6>
                                            <p class="text-xs text-secondary mb-0">Start Date: {{ $subscription->start_date->format('d/m/Y') }}</p>
                                            @php
                                            $remainingDays = ceil($subscription->end_date->diffInHours(today(), false) / 24); // Làm tròn ngày
                                            @endphp
                                            <span class="text-danger">Expired {{ abs($remainingDays) }} days ago</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="align-middle text-center">
                                        @if ($subscription->status === 'pending')
                                        <!-- Nút xóa và xác nhận chuyển sang active -->
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm activate-subscription" data-id="{{ $subscription->id }}">
                                            <i class="fa-solid fa-arrow-up"></i> Activate
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm delete-subscription" data-id="{{ $subscription->id }}">
                                            <i class="fa-solid fa-xmark"></i> Delete
                                        </a>
                                        @elseif ($subscription->status === 'active' || $subscription->status === 'expired')
                                        <!-- Nút để cập nhật ngày kết thúc và kết thúc -->
                                        <a href="javascript:void(0);" class="openOverlay btn-show-package ml-3 float-right" data-toggle="tooltip" data-original-title="Check"
                                            data-id="{{ $subscription->id }}"
                                            data-app-trans-id="{{ $subscription->app_trans_id }}"
                                            data-user-name="{{ $subscription->user->name }}"
                                            data-amount="{{ $subscription->amount }}"
                                            data-premium-plan="{{ $subscription->premiumPlan->name }}"
                                            data-status="{{ $subscription->status }}"
                                            data-start-date="{{ $subscription->start_date->format('Y-m-d') }}"
                                            data-end-date="{{ $subscription->end_date->format('Y-m-d') }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="pagination-container m-2 mt-4">
                            {{ $subscriptions->links('pagination::bootstrap-5') }}
                        </div>
                    </div>


                </div>

                <!-- Overlay -->
                <div class="an" id="overlay">
                    <div class="overlay-content bg-white rounded shadow-lg">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0"></h5>
                            <i class="fa-solid fa-x text-danger" style="cursor: pointer;" id="closeOverlay"></i>
                        </div>
                        <hr class="hr-text " data-content="Update Subcription">
                        <form id="overlayForm" class="form-container" style="width: 80%; margin: 0 auto;">
                            <input type="text" id="appTransId" class="form-control" disabled>
                            <div class="form-group">
                                <label for="appTransId" class="form-label">appTransId</label>
                                <input type="text" id="appTransId" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" id="userName" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" id="amount" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="premiumPlan" class="form-label">Premium Plan</label>
                                <input type="text" id="premiumPlan" class="form-control" disabled>
                            </div>
                            <!-- <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" id="status" class="form-control" disabled>
                            </div> -->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-info btn-sm save-subscription" id="saveBtn" style="font-size: 15px;" disabled>
                                    <span>Save</span>
                                </a>
                            </div>
                            <hr class="hr-text" data-content="Delete Subscription">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm " id="deleteBtn" style="font-size: 15px;">
                                    <span>Delete</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Khi nhấn nút " Activate"
        $('.activate-subscription').on('click', function() {
            var subscriptionId = $(this).data('id');
            if (confirm('Are you sure you want to activate this subscription?')) {
                $.ajax({
                    url: '/subscriptions/activate/' + subscriptionId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật lại giao diện sau khi kích hoạt
                            location.reload(); // Reload trang sau khi cập nhật
                        } else {
                            alert('Failed to activate subscription.');
                        }
                    },
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            }
        });

        // Khi nhấn nút "Delete"
        $('.delete-subscription').on('click', function() {
            var subscriptionId = $(this).data('id');

            if (confirm('Are you sure you want to delete this subscription?')) {
                $.ajax({
                    url: '/subscriptions/delete/' + subscriptionId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật lại giao diện sau khi xóa
                            location.reload(); // Reload trang sau khi xóa
                        } else {
                            alert('Failed to delete subscription.');
                        }
                    },
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            }
        });
    });
    // -----------------
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('overlay');
        const closeOverlayBtn = document.getElementById('closeOverlay');
        const saveBtn = document.getElementById('saveBtn');
        const deleteBtn = document.getElementById('deleteBtn');

        const openOverlayBtns = document.querySelectorAll('.openOverlay');

        // Mở overlay khi nhấn vào nút mở
        openOverlayBtns.forEach(button => {
            button.addEventListener('click', () => {
                const userId = button.getAttribute('data-id');
                const userName = button.getAttribute('data-user-name');
                const amount = button.getAttribute('data-amount');
                const premiumPlan = button.getAttribute('data-premium-plan');
                const startDate = button.getAttribute('data-start-date');
                const endDate = button.getAttribute('data-end-date');
                const appTransId = button.getAttribute('data-app-trans-id');

                // Điền dữ liệu vào các input trong overlay
                document.getElementById('userName').value = userName;
                document.getElementById('amount').value = amount;
                document.getElementById('premiumPlan').value = premiumPlan;
                document.getElementById('startDate').value = startDate;
                document.getElementById('endDate').value = endDate;
                document.getElementById('appTransId').value = appTransId;

                // Hiển thị overlay
                overlay.classList.remove('an'); // Loại bỏ class "an" để hiển thị overlay
            });
        });

        // Đóng overlay khi nhấn vào dấu "X"
        closeOverlayBtn.addEventListener('click', () => {
            overlay.classList.add('an'); // Thêm lại class "an" để ẩn
        });

        // Kiểm tra sự thay đổi ở startDate và endDate
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        const checkChanges = () => {
            if (startDateInput.value !== "" && endDateInput.value !== "" &&
                (startDateInput.value !== startDateInput.defaultValue || endDateInput.value !== endDateInput.defaultValue)) {
                saveBtn.disabled = false; // Bật nút Save nếu có thay đổi
            } else {
                saveBtn.disabled = true; // Giữ nút Save vô hiệu hóa nếu không có thay đổi
            }
        };

        startDateInput.addEventListener('change', checkChanges);
        endDateInput.addEventListener('change', checkChanges);

        // Khi nhấn nút Save, thực hiện AJAX để cập nhật thông tin
        saveBtn.addEventListener('click', () => {
            const appTransId = document.getElementById('appTransId').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            console.log(startDate);
            $.ajax({
                url: '/update-subscription',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    appTransId: appTransId,
                    startDate: startDate,
                    endDate: endDate
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Assuming the response message is already in English
                        location.reload();
                    } else {
                        alert(response.message); // Assuming the response message is already in English
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while updating. Please try again!');
                }
            });
        });

        deleteBtn.addEventListener('click', () => {
            const appTransId = document.getElementById('appTransId').value;
            console.log(appTransId);
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '/delete-subscription',
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        appTransId: appTransId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Record deleted successfully!');
                            location.reload();
                        } else {
                            alert('Failed to delete the record!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while deleting. Please try again!');
                    }
                });
            }
        });

    });
</script>
@endsection