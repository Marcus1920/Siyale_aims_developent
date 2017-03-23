@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="#">User Groups</a></li>
    <li class="active">User Groups Listing</li>
</ol>

<h4 class="page-title">USER GROUPS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">User Groups Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddRole">
     Add User Groups
    </a>
</div>

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
    @if(Session::has('success'))
      <div class="alert alert-success alert-icon">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ Session::get('success') }}
          <i class="icon">&#61845;</i>
      </div>
    @endif

    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="rolesTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@include('roles.edit')
@include('roles.add')
@include('roles.permissions')
@include('roles.addGroupPermission')

@endsection

@section('footer')

 <script>
  $(document).ready(function() {


  var oTable     = $('#rolesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/roles-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-permissions-per-group/" + d.id + "') !!}' class='btn btn-sm'>" + d.name + "</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateRoleModal(id)
    {

       $(".modal-body #roleID").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/roles/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditRole #name").val(data[0].name);

            }
            else {
               $("#modalEditRole #name").val('');
            }

        }
    });

    }

    function launchPermissions(id) {


          if ( $.fn.dataTable.isDataTable( '#groupPermissionsTable' ) ) {
            oTablePermissionTable.destroy();
          }

          oTablePermissionTable     = $('#groupPermissionsTable').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "dom": '<"toolbar">frtip',
            "order" :[[1,"desc"]],
            "ajax": "{!! url('/permissions-list/" + id +"')!!}",
             "columns": [
            {data: function(d){

                  return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

            }},
            {data: 'name', name: 'name'},


           ],

        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [ 0] },
            { "bSortable": false, "aTargets": [ 0] }
        ]

        });

          var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchGroupPermissions();' data-target='.modalSelectGroupPermissions' class='tooltips' title='Add Group Permission'><i class='sa-list-add'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteGroupPermission("+ id +");' class='tooltips' title='Delete Group Permission'><i class='sa-list-delete'></i></a>";

          $("div.toolbar").html(buttonVar);

          $("#addGroupPermissionsForm #groupID").val(id);








    }

     $("#closeGroupPermissions").on("click",function(){

          $('#modalAddRolePermissions').modal('toggle');

      });

      $("#closePerm").on("click",function(){

          $('#modalSelectGroupPermissions').modal('toggle');

      });


 $('#selecctall').on('click',function(){


  var checkValue =  $(this).attr("data-value");

  if (checkValue == 0)
  {
    $(this).attr('data-value','1');
    $(this).html('deselect/All');
    $('.chk').each(function() {
            this.checked = true;
    });
  }
  else {

    $(this).attr('data-value','0');
     $(this).html('select/All');
    $('.chk').each(function() {
            this.checked = false;
    });
  }


});
 

 var oPoiTable;

