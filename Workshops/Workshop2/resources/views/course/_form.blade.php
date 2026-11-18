@php
    $course = $course ?? new \App\Models\Course(['is_active' => true]);
@endphp

<x-form-input name="name" label="Name" :value="$course->name" required />
<x-form-textarea name="description" label="Description" :value="$course->description" rows="5" />
<div class="form-row">
    <x-form-input name="duration" label="Duration (weeks)" type="number" min="1" :value="$course->duration" required />
    <x-form-input name="fee" label="Fee" type="number" min="0" step="0.01" :value="$course->fee" required />
</div>

<div class="form-group">
    <label for="difficulty">Difficulty</label>
    <select id="difficulty" name="difficulty" class="form-control" required
            @error('difficulty') aria-invalid="true" aria-describedby="difficulty-error" @enderror>
        <option value="" disabled @selected(! old('difficulty', $course->difficulty))>Choose a level</option>
        @foreach(['Easy', 'Medium', 'Hard'] as $level)
            <option value="{{ $level }}" @selected(old('difficulty', $course->difficulty) === $level)>
                {{ $level }}
            </option>
        @endforeach
    </select>
    @error('difficulty')
        <p class="error" id="difficulty-error">{{ $message }}</p>
    @enderror
</div>

<div class="checkbox-group">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" id="is_active" name="is_active" value="1"
           @checked((bool) old('is_active', $course->is_active))>
    <label for="is_active">Course is active</label>
    @error('is_active')
        <p class="error">{{ $message }}</p>
    @enderror
</div>
