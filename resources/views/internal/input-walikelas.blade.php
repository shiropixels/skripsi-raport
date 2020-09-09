@extends('template.internal_master')
@section('title', 'Input WaliKelas')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid pl-4 pt-2">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar WaliKelas</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        @if(Session::get('message') != null)
        <div class="row">
          <div class="col-12">
            <div class="alert alert-success" role="alert">
              <strong>
                {{ Session::get('message') }}
              </strong>
            </div>
          </div>
        </div>

        @elseif(Session::get('error') != null)
        <div class="row">
          <div class="col-12">
            <div class="alert alert-danger" role="alert">
              <strong>
                {{ Session::get('error') }}
              </strong>
            </div>
          </div>
        </div>
        @endif

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
    <section class="content">
        <div class="container-fluid p-4">

          <div class="row mb-4">
            <div class="col-12 d-flex justify-content-end">
              <button type="button" class="btn btn-primary" onclick="$('#school-internal-add-modal').modal('show');"><i class="fa fa-plus"></i> Tambah Internal Sekolah</button>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Nomor Telpon</th>           
                  <th>Aksi</th>           
                </tr>
              </thead>
              <tbody>
                @foreach($school_internal as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>         
                    <td>{{$row->email}}</td> 
                    <td>{{$row->phone}}</td>      
                    <td class="d-block d-md-flex justify-content-center">
                      <div class="d-flex justify-content-center mr-md-1 mr-0">
                        <button onclick="triggerModal('/ajax/get-school-internal/{{ $row->id }}')" class="btn btn-warning mr-2"><i class="fa fa-edit"></i> Edit</button>
                      </div>

                      <div class="d-flex justify-content-center ml-md-1 ml-0 mt-2 mt-md-0">
                        @if($row->active == 'Y')
                          <button type="button" onclick="triggerModal('/ajax/get-school-internal-deactivate/{{ $row->id }}');" class="btn btn-danger"><i class="fa fa-user-alt-slash"></i> Non-Aktifkan</button>
                        @else 
                          <button type="button" onclick="triggerModal('/ajax/get-school-internal-activate/{{ $row->id }}');" class="btn btn-info"><i class="fa fa-user-check"></i> Aktifkan</button>
                        @endif
                      </div>
                    </td> 
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </section>


  <script type="text/javascript" src="{{ asset('js/custom/js-only-input-number.js') }}"></script>
@endsection

@section('modal')
  @include('internal/school-internal-functions/school-internal-add-modal')

@endsection