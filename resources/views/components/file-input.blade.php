<div>
    <label for="{{ $attributes->get('id') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <input type="file" {{ $attributes->merge(['class' => 'form-control']) }}>
</div>
