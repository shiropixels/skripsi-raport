@extends('template.internal_master')
@section('title', 'Dashboard')
@section('content')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Data Siswa</h1>
          </div>
        </div>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="/student/internal/store">
     {{csrf_field()}}    
     <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Siswa ..">

                            @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif

                        </div>

                         <div class="form-group">
                            <label>Nis</label>
                               <input type="text" name="nis" class="form-control" placeholder="Nis Siswa ..">

                             @if($errors->has('nis'))
                                <div class="text-danger">
                                    {{ $errors->first('nis')}}
                                </div>
                            @endif

                        </div>

                        

                        <div class="form-group">
                            <label>Email</label>
                               <input type="text" name="email" class="form-control" placeholder="Email Siswa ..">

                             @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                            @endif

                        </div>


                         <div class="form-group">
                            <label>No Telepon</label>
                              <input type="text" name="phone" class="form-control" placeholder="Phone Siswa ..">

                             @if($errors->has('phone'))
                                <div class="text-danger">
                                    {{ $errors->first('phone')}}
                                </div>
                            @endif



                        </div>

                        
                         <div class="form-group">
                            <label>Password</label>
                              <input type="password" name="password" class="form-control" placeholder="Password Siswa ..">

                             @if($errors->has('password'))
                                <div class="text-danger">
                                    {{ $errors->first('password')}}
                                </div>
                            @endif
                            
                         <div class="form-group">
                            <label>class</label>

                            <select class="custom-select" name="class_id" required>
                                <option value="">--Pilih class--</option>
                                @foreach($class as $item)
                                    <option value="{{ $item->id }}"> {{ $item->class_name }}</option>
                                @endforeach
                            </select>

                             @if($errors->has('class_id'))
                                <div class="text-danger">
                                    {{ $errors->first('class_id')}}
                                </div>
                            @endif

                        </div>
                            

                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

        </form>
      </div>
    </div>
@endsection
