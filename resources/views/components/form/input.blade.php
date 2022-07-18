<input type="{{ !empty($type) ? $type : 'text' }}" class="{{ $class }}" name="{{ $name }}"
    id="{{ $id }}" @if ($value) value="{!! $value !!}" @endif
    placeholder="{{ $placeholder }}" @if ($disabled) disabled="disabled" @endif
    @if ($required) required="required" @endif
    @if ($readonly) readonly="readonly" @endif
    {{ $attributes->except(['placeholder', 'disabled', 'required', 'readonly']) }} />
@error($name)
    <x-alert :message="$message" />
@enderror

{{ $class }}
