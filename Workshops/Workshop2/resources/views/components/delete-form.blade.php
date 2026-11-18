@props(['action', 'label' => 'Delete'])

<form action="{{ $action }}" method="POST" class="inline-form"
      onsubmit="return confirm('Are you sure you want to delete this record?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-small">{{ $label }}</button>
</form>
