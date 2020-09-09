@extends('template.internal_master')
@section('title', 'Manage Legalisir')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid pl-4 pt-2">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Legalisir</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        @if (Session::get('message') != null)
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
            <form action="{{url('internal/legalization')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead"> Nama Kepala Sekolah </strong>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                    <div class="custom-file">
                        <input name="headmaster" type="text" class="form-control" required placeholder="Input Name" value="{{$attribute['headmaster']}}" />
                    </div>
                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead">Tanda Tangan</strong>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <div class="custom-file">
                            <input name="signature" type="file" class="custom-file-input" id="signatureInput" accept="image/x-png"
                                onchange="document.getElementById('signaturePreview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="signatureInput">Choose file</label>
                        </div>
                        <img src="{{ url($attribute['signature']??'https://placehold.it/80x80') }}" id="signaturePreview"
                            class="img-thumbnail">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <strong class="align-self-center lead">Stempel</strong>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <div class="custom-file">
                            <input type="file" name="stample" class="custom-file-input" id="stampleInput" accept="image/x-png"
                                onchange="document.getElementById('stamplePreview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="stampleInput">Choose file</label>
                        </div>
                        <img src="{{ url($attribute['stample']??'https://placehold.it/80x80') }}" id="stamplePreview"
                            class="img-thumbnail">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 text-center">
                        <button type="submit" class="btn btn-primary btn-md btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
