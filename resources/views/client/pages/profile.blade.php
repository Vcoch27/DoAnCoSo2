<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{'img/logo/navican.png'}}">
    <title>
        {{ $user->name}}
    </title>
    <!-- CSS Files -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/css/css1.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/css2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/components/pagination.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('overlay');
            const openOverlayBtn = document.getElementById('openOverlay');
            const closeOverlayBtn = document.getElementById('closeOverlay');

            // Hiện vùng chồng
            openOverlayBtn.addEventListener('click', () => {
                overlay.classList.remove('an'); // Loại bỏ class "an" để hiển thị
            });

            // Đóng vùng chồng
            closeOverlayBtn.addEventListener('click', () => {
                overlay.classList.add('an'); // Thêm lại class "an" để ẩn
            });
        });
    </script>
</head>
<?php

use Illuminate\Support\Facades\Auth;

$owner = Auth::user()->id === $user->id;
?>

<body class="profile-page">
    @if ($owner)
    <div class="an" id="overlay">
        <div class="overlay-content bg-white rounded shadow-lg">
            <!-- Header -->
            <div style="width: 80%; margin: 0 auto;">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Chỉnh sửa thông tin</h5>
                    <i class="fa-solid fa-x text-danger" style="cursor: pointer;" id="closeOverlay"></i>
                </div>

                <!-- Form -->
                <div class="row g-3">
                    <!-- Cột bên trái -->
                    <div class="col-md-6">
                        <!-- Avatar -->
                        <div>
                            <div class="card-profile-image">
                                <a href="javascript:;">
                                    <img id="avatar-preview" src="{{ asset('img/avatar/' . $user->avatar) }}" style="width: 200px; height: 200px;" class="rounded-circle img-thumbnail avatar-preview">
                                </a>
                                <button class="container-btn-file mt-4" style="margin: 5px auto; position: relative;">
                                    <i class="fa-solid fa-image mr-1"></i> Upload Avatar
                                    <input id="file-input" class="file" name="avatar" type="file" accept="image/*" style="opacity: 0; position: absolute; left: 0; top: 0; width: 100%; height: 100%; cursor: pointer;">
                                </button>
                                <button id="confirm-button" class="btn btn-success mt-2" style="display: none; margin:0 auto;" onclick="updateAvatar()">Update</button>
                            </div>
                        </div>

                        <hr class="hr-text mt-5" data-content="Tên người dùng">
                        <div class="mb-3">

                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng" value="{{$user->name}}">
                                <button class="btn-save btn-save-name" type="button" style="display: none;">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            </div>
                            <div id="status-message"></div>

                        </div>
                        <hr class="hr-text mt-5" data-content="Delete account">
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-danger">Delete account </button>
                        </div>



                    </div>

                    <!-- Cột bên phải -->
                    <div class="col-md-6">
                        <!-- Bio -->
                        <hr class="hr-text" data-content="Bio">

                        <div class="mb-3">
                            <div class="input-group">
                                <textarea class="form-control" id="area-bio" name="bio" rows="4" placeholder="Nhập mô tả bản thân">{{$user->bio}}</textarea>
                                <button class="btn-save-bio btn-save" type="button" style="display: none;">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            </div>
                        </div>
                        <div id="status-message-bio"></div>


                        <!-- ----------------------------------- -->
                        <!-- Email -->
                        <!-- <hr class="hr-text" data-content="Email"> -->
                        <div class="mb-3">
                            <!-- @if (!isset($user->google_id))
                                <p class="text-muted d-flex align-items-start mt-2">
                                    <span id="emailStatus">Xác minh <i class="fa-solid fa-check"></i></span>
                                </p>
                                <input type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Nhập email"
                                    value="{{ $user->email }}"
                                    disabled>

                                @else
                                <p class="text-muted d-flex align-items-start mt-2">
                                    <span id="emailStatus">Chưa xác minh <i class="fa-solid fa-x"></i></span>
                                </p>
                                <input type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Nhập email"
                                    value="{{ $user->email }}">
                                <button>Xác minh</button>
                                @endif -->
                        </div>
                        <!-- ---------------------------------- -->
                        <!-- Đổi mật khẩu -->
                        <hr class="hr-text mt-5" data-content="Đổi mật khẩu">
                        <div class="mb-3">
                            <div class="d-flex align-items-start ">
                                <label for="newPassword" class="form-label mb-2 fw-bold text-dark">Mật khẩu cũ</label>
                            </div>
                            <input type="password" class="form-control mb-2" id="oldPassword" name="oldPassword" placeholder="Nhập mật khẩu cũ">

                            <div class="d-flex align-items-start mt-4">
                                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                            </div>
                            <input type="password" class="form-control mb-2" id="newPassword" name="newPassword" placeholder="Nhập mật khẩu mới">

                            <div class="d-flex align-items-start mt-4">
                                <label for="newPassword" class="form-label">Nhập lại mật khẩu mới</label>
                            </div>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Xác nhận mật khẩu mới">
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Lưu mật khẩu</button>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Nút lưu -->

            </div>

        </div>

    </div>

    @endif

    </div>

    <div class="wrapper">
        <div class="button-container">
            <button class="btn-back">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
                </svg>
                <span onclick="window.history.back()">Back</span>
            </button>
            <button class="btn-back" onclick="window.location.href='{{ route('welcome') }}'">
                <i class="fa-solid fa-house"></i>
            </button>
        </div>


        <section class="section-profile-cover section-shaped">
            <!-- Circles background -->

        </section>
        <section class="section">
            <div class="container">

                <div class="card card-profile shadow mt--300">
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="javascript:;">
                                        <img id="profile_avt" src="{{ asset('img/avatar/' . $user->avatar) }}" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0">
                                    <a href="mailto:{{ $user->email }}" class="btn btn-sm btn-info mr-4">Contact</a>
                                    @if ($owner)
                                    <a id="openOverlay" class="ml-3 float-right"><i class="fa-solid fa-user-pen"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-1">
                                <div class="card-profile-stats d-flex justify-content-center">

                                    <div>
                                        <span class="heading">{{$questionPackageCount}}</span>
                                        <span class="description">Packages</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->cumulative }}</span>
                                        <span class="description">Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5 mb-5">
                            <h3 id="name_profile">{{ $user->name}} <i class="fa-solid fa-frog" style="color: #0087ff;"></i></h3>
                            <span id="user-bio">
                                @if(isset($user->bio))
                                {!! nl2br(e($user->bio)) !!}
                                @else
                                Null
                                @endif
                            </span>
                        </div>

                        @if ($owner)

                        <hr class="hr-text" data-content="Implementation History">
                        <!-- <pre>{{ json_encode($history, JSON_PRETTY_PRINT) }}</pre> -->

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Completion (%)</th>
                                    <th>Points</th>
                                    <th>Completed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($history as $key => $item)
                                <tr>
                                    <td>{{ ($history->currentPage() - 1) * $history->perPage() + $key + 1 }}</td>
                                    <td style="cursor: pointer;" onclick="window.location.href='{{ route('packages.show', ['id' => $item['id_package']]) }}'">{{ $item['title'] }}</td>
                                    <td>{{ $item['percent'] }}</td>
                                    <td>{{ $item['points'] }}</td>
                                    <td>{{ $item['completed_at'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination">
                            {{ $history->links() }}
                        </div>
                        @endif





                        <h3></h3>
                        <hr class="hr-text" data-content="Public Question Packages">
                        <div class="packages-part  pt-5 ">
                            @foreach($publicPackages as $package)
                            <div class="card-list">
                                <article class="card card-packages">
                                    <div class="premium-div">
                                        <i class="premium-logo fa-solid fa-frog"></i>
                                    </div>

                                    <figure class="card-image an">
                                        <img src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYyNDcwMTUwOQ&ixlib=rb-1.2.1&q=85" alt="An orange painted blue, cut in half laying on a blue background" />
                                    </figure>
                                    <div class="card-header">
                                        <a href="#"><span>#{{$package->id}} </span> <br> {{$package->title}}</a>
                                        <button class="icon-button" onclick="location.href='{{ route('packages.show', ['id' => $package->id]) }}'">
                                            <i class="fa-solid fa-play"></i>
                                        </button>

                                    </div>
                                    <div class="card-header">
                                        <div class="tags">
                                            @foreach($package->tags as $tag)
                                            <span class="tag">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="card-footer">

                                        <div class="card-meta ">
                                            <span><i class="fa-solid fa-list-check"></i> <span>{{$package->question_count}}</span></span>
                                        </div>
                                        <span class="point"></span>

                                        <div class="card-meta card-meta--views">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="EyeOpen">
                                                <path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            {{$package->attempt_count}}
                                        </div>
                                        <span class="point"></span>
                                        <div class="card-meta card-meta--date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="Calendar">
                                                <rect x="2" y="4" width="20" height="18" rx="4" />
                                                <path d="M8 2v4" />
                                                <path d="M16 2v4" />
                                                <path d="M2 10h20" />
                                            </svg>
                                            {{ $package->created_at->format('M d, Y') }}
                                        </div>

                                    </div>

                                </article>
                            </div>
                            @endforeach
                        </div>

                        @if ($owner)

                        <hr class="hr-text" data-content="Private Question Packages">

                        <div class="packages-part  pt-5 ">
                            @foreach($nonPublicPackages as $package)
                            <div class="card-list">
                                <article class="card card-packages">


                                    <figure class="card-image hidden">
                                        <img src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYyNDcwMTUwOQ&ixlib=rb-1.2.1&q=85" alt="An orange painted blue, cut in half laying on a blue background" />
                                    </figure>
                                    <div class="card-header">
                                        <a href="#"><span>#{{$package->id}} </span> <br> {{$package->title}}</a>
                                        <button class="icon-button" onclick="location.href='{{ route('packages.show', ['id' => $package->id]) }}'">
                                            <i class="fa-solid fa-play"></i>
                                        </button>

                                    </div>
                                    <div class="card-header">
                                        <div class="tags">

                                            @foreach($package->tags as $tag)
                                            <span class="tag">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="card-footer">

                                        <div class="card-meta ">
                                            <span><i class="fa-solid fa-list-check"></i> <span>{{$package->question_count}}</span></span>
                                        </div>
                                        <span class="point"></span>

                                        <div class="card-meta card-meta--views">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="EyeOpen">
                                                <path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            {{$package->attempt_count}}
                                        </div>
                                        <span class="point"></span>
                                        <div class="card-meta card-meta--date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="Calendar">
                                                <rect x="2" y="4" width="20" height="18" rx="4" />
                                                <path d="M8 2v4" />
                                                <path d="M16 2v4" />
                                                <path d="M2 10h20" />
                                            </svg>
                                            {{ $package->created_at->format('M d, Y') }}
                                        </div>

                                    </div>

                                </article>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

<script>
    document.getElementById('file-input').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            // Hiển thị ảnh xem trước
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatar-preview').src = event.target.result;
            };
            reader.readAsDataURL(file);

            // Hiển thị nút xác nhận "Update"
            document.getElementById('confirm-button').style.display = 'block';
        }
    });

    function updateAvatar() {
        var formData = new FormData();
        var fileInput = document.getElementById('file-input');
        var file = fileInput.files[0];
        if (file) {
            formData.append('avatar', file);
            console.log(formData)

            // Gửi yêu cầu AJAX để cập nhật avatar
            fetch('/update-avatar', { // Thay thế '/update-avatar' bằng route của bạn
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật lại avatar trên giao diện
                        console.log(data.avatar_url);
                        document.getElementById('avatar-preview').src = data.avatar_url;
                        document.getElementById('profile_avt').src = data.avatar_url;
                        document.getElementById('confirm-button').style.display = 'none';
                        alert('Avatar updated successfully!');
                    } else {
                        alert('Failed to update avatar.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error updating the avatar.');
                });
        }
    }
