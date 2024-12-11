@if (isset($searchCount))
<div class="row mx-2">
    <p>* Found <b id="search-count">{{ $searchCount }}</b> results <i class="fa-solid fa-x" id="clear-search"></i></p>
</div>
@endif
<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Users</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Packages</th>
            <th id="sort-points" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                <a href="#" id="points-icon" data-sort="cumulative">
                    Points <i class="fa-solid fa-square-caret-down"></i>
                </a>
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
            <th class="text-secondary opacity-7"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                <div class="d-flex px-2 py-1">
                    <div>
                        <img id="avatar-{{ $user->id }}" src="{{ asset('img/avatar/' . $user->avatar) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        @php
                        $style = $user->is_blocked ? 'color: red;' : '';
                        @endphp
                        <h6 id="name-{{ $user->id }}" class="mb-0 text-sm" style="<?php echo $style; ?>">
                            {{ $user->id }}. {{ $user->name }}
                        </h6>
                        <p id="premium-status-{{ $user->id }}" class="text-xs text-secondary mb-0">{{ $user->is_premium ? 'Premium' : 'Free' }}</p>
                    </div>
                </div>
            </td>
            <td id="email-{{ $user->id }}">{{ $user->email }}</td>
            <td class="text-center" id="packages-count-{{ $user->id }}">{{ $user->question_packages_count }}</td>
            <td class="text-center">
                <span id="cumulative-{{ $user->id }}" class="badge badge-sm bg-gradient-success">{{ $user->cumulative }}</span>
            </td>
            <td class="text-center" id="created-at-{{ $user->id }}">{{ $user->created_at->format('d/m/Y') }}</td>
            <td>
                <a class="ml-3 float-right openOverlay"
                    data-user-id="{{ $user->id }}"
                    data-avatar="{{ asset('img/avatar/' . $user->avatar) }}"
                    data-name="{{ $user->name }}"
                    data-bio="{{ $user->bio }}"
                    data-blocked="{{ $user->is_blocked }}">
                    <i class="fa-solid fa-user-pen"></i>
                </a>
                <!-- <a href="#" onclick="return confirm('Are you sure?')" class="ml-3 float-right"><i class="fa-solid fa-lock"></i></a> -->
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<div class="an" id="overlay" style="display: none;">
    <div class="overlay-content bg-white rounded shadow-lg">
        <!-- Header -->
        <div style="width: 80%; margin: 0 auto;">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Chỉnh sửa thông tin</h5>
                <i class="fa-solid fa-x text-danger" style="cursor: pointer;" id="closeOverlay"></i>
            </div>
            <!-- Form -->
            <input type="text" hidden id="hidden-user-id">
            <div class="row g-3">
                <!-- Cột bên trái -->
                <div class="col-md-6">
                    <!-- Avatar -->
                    <div>
                        <div class="card-profile-image">
                            <a href="javascript:;">
                                <img id="avatar-preview" src="E" style="width: 200px; height: 200px;" class="rounded-circle img-thumbnail avatar-preview">
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

                        <div class="input-group-users">
                            <input type="text" class="form-control-user " id="username" name="username" placeholder="Nhập tên người dùng">
                            <button class="btn-save btn-save-name" type="button" style="display: none;">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </button>
                        </div>
                        <div id="status-message"></div>

                    </div>

                </div>
                <!-- Cột bên phải -->
                <div class="col-md-6">
                    <!-- Bio -->
                    <hr class="hr-text" data-content="Bio">

                    <div class="mb-3">
                        <div class="input-group-users">
                            <textarea class=" form-control-user" id="area-bio" name="bio" rows="4" placeholder="Nhập mô tả bản thân">{{$user->bio}}</textarea>
                            <button class="btn-save-bio btn-save" type="button" style="display: none;">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </button>
                        </div>
                    </div>
                    <div id="status-message-bio"></div>
                    <div class="mb-3">
                    </div>
                    <!-- ---------------------------------- -->
                    <!-- <hr class="hr-text mt-5" data-content="User Mode"> -->
                    <hr class="hr-text mt-5" data-content="Block account">
                    <div class="d-grid mt-4">
                        <button type="button" id="block-button" class="btn btn-danger" onclick="blockAccount()">Block account</button>
                    </div>
                </div>
            </div>

            <!-- Nút lưu -->

        </div>

    </div>

