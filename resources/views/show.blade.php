

<div>
    <strong>Tipologia:</strong> {{ $project->type->name ?? 'Non specificato' }}
</div>

@if($project->technologies->isNotEmpty())
    <p>Tecnologie utilizzate:</p>
    <ul>
        @foreach($project->technologies as $technology)
            <li>{{ $technology->name }}</li>
        @endforeach
    </ul>
@endif


@if($project->cover_image)
    <img src="{{ asset('storage/projects/'.$project->cover_image) }}" alt="Cover Image">
@endif
