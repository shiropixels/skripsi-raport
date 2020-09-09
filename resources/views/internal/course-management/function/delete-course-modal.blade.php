<form method="post" action="/course-management/{{ $data->id }}">
    @csrf
    {{ method_field('PATCH') }}

    <div class="modal" id="hapus_mataPelajaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <Span style="font-size:20px;">Anda yakin ingin menghapus mata pelajaran</Span>
                <span class="text-bold" style="font-size:20px;">{{ $data->name }}</span>
                <Span style="font-size:20px;">?</Span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#hapus_mataPelajaran').modal('show');
</script>