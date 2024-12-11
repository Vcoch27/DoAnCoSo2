@extends('client.layouts.app')
@push('styles')
<!-- -- -->
<!-- Styles -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('client/assets/css/now-ui-kit.css') }}" rel="stylesheet" />
<link href="{{ asset('css/components/header.css') }}" rel="stylesheet" />
<link href="{{ asset('css/components/choice.css') }}" rel="stylesheet" />
<link href="{{ asset('css/questionpage.css') }}" rel="stylesheet" />

<style>
    .user {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        padding: 5px 15px;
        width: 40%;
        margin: 0 auto;
        border-radius: 20px;
        background-color: #d2d1d1;
    }



    .user__container {
        display: flex;
        flex-direction: column;
    }


    .name {
        font-weight: 800;
    }

    .username {
        font-size: .9em;
        color: #64696e;
    }

    .image {
        width: 30px;
        height: 30px;
        background: rgb(22, 19, 70);
        background: linear-gradient(295deg, rgba(22, 19, 70, 1) 41%, rgba(89, 177, 237, 1) 100%);
        border-radius: 50%;
        margin-right: 15px;
    }

    /* ------------ */
    .avatar-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user {
        cursor: pointer;
    }
</style>
@endpush

@section('title',$package->title)

@section('content')
<main class="main-content bg-pale-secondary">
    <!-- <pre>{{ json_encode($package, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre> -->

    <div class="container">
        <div class="row bg-light">
            <!-- Sidebar -->
            <div class="col-md-12 col-xl-12 ml-md-auto ">
                <header class="section-header mb-4 title-package">
                    <div class="container">
                        <div class="row align-items-center py-4">
                            <!-- Title -->
                            <div class="col-12 mb-3">
                                <h1 class="text-center fw-bold"><?php echo $package->title; ?></h1>
                            </div>

                            <!-- Package Details -->
                            <div class="col-12 col-md-8 offset-md-2 text-center">
                                <div class="p-4 bg-light rounded shadow-sm">
                                    <p class="mb-2">Title: <strong><?php echo $package->title; ?></strong></p>
                                    <div class="user" onclick="window.location.href='{{ route('profile.show', ['id' => $userPQ->id]) }}'">
                                        <img src="{{ asset('img/avatar/' . $userPQ->avatar) }}" alt="User Avatar" class="avatar-img mr-2">
                                        <span class="name">{{ $userPQ->name }}</span>
                                    </div>

                                    <p class="mb-2">Number of Questions: <strong><?php echo $package->question_count; ?></strong></p>
                                    <p class="mb-2">Description:
                                        <strong><?php echo $package->description ?? 'No description provided'; ?></strong>
                                    </p>
                                    <p class="mb-2">Number of Attempts: <strong><?php echo $package->attempt_count; ?></strong></p>
                                    <p class="mb-2">Created At:
                                        <strong><?php echo date('d/m/Y H:i', strtotime($package->created_at)); ?></strong>
                                    </p>
                                    <p class="mb-2">Public:
                                        <strong class="<?php echo $package->public ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo $package->public ? 'Yes' : 'No'; ?>
                                        </strong>
                                    </p>
                                    <p class="mb-3">Number of points you can get:
                                        <strong>
                                            <?php
                                            $basePoints = $package->question_count * 2; // Điểm cơ bản cho mỗi câu hỏi là 2 điểm
                                            $totalPoints = $basePoints * 1.2; // Áp dụng hệ số x1.2 nếu hoàn thành 100% (chỉ hiển thị cho người dùng biết cách tính)
                                            echo $totalPoints;
                                            ?>
                                        </strong>
                                    </p>
                                    <p class="text-muted" style="font-size: 0.9em;">
                                        Calculation: <strong>Number of Questions</strong> x <strong>2 points</strong>
                                        <strong>x 1.2 multiplier</strong> (only for 100% completion)
                                    </p>

                                </div>
                            </div>

                            <!-- Button -->

                            <div class="col-12 text-center mt-4">

                                @if (Auth::user()->id === $package->author_id||$package->public)
                                <button class="btn btn-success px-4 py-2" id="but-pack" onclick="toggleQuestions()">
                                    <i class="fa-solid fa-play"></i>
                                    <i class="bi bi-play-circle me-2"></i>Start
                                </button>
                                <a href="{{ route('packages.edit', ['id' => $package->id]) }}"
                                    class="btn btn-secondary px-2 py-1"
                                    id="edit-link"
                                    @if(Auth::user()->id != $package->author_id) hidden @endif>
                                    <i class="fa-solid fa-file-pen"></i>
                                </a>

                                @endif

                                <?php if ($package->public) : ?>
                                    <p style="color: #888;">Note: Earn <strong>points</strong> based on your <strong>results</strong> for this <strong>public</strong> question package.</p>
                                <?php else : ?>
                                    <p style="color: #888;">Note: No <strong>points</strong> will be earned for your <strong>results</strong> in this <strong>private</strong> question package.</p>
                                <?php endif; ?>

                            </div>

                        </div>

                    </div>
                </header>


                <?php
                $questions = json_decode($jsonData, true);
                $numberOfQuestions = count($questions);
                $counter = 1;
                session(['questions' => $questions]);
                ?>


                <section class="section " id="question-container" style="display: none;">
                    <!-- <pre>{{ json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre> -->
                    <div class="container pt-5">

                        <div class="row gap-y text-center pr-4">

                            <?php
                            for ($i = 1; $i <= $numberOfQuestions; $i++) {
                                echo '
                                    <div class="col-4 col-md-4 col-lg-2 choice-btn">
                                        <div class="bg-black col-md-2 hover-shadow-8 rounded">
                                            <button class="btn btn-xs small '
                                    . ($i == 1 ? 'btn-secondary btn-info' : '') . '" 
                                                name="buttonQuestion' . $i . '" 
                                                onclick="showQuestions(' . $i . ')">
                                                Question ' . $i . '
                                            </button>
                                        </div>
                                    </div>
                                    ';
                            }
                            ?>
                        </div>
                        <!-- form -->
                        <form action="{{ route('submit.questions') }}" method='POST'>
                            @csrf
                            <?php foreach ($questions as $question): ?>
                                <div name="Question<?php echo $counter; ?>" style="display: <?php if ($counter != 1) {
                                                                                                echo 'none';
                                                                                            } else {
                                                                                                echo 'block';
                                                                                            } ?>;">
                                    <h6 class="divider mt-7 mb-1">Question <?php echo $counter; ?></h6>
                                    <p class="text-right">
                                        Correct Answers:
                                        <span class="text-success">
                                            <?php
                                            $correct_count = count(array_filter($question['correct_answers'], fn($correct) => $correct === "true"));
                                            $total_answers = count(array_filter($question['answers']));
                                            echo "$correct_count/$total_answers";
                                            ?>
                                        </span>
                                    </p>
                                    <h4 class="lead"><strong><?php echo $question['question']; ?></strong></h4>

                                    <div class="custom-controls-stacked">
                                        <?php foreach ($question['answers'] as $key => $answer): ?>
                                            <?php if ($answer !== null): // Kiểm tra nếu câu trả lời không rỗng 
                                            ?>
                                                <?php
                                                $checkbox_id = $question['id'] . '_' . $key;
                                                ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input lead" id="<?php echo $checkbox_id; ?>" name="<?php echo $question['id']; ?>[]" value="<?php echo $key; ?>">
                                                    <label class="custom-control-label lead" for="<?php echo $checkbox_id; ?>"><?php echo $answer; ?></label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class=" row">
                                            <div class="col">
                                                <?php
                                                if ($counter != 1) {
                                                    echo '<button type="button" name="previousQuestion' . $counter . 'Button" class="btn-round btn btn-outline-info">Previous Question</button>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col" style="text-align: right;">
                                                <?php
                                                if ($counter != $numberOfQuestions) {
                                                    echo '<button type="button" name="nextQuestion' . $counter . 'Button" class="btn-round btn btn-outline-info">Next Question</button>';
                                                }
                                                ?>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <?php $counter++; ?>
                            <?php endforeach ?>
                            <input type="hidden" name="title_package" value="<?php echo $package['title']; ?>">
                            <input type="hidden" name="id_package" value="<?php echo $package['id']; ?>">
                            <input type="hidden" name="is_public_package" value="<?php echo   $package->public; ?>">

                            <div class="mt-8 input-round pt-4" name='submitForm'>

                                <h6 class="divider mt-7 mb-1">Finish Quiz</h6>
                                <!-- Button to Open the Modal -->
                                <button type="submit" class="btn btn-round btn-block btn-outline-success">Submit Answers</button>

                            </div>

                            <div class="background" id="background"></div>

                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

<script>
    const totalQuestions = <?php echo $counter; ?>;
    const questionButtons = [];
    const questionDivs = [];
    const nextQuestionButtons = [];
    const previousQuestionButtons = [];
    const showQuestions = [];
    const markQuestions = [];

    for (let i = 1; i <= totalQuestions; i++) {
        questionButtons[i] = document.querySelector('[name=buttonQuestion' + i + ']');
        questionDivs[i] = document.querySelector('[name=Question' + i + ']');
        nextQuestionButtons[i] = document.querySelector('[name=nextQuestion' + i + 'Button]');
        previousQuestionButtons[i] = document.querySelector('[name=previousQuestion' + i + 'Button]');

        // Kiểm tra nếu các phần tử không tồn tại để tránh lỗi.
        if (!questionButtons[i] || !questionDivs[i]) continue;

        // Hàm hiển thị câu hỏi.
        showQuestions[i] = function() {
            questionButtons[i].classList.add('btn-secondary'); // Thêm màu xám cho nút (đã xem qua)
            questionDivs[i].style.display = 'block'; // Hiển thị câu hỏi
            questionButtons[i].classList.add('btn-info'); // Thêm class btn-info để highlight

            // Ẩn các câu hỏi khác.
            for (let j = 1; j <= totalQuestions; j++) {
                if (i !== j) {
                    questionDivs[j].style.display = 'none';
                    questionButtons[j]?.classList.remove('btn-info'); // Xóa highlight nút khác (nếu tồn tại)
                }
            }
        };

        // Hàm đánh dấu câu hỏi.
        markQuestions[i] = function() {
            questionButtons[i].classList.add('btn-secondary');
        };

        // Thêm sự kiện cho nút previous.
        if (i !== 1 && previousQuestionButtons[i]) {
            previousQuestionButtons[i].addEventListener('click', () => showQuestions[i - 1]());
        }

        // Thêm sự kiện cho nút next.
        if (i !== totalQuestions && nextQuestionButtons[i]) {
            nextQuestionButtons[i].addEventListener('click', () => showQuestions[i + 1]());
        }

        // Thêm sự kiện cho nút câu hỏi.
        questionButtons[i].addEventListener('click', showQuestions[i]);


    }
</script>
<script>
    function toggleQuestions() {
        var questionContainer = document.getElementById("question-container");
        var button = document.getElementById("but-pack");
        var buttonEdit = document.getElementById("edit-link");

        button.style.display = "none"; // Ẩn nút
        buttonEdit.style.display = "none";
        // Kiểm tra và chuyển đổi giữa hiện/ẩn
        if (questionContainer.style.display === "none") {
            questionContainer.style.display = "block"; // Hiện nếu đang ẩn
        } else {
            questionContainer.style.display = "none"; // Ẩn nếu đang hiện



        }
    }

    function hideButtons() {

    }
</script>
<script>
    function launchAlert(event) {
        event.preventDefault(); // Prevent form submission
        document.getElementById("background").style.display = "block";
        document.getElementById("alertBox").style.display = "block";
    }

    function closeAlert() {
        document.getElementById("background").style.display = "none";
        document.getElementById("alertBox").style.display = "none";
    }

    function submitForm() {
        closeAlert(); // Close the alert box
        document.querySelector("form").submit(); // Submit the form
    }

    angular.module('modalTest', ['ui.bootstrap', 'dialogs'])
        .controller('dialogServiceTest', function($scope, $rootScope, $timeout, $dialogs) {
            $scope.confirmed = 'You have yet to be confirmed!';
            $scope.name = '"Your name here."';

            $scope.launch = function(which) {
                var dlg = null;
                switch (which) {

                    // Error Dialog
                    case 'error':
                        dlg = $dialogs.error('This is my error message');
                        break;

                        // Wait / Progress Dialog
                    case 'wait':
                        dlg = $dialogs.wait(msgs[i++], progress);
                        fakeProgress();
                        break;

                        // Notify Dialog
                    case 'notify':
                        dlg = $dialogs.notify('Something Happened!', 'Something happened that I need to tell you.');
                        break;

                        // Confirm Dialog
                    case 'confirm':
                        dlg = $dialogs.confirm('Please Confirm', 'Is this awesome or what?');
                        dlg.result.then(function(btn) {
                            $scope.confirmed = 'You thought this quite awesome!';
                        }, function(btn) {
                            $scope.confirmed = 'Shame on you for not thinking this is awesome!';
                        });
                        break;

                        // Create Your Own Dialog
                    case 'create':
                        dlg = $dialogs.create('/dialogs/whatsyourname.html', 'whatsYourNameCtrl', {}, {
                            key: false,
                            back: 'static'
                        });
                        dlg.result.then(function(name) {
                            $scope.name = name;
                        }, function() {
                            $scope.name = 'You decided not to enter in your name, that makes me sad.';
                        });

                        break;
                }; // end switch
            }; // end launch

            // for faking the progress bar in the wait dialog
            var progress = 25;
            var msgs = [
                'Hey! I\'m waiting here...',
                'About half way done...',
                'Almost there?',
                'Woo Hoo! I made it!'
            ];
            var i = 0;

            var fakeProgress = function() {
                $timeout(function() {
                    if (progress < 100) {
                        progress += 25;
                        $rootScope.$broadcast('dialogs.wait.progress', {
                            msg: msgs[i++],
                            'progress': progress
                        });
                        fakeProgress();
                    } else {
                        $rootScope.$broadcast('dialogs.wait.complete');
                    }
                }, 1000);
            }; // end fakeProgress 

        }) // end dialogsServiceTest
        .controller('whatsYourNameCtrl', function($scope, $modalInstance, data) {
            $scope.user = {
                name: ''
            };

            $scope.cancel = function() {
                $modalInstance.dismiss('canceled');
            }; // end cancel

            $scope.save = function() {
                $modalInstance.close($scope.user.name);
            }; // end save

            $scope.hitEnter = function(evt) {
                if (angular.equals(evt.keyCode, 13) && !(angular.equals($scope.name, null) || angular.equals($scope.name, '')))
                    $scope.save();
            }; // end hitEnter
        }) // end whatsYourNameCtrl
        .run(['$templateCache', function($templateCache) {
            $templateCache.put('/dialogs/whatsyourname.html', '<div class="modal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> User\'s Name</h4></div><div class="modal-body"><ng-form name="nameDialog" novalidate role="form"><div class="form-group input-group-lg" ng-class="{true: \'has-error\'}[nameDialog.username.$dirty && nameDialog.username.$invalid]"><label class="control-label" for="username">Name:</label><input type="text" class="form-control" name="username" id="username" ng-model="user.name" ng-keyup="hitEnter($event)" required><span class="help-block">Enter your full name, first &amp; last.</span></div></ng-form></div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button><button type="button" class="btn btn-primary" ng-click="save()" ng-disabled="(nameDialog.$dirty && nameDialog.$invalid) || nameDialog.$pristine">Save</button></div></div></div></div>');
        }]); // end run / module
</script>

@endsection