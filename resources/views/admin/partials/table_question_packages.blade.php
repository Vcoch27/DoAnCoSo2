<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th class="text-center">Number of Questions</th>
            <th class="text-center">Attempts</th>
            <th class="text-center">Mode</th>
            <th class="text-center">Created Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($packages as $package)
        <tr>
            <td>{{ $package->title }}</td>
            <td>{{ $package->author->name }}</td>
            <td class="text-center">{{ $package->question_count }}</td>
            <td class="text-center">{{ $package->attempt_count }}</td>
            <td class="text-center">{{ $package->public ? 'Public' : 'Private' }}</td>
            <td class="text-center">{{ $package->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="#" class="text-secondary font-weight-bold text-xs">Edit</a>
                <a href="#" onclick="return confirm('Are you sure?')" class="text-secondary font-weight-bold text-xs">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination-container">
    {{ $packages->links('pagination::bootstrap-5') }}
</div>