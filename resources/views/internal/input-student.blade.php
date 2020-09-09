@extends('template.internal_master')
@section('title', 'Input Siswa')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Siswa</h1>
                </div>
            </div>
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
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-12 d-flex justify-content-center">
                    <input type="text" class="form-control d-none" id="search-box" onkeyup="search();" placeholder="Cari nama siswa. . ." aria-label="" aria-describedby="basic-addon1">
                </div>
                <div class="col-md-3 col-12 d-flex justify-content-md-end justify-content-center mt-md-0 mt-2">
                    <button type="button" class="btn btn-primary" onclick="$('#student-add-modal').modal('show');"><i class="fa fa-plus"></i> Input Siswa Baru</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>NIS</th>
                            <th>Email</th>
                            <th>Nomer Telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="content">
                        @foreach ($students as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->class_name }}</td>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td class="d-block d-md-flex justify-content-center">
                                    <div class="d-flex justify-content-center mr-md-1 mr-0">
                                        <a onclick="triggerModal('/ajax/get-student/{{ $row->id }}');" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    </div>

                                    <div class="d-flex justify-content-center ml-md-1 ml-0 mt-2 mt-md-0">
                                        @if($row->active == 'Y')
                                            <button type="button" onclick="triggerModal('/ajax/get-student-deactivate/{{ $row->id }}');" class="btn btn-danger"><i class="fa fa-user-alt-slash"></i> Deactive</button>
                                        @else 
                                            <button type="button" onclick="triggerModal('/ajax/get-student-activate/{{ $row->id }}');" class="btn btn-info"><i class="fa fa-user-check"></i> Activate</button>
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

    <script type="text/javascript">
        let dataSet = {!! $students !!};
        let searchTextbox = $('#search-box');

        function search(){
            var htmlString = "";
            $('#content').empty();

            if(searchTextbox.val() == ""){
                dataSet.forEach(function(value, key){
                    htmlString += '<tr> <td> '+ value.name +' </td> <td> '+ value.class_name +' </td> <td>'+ value.code +'</td> <td> '+ value.email +' </td> <td> '+ value.phone +' </td> <td class="d-block d-md-flex justify-content-center"> <div class="d-flex justify-content-center mr-md-1 mr-0"> <a onclick="triggerModal(\'/ajax/get-student/'+value.id+'\');" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a> </div> <div class="d-flex justify-content-center ml-md-1 ml-0 mt-2 mt-md-0">'+ ((value.active == 'Y') ? '<a href="/auth/internal/input-walikelas/hapus/'+value.id+'" class="btn btn-danger"><i class="fa fa-user-alt-slash"></i> Deactive</a>' : '<a href="/auth/internal/input-walikelas/hapus/{{'+value.id+'}}" class="btn btn-info"><i class="fa fa-user-check"></i> Activate</a>' )+'</td></tr>';
                });
                $('#content').html(htmlString);
                return;
            }
            dataSet.forEach(function(value, key){
                if(value.name.includes(searchTextbox.val())){
                    htmlString += '<tr> <td> '+ value.name +' </td> <td> '+ value.class_name +' </td> <td>'+ value.code +'</td> <td> '+ value.email +' </td> <td> '+ value.phone +' </td> <td class="d-block d-md-flex justify-content-center"> <div class="d-flex justify-content-center mr-md-1 mr-0"> <a onclick="triggerModal(\'/ajax/get-student/'+value.id+'\');" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a> </div> <div class="d-flex justify-content-center ml-md-1 ml-0 mt-2 mt-md-0">'+ ((value.active == 'Y') ? '<a href="/auth/internal/input-walikelas/hapus/'+value.id+'" class="btn btn-danger"><i class="fa fa-user-alt-slash"></i> Deactive</a>' : '<a href="/auth/internal/input-walikelas/hapus/{{'+value.id+'}}" class="btn btn-info"><i class="fa fa-user-check"></i> Activate</a>' )+'</td></tr>';
                }    
            });

            $('#content').html(htmlString);
        }
    </script>

@endsection

@section('modal')
    @include('internal/student-functions/student-add-modal')
@endsection