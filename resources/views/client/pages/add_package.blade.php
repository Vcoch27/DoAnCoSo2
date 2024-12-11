<!-- resources/views/client/pages/homepage.blade.php -->

<!-- Kế thừa layout  -->
@extends('client.layouts.app')

@push('styles')
<link href="{{ asset('client/assets/css/now-ui-kit.css') }}" rel="stylesheet" />
<link href="{{ asset('css/components/header.css') }}" rel="stylesheet" />
@vite('resources/css/homepage.css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ------------------- -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/create_packages.css') }}" rel="stylesheet" />

@endpush

@section('title', 'Add packages')

@section('content')

<div class="container my-4" style=" position: relative;">

    @if (session('testValue'))
    <pre>{{ json_encode(json_decode(session('testValue')), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    @endif

    <form action="{{ route('packages.store') }}" method="post">

        @csrf
        <!-- Header and Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Create Packages Questions For You</h2>

            <div>

                <button type="submit" class="btn btn-secondary me-2">Create</button>
                <button class="btn btn-primary">Create and practice</button>
            </div>

        </div>
        <!-- Public packages -->
        @if (Auth::user()->isPremium)
        <div class="mb-3">
            <h6>Public Visibility</h6>
            <div class="d-flex align-items-center mb-2">
                <label class="switch me-3">
                    <input type="checkbox" name="register_public" id="register_public">

                    <span class="slider"></span>
                </label>
                <span>
                    Your question pack can be made <strong>publicly visible</strong> to <strong>all users</strong>.
                    Once enabled, it will be subject to an <strong>approval process</strong>, which may take <strong>some time</strong>.
                </span>

            </div>
        </div>
        @else
        <div class="mb-3">
            <p>
                <strong>Basic User Notice:</strong> Your question pack will be private and only accessible to you for practice.
            </p>
            <p>
                Upgrade to a premium plan to make your question pack public and shareable with others.
                <a class="btn button-up-pre" href="{{ route('premium') }}">Update here</a>
            </p>
        </div>
        @endif


        <!-- Title and Description Inputs -->
        <div class="mb-3">
            <label for="title">
                <h6>Title:</h6>
            </label>
            <input type="text" name="title" class="form-control" placeholder="Enter a title, like 'Biology - Chapter 22: Evolution'">
        </div>
        <div class="mb-3">
            <label for="title">
                <h6>Description:</h6>
            </label>
            <textarea name="description" class="form-control" placeholder="Add a description..."></textarea>
        </div>

        <!-- Action Buttons Row -->
        <div class="d-flex mb-3">
            <input type="hidden" name="tags[]" id="tags-input" value="">

            <div class="menu">
                <div class="tags-input-container"></div>
                <div class="item">
                    <a href="#" class="link">
                        <span> Add Tag </span>
                        <svg viewBox="0 0 360 360" xml:space="preserve">
                            <g id="SVGRepo_iconCarrier">
                                <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393 c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393 s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"></path>
                            </g>
                        </svg>
                    </a>
                    <div class="submenu">
                        <!-- Lặp qua danh sách tags và hiển thị chúng -->
                        @foreach($tags as $tag)
                        <div class="submenu-item">
                            <a href="#" class="submenu-link" data-id="{{ $tag->id }}">{{ $tag->name }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card__tags">
                <ul class="tag"></ul>
            </div>
        </div>
        <div class="d-flex mb-3">
            <button type="button" class="btn btn-secondary me-2" id="import-questions-btn">+ Import Questions</button>

        </div>



        <div id="question-container">
        </div>
        <button type="button" class="btn btn-primary add-question-btn">Add Question</button>

        <button type="submit" class="btn btn-secondary me-2">Create</button>


    </form>
    <!-- Add more cards as needed -->
    <div id="import-questions-modal" style=" position: absolute;top: 80px;width: 100%;display:none;">
        <!-- <div id="import-questions-modal" style="display:none;"> -->
        <textarea id="import-json" rows="10" cols="30" class="area-import" placeholder='Paste your JSON here:
{
  "questions": [
    {
      "question_text": "What is the capital of France?",
      "answers": [
        {
          "is_correct": "on",
          "answer_text": "Paris"
        },
        {
          "answer_text": "London"
        },
        {
          "answer_text": "Berlin"
        }
      ]
    },
    {
      "question_text": "What is 2 + 2?",
      "answers": [
        {
          "is_correct": "on",
          "answer_text": "4"
        },
        {
          "answer_text": "5"
        },
        {
          "answer_text": "3"
        }
      ]
    }
  ]
}'></textarea>

        <button id="submit-import-btn">Submit</button>
        <button id="close-modal-btn">Close</button>
    </div>
    <div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 20;"></div>
</div>


<script>
    const questionContainer = document.getElementById("question-container");
    const addQuestionButton = document.querySelector(".add-question-btn");

    // Thêm một câu hỏi mới khi bấm nút "Add Question"
    addQuestionButton.addEventListener("click", () => addNewQuestion());

    function addNewQuestion() {
        const questionIndex = questionContainer.children.length;

        // Create a new question card
        const newQuestionCard = document.createElement("div");
        newQuestionCard.className = "question-card card text-white-custom mb-3";
        newQuestionCard.setAttribute("data-question-index", questionIndex);

        newQuestionCard.innerHTML = `
    <div class="card-body">
        <div class="mb-3">
            <div class="justify-container">
                <label class="form-label">Question ${questionIndex + 1}</label>
                <button type="button" class="btn delete-question-btn"><i class="fa-solid fa-folder-minus"></i></button>
            </div>
            <input type="text" class="form-control text-white-custom question-input" 
                   placeholder="Enter your question here" name="questions[${questionIndex}][question_text]">
        </div>
        <div class="options-section">
            <label class="form-label">Options</label>
            <div class="form-check d-flex justify-content-between align-items-center option-item">
                <label class="container-checkbox">
                    <input type="checkbox" name="questions[${questionIndex}][answers][0][is_correct] ">
                    <div class="checkmark"></div>
                </label>
                <div class="input-wrapper">
                    <input type="text" class="option-input" placeholder="Enter option" 
                           name="questions[${questionIndex}][answers][0][answer_text]">
                </div>
                <i class="fa-solid fa-trash trash-icon" style="cursor: pointer;"></i>
            </div>
            <button type="button" class="btn btn-primary mt-3 add-option-btn">Add Option</button>
        </div>
    </div>
    `;


        questionContainer.appendChild(newQuestionCard);
        addOptionAndDeleteHandlers(newQuestionCard);
        updateQuestionLabels();
    }

    function addOptionAndDeleteHandlers(questionCard) {
        const addOptionButton = questionCard.querySelector(".add-option-btn");

        // Thêm một tùy chọn mới trong câu hỏi
        addOptionButton.addEventListener("click", () => {

            const optionsSection = questionCard.querySelector(".options-section");
            const questionIndex = questionCard.getAttribute("data-question-index");
            const optionIndex = optionsSection.querySelectorAll(".option-item").length;
            const newOption = document.createElement("div");
            newOption.className = "form-check d-flex justify-content-between align-items-center option-item";
            newOption.innerHTML = `
        <label class="container-checkbox">
            <input type="checkbox" name="questions[${questionIndex}][answers][${optionIndex}][is_correct]">
            <div class="checkmark"></div>
        </label>
        <div class="input-wrapper">
            <input type="text" class="option-input" placeholder="Enter option" 
                   name="questions[${questionIndex}][answers][${optionIndex}][answer_text]">
        </div>
        <i class="fa-solid fa-trash trash-icon" style="cursor: pointer;"></i>
    `;
            optionsSection.insertBefore(newOption, addOptionButton);

            // Gán sự kiện thay đổi giá trị cho checkbox is_correct
            const checkbox = newOption.querySelector("input[type='checkbox']");
            checkbox.addEventListener("change", () => {
                checkbox.setAttribute("value", checkbox.checked ? "true" : "false");
            });

            // Gán sự kiện xóa cho tùy chọn
            const trashIcon = newOption.querySelector(".trash-icon");
            trashIcon.addEventListener("click", () => optionsSection.removeChild(newOption));
        });

        const deleteQuestionButton = questionCard.querySelector(".delete-question-btn");
        // Xóa câu hỏi và cập nhật nhãn các câu hỏi còn lại
        deleteQuestionButton.addEventListener("click", () => {
            questionContainer.removeChild(questionCard);
            updateQuestionLabels();
        });

        // Gán sự kiện xóa cho các tùy chọn có sẵn trong câu hỏi
        questionCard.querySelectorAll(".trash-icon").forEach(trashIcon => {
            trashIcon.addEventListener("click", function() {
                const optionItem = this.closest(".option-item");
                optionItem.parentElement.removeChild(optionItem);
            });
        });
    }

    function updateQuestionLabels() {
        Array.from(questionContainer.children).forEach((questionCard, index) => {
            questionCard.querySelector(".form-label").textContent = `Question ${index + 1}`;
            questionCard.setAttribute("data-question-index", index);
        });
    }

    // Khởi tạo các sự kiện cho câu hỏi đầu tiên (nếu có sẵn)
    document.querySelectorAll(".question-card").forEach(card => addOptionAndDeleteHandlers(card));


    // -----------------JavaScript để thêm/xóa tag và input ẩn---------------
    document.addEventListener("DOMContentLoaded", function() {
        const tagsInputContainer = document.querySelector(".tags-input-container");

        // Hàm cập nhật input ẩn
        function updateHiddenInput() {
            // Lấy tất cả các input ẩn đã tạo từ các tag
            const hiddenInputs = Array.from(tagsInputContainer.querySelectorAll("input[name='tags[]']"));

            // Xóa tất cả các input ẩn hiện có
            hiddenInputs.forEach(input => input.remove());

            // Lấy danh sách các tag và tạo các input ẩn tương ứng
            const tagIds = Array.from(document.querySelectorAll(".tag__name"))
                .map(tag => tag.getAttribute("data-id"))
                .filter(tagId => tagId !== null && tagId !== ""); // Lọc bỏ null và giá trị rỗng

            // Tạo input ẩn mới cho từng tag
            tagIds.forEach(tagId => {
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "tags[]";
                hiddenInput.value = tagId;
                tagsInputContainer.appendChild(hiddenInput); // Thêm vào container
            });
        }

        document.querySelectorAll(".submenu-link").forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault();

                const tagText = item.textContent.trim();
                const tagId = item.getAttribute("data-id");
                const existingTags = document.querySelectorAll(".tag__name");

                // Kiểm tra xem tag đã tồn tại chưa
                let tagExists = false;
                existingTags.forEach(tag => {
                    if (tag.getAttribute("data-id") === tagId) {
                        tagExists = true;
                    }
                });

                if (!tagExists && tagId !== null && tagId !== "") { // Kiểm tra tagId hợp lệ
                    // Thêm tag mới vào danh sách
                    const newTag = document.createElement("li");
                    newTag.classList.add("tag__name");
                    newTag.setAttribute("data-id", tagId);
                    newTag.innerHTML = `${tagText} <sup>x</sup>`;
                    document.querySelector(".tag").appendChild(newTag);

                    // Cập nhật input ẩn
                    updateHiddenInput();

                    // Xóa tag khi nhấn 'x'
                    newTag.querySelector("sup").addEventListener("click", function() {
                        newTag.remove();
                        updateHiddenInput();
                    });
                }
            });
        });
    });
