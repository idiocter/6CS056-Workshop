@props(['type' => 'success'])

@if(session($type))
    <div class="alert alert-{{ $type }}" role="status">
        {{ session($type) }}
    </div>
@endif
