@extends('template.internal_master')
@section('title', 'Manage class')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage class</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      @foreach($rapot->raport_headers as $data)
          <div class="row">
            <div class="card-body table-responsive-sm">       
            <h3 class="m-0 text-dark">class {{ $data->grade }} Semester {{ $data->semester }}</h3>
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                    <th>Nama class</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  @empty($data->classNama)
                    <tr>
                      <td colspan="5">
                        <div class="d-flex justify-content-center align-self-center">
                          Data Kosong
                        </div>
                      </td>
                    </tr>
                  @else   
                    @foreach($data->class as $classNama)
                      <tr>
                        <td> {{ $pelajaran->class_name }} </td>
                      </tr>
                      <td>
               
                  " class="btn btn-danger">Hapus</a>
                </td>
                    @endforeach
                  @endempty
                </tbody>
              </table>
            </div>
          </div>
      @endforeach
    </section>
@endsection