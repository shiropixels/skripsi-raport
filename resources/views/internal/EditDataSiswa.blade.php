@extends('template.internal_master')
@section('title', 'Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Data Siswa</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="post" action="/student/internal/update/{{$students->id}}">
          {{csrf_field()}}
          {{method_field('PUT')}}
    
    
          <!-- /.content-header -->
    
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
    
              <!-- Main row -->
              <div class="row">
              <input type="hidden" name="id" value="{{$students->id}}">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIS</th>
                      <th>Kelas</th>
                      <th>Email</th>
                      <th>Nomer Telpon</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input class="form-control" type="text" name="name" id="name" value="{{$students->name}}"></td>
                      <td><input class="form-control" type="text" name="code" id="code" value="{{$students->code}}" ></td>

                      <td>
                      <select class="custom-select" name="class_id" required>
                        <option value="">--Pilih class--</option>
                        @foreach($class as $item)
                            <option value="{{ $item->id }}" @if($students->class_id == $item->id) selected @endif> {{ $item->class_name }}</option>
                        @endforeach
                      </select>
                    </td>
                      <td><input class="form-control" type="email" name="email" id="email" value="{{$students->email}}"></td>
                      <td><input class="form-control" type="text" name="phone" id="phone" value="{{$students->phone}}"></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <div class="form-group">
                  <input type="submit" class="btn btn-success" value="Simpan">
                </div>
                <div class="card-body">
                </div>
              </div>
            </form>
            <!-- /.row (main row) -->
    @endsection

      </div><!-- /.container-fluid -->
    </div>