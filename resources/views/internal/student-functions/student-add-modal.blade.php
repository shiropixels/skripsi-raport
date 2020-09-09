<form method="POST" action="/student/internal/store">
    @csrf

<div class="modal fade" id="student-add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h3 class="modal-title" id="exampleModal3Label">Add Student</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" onclick="addForm();" class="btn btn-primary"> <i class="fa fa-plus"></i> Add More</button>
                </div>
            </div>

            <hr />

            <span id="multiple-form-school-internal">
                <div class="row">
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> Name </strong>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <input name="name[]" type="text" class="form-control" required placeholder="Input Name" value="" />
                    </div>
                </div>

                <div class="row mt-4 mt-md-2">
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> NIS </strong>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <input name="nis[]" type="text" class="form-control numeric-text" required placeholder="Input NIS" value="" />
                    </div>
                </div>

                <div class="row mt-4 mt-md-2">
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> Email </strong>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <input name="email[]" type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required placeholder="Input Email" value="" />
                    </div>
                </div>

                <div class="row mt-4 mt-md-2">
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> Password </strong>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <input name="password[]" type="password" class="form-control" required placeholder="Input Password" value="" />
                    </div>
                </div>

                <div class="row mt-4 mt-md-2">
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> Phone </strong>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <input name="phone[]" type="text" class="form-control numeric-text" required placeholder="Input Phone" value="" />
                    </div>
                </div>

                <div class="row mt-4 mt-md-2 mb-2">
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> Role </strong>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                        <select class="custom-select" disabled="true">
                            <option value="1" selected> Student </option>
                        </select>
                    </div>
                </div>
            </span>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
    let form = $('#multiple-form-school-internal');
    let count = 0;


    function addForm(){
        count++;
        form.append('<span id="multiple-form-number-'+count+'"> <hr /> <div class="row mb-2"> <div class="col-12 d-flex justify-content-end"> <button type="button" onclick="removeForm(\'multiple-form-number-'+count+'\');" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button> </div> </div> <div class="row"> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <strong class="align-self-center lead"> Name </strong> </div> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <input name="name[]" type="text" class="form-control" required placeholder="Input Name" value="" /> </div> </div> <div class="row mt-4 mt-md-2"> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <strong class="align-self-center lead"> NIS </strong> </div> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <input name="nis[]" type="text" class="form-control numeric-text" required placeholder="Input NIS" value="" /> </div> </div> <div class="row mt-4 mt-md-2"> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <strong class="align-self-center lead"> Email </strong> </div> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <input name="email[]" type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$" required placeholder="Input Email" value="" /> </div> </div> <div class="row mt-4 mt-md-2"> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <strong class="align-self-center lead"> Password </strong> </div> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <input name="password[]" type="password" class="form-control" required placeholder="Input Password" value="" /> </div> </div> <div class="row mt-4 mt-md-2"> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <strong class="align-self-center lead"> Phone </strong> </div> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <input name="phone[]" type="text" class="form-control numeric-text" required placeholder="Input Phone" value="" /> </div> </div> <div class="row mt-4 mt-md-2 mb-2"> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <strong class="align-self-center lead"> Role </strong> </div> <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start"> <select class="custom-select" disabled="true"> <option value="1" selected> Student </option> </select> </div> </div> </span><script type="text/javascript" src="{{ asset('js/custom/js-only-input-number.js') }}"><\/script>');
    }

    function removeForm(id){
        var formToDelete = $('#'+id);

        formToDelete.remove();
    }
</script>