@extends('template.internal_master')
@section('title', 'Manage Mata Pelajaran')
@section('content')

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <span class="text-bold" style="font-size:30px;">Manage Mata Pelajaran</span>
            </div>
        </div>

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

        <div class="row mb-3">
            <div class="col-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mata_pelajaran">
                <i class="fa fa-plus"></i> Tambah Mata Pelajaran
            </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <table class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>KKM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $mp)
                    <tr>
                        <td> {{$mp->name}} </td>
                        <td> {{ (int) $mp->min_grade}} </td>
                        <td>
                        <button type="button" class="btn btn-primary" onclick="triggerModal('/ajax/get-course-edit-modal/{{ $mp->id }}');">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger"  onclick="triggerModal('/ajax/get-course-delete-modal/{{ $mp->id }}');">
                            Hapus
                        </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('internal/course-management/function/add-course-modal')
@endsection