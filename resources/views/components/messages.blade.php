{{-- @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show notice notice-danger notice-sm" role="alert">
        <strong><i class="fa fa-exclamation-triangle"></i></strong>
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}
@if($errors->any())
    @foreach($errors->all() as $error)
        @php
            echo '<script> toastr.error("'.$error.'") </script>';  
        @endphp
    @endforeach
@endif