<form method="POST" action="/pelajaran/internal/update-score">
    @csrf
    {{ method_field('PUT') }}
    <input type="hidden" name="rh_id" value="{{ $data->id }}" />

    <div class="modal" id="modalNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="inputEdit" class="col-sm-3 col-form-label">Edit:</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $data->course_name }}" class="form-control" id="inputEdit" placeholder="Nama Mata Pelajaran"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPengetahuan" class="col-sm-3 col-form-label">Pengetahuan:</label>
                            <div class="col-sm-9">
                                <input type="number" pattern="[0-9]" required value="{{ $data->score }}" name="score" class="form-control" id="inputPengetahuan" min="0" max="100"
                                    placeholder="Nilai Mata Pelajaran">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputKeterampilan" class="col-sm-3 col-form-label">Keterampilan:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" pattern="[0-9]" required value="{{ $data->practicume }}" name="practicume" id="inputKeterampilan" min="0" max="100"
                                    placeholder="Nilai Mata Pelajaran">
                            </div>
                            <!-- <div class="invalid-feedback">Isi nilai dari 0 sampai 100</div> -->
                        </div>
                        <div class="form-group row">
                            <label for="inputCatatan" class="col-sm-3 col-form-label">Catatan:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control responsive" required value="{{ $data->description }}" name="description" id="inputCatatan"
                                    placeholder="Isi Catatan">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#modalNilai').modal('show');
</script>
