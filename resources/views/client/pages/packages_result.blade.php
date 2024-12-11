@extends('client.layouts.app')
@push('styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('client/assets/css/now-ui-kit.css') }}" rel="stylesheet" />
<link href="{{ asset('css/components/header.css') }}" rel="stylesheet" />
@vite('resources/css/components/choice.css')
@vite('resources/css/packages_result_page.css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


@endpush

@section('title','Ket qua')

@section('content')


<main class="main-content bg-pale-secondary">
    <div class="container ">
        <div class="row bg-light">
            <div class="col-md-12 col-xl-12 ml-md-auto ">
                <section class="section pt-0">
                    <div class="container pt-5">
                        <!-- -------------- -->
                        <!-- <pre>{{ json_encode($resultDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre> -->

                        <div class="pt-5" style="text-align: center;">
                            <h4 class="text-uppercase ">{{$package_title}} </h4>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mx-auto">

                                <!-- Quiz Information -->
                                <div class="col-md-8 mx-auto">
                                    <h6 class="divider">Result Information</h6>
                                </div>
                                <?php $percent = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100, 2) : 0;
                                $message = "";

                                if ($percent >= 90) {
                                    $message = "<h6 class='text-uppercase text-center fw-500 ls-2 my-4 text-success'>Excellent! You've mastered this topic!</h6>";
                                } elseif ($percent >= 75) {
                                    $message = "<h6 class='text-uppercase text-center fw-500 ls-2 my-4 text-info'>Great job! You're almost there!</h6>";
                                } elseif ($percent >= 50) {
                                    $message = "<h6 class='text-uppercase text-center fw-500 ls-2 my-4 text-warning'>Good effort! A little more practice will help.</h6>";
                                } elseif ($percent > 0) {
                                    $message = "<h6 class='text-uppercase text-center fw-500 ls-2 my-4 text-danger'>Oh bummer, you need to study more!</h6>";
                                } else {
                                    $message = "<h6 class='text-uppercase text-center fw-500 ls-2 my-4 text-muted'>No attempts made! Let's try some questions.</h6>";
                                }

                                echo $message;
                                ?>
                                <div class="text-left ml-10 row col-md-3 mr-0">
                                </div>
                                <div class="form-row input-border input-round">
                                    <div class="form-group col-sm-6 col-xl-6">
                                        <p class="text-center">
                                            <?php $percent = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100, 2) : 0; ?>
                                            Score : <span class="text-danger"><?php echo $percent ?>%</span>
                                            <br>
                                            Total questions: {{ $totalQuestions }}
                                            <br>
                                            Correct answers: <b>{{ $score }}</b>/{{ $totalQuestions }}
                                        </p>
                                    </div>
                                    <div class="form-group col-sm-6 col-xl-6">
                                        <p class="text-center">
                                            <!-- Topic: <code>...</code> -->
                                            <br>
                                            <?php
                                            $grade = ""; // Biến để chứa grade
                                            $gradeClass = ""; // Biến để chứa class màu sắc của grade

                                            if ($percent >= 90) {
                                                $grade = "A";
                                                $gradeClass = "text-success"; // Màu xanh lá cây cho điểm cao
                                            } elseif ($percent >= 80) {
                                                $grade = "B";
                                                $gradeClass = "text-info"; // Màu xanh lam cho điểm khá
                                            } elseif ($percent >= 70) {
                                                $grade = "C";
                                                $gradeClass = "text-primary"; // Màu xanh dương cho điểm trung bình
                                            } elseif ($percent >= 50) {
                                                $grade = "D";
                                                $gradeClass = "text-warning"; // Màu vàng cho điểm thấp
                                            } else {
                                                $grade = "F";
                                                $gradeClass = "text-danger"; // Màu đỏ cho điểm không đạt
                                            }
                                            ?>
                                            Grade: <span class="<?php echo $gradeClass; ?>"><?php echo $grade; ?></span>
                                            <br>
                                            @if (!($cumulativePoints === -1))
                                            Points achieved : <span class="text-success">{{$cumulativePoints}} </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mx-md-auto text-left">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo $percent ?>%" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <!-- Answers -->
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <h6 class="divider">Answers</h6>
                                    </div>
                                    <?php $count = 1 ?>
                                    @foreach ($resultDetails as $result)
                                    <div class="border rounded-lg bt-4 col-md-12 ctn-result ">
                                        <div class="text-center px-4 py-6">
                                            <p class="mb-7"><img width="70px" height="70px" src="<?php if ($result['is_correct']) {
                                                                                                        echo 'https://www.gifcen.com/wp-content/uploads/2022/03/pepe-the-frog-gif.gif';
                                                                                                    } else {
                                                                                                        echo 'https://www.gifcen.com/wp-content/uploads/2023/05/pepe-the-frog-gif-3.gif';
                                                                                                    }
                                                                                                    ?>" alt="Correct Answer"></p>
                                            <h6 class="text-uppercase fw-500 ls-2 my-4">Question {{$count}} </h6> <?php $count++; ?>
                                            <p class="lead"><span class="lead-2 text-dark">Question : </span>{{ $result['question'] }}</p>
                                        </div>
                                        <div class="px-4 py-6 col-md-12 gap-y row ml-0">
                                            <div class='col-md-6 bg-gradient-info text-white p-4'>
                                                <h6 class="text-center mb-6 font-weight-600">Given Answers</h6>
                                                <ul class="list-unstyled mb-0">
                                                    @foreach ($result['answer'] as $key => $answer)
                                                    <li class="font-weight-500">
                                                        @if (in_array($key, $result['user_answer']))
                                                        <i class="fa-solid fa-check" style="color: #77ff77;"></i>{{ $answer }}
                                                        @else
                                                        <i class="fa-solid fa-xmark" style="color: red;"></i> {{ $answer }}
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class='col-md-6 bg-gradient-primary text-white p-4'>
                                                <h6 class="text-center mb-6 font-weight-600">Correct Answers</h6>
                                                <ul class="list-unstyled mb-0">
                                                    @foreach ($result['answer'] as $key => $answer)
                                                    <li class="font-weight-500">
                                                        @if (in_array($key, $result['correct_answer']))
                                                        <i class="fa-solid fa-check" style="color: #77ff77;"></i>
                                                        @else
                                                        <i class="fa-solid fa-xmark" style="color: red;"></i>
                                                        @endif
                                                        {{$answer}}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-center px-4">
                                            <?php if ($result['is_correct']) {
                                                echo '<h6 class="text-uppercase fw-500 ls-2 my-4 text-success">Correct</h6>';
                                            } else {
                                                echo '<h6 class="text-uppercase fw-500 ls-2 my-4 text-danger">Wrong</h6>';
                                            } ?>
                                            <h6 class="text-uppercase fw-500 ls-2 my-4 text-success"></h6>
                                            <div class="text-right">
                                                <button class="mb-3 btn btn-xs btn-round btn-outline-success report-btn" type="button" data-toggle="modal" data-question-id="{{$result['question_id']}}" data-question-content="{{$result['question']}}">Report a problem</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <!-- Modal báo cáo vấn đề -->
                                    <!-- Modal Giao Diện Form Báo Cáo Vấn Đề -->
                                    <div class="modal fade" id="modalReportProblem" tabindex="-1" role="dialog" aria-labelledby="modalReportProblemLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content bg-img bg-img-bottom" style="background-image: url(https://quizapi.io/storage/quiz/contributeImage3.jpeg)">
                                                <div class="modal-body text-white">
                                                    <div class="row">
                                                        <div class="col-md-12 ml-auto">
                                                            <form class="input-glass p-5 p-md-3" method="POST" action="https://quizapi.io/report">
                                                                <input type="hidden" name="_token" value="Us63wz7tpt4BrbIYbtStmJRDvSikXBqnPe9uiugF">
                                                                <h2 class="text-center" id="modalReportProblemLabel">Hello there!</h2>
                                                                <p class="lead-1 text-center">It seems you want to report a problem with the question:</p>
                                                                <input type="hidden" name='quiz_id' id="quiz_id" value="">
                                                                <input type="hidden" name='report_type' value='1'>
                                                                <p><span class='font-weight-700' id="question_content"></span></p>
                                                                <p class="lead-1">Please type in the issue below and submit the form!</p>
                                                                <textarea name="report" class="rounded-xl form-control" id="report" cols="73" rows="7" required></textarea>
                                                                <hr class="w-10">
                                                                <div class="input-group input-group-lg text-right">
                                                                    <button type="button" class="btn btn-round btn-lg1 btn-outline-danger" data-dismiss="modal" id="closeButton">Close</button>
                                                                    <div class="pl-3 text-right">
                                                                        <button type="submit" class="btn btn-round btn-lg1 btn-success">Report problem</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        // Khi modal được đóng
        $('#modalReportProblem').on('hidden.bs.modal', function() {
            // Reset form
            $('#reportForm')[0].reset(); // Đặt lại các trường trong form
        });

        // Khi nút "Report a problem" được nhấn
        $('.report-btn').click(function() {
            // Lấy dữ liệu từ các thuộc tính data của nút
            var questionId = $(this).data('question-id');
            var questionContent = $(this).data('question-content');

            // Đặt giá trị cho các trường ẩn trong modal
            $('#quiz_id').val(questionId);
            $('#question_content').text(questionContent);

            // Hiện modal
            $('#modalReportProblem').modal('show');
        });

        // Lắng nghe sự kiện click cho nút đóng
        $('#closeButton').click(function() {
            $('#modalReportProblem').modal('hide'); // Ẩn modal

            // Backdrop sẽ tự động được xóa bởi Bootstrap, nhưng nếu bạn muốn xóa thủ công
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.parentNode.removeChild(backdrop); // Xóa backdrop nếu nó còn tồn tại
            }
        });
    });
</script>



@endsection