@if(session('error'))
    <div class="alert alert-danger" role="alert">
        <div class="container">
            <div class="alert-icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <strong class="text-white">
                {{ session('error') }}
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa fa-window-close"></i>
                </span>
            </button>
        </div>
    </div>
@elseif(session('success'))
    <div class="alert alert-success" role="alert">
        <div class="container">
            <div class="alert-icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <strong class="text-white">
                {{ session('success') }}
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa fa-window-close"></i>
                </span>
            </button>
        </div>
    </div>
@endif