<form method="post" action="">
    @csrf
    <input type="hidden" name="class_id" value="{{ $id }}" />

    <div class="modal" id="daftar_mata_pelajaran" tabindex="-1" role="dialog" aria-labelledby="ts" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="tw">Mata Pelajaran Kelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex justify-content-start">
                            <h3 class="align-self-center"> Daftar Mata Pelajaran </h3>
                        </div>

                        <div class="col-12 col-md-6 d-flex justify-content-end mt-2 mt-md-0">
                            <button type="button" class="btn btn-warning" id="edit-btn" onclick="editMap();"> <i class="fa fa-edit"></i> Edit</button>                
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div id="editing-alert" class="col-12 alert alert-warning d-none" role="alert">
                            <strong>You currently editing Daftar Mata pelajaran</strong>
                            <p class="text-weight-bolder">
                                Silahkan melakukan pemilihan kelas dengan metode Drag and Drop, atau dengan memilih mata pelajaran dan mengikuti instruksi warna yang ada.
                            </p>
                        </div>

                        <div id="current-not-in-map" class="col-12 col-md-6 d-none">
                            <h3 id="unselect-title" class="d-none">Mata Pelajaran</h3>

                            <ul id="not-in-map-list" class="list-group" ondragover="allowDropUnselect(event)" ondrop="dropToUnselect(event)">
                                
                                    <li class="list-group-item no-data-available-in-not-map @if($counter_non_mapped != 0) d-none @endif" onclick="selectedUnselected($(this));">
                                        Tidak ada data
                                    </li>
                                
                                @foreach ($data as $set)
                                    @if($set->ada == 1) @continue @endif

                                    <li draggable="true" onclick="selectedUnselected($(this));" id="{{ $set->id }}" class="list-group-item" ondragstart="dragUnselected(event)">
                                        {{ $set->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div id="current-selected-map" class="col-12 col-md-12 mt-4 mt-md-0">
                            <h3 id="select-title" class="d-none">Mata Pelajaran Kelas Ini</h3>

                            <ul id="in-map-list" class="list-group" ondragover="allowDropSelect(event)" ondrop="dropToSelect(event)">
                                
                                    <li class="list-group-item no-data-available-in-map @if($counter != 0) d-none @endif" onclick="selectedSelected($(this));">
                                        Tidak ada data
                                    </li>
                                
                                @foreach ($data as $set)
                                    @if($set->ada == 0) @continue @endif

                                    <li draggable="true" id="{{ $set->id }}" onclick="selectedSelected($(this));" class="list-group-item" ondragstart="dragSelected(event)">
                                        {{ $set->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    var enableEdit = false;

    $('#daftar_mata_pelajaran').modal('show');

    $('#fab').removeClass('d-none');

    $('#daftar_mata_pelajaran').on('hidden.bs.modal', function (e) {
        $('#fab').addClass('d-none');
    });

    function editMap(){
        $('#current-selected-map').removeClass('col-md-12');
        $('#current-selected-map').addClass('col-md-6');
        $('#current-not-in-map').removeClass('d-none');
        $('#editing-alert').removeClass('d-none');

        $('#select-title').removeClass('d-none');
        $('#unselect-title').removeClass('d-none');
        $('edit-btn').prop('disabled', 'disabled');

        $('#in-map-list > .list-group-item').addClass('list-group-item-info');

        enableEdit = true;
    }

{{-- DRAG AND DROP SECTION --}}
    function dragSelected(e){
        e.dataTransfer.setData("text", e.target.id);
    }

    function dropToSelect(e){
        e.preventDefault();
        var data = e.dataTransfer.getData("text");
        var setDiv = document.getElementById("in-map-list");

        createMapping(document.getElementById(data).id);

        $('#'+data).attr('onclick', "selectedSelected($(this));");
        $('#'+data).attr('ondragstart', "dragSelected(event)");
        
        setDiv.appendChild(document.getElementById(data));

        if(!$('.no-data-available-in-map').hasClass('d-none')){
            $('.no-data-available-in-map').addClass('d-none');
        }

        if($('#not-in-map-list > .list-group-item').length == 1){
            $('.no-data-available-in-not-map').removeClass('d-none');
        }

        clearSelection();
    }

    function allowDropSelect(e){ e.preventDefault(); }

    function dragUnselected(e){
        e.dataTransfer.setData("text", e.target.id);
    }

    function dropToUnselect(e){
        e.preventDefault();
        var data = e.dataTransfer.getData("text");
        var unsetDiv = document.getElementById("not-in-map-list");

        $('#'+data).attr('onclick', "selectedUnselected($(this));");
        $('#'+data).attr('ondragstart', "dragUnselected(event)");

        deleteMapping(document.getElementById(data).id);

        unsetDiv.appendChild(document.getElementById(data));

        if(!$('.no-data-available-in-not-map').hasClass('d-none')){
            $('.no-data-available-in-not-map').addClass('d-none');
        }

        if($('#in-map-list > .list-group-item').length == 1){
            $('.no-data-available-in-map').removeClass('d-none');
        }

        clearSelection();
    }

    function allowDropUnselect(e){ e.preventDefault(); }

    var globalUnselectTemp = null;
    var globalSelectedTemp = null;

{{-- Select Method --}}
    function selectedUnselected(e){
        if(enableEdit == false) return;

        if(globalSelectedTemp != null){
            if(globalSelectedTemp.prop('id') == ""){
                globalSelectedTemp = null;
                clearSelection();
                return;
            }

            deleteMapping(globalSelectedTemp.prop('id'));

            var temp = globalSelectedTemp;
            globalSelectedTemp.remove();

            temp.attr("onclick", "selectedUnselected($(this));");
            temp.attr('ondragstart', "dragUnselected(event)");

            $('#not-in-map-list').append(temp.prop('outerHTML'));

            if(!$('.no-data-available-in-not-map').hasClass('d-none')){
                $('.no-data-available-in-not-map').addClass('d-none');
            }

            if($('#in-map-list > .list-group-item').length == 1){
                $('.no-data-available-in-map').removeClass('d-none');
            }

            globalSelectedTemp = null;
            clearSelection();
            return;         
        }

        if(e.prop('id') == "") return;

        globalUnselectTemp = e;
        
        $('#in-map-list > .list-group-item').removeClass('list-group-item-info');
        $('#in-map-list > .list-group-item').addClass('list-group-item-success');
        $('#not-in-map-list > .list-group-item').removeClass('list-group-item-secondary');

        $('#not-in-map-list > .list-group-item').removeClass('list-group-item-success');
        e.addClass('list-group-item-success');
    }

    function selectedSelected(e){
        if(enableEdit == false) return;
        
        //In case drop
        if(globalUnselectTemp != null){
            if(globalUnselectTemp.prop('id') == "") {
                globalUnselectTemp = null;
                clearSelection();
                return;
            }

            createMapping(globalUnselectTemp.prop('id'));
            
            var temp = globalUnselectTemp;
            globalUnselectTemp.remove();

            temp.attr("onclick", "selectedSelected($(this));");
            temp.attr('ondragstart', "dragSelected(event)");

            $('#in-map-list').append(temp.prop('outerHTML'));

            if(!$('.no-data-available-in-map').hasClass('d-none')){
                $('.no-data-available-in-map').addClass('d-none');
            }

            console.log($('#not-in-map-list > .list-group-item').length);

            if($('#not-in-map-list > .list-group-item').length == 1){
                $('.no-data-available-in-not-map').removeClass('d-none');
            }

            globalUnselectTemp = null;
            clearSelection();
            return;           
        }

        if(e.prop('id') == "") return;

        globalSelectedTemp = e;

        $('#not-in-map-list > .list-group-item').removeClass('list-group-item-success');
        $('#not-in-map-list > .list-group-item').addClass('list-group-item-secondary');
        $('#in-map-list > .list-group-item').removeClass('list-group-item-primary');
        $('#in-map-list > .list-group-item').removeClass('list-group-item-success');

        $('#in-map-list > .list-group-item').removeClass('list-group-item-secondary');
        $('#in-map-list > .list-group-item').addClass('list-group-item-info');
        e.removeClass('list-group-item-info');
        e.addClass('list-group-item-secondary');
    }

    {{-- Cancel Selection --}}

    $('#fab').click(function(e){
        clearSelection();
    });

    function clearSelection(){
        globalSelectedTemp = null;
        globalUnselectTemp = null;

        $('#not-in-map-list > .list-group-item').removeClass('list-group-item-success');
        $('#not-in-map-list > .list-group-item').removeClass('list-group-item-primary');
        $('#not-in-map-list > .list-group-item').removeClass('list-group-item-info');
        $('#not-in-map-list > .list-group-item').addClass('list-group-item-secondary');
        $('#in-map-list > .list-group-item').removeClass('list-group-item-primary');
        $('#in-map-list > .list-group-item').removeClass('list-group-item-success');
        $('#in-map-list > .list-group-item').addClass('list-group-item-info');
    }

{{-- SERVICES --}}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function createMapping(id){
        $.ajax({
            "method": "POST", 
            "dataType": 'json', 
            "url": "/class-management/mapping-course",
            "data": {
                "course_id": id,
                "class_id": {!! $id !!}
            },
            "success": function(e){
                if(e.status){
                    alert("Data berhasil disimpan");
                }else{
                    alert(e.message);
                }
            },
            "error": function(xhr, status, error){
                alert("An error occured: "+ xhr);
            }
        });
    }

    function deleteMapping(id){
        $.ajax({
            "method": "DELETE", 
            "dataType": 'json', 
            "url": "/class-management/mapping-course/delete/",
            "data": {
                "course_id": id,
                "class_id": {!! $id !!}
            },
            "success": function(e){
                if(e.status){
                    alert("Data berhasil disimpan");
                }else{
                    alert(e.message);
                }
            },
            "error": function(xhr, status, error){
                alert("An error occured: "+ xhr);
            }
        });
    }
</script>