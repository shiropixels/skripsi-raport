<script type="text/javascript" src="{{ asset('js/custom/js-only-input-number.js') }}"></script>

<form method="POST" action="/student/internal/update/{{$data->id}}">
    @csrf
    {{ method_field('PUT') }}

<div class="modal fade" id="student-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModal3Label">Edit Siswa - {{ $data->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <strong class="align-self-center lead"> Nama </strong>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <input name="name" type="text" class="form-control" required placeholder="Input Nama" value="{{ $data->name }}" />
                </div>
            </div>

            <div class="row mt-4 mt-md-2">
                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <strong class="align-self-center lead"> NIS </strong>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <input name="nis" type="text" class="form-control numeric-text" required placeholder="Input NIS" value="{{ $data->code }}" />
                </div>
            </div>

            <div class="row mt-4 mt-md-2">
                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <strong class="align-self-center lead"> Email </strong>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <input name="email" type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required placeholder="Input Email" value="{{ $data->email }}" />
                </div>
            </div>

            <div class="row mt-4 mt-md-2">
                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <strong class="align-self-center lead"> Nomor Telpon </strong>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                    <input name="phone" type="text" class="form-control numeric-text" required placeholder="Input Nomor Telpon" value="{{ $data->phone }}" />
                </div>
            </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
    $('#student-detail-modal').modal('show');

</script>