</div>
<script>
    $(document).ready(function() {

        // Mở overlay khi click vào "openOverlay"
        $('.openOverlay').on('click', function(e) {
            e.preventDefault();

            // Lấy thông tin người dùng từ thuộc tính data
            const userId = $(this).data('user-id');
            const avatar = $(this).data('avatar');
            const name = $(this).data('name');
            const bio = $(this).data('bio');
            const isBlocked = $(this).data('blocked');

            // Cập nhật giá trị trong overlay
            $('#avatar-preview').attr('src', avatar);
            $('#username').val(name);
            $('#area-bio').val(bio);
            $('#hidden-user-id').val(userId);

            // Kiểm tra trạng thái is_blocked và thay đổi nội dung nút
            if (isBlocked) {
                $('#block-button').text('Unblock account').removeClass('btn-danger').addClass('btn-success');
            } else {
                $('#block-button').text('Block account').removeClass('btn-success').addClass('btn-danger');
            }


            // Hiển thị overlay
            $('#overlay').fadeIn();
        });

        // Đóng overlay khi click vào icon "x"
        $('#closeOverlay').on('click', function() {
            $('#overlay').fadeOut();
        });
        // Phương thức xử lý click vào nút Block/Unblock
        $('#block-button').on('click', function() {
            const userId = $('#hidden-user-id').val(); // Lấy ID người dùng từ hidden field
            const isBlocked = $(this).text().toLowerCase() === 'unblock account'; // Kiểm tra trạng thái của nút

            if (isBlocked) {
                unblockAccount(userId); // Nếu đang unblock, gọi phương thức unblock
            } else {
                blockAccount(userId); // Nếu đang block, gọi phương thức block
            }
        });

        // Phương thức block tài khoản
        function blockAccount(userId) {
            var confirmation = confirm('Are you sure you want to block this account?');
            if (!confirmation) return;

            $.ajax({
                url: '/users/' + userId + '/block', // URL cho hành động block
                method: 'PUT', // Sử dụng PUT để cập nhật dữ liệu
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token để bảo mật yêu cầu
                },
                success: function(response) {
                    // Xử lý khi thành công
                    alert('Account has been blocked');
                    $('#block-button').text('Unblock account').removeClass('btn-danger').addClass('btn-success');
                    location.reload(); // Reload lại trang để cập nhật trạng thái
                },
                error: function(xhr, status, error) {
                    // Xử lý khi có lỗi
                    alert('An error occurred while blocking the account');
                }
            });
        }

        // Phương thức unblock tài khoản
        function unblockAccount(userId) {
            $.ajax({
                url: '/users/unblock-account/' + userId, // Gọi route unblock account
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert('Account unblocked successfully!');
                        $('#block-button').text('Block account').removeClass('btn-success').addClass('btn-danger');
                        location.reload(); // Reload lại trang để cập nhật trạng thái
                    } else {
                        alert('Failed to unblock account');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while unblocking the account');
                }
            });
        }

    });
</script>
<script>
    document.getElementById('file-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Hiển thị ảnh xem trước
            const reader = new FileReader();
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
        const inputElement = document.getElementById('hidden-user-id');
        const id = inputElement.value;

        if (file) {
            formData.append('avatar', file);
            console.log('form'.formData)

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
                        document.getElementById('avatar-' + id).src = data.avatar_url;
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
        const inputElement = document.getElementById('hidden-user-id');
        const id = inputElement.value;
        var newUsername = usernameInput.value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(newUsername)
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
                    document.getElementById('name-' + id).textContent = id + '. ' + newUsername;
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