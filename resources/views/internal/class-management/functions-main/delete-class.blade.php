<form method="post" action="/class-management/deactivate/class/{{ $data->id }}">
    @csrf 

    {{ method_field('PATCH') }}
    <div class="modal" id="hapus_Kelas" tabindex="-1" role="dialog" aria-labelledby="hapus_kelas" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- masih hardcode -->
            <div class="modal-body">
                <Span style="font-size:20px;">Anda yakin ingin menghapus kelas</Span>
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
    $('#hapus_Kelas').modal('show');
</script>