</script>
<script>
    // Các phần tử
    const importQuestionsBtn = document.getElementById("import-questions-btn");
    const importQuestionsModal = document.getElementById("import-questions-modal");
    const importJsonTextarea = document.getElementById("import-json");
    const submitImportBtn = document.getElementById("submit-import-btn");
    const closeModalBtn = document.getElementById("close-modal-btn");

    const overlay = document.getElementById("overlay");


    // Hiển thị modal khi bấm "Import Questions"
    importQuestionsBtn.addEventListener("click", () => {
        importQuestionsModal.style.display = "block";
        overlay.style.display = "block";
    });

    // Đóng modal
    closeModalBtn.addEventListener("click", () => {
        importQuestionsModal.style.display = "none";
        importJsonTextarea.value = ""; // Reset input
        overlay.style.display = "none";
    });

    // Xử lý Import
    submitImportBtn.addEventListener("click", () => {
        const jsonText = importJsonTextarea.value.trim();
        try {
            jsonData = JSON.parse(jsonText); //phân tích cú pháp chuỗi JSON thành một đối tượng.
            //Kiểm tra xem JSON có chứa mảng questions hay không
            if (!jsonData.questions) {
                alert("Invalid JSON format! Please ensure the 'questions' array is present.");
                return;
            }
            for (let index = 0; index < jsonData.questions.length; index++) {
                const question = jsonData.questions[index];
                const questionIndex = questionContainer.children.length;
                const newQuestionCard = document.createElement("div");
                newQuestionCard.className = "question-card card text-white-custom mb-3";
                newQuestionCard.setAttribute("data-question-index", questionIndex);

                const answersHTML = question.answers.map((answer, i) => `
                    <div class="form-check d-flex justify-content-between align-items-center option-item">
                        <label class="container-checkbox">
                            <input type="checkbox" name="questions[${questionIndex}][answers][${i}][is_correct]" 
                            ${answer.is_correct === "on" ? "checked" : ""}>
                            <div class="checkmark"></div>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" class="option-input" placeholder="Enter option" 
                                value="${answer.answer_text || ""}" 
                                name="questions[${questionIndex}][answers][${i}][answer_text]">
                        </div>
                        <i class="fa-solid fa-trash trash-icon" style="cursor: pointer;"></i>
                    </div>
                    `).join("");

                newQuestionCard.innerHTML = `
                  <div class="card-body">
                    <div class="mb-3">
                        <div class="justify-container">
                            <label class="form-label">Question ${questionIndex + 1}</label>
                            <button type="button" class="btn delete-question-btn">
                                <i class="fa-solid fa-folder-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control text-white-custom question-input" 
                            placeholder="Enter your question here" 
                            value="${question.question_text || ""}" 
                            name="questions[${questionIndex}][question_text]">
                    </div>
                    <div class="options-section">
                        <label class="form-label">Options</label>
                        ${answersHTML}
                        <button type="button" class="btn btn-primary mt-3 add-option-btn">Add Option</button>
                    </div>
                </div>
                 `;
                questionContainer.appendChild(newQuestionCard);
                addOptionAndDeleteHandlers(newQuestionCard);
            }
        } catch (error) {
            if (error instanceof SyntaxError) {
                alert(`Invalid JSON format! Please check your format.\nError: ${error.message}\nLine number: ${error.lineNumber}`);
            } else {
                alert(`An unexpected error occurred: ${error.message}`);
            }
        } finally {
            importQuestionsModal.style.display = "none";
            importJsonTextarea.value = ""; // Reset input
            overlay.style.display = "none";

        }

    });
</script>


@endsection