<div class="card" id="package-card-{{ $questionPackage->id }}">

    <div class="card-body">
        <h6>Title: {{ $questionPackage->title }}</h6>
        <p>Tags:
            @forelse($questionPackage->tags as $tag)
            <span class="badge bg-primary">{{ $tag->name }}</span>
            @empty
            <span class="badge bg-secondary">No tags available</span>
            @endforelse
        </p>
        <p>Description: {{ $questionPackage->description ?? 'No description available.' }}</p>

        <h6>Questions:</h6>
        <ul class="question-list">
            @foreach($questions as $index => $question)
            <li>
                <strong>{{ $index + 1 }}. {{ $question['question_text'] }}</strong>
                <ul>
                    @foreach($question['answers'] as $answer)
                    <li>{{ $answer['answer_text'] }}
                        @if($answer['is_correct'])
                        <span style="color: green; font-weight: bold;">(Correct Answer)</span>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
        <!-- Các nút điều khiển -->
        <div class="card" id="package-card-{{ $questionPackage->id }}">
            <div class="card-body">
                <h6>Title: {{ $questionPackage->title }}</h6>
                <button class="btn btn-success approve-btn" data-id="{{  $questionPackage->id }}">Approve</button>
                <button class="btn btn-danger reject-btn" data-id="{{  $questionPackage->id }}">Reject</button>
                <div class="reject-message" style="display: none;">
                    <textarea class="form-control mt-2" placeholder="Enter rejection message..."></textarea>
                    <button class="btn btn-warning mt-2">Submit Rejection</button>
                    <button class="btn btn-light close-reject btn-sm mt-2">X</button>
                </div>
                <button class="btn btn-secondary skip-btn" data-id="{{ $questionPackage->id }}">Skip</button>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Nút Duyệt
        $('.approve-btn').on('click', function() {
            var requestId = $(this).data('id');
            if (confirm('Are you sure you want to approve this package?')) {
                // Gửi yêu cầu duyệt qua AJAX
                $.ajax({
                    url: `/packages/${requestId}/approve`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#package-card-' + requestId).fadeOut(); // Ẩn card sau khi duyệt
                    },
                    error: function() {
                        alert('Failed to approve the package.');
                    },
                });
            }
        });

        // Hiển thị input và nút submit rejection khi bấm Reject
        $('.reject-btn').on('click', function() {
            var rejectMessageDiv = $(this).siblings('.reject-message'); // Lấy phần tử chứa input và nút submit
            rejectMessageDiv.toggle(); // Chuyển đổi giữa hiển thị và ẩn đi
        });

        // Ẩn đi phần nhập liệu và nút submit khi bấm nút X
        $('.close-reject').on('click', function() {
            $(this).closest('.reject-message').hide(); // Ẩn phần tử .reject-message chứa input và nút submit
        });

        // Nút Submit Rejection
        $('.reject-message .btn-warning').on('click', function() {
            var requestId = $(this).closest('.reject-message').siblings('.reject-btn').data('id');
            var rejectionMessage = $(this).siblings('textarea').val();
            if (rejectionMessage.trim() !== '') {
                // Gửi rejection message qua AJAX
                $.ajax({
                    url: `/packages/${requestId}/reject`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rejection_message: rejectionMessage,
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#package-card-' + requestId).fadeOut(); // Ẩn card sau khi từ chối
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);

                        alert('Failed to reject the package.');
                    },
                });
            } else {
                alert('Please enter a rejection message.');
            }
        });

        // Nút Tạm thời bỏ qua
        $('.skip-btn').on('click', function() {
            var requestId = $(this).data('id');
            $('#package-card-' + requestId).fadeOut(); // Ẩn card này
        });
    });
</script>