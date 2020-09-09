@extends('template.internal_master')
@section('title', 'Dashboard')
@section('content')
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Daftar Siswa {{ $tbl_student[0]->class_name }}</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
              <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nama</th>
                      <th>NIS</th>

                    </tr>
                  </thead>
                  <tbody`>
                  @foreach($tbl_student as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->nis}}</td>
                    <td> 
                      <a href="/pelajaran/internal/student-grade-list/{{ $row->id}}" class="btn btn-info">Detail Nilai</a>
                    </td>
                  </tr>
                  @endforeach


                </tbody>
              </table>

            </div>



          </section>
        </div>
      </div>
    </section>
@endsection