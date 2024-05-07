<div class="{{ $classp }}">
	<label class="{{ $colSize }} col-form-label fw-semibold fs-6">
		<span class="required">{{ $label }}</span>
	</label>
	{{ $exch }}
	<div class="{{ $colSize }} fv-row fv-plugins-icon-container">
		<select name="{{ $name }}" class="form-control form-control-lg" id="{{ $id }}"
			placeholder="{{ $placeholder }}"
			>
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
</div>