<label for="{{ $name }}" class="lbp-label">{{ $label }}</label>
@if ($type === 'textarea')
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" class="lbp-input"
              rows={{ $rows }} {{ $required }}>{{ $value }}</textarea>
@else
    <input name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" type="{{ $type }}"
           placeholder="{{ $placeholder }}" class="lbp-input" {{ $required }}>
@endif

@error($name)
<div class="text-red-500 text-sm mt-2">{{ $message }}</div>
@enderror
