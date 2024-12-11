@extends('admin.layouts.app')
@section('title','Packages Management')
@push('styles')
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
        width: 80%;
        height: 90%;
        background: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        margin-left: 200px;
    }

    .an {
        display: none !important;
    }

    /* ---------------- */
    .input {
        position: relative;
        max-width: 190px;
        border: none;
        box-shadow: 0px 1.5px 0px 0px #858585;
        padding: .5rem;
        transition: all 200ms ease-in-out;
        opacity: .8;
    }

    .input-box {
        display: flex;
        flex-direction: column;
    }

    .input-label {
        font-size: .625rem;
        font-weight: bold;
        color: #858585;
        margin-bottom: 4px;
        margin-left: 1px;
    }

    .input-helper {
        color: #858585;
        font-size: .5rem;
        margin-top: 6px;
        margin-left: 1px;
        visibility: hidden;
        transform: translateY(-.5rem);
        transition: all 100ms linear;
        z-index: -1;
    }

    .input::placeholder {
        color: rgb(145, 145, 145);
        font-size: .75rem;
    }

    .input::after {
        content: attr(placeholder);
        position: absolute;
        color: #161616;
        top: 0;
        left: 0;
    }

    .input:focus {
        border: none;
        box-shadow: 0px 1.5px 0px 0px #72E985;
        outline: none;
    }

    .input:focus+.input-helper {
        visibility: visible;
        transform: translateY(0rem);
    }

    .input:focus::placeholder {
        visibility: hidden;
    }

    /* ---------- */

    .container-btn-file {
        display: flex;
        position: relative;
        justify-content: center;
        align-items: center;
        background-color: #307750;
        color: #fff;
        border-style: none;
        padding: 1em 2em;
        border-radius: 0.5em;
        overflow: hidden;
        z-index: 1;
        box-shadow: 4px 8px 10px -3px rgba(0, 0, 0, 0.356);
        transition: all 250ms;
    }

    .container-btn-file input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .container-btn-file>svg {
        margin-right: 1em;
    }

    .container-btn-file::before {
        content: "";
        position: absolute;
        height: 100%;
        width: 0;
        border-radius: 0.5em;
        background-color: #469b61;
        z-index: -1;
        transition: all 350ms;
    }

    .container-btn-file:hover::before {
        width: 100%;
    }

    .form-label {
        font-size: 16px;
        /* Tùy chỉnh kích thước */
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group .form-control {
        flex-grow: 1;
        /* Đảm bảo input chiếm không gian còn lại */
    }

    .input-group .btn-save {
        border: none;
        background-color: transparent;
        padding-left: 15px;
        font-size: 20px;
        cursor: pointer;
        left: -20px;
    }



    /* -------------- */
    .question-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* Chia thành 2 cột */
        gap: 20px;
        /* Khoảng cách giữa các câu hỏi */
        list-style-type: none;
        /* Xóa dấu chấm đầu dòng */
        padding: 0;
    }

    .question-list li {
        margin-bottom: 15px;
    }

    .question-list ul {
        padding-left: 20px;
        margin-top: 10px;
    }
</style>
@endpush
@section('content')
<script>

