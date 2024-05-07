<div id="{{ $id }}" class="modal fade">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}modaltitle">{{ $title }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer d-flex {{ $mfooterjustify ? 'justify-content-between' : ""}}">
                {{ $mfooter ?? "" }}
            </div>
        </div>
    </div>
</div>