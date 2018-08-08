@if(session('error'))
    <div class="alert alert-danger notice notice-danger notice-sm" role="alert">
        <div class="container">
            <strong><i class="fa fa-exclamation-triangle"></i></strong>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa fa-window-close"></i>
                </span>
            </button>
        </div>
    </div>
@elseif(session('success'))
    <div class="alert alert-success notice notice-success notice-sm" role="alert">
        <div class="container">
            <strong><span class="fa fa-check"></span></strong>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa fa-window-close"></i>
                </span>
            </button>
        </div>
    </div>
@endif