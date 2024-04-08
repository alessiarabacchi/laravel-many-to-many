

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