</script>

<!-- cho username -->
<script>
    // Lấy phần tử input và button
    var usernameInput = document.getElementById('username');
    var btnSave = document.querySelector('.btn-save-name');
    var statusMessage = document.getElementById('status-message');
    // Lưu giá trị ban đầu của người dùng
    var initialUsername = usernameInput.value;
    // Lắng nghe sự kiện thay đổi giá trị trong input
    usernameInput.addEventListener('input', function() {
        if (usernameInput.value !== initialUsername) {
            // Nếu giá trị input khác giá trị ban đầu, hiển thị nút save
            btnSave.style.display = 'block';
        } else {
            // Nếu giá trị input giống với giá trị ban đầu, ẩn nút save
            btnSave.style.display = 'none';
        }
    });

    // Lắng nghe sự kiện click vào nút save
    btnSave.addEventListener('click', function() {
        var newUsername = usernameInput.value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: '/update-username',
            type: 'POST',
            data: {
                _token: csrfToken, // Lấy token CSRF từ meta tag
                username: newUsername
            },
            success: function(response) {
                if (response.success) {
                    initialUsername = newUsername;

                    document.getElementById('name_profile').style.value = newUsername;
                    statusMessage.innerHTML = '<p class="text-success">Cập nhật thành công!</p>';
                } else {
                    statusMessage.innerHTML = '<p class="text-danger">Cập nhật không thành công. Vui lòng thử lại!</p>';
                }
                setTimeout(function() {
                    statusMessage.style.display = 'none';
                }, 2000);
            },
            error: function(xhr, status, error) {
                statusMessage.innerHTML = '<p class="text-danger">Có lỗi xảy ra. Vui lòng thử lại sau.</p>';
                setTimeout(function() {
                    statusMessage.style.display = 'none';
                }, 2000);
            }
        });
    });
    // ------------------
    var bioArea = document.getElementById('area-bio');
    var btnSaveBio = document.querySelector('.btn-save-bio');
    var statusMessageBio = document.getElementById('status-message-bio');

    // Lấy giá trị ban đầu của bio khi trang được tải
    var initialBio = bioArea.value;

    bioArea.addEventListener('input', function() {
        // Kiểm tra nếu giá trị trong textarea khác giá trị ban đầu
        if (bioArea.value !== initialBio) {
            btnSaveBio.style.display = 'block'; // Hiển thị nút save
        } else {
            btnSaveBio.style.display = 'none'; // Ẩn nút save nếu không thay đổi
        }
    });

    btnSaveBio.addEventListener('click', function() {
        var newBio = bioArea.value;
        statusMessageBio.innerHTML = '<p class="text-info">Cập nhật ...</p>';

        // Gửi yêu cầu AJAX để cập nhật bio
        $.ajax({
            url: '/update-bio', // URL xử lý yêu cầu cập nhật
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Thêm CSRF token (Laravel)
                bio: newBio // Dữ liệu gửi lên server
            },
            success: function(response) {
                if (response.success) {
                    // Cập nhật thành công
                    initialBio = newBio; // Cập nhật lại giá trị ban đầu sau khi lưu
                    statusMessageBio.innerHTML = '<p class="text-success">Cập nhật thành công!</p>';
                    document.getElementById('user-bio').innerHTML = newBio.replace(/\n/g, '<br>'); // Thêm dòng mới nếu có


                    btnSaveBio.style.display = 'none'; // Ẩn nút save sau khi lưu thành công
                } else {
                    // Xử lý lỗi
                    statusMessageBio.innerHTML = '<p class="text-danger">Cập nhật không thành công. Vui lòng thử lại!</p>';
                }
                setTimeout(function() {
                    statusMessageBio.style.display = 'none';
                }, 2000);
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi khi yêu cầu AJAX gặp sự cố
                statusMessageBio.innerHTML = '<p class="text-danger">Có lỗi xảy ra. Vui lòng thử lại sau.</p>';
                setTimeout(function() {
                    statusMessageBio.style.display = 'none';
                }, 2000);
            }
        });
    });
</script>

</html>