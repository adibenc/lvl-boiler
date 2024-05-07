<div class="form-group">
  <label>{{ $label }}</label>
    <select class="form-control {{ $classApp }}" id="{{ $id }}" name="{{ $name }}" 
      placeholder="{{ $placeholder }}" {{ $required }} value="{{ $value }}" {{ $attr }}>
      <option value="">{{ $initPlaceholder ?? "-" }}</option>
      @foreach($datas as $e)
        @php
          $e = $mappedItem($e);
          $slc = $value == $e['val'] ? "selected" : "";
        @endphp
        <option {{ $slc }} value="{{ $e['val'] }}">{{ $e['label'] }}</option>
      @endforeach
    </select>
</div>