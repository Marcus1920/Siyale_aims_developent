@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-departments') }}">Meetings</a></li>
    <li class="active">Meetings Listing</li>
</ol>

<h4 class="page-title">MEETINGS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Meeting Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" onClick="launchMeetingModal();" data-target=".modalAddMeeting">
     Add Meeting
    </a>
</div>

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">

    <div id="MeetingNotification"></div>
    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="meetingsTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@include('meetings.edit')
@include('meetings.add')
@include('meetings.venue')
@include('meetings.attendees')
@include('meetings.selAttendees')
@include('meetings.minutes')
@include('meetings.files')
@endsection

@section('footer')

 <script>


function activateToolBar() {

  $("#toolbarDelete").removeClass('hidden');
  $("#toolbarInvite").removeClass('hidden');
  $("#toolbarAttended").removeClass('hidden');

}


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


})


$(document).ready(function() {



  var oTableMeetingMinutes;
  var oTable     = $('#meetingsTable').DataTable({
                "autoWidth":false,
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/meetings-list/')!!}",
                 "columns": [
                {data: 'id', name: 'meetings.id'},
                {data: 'title', name: 'meetings.title'},
                {data: function(d){

                    return d.description;

                },"name" : 'meetings.description',"width" :"25%"},
                {data: 'name', name: 'meetings_venues.name'},
                {data: 'date', name: 'meetings.date'},
                {data: 'start_time', name: 'meetings.start_time'},
                {data: 'end_time', name: 'meetings.end_time'},
                {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1,7] },
                { "bSortable": false, "aTargets": [ 1,7 ] }
            ]

  });


  });


    function getval(sel,id) {


       if (sel.value == 'a_att') {


          if ( $.fn.dataTable.isDataTable( '#meetingAttendeesTable' ) ) {
            oTableMeetingAttendee.destroy();
          }

          oTableMeetingAttendee     = $('#meetingAttendeesTable').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "dom": '<"toolbar">frtip',
            "order" :[[1,"desc"]],
            "ajax": "{!! url('/meetings-attendees-list/" + id +"')!!}",
             "columns": [
            {data: function(d){

                  return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

            }},
            {data: 'name', name: 'name'},
            {data: 'cellphone', name: 'cellphone'},

            {data: function(d){

                if (d.invited == 1) {
                  return 'yes';
                } else {
                  return 'no';
                }

            }},

            {data: function(d){

               return d.accepted

            }},

            {data: function(d){


                if (d.attended == 1) {
                  return 'yes';
                } else {
                  return 'no';
                }

            }}

           ],

        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [ 0,3] },
            { "bSortable": false, "aTargets": [ 0,3 ] }
        ]

        });

          var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchMeetingAttendee();' data-target='.modalSelectAttendees' class='tooltips' title='Add Attendee'><i class='sa-list-add'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteMeetingAttendee("+ id +");' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarInvite' onclick='inviteMeetingAttendee("+ id +");' class='tooltips' title='Invite Attendee'><i class='sa-list-message'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarAttended' onclick='markMeetingAttendee("+ id +");' class='tooltips' title='Mark as Attended'><i class='fa fa-check fa-2x'></i></a>";

          $("div.toolbar").html(buttonVar);

          $("#addMeetingAttendeeForm #meetingID").val(id);
          $('#modalAddAttendee').modal('show');

       }

       if (sel.value == 'u_file') {


          if ( $.fn.dataTable.isDataTable( '#meetingMinutesTable' ) ) {

            oTableMeetingMinutes.destroy();

          }

            oTableMeetingMinutes = $('#meetingMinutesTable').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "dom": '<"toolbar">frtip',
            "order" :[[1,"desc"]],
            "ajax": "{!! url('/meetings-files-list/" + id +"')!!}",
             "columns": [
            {data: 'created_at', name: 'created_at'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: function(d){

              return "<a href='{{ env('LOCAL_URL') }}"+d.img_url+"' download='file'>" + d.file + "</a>";

            }}
           ],

        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [ 0,3] },
            { "bSortable": false, "aTargets": [ 0,3 ] }
        ]

        });

          var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchMeetingFile();' data-target='.modalAddMeetingFilesModal' class='tooltips' title='Add File'><i class='sa-list-add'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteMeetingAttendee("+ id +");' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";
          buttonVar += "<a class='btn btn-sm hidden' id='toolbarInvite' onclick='inviteMeetingAttendee("+ id +");' class='tooltips' title='Invite Attendee'><i class='sa-list-message'></i></a>";
          $("div.toolbar").html(buttonVar);

          $("#addMeetingMinutesFileForm #meetingID").val(id);
          $("#modalAddMeetingMinutesFilesModal").modal('show');

       }


    }

    function launchVenueModal() {

         $('#modalAddMeeting').modal('hide');

    }

    function launchMeetingModal() {


      $("#facilitators").prev(".token-input-list").remove();
      $("#facilitators").tokenInput("{!! url('/getMeetingFacilitators') !!}");

    }


    function deleteMeetingAttendee(id) {

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
        url     :"{!! url('/removeMeetingAttendee')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> deleting meeting attendees  please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

            if (data.message == 'Meeting Attendees Deleted!') {

                  HoldOn.close();

                  if ( $.fn.dataTable.isDataTable( '#meetingAttendeesTable' ) ) {
                    oTableMeetingAttendee.destroy();
                  }

                  oTableMeetingAttendee     = $('#meetingAttendeesTable').DataTable({
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"toolbar">frtip',
                    "order" :[[1,"desc"]],
                    "ajax": "{!! url('/meetings-attendees-list/" + data.meetingID +"')!!}",
                     "columns": [
                    {data: function(d){

                          return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

                    }},
                    {data: 'name', name: 'name'},
                    {data: 'cellphone', name: 'cellphone'},
                    {data: function(d){

                      if (d.invited == 1) {
                        return 'yes';
                      } else {
                        return 'no';
                      }

                    }},
                    {data: function(d){

                        if (d.accepted == 1) {
                          return 'yes';
                        } else {
                          return 'no';
                        }

                    }},
                    {data: function(d){

                        if (d.attended == 1) {
                          return 'yes';
                        } else {
                          return 'no';
                        }

                    }}
                   ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 0,3] },
                    { "bSortable": false, "aTargets": [ 0,3 ] }
                ]

                });

                  var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchMeetingAttendee();' data-target='.modalSelectAttendees' class='tooltips' title='Add Attendee'><i class='sa-list-add'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteMeetingAttendee(" + data.meetingID + ");' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarInvite' onclick='inviteMeetingAttendee("+ data.meetingID +");' class='tooltips' title='Invite Attendee'><i class='sa-list-message'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarAttended' onclick='markMeetingAttendee("+ data.meetingID +");' class='tooltips' title='Mark as Attended'><i class='fa fa-check fa-2x'></i></a>";
                  $("div.toolbar").html(buttonVar);

                 $("#MeetingAttendeeNotification").html('<div class="alert alert-success alert-icon">Well done! attendee(s) has been deleted successfully <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');

                $("#addMeetingAttendeeForm #meetingID").val(data.meetingID);
                $('#modalAddAttendee').modal('show');


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

    function inviteMeetingAttendee(id) {

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
        url     :"{!! url('/inviteMeetingAttendee')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> inviting meeting attendees  please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

            if (data.message == 'Meeting Attendees Invited!') {

                  HoldOn.close();

                  if ( $.fn.dataTable.isDataTable( '#meetingAttendeesTable' ) ) {
                    oTableMeetingAttendee.destroy();
                  }

                  oTableMeetingAttendee     = $('#meetingAttendeesTable').DataTable({
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"toolbar">frtip',
                    "order" :[[1,"desc"]],
                    "ajax": "{!! url('/meetings-attendees-list/" + data.meetingID +"')!!}",
                     "columns": [
                    {data: function(d){

                          return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

                    }},
                    {data: 'name', name: 'name'},
                    {data: 'cellphone', name: 'cellphone'},
                    {data: function(d){

                      if (d.invited == 1) {
                        return 'yes';
                      } else {
                        return 'no';
                      }

                    }},
                    {data: function(d){

                     return d.accepted;

                    }},
                    {data: function(d){

                      if (d.attended == 1) {
                        return 'yes';
                      } else {
                        return 'no';
                      }

                    }}
                   ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 0,3] },
                    { "bSortable": false, "aTargets": [ 0,3 ] }
                ]

                });

                  var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchMeetingAttendee();' data-target='.modalSelectAttendees' class='tooltips' title='Add Attendee'><i class='sa-list-add'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteMeetingAttendee(" + data.meetingID + ");' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarInvite' onclick='inviteMeetingAttendee("+ data.meetingID +");' class='tooltips' title='Invite Attendee'><i class='sa-list-message'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarAttended' onclick='markMeetingAttendee("+ data.meetingID +");' class='tooltips' title='Mark as Attended'><i class='i class='fa fa-check fa-2x'></i></a>";

                $("div.toolbar").html(buttonVar);

                 $("#MeetingAttendeeNotification").html('<div class="alert alert-success alert-icon">Well done! attendee(s) has been invited successfully <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');

                $("#addMeetingAttendeeForm #meetingID").val(data.meetingID);
                $('#modalAddAttendee').modal('show');


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

  function markMeetingAttendee(id) {

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
        url     :"{!! url('/markMeetingAttendee')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",//If not given or inexistent theme throws default theme sk-rect
                message: "<h4> inviting meeting attendees  please wait... ! </h4>",
                content:"Your HTML Content", // If theme is set to "custom", this property is available
                                             // this will replace the theme by something customized.
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",//Change the background color of holdon with javascript
                           // Keep in mind is necessary the .css file too.
                textColor:"white" // Change the font color of the message
            });

        },
        success : function(data){

            if (data.message == 'Meeting Attendees Attended!') {

                  HoldOn.close();

                  if ( $.fn.dataTable.isDataTable( '#meetingAttendeesTable' ) ) {
                    oTableMeetingAttendee.destroy();
                  }

                  oTableMeetingAttendee     = $('#meetingAttendeesTable').DataTable({
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"toolbar">frtip',
                    "order" :[[1,"desc"]],
                    "ajax": "{!! url('/meetings-attendees-list/" + data.meetingID +"')!!}",
                     "columns": [
                    {data: function(d){

                          return "<input class='checkbox-custom chk'  onClick='activateToolBar();' name='checkbox-1' value=" + d.id + " type='checkbox'>";

                    }},
                    {data: 'name', name: 'name'},
                    {data: 'cellphone', name: 'cellphone'},
                    {data: function(d){

                      if (d.invited == 1) {
                        return 'yes';
                      } else {
                        return 'no';
                      }

                    }},
                    {data: function(d){

                     return d.accepted;

                    }},
                    {data: function(d){

                      if (d.attended == 1) {
                        return 'yes';
                      } else {
                        return 'no';
                      }

                    }}
                   ],

                "aoColumnDefs": [
                    { "bSearchable": false, "aTargets": [ 0,3] },
                    { "bSortable": false, "aTargets": [ 0,3 ] }
                ]

                });

                  var buttonVar = "<a class='btn btn-sm' data-toggle='modal' onclick='launchMeetingAttendee();' data-target='.modalSelectAttendees' class='tooltips' title='Add Attendee'><i class='sa-list-add'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarDelete' onclick='deleteMeetingAttendee(" + data.meetingID + ");' class='tooltips' title='Delete Attendee'><i class='sa-list-delete'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarInvite' onclick='inviteMeetingAttendee("+ data.meetingID +");' class='tooltips' title='Invite Attendee'><i class='sa-list-message'></i></a>";
                  buttonVar += "<a class='btn btn-sm hidden' id='toolbarAttended' onclick='markMeetingAttendee("+ data.meetingID +");' class='tooltips' title='Mark as Attended'><i class='fa fa-check fa-2x'></i></a>";

                $("div.toolbar").html(buttonVar);

                 $("#MeetingAttendeeNotification").html('<div class="alert alert-success alert-icon">Well done! attendee(s) has been marked as attended successfully <i class="icon">&#61845;</i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>');

                $("#addMeetingAttendeeForm #meetingID").val(data.meetingID);
                $('#modalAddAttendee').modal('show');


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

    function launchMeetingFile() {

      $('#modalAddMeetingMinutesFilesModal').modal('hide');

    }


    function launchMeetingAttendee() {



      $("#addMeetingAttendeeForm #first_name").val('');
      $("#addMeetingAttendeeForm #surname").val('');
      $("#addMeetingAttendeeForm #cellphone").val('');
      $("#addMeetingAttendeeForm #email").val('');
      $("#captureAttendeeSearch").removeClass('hidden');
      $("#addMeetingAttendeeForm #attendees").removeAttr("disabled");
      $("#addMeetingAttendeeForm #first_name").attr("disabled","disabled");
      $("#addMeetingAttendeeForm #surname").attr("disabled","disabled");
      $("#addMeetingAttendeeForm #cellphone").attr("disabled","disabled");
      $("#addMeetingAttendeeForm #email").attr("disabled","disabled");
      $("#modalAddAttendee").modal('hide');
      $("#attendees").prev(".token-input-list").remove();
      $("#addMeetingAttendeeForm #attendees").tokenInput("{!! url('/getMeetingFacilitators') !!}", {
        tokenLimit: 1,
        animateDropdown: false,
        onResult: function (results) {


                if (results.length == 0)
                {
                    $("#captureAttendee").removeClass('hidden');
                    $("#captureAttendeeSearch").addClass('hidden');
                    $("#CreateCaseAgentForm #attendees").attr("disabled","disabled");
                    $("#addMeetingAttendeeForm #first_name").removeAttr("disabled");
                    $("#addMeetingAttendeeForm #surname").removeAttr("disabled");
                    $("#addMeetingAttendeeForm #cellphone").removeAttr("disabled");
                    $("#addMeetingAttendeeForm #email").removeAttr("disabled");
                    $("#addMeetingAttendeeForm #name").val('');
                    $("#addMeetingAttendeeForm #surname").val('');
                    $("#addMeetingAttendeeForm #cellphone").val('');
                    $("#addMeetingAttendeeForm #email").val('');

                }
                return results;
        },
        onAdd: function (results) {

                  if(results.name)
                  {

                      $("#addMeetingAttendeeForm #first_name").removeAttr("disabled");
                      $("#addMeetingAttendeeForm #surname").removeAttr("disabled");
                      $("#addMeetingAttendeeForm #cellphone").removeAttr("disabled");
                      $("#addMeetingAttendeeForm #email").removeAttr("disabled");

                      $("#error_cellphone").html("");
                      $("#error_title").html("");
                      $("#error_language").html("");



                      $("#addMeetingAttendeeForm #first_name").val(results.first_name);
                      $("#addMeetingAttendeeForm #surname").val(results.surname);
                      $("#addMeetingAttendeeForm #cellphone").val(results.cellphone +'_');
                      $("#addMeetingAttendeeForm #email").val(results.email + '_');

                  }
                  else {

                    $("#caseReportCaseForm #cellphone,#CreateCaseAgentForm #cellphone").val('');
                    $("#caseReportCaseForm #name,#CreateCaseAgentForm #name").val('');
                    $("#caseReportCaseForm #surname,#CreateCaseAgentForm #surname").val('');
                    $("#caseReportCaseForm #id_number,#CreateCaseAgentForm #id_number").val('');
                    $("#caseReportCaseForm #language,#CreateCaseAgentForm #language").val('');
                    $("#caseReportCaseForm #province,#CreateCaseAgentForm #province").val('');
                    $("#caseReportCaseForm #district,#CreateCaseAgentForm #district").val('');
                    $("#caseReportCaseForm #municipality,#CreateCaseAgentForm #municipality").val('');
                    $("#caseReportCaseForm #house_number,#CreateCaseAgentForm #house_number").val('');
                    $("#caseReportCaseForm #ward,#CreateCaseAgentForm #ward").val('');
                    $("#caseReportCaseForm #area,#CreateCaseAgentForm #area").val('');
                    $("#caseReportCaseForm #hseHolderId,#CreateCaseAgentForm #hseHolderId").val('');
                    $("#caseReportCaseForm #title,#CreateCaseAgentForm #title").val('');
                    $("#caseReportCaseForm #position,#CreateCaseAgentForm #position").val('');
                    $("#caseReportCaseForm #priority,#CreateCaseAgentForm #priority").val('');
                    $("#caseReportCaseForm #gender,#CreateCaseAgentForm #gender").val('');
                    $("#caseReportCaseForm #dob,#CreateCaseAgentForm #dob").val('');
                    $("#error_cellphone").html("");
                    $("#error_title").html("");
                    $("#error_language").html("");
                    $("#error_province").html("");
                    $("#error_district").html("");
                    $("#error_municipality").html("");
                    $("#error_ward").html("");
                    $("#error_name").html("");
                    $("#error_surname").html("");
                    $("#error_id_number").html("");
                    $("#error_position").html("");
                    $("#error_priority").html("");
                    $("#error_gender").html("");
                    $("#error_dob").html("");


                    $("#caseReportCaseForm #cellphone,#CreateCaseAgentForm #cellphone").removeAttr("disabled");
                    $("#caseReportCaseForm #name,#CreateCaseAgentForm #name").removeAttr("disabled");
                    $("#caseReportCaseForm #surname,#CreateCaseAgentForm #surname").removeAttr("disabled");
                    $("#caseReportCaseForm #id_number,#CreateCaseAgentForm #id_number").removeAttr("disabled");
                    $("#caseReportCaseForm #language,#CreateCaseAgentForm #language").removeAttr("disabled");
                    $("#caseReportCaseForm #province,#CreateCaseAgentForm #province").removeAttr("disabled");
                    $("#caseReportCaseForm #house_number,#CreateCaseAgentForm #house_number").removeAttr("disabled");
                    $("#caseReportCaseForm #district,#CreateCaseAgentForm #district").removeAttr("disabled");
                    $("#caseReportCaseForm #municipality,#CreateCaseAgentForm #municipality").removeAttr("disabled");
                    $("#caseReportCaseForm #ward,#CreateCaseAgentForm #ward").removeAttr("disabled");
                    $("#caseReportCaseForm #area,#CreateCaseAgentForm #area").removeAttr("disabled");
                    $("#caseReportCaseForm #title,#CreateCaseAgentForm #title").removeAttr("disabled");
                    $("#caseReportCaseForm #position,#CreateCaseAgentForm #position").removeAttr("disabled");
                    $("#caseReportCaseForm #priority,#CreateCaseAgentForm #priority").removeAttr("disabled");
                    $("#caseReportCaseForm #gender,#CreateCaseAgentForm #gender").removeAttr("disabled");
                    $("#caseReportCaseForm #dob,#CreateCaseAgentForm #dob").removeAttr("disabled");


                  }

                  return results;


        },
       onDelete: function (item) {


                    $("#caseReportCaseForm #cellphone,#CreateCaseAgentForm #cellphone").val('');
                    $("#caseReportCaseForm #name,#CreateCaseAgentForm #name").val('');
                    $("#caseReportCaseForm #surname,#CreateCaseAgentForm #surname").val('');
                    $("#caseReportCaseForm #id_number,#CreateCaseAgentForm #id_number").val('');
                    $("#caseReportCaseForm #language,#CreateCaseAgentForm #language").val('');
                    $("#caseReportCaseForm #province,#CreateCaseAgentForm #province").val('');
                    $("#caseReportCaseForm #district,#CreateCaseAgentForm #district").val('');
                    $("#caseReportCaseForm #municipality,#CreateCaseAgentForm #municipality").val('');
                    $("#caseReportCaseForm #house_number,#CreateCaseAgentForm #house_number").val('');
                    $("#caseReportCaseForm #ward,#CreateCaseAgentForm #ward").val('');
                    $("#caseReportCaseForm #area,#CreateCaseAgentForm #area").val('');
                    $("#caseReportCaseForm #title,#CreateCaseAgentForm #title").val('');
                    $("#caseReportCaseForm #position,#CreateCaseAgentForm #position").val('');
                    $("#caseReportCaseForm #priority,#CreateCaseAgentForm #priority").val('');
                    $("#caseReportCaseForm #gender,#CreateCaseAgentForm #gender").val('');
                    $("#caseReportCaseForm #dob,#CreateCaseAgentForm #dob").val('');
                    $("#caseReportCaseForm #hseHolderId,#CreateCaseAgentForm #hseHolderId").val('');
                    $("#caseReportCaseForm #cellphone,#CreateCaseAgentForm #cellphone").removeAttr("disabled");
                    $("#caseReportCaseForm #name,#CreateCaseAgentForm #name").removeAttr("disabled");
                    $("#caseReportCaseForm #surname,#CreateCaseAgentForm #surname").removeAttr("disabled");
                    $("#caseReportCaseForm #id_number,#CreateCaseAgentForm #id_number").removeAttr("disabled");
                    $("#caseReportCaseForm #language,#CreateCaseAgentForm #language").removeAttr("disabled");
                    $("#caseReportCaseForm #province,#CreateCaseAgentForm #province").removeAttr("disabled");
                    $("#caseReportCaseForm #district,#CreateCaseAgentForm #district").removeAttr("disabled");
                    $("#caseReportCaseForm #municipality,#CreateCaseAgentForm #municipality").removeAttr("disabled");
                    $("#caseReportCaseForm #house_number,#CreateCaseAgentForm #house_number").removeAttr("disabled");
                    $("#caseReportCaseForm #ward,#CreateCaseAgentForm #ward").removeAttr("disabled");
                    $("#caseReportCaseForm #area,#CreateCaseAgentForm #area").removeAttr("disabled");
                    $("#caseReportCaseForm #title,#CreateCaseAgentForm #title").removeAttr("disabled");
                    $("#caseReportCaseForm #position,#CreateCaseAgentForm #position").removeAttr("disabled");
                    $("#caseReportCaseForm #priority,#CreateCaseAgentForm #priority").removeAttr("disabled");
                    $("#caseReportCaseForm #gender,#CreateCaseAgentForm #gender").removeAttr("disabled");
                    $("#caseReportCaseForm #dob,#CreateCaseAgentForm #dob").removeAttr("disabled");
                    $("#error_cellphone").html("");
                    $("#error_title").html("");
                    $("#error_language").html("");
                    $("#error_province").html("");
                    $("#error_district").html("");
                    $("#error_municipality").html("");
                    $("#error_ward").html("");
                    $("#error_name").html("");
                    $("#error_surname").html("");
                    $("#error_id_number").html("");
                    $("#error_position").html("");
                    $("#error_priority").html("");
                    $("#error_gender").html("");
                    $("#error_dob").html("");

      }
    });




    }

    @if (count($errors) > 0)

      $('#modalEditDepartment').modal('show');

    @endif


</script>
@endsection
