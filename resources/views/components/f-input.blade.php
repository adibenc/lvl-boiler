<div class="form-group">
  <label>{{ $label }}</label>
  
  @if($btngroup)
    <div class="btn-group">
      <input type="{{ $type }}" class="form-control {{ $classApp }}" id="{{ $id }}" name="{{ $name }}" 
      placeholder="{{ $placeholder }}" {{ $required }} value="{{ $value }}" {{ $attr }}>
      <button id="{{ $btngroup['id'] }}" type="button" class="btn btn-success">{{ $btngroup['label'] }}</button>
    </div>
  @elseif($prepend)
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
              {{ $prepend }}
            </div>
        </div>
        <input type="{{ $type }}" class="form-control {{ $classApp }}" id="{{ $id }}" name="{{ $name }}" 
      placeholder="{{ $placeholder }}" {{ $required }} value="{{ $value }}" {{ $attr }}>
    </div>
  @else
    <input type="{{ $type }}" class="form-control {{ $classApp }}" id="{{ $id }}" name="{{ $name }}" 
      placeholder="{{ $placeholder }}" {{ $required }} value="{{ $value }}" {{ $attr }}>
  @endif
</div>