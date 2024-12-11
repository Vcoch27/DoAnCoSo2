<div class="card" id="package-card-{{ $questionPackage->id }}">
    <div class="card-body">
        <h6>Title: {{ $questionPackage->title }} <span class="badge badge-sm bg-gradient-{{$questionPackage->public ? 'success' : 'warning'}}">{{$questionPackage->public ? 'Public' : 'Private'}}</span></h6>
        <p>Tags:
            @forelse($questionPackage->tags as $tag)
            <span class="badge bg-primary">{{ $tag->name }}</span>
            @empty
            <span class="badge bg-secondary">No tags available</span>
            @endforelse
        </p>
        <p>Description: {{ $questionPackage->description ?? 'No description available.' }}</p>

        <h6>Questions:</h6>
        <div style="max-height: 25rem; overflow-y: auto;">
            <ul class="question-list" style="text-align: left; ">
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
        </div>

        <!-- Các nút điều khiển -->
        <div class="card" id="package-card-{{ $questionPackage->id }}">
            <div class="card-body">
                <button class="btn btn-danger delete-btn" data-id="{{ $questionPackage->id }}">Delete</button>
                @if($questionPackage->public)
                <button class="btn btn-secondary public-btn" data-id="{{ $questionPackage->id }}" data-public="{{ $questionPackage->public }}">Cancel Public Mode</button>
                @else
                <button class="btn btn-info public-btn" data-id="{{ $questionPackage->id }}" data-public="{{ $questionPackage->public }}">Update Public Mode</button>
                @endif

            </div>
        </div>


    </div>
</div>