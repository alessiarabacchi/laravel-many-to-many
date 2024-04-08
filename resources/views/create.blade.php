<select name="type_id">
    <option value="">Seleziona una Tipologia</option>
    @foreach($types as $type)
        <option value="{{ $type->id }}" {{ (isset($project) && $project->type_id == $type->id) ? 'selected' : '' }}>
            {{ $type->name }}
        </option>
    @endforeach
</select>

<select name="technologies[]" multiple>
    @foreach($technologies as $technology)
        <option value="{{ $technology->id }}" @if(in_array($technology->id, $selectedTechnologies)) selected @endif>{{ $technology->name }}</option>
    @endforeach
</select>
