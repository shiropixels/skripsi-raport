@extends('template.internal_master')
@section('title', 'Manage Kelas')
@section('content')
    <div class="container-fluid p-3">
        <div class="row ml-2 mb-3">
            <div class="col-4">
                <span class="text-bold" style="font-size:30px;">Manage Kelas</span>
            </div>
        </div>

        <div class="row ml-2 mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_kelas">
                    <i class="fa fa-plus"></i> Tambah Kelas
                </button>
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

        <!-- masih hardcode -->
        <ul class="nav nav-pills ml-3 mb-3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#kelas10">Kelas 10</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#kelas11">Kelas 11</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#kelas12">Kelas 12</a>
            </li>
        </ul>
        <!-- masih hardcode -->
        <div class="tab-content ml-3">
            <div id="kelas10" class="tab-pane active">
                <!-- 10 IPA -->
                <div class="row">
                    <div class="col-12">
                        @foreach ($data as $set)
                            @if($set->grade != 10) @continue @endif
                            <h3 class="text-bold"> {{ $set->class_specification }} </h3>

                            <table class="table table-striped table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>Nama Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($set->class_list as $item)
                                    <tr>
                                        <td> {{ $item->name }} </td>
                                        <td width="20%">
                                           <a href="/class-management/detail/{{ $item->id }}">
                                                <button type="button" class="btn btn-info" href="">Lihat</button>
                                            </a>

                                            <button type="button" class="btn btn-danger" onclick="triggerModal('/ajax/get-class-deactivate-modal/{{ $item->id }}');">
                                                Nonaktifkan
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="kelas11" class="tab-pane">
                @foreach ($data as $set)
                    @if($set->grade != 11) @continue @endif
                    <h3 class="text-bold"> {{ $set->class_specification }} </h3>

                    <table class="table table-striped table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($set->class_list as $item)
                            <tr>
                                <td> {{ $item->name }} </td>
                                <td width="20%">
                                <a href="/class-management/detail/{{ $item->id }}">
                                        <button type="button" class="btn btn-info" href="">Lihat</button>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="triggerModal('/ajax/get-class-deactivate-modal/{{ $item->id }}');">
                                        Nonaktifkan
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>

            <div id="kelas12" class="tab-pane">
                @foreach ($data as $set)
                    @if($set->grade != 12) @continue @endif
                    <h3 class="text-bold"> {{ $set->class_specification }} </h3>

                    <table class="table table-striped table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($set->class_list as $item)
                            <tr>
                                <td> {{ $item->name }} </td>
                                <td width="20%">
                                <a href="/class-management/detail/{{ $item->id }}">
                                        <button type="button" class="btn btn-info" href="">Lihat</button>
                                </a>

                                <button type="button" class="btn btn-danger" onclick="triggerModal('/ajax/get-class-deactivate-modal/{{ $item->id }}');">
                                    Nonaktifkan
                                </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('internal/class-management/functions-main/add-new-class')
@endsection