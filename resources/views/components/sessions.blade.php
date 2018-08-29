{{-- @if(session('error'))
    <div class="alert alert-danger notice notice-danger notice-sm" role="alert">
        <strong><i class="fa fa-exclamation-triangle"></i></strong>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="fa fa-window-close"></i>
            </span>
        </button>
    </div>
@elseif(session('success'))
    <div class="alert alert-success notice notice-success notice-sm" role="alert">
        <strong><span class="fa fa-check"></span></strong>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="fa fa-window-close"></i>
            </span>
        </button>
    </div>
@endif --}}

@if(session('error'))
    @php
        echo '<script> toastr.error("'.session("error").'")</script>';
    @endphp
@elseif(session('success'))
    @php
        echo '<script> toastr.success("'.session("success").'")</script>';
    @endphp
@endif