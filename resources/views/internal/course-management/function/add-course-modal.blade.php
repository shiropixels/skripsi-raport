<form method="post" action="/course-management/create">
    @csrf

    <div class="modal" id="mata_pelajaran" tabindex="-1" role="dialog" aria-labelledby="Tambah Mata Pelajaran" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Tambah Mata Pelajaran">Tambah Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEdit" class="col-sm-4 col-form-label">Mata Pelajaran:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputMP" required name="name" placeholder="Nama Mata Pelajaran">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPengetahuan" class="col-sm-4 col-form-label">KKM:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control numeric-text" pattern="[0-9]" required id="inputKKM" name="kkm" min="0" max="100" placeholder="KKM">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
    </div>
</form>
