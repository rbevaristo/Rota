@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle"></i>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            <strong>{{ $error }}</strong> 
        @endforeach
    </div>
@endif