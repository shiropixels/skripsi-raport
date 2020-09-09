<form method="POST" action="/class-management/deactivate/school-internal/{{ $data->id }}">
    @csrf 
    {{ method_field('PATCH') }}

    <div class="modal" id="deactivate-school-internal" tabindex="-1" role="dialog" aria-labelledby="naw" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="naw">Non-aktifkan Walikelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <Span style="font-size:20px;">Anda yakin ingin Mentidak-aktifkan walikelas</Span>
            <span class="text-bold" style="font-size:20px;">{{ $data->name }}</span>
            <Span style="font-size:20px;">?</Span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Non-aktifkan</button>
            </div>
        </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#deactivate-school-internal').modal('show');
</script>