function launchGroupPermissions() {


      if ( $.fn.dataTable.isDataTable( '#allPermissionsTable' ) ) {
            oPoiTable.destroy();
      }



       oPoiTable     = $('#allPermissionsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "bPaginate":false,
                "dom": 'rtip',
                "ajax": "{!! url('/permissions-list')!!}",
                "order" :[[0,"desc"]],
                 "columns": [

                    {data: function(d){

                      return "<input class='checkbox-custom chk' name='checkbox-1[]' value=" + d.id + " type='checkbox'>";

                    }},
                    {data: 'name', name: 'permissions.name'}
                   

               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 0] },
                { "bSortable": false, "aTargets": [ 0] }
            ]

         });





    $('#modalAddRolePermissions').modal('toggle');

}



  $('#selecctallpermissions').on('click',function(){


  var checkValue =  $(this).attr("data-value");

  if (checkValue == 0)
  {
    $(this).attr('data-value','1');
    $(this).html('deselect/All');
    $('.chk').each(function() {
            this.checked = true;
    });
  }
  else {

    $(this).attr('data-value','0');
     $(this).html('select/All');
    $('.chk').each(function() {
            this.checked = false;
    });
  }


});


 $("#submitAddPermissionsGroupForm").on("click",function(){


        var myForm   = $("#addGroupPermissionsForm")[0];
        var formData = new FormData(myForm);
        var token    = $('input[name="_token"]').val();

        $.ajax({
        type    :"POST",
        data    : formData,
        contentType: false,
        processData: false,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/addGroupPermission')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> creating meeting  please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){


            if (data.message == 'Permission Added!') {

                HoldOn.close();
                $('#modalSelectGroupPermissions').modal('toggle');
                $('#modalAddRolePermissions ').modal('toggle');
                $('#addGroupPermissionsForm')[0].reset();
                $("#MeetingAttendeeNotification").html('<div class="alert alert-success alert-icon">Well done! permission has been added successfully <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');

                if ( $.fn.dataTable.isDataTable( '#groupPermissionsTable' ) ) {
                    oTablePermissionTable.destroy();
                  }

                  oTablePermissionTable     = $('#groupPermissionsTable').DataTable({
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"toolbar">frtip',
                    "order" :[[1,"desc"]],
                    "sAjaxSource": "{!! url('/permissions-list/" + data.groupID +"')!!}",
                    "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                     oSettings.jqXHR = $.ajax( {
                    "dataType": 'json',
                    "type": "GET",
                    "url": sSource,
                    "data": aoData,
                    "timeout": 40000,
                    "error": handleAjaxError,
                    "success": fnCallback
                  } );
                },

                     "columns": [
                     {data: function(d){

                        return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value="+d.id+" type='checkbox'>";

                      }},
                    {data: 'name', name: 'name'}



                   ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 0,1] },
                    { "bSortable": false, "aTargets": [ 0,1 ] }
                ]

                });

                var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchGroupPermissions();' data-target='.modalSelectGroupPermissions' class='tooltips' title='Add Group Permission'><i class='sa-list-add'></i></a>";
                buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteGroupPermission("+ data.groupID +");' class='tooltips' title='Delete Group Permission'><i class='sa-list-delete'></i></a>";

                $("div.toolbar").html(buttonVar);


            }


        },


    })

     });

  function activateToolBar() {


      $("#toolbarDelete").removeClass('hidden');


  }


   function deleteGroupPermission(id) {

      var arr = [];

      $('input:checkbox.chk').each(function () {

        if (this.checked) {

            arr.push($(this).val());
        }

      });

      $.ajax({
        type    :"POST",
        data    : {arr:arr,id:id},
        headers : { 'X-CSRF-Token': '{{ csrf_token() }}' },
        url     :"{!! url('/removeGroupPermission')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> deleting group permissions  please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

            if (data.message == 'Group Permission Deleted!') {

                  HoldOn.close();

                    if ( $.fn.dataTable.isDataTable( '#groupPermissionsTable' ) ) {
                    oTablePermissionTable.destroy();
                  }

                  oTablePermissionTable     = $('#groupPermissionsTable').DataTable({
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"toolbar">frtip',
                    "order" :[[1,"desc"]],
                    "sAjaxSource": "{!! url('/permissions-list/" + data.groupID +"')!!}",
                    "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                     oSettings.jqXHR = $.ajax( {
                    "dataType": 'json',
                    "type": "GET",
                    "url": sSource,
                    "data": aoData,
                    "timeout": 40000,
                    "error": handleAjaxError,
                    "success": fnCallback
                  } );
                },

                     "columns": [
                     {data: function(d){

                        return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value="+d.id+" type='checkbox'>";

                      }},
                    {data: 'name', name: 'name'}



                   ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 0,1] },
                    { "bSortable": false, "aTargets": [ 0,1 ] }
                ]

                });

                var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchGroupPermissions();' data-target='.modalSelectGroupPermissions' class='tooltips' title='Add Group Permission'><i class='sa-list-add'></i></a>";
                buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteGroupPermission("+ id +");' class='tooltips' title='Delete Group Permission'><i class='sa-list-delete'></i></a>";

                $("div.toolbar").html(buttonVar);





                $("#MeetingAttendeeNotification").html('<div class="alert alert-success alert-icon">Well done! permission(s) has been deleted successfully <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');

                $("#addGroupPermissionsForm #groupID").val(data.groupID);
                //$('#modalAddAttendee').modal('show');


            }


        },


    })

    }


    @if (count($errors) > 0)

      $('#modalDepartment').modal('show');

    @endif


</script>
@endsection
