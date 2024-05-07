<div class="single-upselling">
    <img src="https://dummyimage.com/200x200/555/fff" alt="">
    <div class="detail">
        <div class="title">{{ $name }}</div>
        <div class="price">@Rp{{ $price }}</div>
        <div class="progress">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $percent }}%;"
            aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">{{ $percent }}%</div>
        </div>
        <div class="target">Target : <span>{{ $progress }}/{{ $target }}</span></div>
    </div>
</div>