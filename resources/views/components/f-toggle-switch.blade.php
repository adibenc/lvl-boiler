<div class="form-group">
    <div class="control-label">{{ $label }}</div>
    <label class="custom-switch mt-2">
      <input type="checkbox" name="{{ $name }}" class="custom-switch-input" value="{{ $value }}" {{ $vchecked ? "checked" : ""}}>
      <span class="custom-switch-indicator"></span>
      <span class="custom-switch-description">{{ $label2 }}</span>
    </label>
</div>