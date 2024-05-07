<div class="card-nb gradient-bottom" style="border-color: #813131;border-width: medium;">
    {{ $header ?? '' }}
    {{-- height: 315px; overflow: hidden;  --}}
    <div class="card-body {{ $class }}" id="{{ $id }}" tabindex="2" style="outline: none;" {{ $attri }}>
        <ul class="list-unstyled list-unstyled-border">
            @foreach($dataArr as $item)
                {{ $mappedItem($item) }}
            @endforeach
        </ul>
    </div>
    {{ $footer ?? '' }}
</div>