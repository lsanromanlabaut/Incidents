@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show col-md-5" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-check"></i>
        <strong> {{ session('message') }} </strong>
    </div>
@endif