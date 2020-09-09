<form method="post" action="/class-management/assign-school-internal">
  @csrf
  <input type="hidden" name="class_id" value="{{ $class->id }}" />

  <div class="modal" id="tambah_Walikelas" tabindex="-1" role="dialog" aria-labelledby="tw" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tw">Tambah Walikelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form>
            @empty($s_internals[0]->name)

              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Walikelas 1:</label>
                  <div class="col-sm-9">
                    <select class="js-select2 form-control" name="walikelas[]" id="walikelas1" style="width: 100%;" data-placeholder="Pilih Walikelas">
                        <option></option>
                        @foreach ($all_teacher as $set)
                            <option value="{{ $set->id }}"> {{ $set->name }} </option>
                        @endforeach                        
                    </select>
                  </div>
              </div>

            @endif
            @empty($s_internals[1]->name)
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Walikelas 2:</label>
                  <div class="col-sm-9">
                    <select class="js-select2 form-control" name="walikelas[]" id="walikelas2" style="width: 100%;" data-placeholder="Pilih Walikelas">
                        <option></option>
                        @foreach ($all_teacher as $set)
                            <option value="{{ $set->id }}"> {{ $set->name }} </option>
                        @endforeach
                    </select>
                  </div>
              </div>
            @endif
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
</div>
</form>
