@extends('template.internal_master')
@section('title', 'Lupa Password')
@section('content')
<div class="container-fluid">
    <div class="row m-3">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lupa Password Staff</h1>
        </div>
    </div>

    <div class="row m-3">
        <div class="col-6">
            <form>
                <label for="inputEmail" class="col-sm-12 col-form-label" style="font-size:20px;">Email:</label> 
                <div class="form-group row">
                    <div class="col-sm-10 m-2">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 m-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection