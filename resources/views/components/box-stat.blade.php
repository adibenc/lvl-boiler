<div class="col-lg-{{ $size }} col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div id="{{ $id }}" class="card-icon {{ $type }} text-white" style="font-size: 20px">
            {{ $number }}
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>{{ $name }}</h4>
            </div>
            <div id="{{ $id }}body" class="card-body">
                {{ $body }}
            </div>
        </div>
    </div>
</div>