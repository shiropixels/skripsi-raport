@extends('template.internal_master')
@section('title', 'Dashboard')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Data WaliKelas</h1>
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
            <form method="post" action="/auth/internal/store">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama WaliKelas ..">

                    @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email WaliKelas ..">

                    @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone WaliKelas ..">

                    @if ($errors->has('phone'))
                        <div class="text-danger">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password WaliKelas ..">

                    @if ($errors->has('password'))
                        <div class="text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>
        </div>
    </div>
@endsection
