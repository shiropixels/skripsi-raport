<form method="post" action="/class-management">
    @csrf

    <div class="modal" id="tambah_kelas" tabindex="-1" role="dialog" aria-labelledby="tambah_kls" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah_kls">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- masih hardcode -->
            <div class="modal-body">
                    <div class="form-group row">
                        <label for="tingkatan" class="col-sm-3 col-form-label">Tingkatan:</label>
                        <div class="col-sm-9">
                            <select name="grade" class="custom-select">
                            <option value="" selected>Tingkatan...</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tingkatan" class="col-sm-3 col-form-label">Peminatan:</label>
                        <div class="col-sm-9">
                            <select name="major" class="custom-select">
                            <option selected>Peminatan...</option>
                                <option value="MIA">MIA</option>
                                <option value="IIS">IIS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_kelas" class="col-sm-3 col-form-label">Nama Kelas:</label>
                        <div class="col-sm-9">
                            <input type="text" name="class_name" class="form-control text-uppercase" id="nama_kelas" placeholder="Nama Kelas">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </div>
        </div>
    </div>
</form>
