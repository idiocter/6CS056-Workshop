<div class="form-grid">
    <div class="field">
        <label for="name">Course Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $course?->name) }}" required maxlength="255">
    </div>

    <div class="field">
        <label for="duration">Duration in Weeks</label>
        <input id="duration" name="duration" type="number" value="{{ old('duration', $course?->duration) }}" required min="1" max="520">
    </div>

    <div class="field">
        <label for="fee">Fee</label>
        <input id="fee" name="fee" type="number" value="{{ old('fee', $course?->fee) }}" required min="0" step="0.01">
    </div>

    <div class="field">
        <label for="difficulty">Difficulty</label>
        <select id="difficulty" name="difficulty" required>
            <option value="">Choose difficulty</option>
            @foreach (['Easy', 'Medium', 'Hard'] as $difficulty)
                <option value="{{ $difficulty }}" @selected(old('difficulty', $course?->difficulty) === $difficulty)>{{ $difficulty }}</option>
            @endforeach
        </select>
    </div>

    <div class="field full">
        <label for="description">Description</label>
        <textarea id="description" name="description" required maxlength="2000">{{ old('description', $course?->description) }}</textarea>
    </div>

    <div class="field full checkbox">
        <input id="is_active" name="is_active" type="checkbox" value="1" @checked(old('is_active', $course?->is_active ?? true))>
        <label for="is_active">Course is active</label>
    </div>
</div>
