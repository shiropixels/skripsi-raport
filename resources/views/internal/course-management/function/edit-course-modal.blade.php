<form method="post" action="/course-management">
    @csrf
    {{ method_field('PUT') }}
    <input type="hidden" name="id" value="{{ $data->id }}" />

    <div class="modal" id="edit_mataPelajaran" tabindex="-1" role="dialog" aria-labelledby="Edit Mata Pelajaran" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Tambah Mata Pelajaran">Edit Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputMP" placeholder="ID" hidden>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEdit" class="col-sm-4 col-form-label">Mata Pelajaran:</label>
                    <div class="col-sm-8">
                    <input type="text" name="name" value="{{ $data->name }}" required class="form-control" id="inputMP" placeholder="Mata Pelajaran">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPengetahuan" class="col-sm-4 col-form-label">KKM:</label>
                    <div class="col-sm-8">
                    <input type="number" name="kkm" value="{{ $data->min_grade }}" required pattern="[0-9]" class="form-control" id="inputKKM" min="0" max="100" placeholder="75">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
    </div>
</form>

    <script type="text/javascript">
        $('#edit_mataPelajaran').modal('show');
    </script>