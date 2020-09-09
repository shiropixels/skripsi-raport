<form method="post" action="/class-management/assign-student">
    @csrf
    <input type="hidden" name="class_id" value="{{ $class->id }}" />

    <div class="modal" id="tambah_Siswa" tabindex="-1" role="dialog" aria-labelledby="ts" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="tw">Tambah Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <select class="js-select2 form-control" name="student_id" style="width: 100%;" data-placeholder="Pilih Siswa">
                        <option></option>
                        @foreach ($all_student as $set)
                            <option value="{{ $set->id }}"> {{ $set->name }} </option>
                        @endforeach                        
                    </select>
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
