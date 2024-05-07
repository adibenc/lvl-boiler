<!-- metronic field -->
<div class="{{ $classp }}">
	<label class="{{ $colSize }} col-form-label fw-semibold fs-6">
		<span class="required">{{ $label }}</span>
	</label>
	{{ $exch }}
	<div class="{{ $colSize }} fv-row fv-plugins-icon-container">
		<input name="{{ $name }}" class="form-control" 
			type="{{ $type }}" placeholder="{{ $name }}" value="{{ $value }}" {{ $attrs }}>
	</div>
</div>