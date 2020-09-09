@extends(Session::has('school_internal')? 'template.internal_master':'template.student_master' )

@section('title', 'Ganti Password')
@section('content')
     
      <section class="content p-4">
        <!-- <div class="content-header">
                <div class="container-fluid">
                </div>
        </div> -->
        <div class="container-fluid">
          <div class="row mb-3">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Ganti Password</h1>
            </div>
          </div>
        @if($errors->any())
          <div class="alert alert-danger">{{ implode('', $errors->all('message')) }} </div>
        @endif
        @if(Session::has('school_internal'))
          <form method="POST" id="Update-Password" action="/password/update-password-school-internal">
        @else
          <form method="POST" id="Update-Password" action="/password/update-password-student">
        @endif
         	@method('patch')
         	@csrf
          <!-- Main row -->
          <div class="row">

            <div class="col-6">
              <div class="register">
                <div id="password-form">
                <input type="password" name="new-password" id="new-password" maxlength="50" minlength="8" id="password-field" class="form-control password-form-field w-50" placeholder="Password Baru">
                <input type="password" name="conf-password" id="conf-password" maxlength="50" minlength="8" id="password-field" class="form-control password-form-field w-50 mt-1" placeholder="Konfirmasi Password">
                </div>
                
                <button type="submit" class="btn btn-primary mt-3" id="submit-button">Submit</button>
              </div>
            </div>
          </div>
        </form>      
      </section>


  {{-- <script type="text/javascript">
  $('#submit-button').click(function (e) {
      if($('#new-password').val() == $('#conf-password').val())
      {
        $('#Update-Password').submit();
      }else{
        $.notify({ 
          message: 'Password lu berbeda dengan database tolong disamakan terima kasih!'
        },
          { 
            z_index: 99999, 
            type: 'danger',
            timer: 15000 
          });
      }
  });

  $('#new-password').keyup(function(e){
    if (e.keyCode === 13) {
        $('#conf-password').focus();
    }
  });

  $('#conf-password').keyup(function(e){
    if (e.keyCode === 13) {
        $('#submit-button').click();
    }
  });
  
  </script> --}}
@endsection