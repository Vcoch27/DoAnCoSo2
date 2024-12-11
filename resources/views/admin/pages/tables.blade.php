@extends('admin.layouts.app')
@section('title','Users Management')
@section('content')
@push('styles')
<link id="pagestyle" href="{{ asset('css/admin/users.css') }}" rel="stylesheet" />
@endpush
@push('scripts')
<script>
    let isSortedDesc = false;
    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('overlay');
        const openOverlayBtns = document.querySelectorAll('.openOverlay');
        const closeOverlayBtn = document.getElementById('closeOverlay');
        // Hiện vùng chồng khi nhấn vào bất kỳ nút mở overlay nào
        openOverlayBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                overlay.classList.remove('an'); // Loại bỏ class "an" để hiển thị overlay
            });
        });
        // Đóng vùng chồng khi nhấn vào nút đóng
        closeOverlayBtn.addEventListener('click', () => {
            overlay.classList.add('an'); // Thêm lại class "an" để ẩn overlay
        });

        // Gắn sự kiện vào phần tử cha cố định, thay vì gắn trực tiếp vào #points-icon
        $(document).on('click', '#points-icon', function(e) {
            e.preventDefault(); // Ngăn hành động mặc định nếu cần
            const typePoints = $(this).data('sort'); // Lấy giá trị sort từ data-sort

            // Gửi AJAX yêu cầu sắp xếp
            $.ajax({
                url: '/users/sort',
                method: 'GET',
                data: {
                    column: typePoints,
                    order: isSortedDesc ? 'asc' : 'desc',
                },
                success: function(response) {
                    $('#userTableContainer').html(response); // Cập nhật nội dung bảng

                    // Thay đổi màu sắc dựa trên trạng thái sắp xếp
                    if (typePoints === 'cumulative') {
                        if (isSortedDesc) {
                            $('#points-icon').css('color', ''); // Màu mặc định
                            isSortedDesc = false;
                        } else {
                            $('#points-icon').css('color', '#ff002d'); // Màu đỏ
                            isSortedDesc = true;
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error during sorting:', error);
                }
            });

            console.log(typePoints);
        });
    });
</script>
@endpush

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Users table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <!-- Form tìm kiếm -->
                        <div class="row mx-2">
                            <div class="col-md-3">
                                <div class="container">
                                    <div class="tabs">
                                        <input type="radio" id="radio-1" name="search_field" value="all" checked}}>
                                        <label class="tab" for="radio-1">All of field</label>
                                        <input type="radio" id="radio-2" name="search_field" value="name" }>
                                        <label class="tab" for="radio-2">Name</label>
                                        <input type="radio" id="radio-3" name="search_field" value="email" }>
                                        <label class="tab" for="radio-3">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-outline col-md-3 my-3">
                                <label class="form-label">Search</label>
                                <input type="text" class="form-control" id="search" name="search" value="{{ request()->input('search') }}" autofocus>
                            </div>
                            <div class="col-md-3 my-3">
                                <button type="submit" class="btn btn-primary btn-search" style="margin-bottom: 0;">Search</button>
                            </div>
                        </div>



                        <div id="user-table">
                            <div id="userTableContainer">
                                @include('admin.includes.user_table', ['users' => $users])
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/small-logos/logo-asana.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Asana</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">working</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">60%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/small-logos/github.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Github</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$5,000</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">done</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">100%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Atlassian</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$3,400</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">canceled</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">30%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/small-logos/bootstrap.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Bootstrap</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$14,000</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">working</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">80%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Slack</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$1,000</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">canceled</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">0%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../assets/img/small-logos/devto.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm">Devto</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">$2,300</p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">done</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">100%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    </div>
    <script>
        $(document).ready(function() {

            $('.btn-search').on('click', function() {
                var searchValue = $('#search').val(); // Lấy giá trị từ ô tìm kiếm
                var searchField = $('input[name="search_field"]:checked').val(); // Lấy giá trị trường tìm kiếm đã chọn
                $('#userTableContainer').html('<p>Loading...</p>'); // Hiển thị thông báo đang tải

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route("tables") }}', // Đường dẫn gọi API tìm kiếm
                    method: 'GET', // Sử dụng phương thức GET
                    data: {
                        search: searchValue,
                        search_field: searchField
                    },

                    success: function(response) {
                        // Cập nhật lại phần bảng người dùng
                        $('#userTableContainer').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
                console.log('tao dang lam'); // Sửa lỗi chính tả: consloe.log => console.log

            });
            $('#clear-search').on('click', function() {
                location.reload();
            });

        });
    </script>

    @endsection