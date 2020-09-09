<form method="POST" action="/student/deactivate/{{$data->id}}">
    @csrf
    {{ method_field('PATCH') }}

<div class="modal fade" id="student-deactive-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModal3Label">Deactive Student - {{ $data->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <p class="lead">
                        Are you sure to deactive <strong>{{ $data->name }}</strong> ?
                    </p>
                </div>
            </div>
            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Deactive Student</button>
            </div>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
    $('#student-deactive-modal').modal('show');

</script>