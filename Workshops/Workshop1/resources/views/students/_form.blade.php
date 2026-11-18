<div class="form-grid">
    <div class="field">
        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $student?->name) }}" required maxlength="255">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $student?->email) }}" required maxlength="255">
    </div>

    <div class="field">
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone', $student?->phone) }}" required maxlength="20">
    </div>

    <div class="field">
        <label for="date_of_birth">Date of Birth</label>
        <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth', $student?->date_of_birth?->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}">
    </div>

    <div class="field full">
        <label for="address">Address</label>
        <textarea id="address" name="address" maxlength="500">{{ old('address', $student?->address) }}</textarea>
    </div>
</div>
