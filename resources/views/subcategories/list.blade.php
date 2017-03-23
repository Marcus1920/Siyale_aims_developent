@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-departments') }}">Departments</a></li>
    <li><a href="{{ url('list-categories/'.$deptName->id.'') }}">{{ $deptName->name }}</a></li>
    <li><a href="#">{{ $catObj->name }}</a></li>
    <li class="active">Categories Listing</li>
</ol>

<h4 class="page-title">{{ $catObj->name }} CATEGORIES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Categories Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" onClick="launchAddSubCategoryModal();" data-target=".modalAddSubCategory">
      Add Category
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
        <table class="table tile table-striped" id="subCategoriesTable">
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
@include('subcategories.edit')
@include('subcategories.add')
@include('subcategories.responders')
@include('subcategories.workflows')
@include('subcategories.addWorkflow')
@endsection

@section('footer')

 <script>

  $("#closeAddWorkFlow").on("click",function(){

    $('#modalAddWorkflow').modal('toggle');
    $('#modalWorkflows').modal('toggle');

  });


  $('#selectAllWorkFlows').on('click',function(){


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


})

  $("#submitAddWorkFlow").on("click",function(){

       var subCatID = $("#workFlowAddForm #subCatID").val();
       var name     = $("#workFlowAddForm #name").val();
       formData     = {subCatID:subCatID,name:name};

        $('#modalAddWorkflow').modal('toggle');

        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': '{{ csrf_token() }}' },
        url     :"{!! url('AddWorkF')!!}",
        beforeSend : function() {
          HoldOn.open({
          theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
          message: "<h4> adding workflow please wait... ! </h4>",
          content:"Your HTML Content", // If theme is set to "custom", this property is available
                                       // this will replace the theme by something customized.
          backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                     // Keep in mind is necessary the .css file too.
          textColor:"white" // Change the font color of the message
            });
        },
        success : function(response){

          if (response.message == 'ok') {
            $(".token-input-token").remove();
            $('#workFlowAddForm')[0].reset();
            launchWorkFlow(response.subCatID);
            $("#modalWorkflows").modal('show');
            $("#caseNotesNotification").html('<div class="alert alert-success alert-icon">Well done! You case has been successfully allocated <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
            HoldOn.close();

          }

        }

    })

    });

  $(document).ready(function() {



  var oTableWorkflows;
  var category = {!! $catObj->id !!};
  var oTable     = $('#subCategoriesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/sub-categories-list/" + category +"')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-sub-sub-categories/" + d.id + "') !!}' class='btn btn-sm'>"+d.name+"</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateSubCategoryModal(id)
    {

      $(".modal-body #subCategoryID").val(id);
      $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/subcategories/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditSubCategory #name").val(data[0].name);

            }
            else {
               $("#modalEditSubCategory #name").val('');
            }

        }
    });

    }

    function launchSubCatResponders(id)
    {


      $(".modal-body #subCatID").val(id);
      var prepopulateFirst  = new Array();
      var prepopulateSecond = new Array();
      var prepopulateThird  = new Array();

      $.ajax({
          type    :"GET",
          dataType:"json",
          url     :"{!! url('/getSubResponders/"+ id + "')!!}",
          success :function(data) {

              if(data.length > 0)
              {

                 for (var j = 0; j < data.length; j++) {
                            if (typeof data[j].firstResponder !== 'undefined')
                            {
                              prepopulateFirst.push({ id: data[j].id, name: data[j].firstResponder });
                            }
                            if (typeof data[j].secondResponder !== 'undefined')
                            {
                              prepopulateSecond.push({ id: data[j].id, name: data[j].secondResponder });
                            }

                            if (typeof data[j].thirdResponder !== 'undefined')
                            {
                              prepopulateThird.push({ id: data[j].id, name: data[j].thirdResponder });
                            }

                 }

                if(data[0].firstResponder !== null)
                {


                  $("#firstResponder").prev(".token-input-list").remove();

                  $("#firstResponder").tokenInput("{!! url('/getResponder') !!}",{ prePopulate:prepopulateFirst });
                }
                else {
                  $("#firstResponder").tokenInput("{!! url('/getResponder') !!}");
                }

                if(data[0].secondResponder !== null)
                {
                  $("#secondResponder").prev(".token-input-list").remove();
                  $("#secondResponder").tokenInput("{!! url('/getResponder') !!}",{ prePopulate: prepopulateSecond });
                }
                else {


                  $("#secondResponder").tokenInput("{!! url('/getResponder') !!}",{});
                }

                if(data[0].thirdResponder !== null)
                {
                  $("#thirdResponder").prev(".token-input-list").remove();
                  $("#thirdResponder").tokenInput("{!! url('/getResponder') !!}",{ prePopulate:prepopulateThird });
                }
                else {
                  $("#thirdResponder").tokenInput("{!! url('/getResponder') !!}",{});
                }

              }
              else {


                  if($("#firstResponder").prev(".token-input-list").html())
                  {
                    $("#firstResponder").tokenInput("clear");
                  }
                  else
                  {
                    $("#firstResponder").tokenInput("{!! url('/getResponder') !!}");
                  }

                  if($("#secondResponder").prev(".token-input-list").html())
                  {
                    $("#secondResponder").tokenInput("clear");
                  }
                  else
                  {
                    $("#secondResponder").tokenInput("{!! url('/getResponder') !!}");
                  }

                  if($("#thirdResponder").prev(".token-input-list").html())
                  {
                    $("#thirdResponder").tokenInput("clear");
                  }
                  else
                  {
                    $("#thirdResponder").tokenInput("{!! url('/getResponder') !!}");
                  }


              }

          }
      });

    }


    function launchWorkFlow(id)
    {


      $("#workFlowAddForm #subCatID").val(id);

      if ( $.fn.dataTable.isDataTable( '#workflowsTable' ) ) {
          oTableWorkflows.destroy();
      }

      oTableWorkflows     = $('#workflowsTable').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "dom": '<"toolbar">frtip',
            "order" :[[1,"desc"]],
            "ajax": "{!! url('/workflows-list/" + id +"')!!}",
             "columns": [
            {data: function(d){

                  return "<input class='checkbox-custom chkworkflow'  onClick='activateWorkFlowToolbar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

            }},
            {data: 'name', name: 'name'},
            {data: function(d){

                  return "<input  id ='workflow_" + d.id + "' class='form-control input-sm' type='text' value=" + d.order + ">";

            },"width":"10%"},
            {data: function(d) {

                return "<a href='#' onClick='saveWorkFlowOrder("+d.id+")'><i class='fa fa-refresh'></i></a>";
            }}

           ],

        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [ 0,1] },
            { "bSortable": false, "aTargets": [ 0,1 ] }
        ]

        });

          var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchAddWorkFlow();' data-target='.modalAddWorkflow' class='tooltips' title='Add Workflow'><i class='sa-list-add'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteWorkFlow(" + id + ");' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";

          $("div.toolbar").html(buttonVar);

    }

     function launchAddWorkFlow() {

      $("#modalWorkflows").modal('hide');

    }

    function saveWorkFlowOrder(id) {


      var order     = $("#workflow_" + id).val();
      var paramData = { id : id,order:order};

      $.ajax({
          type    : 'GET',
          url     : "{!! url('/saveWorkFlowOrder/') !!}",
          data    : paramData,
          success : function(data){


              alert(data.message);

          }

      })

    }

    function activateWorkFlowToolbar() {

      $("#toolbarDelete").removeClass('hidden');

    }

     function deleteWorkFlow(id) {

      var arr = [];

      $('input:checkbox.chkworkflow').each(function () {

        if (this.checked) {

            arr.push($(this).val());
        }

      });

      $.ajax({
        type    :"POST",
        data    : {arr:arr},
        headers : { 'X-CSRF-Token': '{{ csrf_token() }}' },
        url     :"{!! url('/removeWorkFlow')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> deleting workflow  please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

            if (data.message == 'Workflow Deleted!') {

                  HoldOn.close();

                  if ( $.fn.dataTable.isDataTable( '#workflowsTable' ) ) {
                    oTableWorkflows.destroy();
                  }

             oTableWorkflows     = $('#workflowsTable').DataTable({
                "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"toolbar">frtip',
                    "order" :[[1,"desc"]],
                    "ajax": "{!! url('/workflows-list/" + id +"')!!}",
                     "columns": [
                    {data: function(d){

                          return "<input class='checkbox-custom chkworkflow'  onClick='activateWorkFlowToolbar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

                    }},
                    {data: 'name', name: 'name'},
                    {data: function(d){

                          return "<input  id ='workflow_" + d.id + "' class='form-control input-sm' type='text' value=" + d.order + ">";

                    },"width":"10%"},
                    {data: function(d) {

                        return "<a href='#' onClick='saveWorkFlowOrder("+d.id+")'><i class='fa fa-refresh'></i></a>";
                    }}

                   ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 0,1] },
                    { "bSortable": false, "aTargets": [ 0,1 ] }
                ]

                });

                  var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchAddWorkFlow();' data-target='.modalAddWorkflow' class='tooltips' title='Add Workflow'><i class='sa-list-add'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteWorkFlow();' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";

                $("div.toolbar").html(buttonVar);
                $("#WorkFlowNotification").html('<div class="alert alert-success alert-icon">Well done! workflow(s) has/have been deleted successfully <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
                $('#modalWorkflows').modal('show');


            }


        },
      error: function(data){

          HoldOn.close();
          var errors = data.responseJSON;

          if (errors.venue) {

            $("#error_venue_meeting").html("<p class='help-block red'>*" + errors.venue + "</p>");

          }

          if (errors.date) {

            $("#error_meeting_date").html("<p class='help-block red'>*" + errors.date + "</p>");

          }

          if (errors.start_time) {

            $("#error_meeting_start_time").html("<p class='help-block red'>*" + errors.start_time + "</p>");

          }


      }

    })

    }


    @if (count($errors) > 0)

      $('#modalAddSubCategory').modal('show');

    @endif
</script>
@endsection