</script>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Question Packages Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="table-responsive p-0" id="packages-table">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#" onclick="sortTable('title')">
                                            Title <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        <a href="#" onclick="sortTable('author')">
                                            Author <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#" onclick="sortTable('question_count')">
                                            Number of Questions <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#" onclick="sortTable('attempt_count')">
                                            Attempts <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mode <i class="fa-solid fa-square-caret-down"></i>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <a href="#" onclick="sortTable('created_at')">
                                            Created Date <i class="fa-solid fa-square-caret-down"></i>
                                        </a>
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $package->title }}</h6>
                                                <p class="text-xs text-secondary mb-0">ID: {{ $package->id }}</p>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $package->author->name }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $package->question_count}}</span>

                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $package->attempt_count }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-{{$package->public ? 'success' : 'warning'}}">{{$package->public ? 'Public' : 'Private'}}</span>

                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $package->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0);" data-id="{{ $package->id }}" class="openOverlay btn-show-package ml-3 float-right" data-toggle="tooltip" data-original-title="Check">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="pagination-container m-2 mt-4">
                            {{ $packages->links('pagination::bootstrap-5') }}
                        </div>
                    </div>


                    <div class="an" id="overlay">
                        <div class="overlay-content bg-white rounded shadow-lg">
                            <!-- Header -->
                            <div style="width: 95%; margin: 0 auto; max-height: 830px;overflow-y: auto;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Detail Packages</h5>
                                    <i class="fa-solid fa-x text-danger" style="cursor: pointer;" id="closeOverlay"></i>
                                </div>
                                <div id="partials-content">
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function sortTable(field) {
        let currentSortField = '{{ $sortField }}';
        let currentSortOrder = '{{ $sortOrder }}';

        // Toggle sort order
        let sortOrder = currentSortField === field && currentSortOrder === 'asc' ? 'desc' : 'asc';

        // Update the URL with new sort parameters
        window.location.href = `?sort_field=${field}&sort_order=${sortOrder}`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const overlay = document.getElementById('overlay');
        const openOverlayBtns = document.querySelectorAll('.openOverlay');
        const closeOverlayBtn = document.getElementById('closeOverlay');

        // Hiển thị overlay khi nhấn vào bất kỳ nút có class "openOverlay"
        openOverlayBtns.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

                overlay.classList.remove('an'); // Loại bỏ class "an" để hiển thị overlay

                // Lấy ID của package từ thuộc tính "data-id" của button
                const packageId = button.getAttribute('data-id');
                console.log(packageId);

                // Cập nhật nội dung "Loading..." trước khi gửi yêu cầu AJAX
                document.getElementById('partials-content').innerHTML = '<p>Loading...</p>';

                // Gửi AJAX request tới server
                $.ajax({
                    url: '/get-package-details-overlay', // Đường dẫn xử lý trên server
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF để bảo mật
                        package_id: packageId
                    },

                    success: function(response) {
                        // Cập nhật nội dung trả về từ server vào phần #partials-content
                        document.getElementById('partials-content').innerHTML = response.html;
                    },

                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Nếu có lỗi, hiển thị thông báo lỗi
                        document.getElementById('partials-content').innerHTML = 'Error loading content.';
                    }
                });
            });
        });

        // Đóng overlay khi click vào nút "Close"
        closeOverlayBtn.addEventListener('click', () => {
            overlay.classList.add('an'); // Thêm lại class "an" để ẩn overlay
        });
        //Xử lý họa động đối với gói câu hỏi trên overlay
        $(document).on('click', '.delete-btn', function() {
            var requestId = $(this).data('id'); // Lấy ID của gói câu hỏi
            var confirmation = confirm('Are you sure you want to delete this package?'); // Hiển thị hộp thoại xác nhận
            if (confirmation) { // Nếu người dùng xác nhận
                $.ajax({
                    url: '/delete-package/' + requestId, // Đường dẫn tới route xóa
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Thêm token CSRF
                    },
                    success: function(response) {
                        alert(response.message); // Hiển thị thông báo
                        location.reload(); // Tải lại trang sau khi xóa
                    },
                    error: function() {
                        alert('Failed to delete the package.');
                    },
                });
            }
        });
        $(document).on('click', '.public-btn', function() {
            var requestId = $(this).data('id'); // Lấy ID của gói câu hỏi
            var isPublic = $(this).data('public'); // Lấy trạng thái public hiện tại

            var confirmationMessage = isPublic ?
                'Are you sure you want to cancel public mode for this package?' :
                'Are you sure you want to update public mode for this package?';

            var confirmation = confirm(confirmationMessage); // Hiển thị hộp thoại xác nhận
            if (confirmation) { // Nếu người dùng xác nhận
                $.ajax({
                    url: '/update-public-mode/' + requestId, // Đường dẫn đến route cập nhật public mode
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Token CSRF bảo vệ
                        public: !isPublic // Cập nhật giá trị public (ngược lại giá trị hiện tại)
                    },
                    success: function(response) {
                        alert(response.message); // Hiển thị thông báo
                        location.reload(); // Làm mới trang để hiển thị trạng thái mới
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while updating the public mode.'); // Thông báo lỗi
                    }
                });
            }
        });

    });
</script>