@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li class="active">Users Listing</li>
</ol>

<h4 class="page-title">USERS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Users Listing</h3>
    @if(isset($userAddUserPermission) && $userAddUserPermission->permission_id =='31')

    <a href="{{ url('add-user') }}" class="btn btn-sm">
       Add User
    </a>
    @endif
</div>

 <!-- Collapse -->
<div class="block-area" id="collapse">
    <h3 class="block-title">Filters</h3>
    <div class="accordion tile">
        <div class="panel-group block" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Show Filters
                        </a>
                    </h3>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- Alternative -->
<div class="block-area" id="alternative-buttons">


    <h3 class="block-title">FILTERS</h3>

    {!! Form::open(['url' => '#', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"filterUsersForm" ]) !!}
    <div class="row">
          <div class="col-md-4 m-b-15">
              <p>From:</p>
              <div class="input-icon datetime-pick date-only">
                  <input data-format="yyyy-MM-dd" type="text" id='fromDate' name ='fromDate' class="form-control input-sm" />
                  <span class="add-on">
                      <i class="sa-plus"></i>
                  </span>
              </div>
          </div>

          <div class="col-md-4 m-b-15">
              <p>To:</p>
              <div class="input-icon datetime-pick date-only">
                  <input data-format="yyyy-MM-dd" type="text" value ="" id='toDate' name ='toDate' class="form-control input-sm" />
                  <span class="add-on">
                      <i class="sa-plus"></i>
                  </span>
              </div>
          </div>


    </div>
    <br/>
         <div class="row">

          <div class="col-md-3 m-b-15">
              <p>Status:</p>
               <div class="p-relative">
                  {!! Form::select('status',$selectUserStatuses,0,['class' => 'form-control input-sm' ,'id' => 'status']) !!}
              </div>
          </div>

          <div class="col-md-3 m-b-15">
              <p>Role:</p>
               <div class="p-relative">
                  {!! Form::select('role',$selectRoles,0,['class' => 'form-control input-sm' ,'id' => 'role']) !!}
              </div>
          </div>

          <div class="col-md-3 m-b-15">
              <p>Gender:</p>
              <div class="p-relative">
                  {!! Form::select('gender',['0' => 'Select/All','1' => 'Male','2' => 'Female'],0,['class' => 'form-control input-sm' ,'id' => 'gender']) !!}
              </div>
          </div>


    </div>

    <br/>

    <div class="row">

          <div class="col-md-3 m-b-15">
              <p>Province:</p>
               <div class="p-relative">
                  {!! Form::select('province',$selectProvinces,0,['class' => 'form-control input-sm' ,'id' => 'province']) !!}
              </div>
          </div>

          <div class="col-md-3 m-b-15">
              <p>District:</p>
              <div class="p-relative">
                  {!! Form::select('district',$selectDistricts,0,['class' => 'form-control input-sm' ,'id' => 'district']) !!}
              </div>
          </div>

          <div class="col-md-3 m-b-15">
              <p>Municipality:</p>
              <div class="p-relative">
                  {!! Form::select('municipality',$selectMunicipalities,0,['class' => 'form-control input-sm' ,'id' => 'municipality']) !!}
              </div>
          </div>

          <div class="col-md-3 m-b-15">
              <p>Ward:</p>
              <div class="p-relative">
                  {!! Form::select('ward',$selectWards,0,['class' => 'form-control input-sm' ,'id' => 'ward']) !!}
              </div>
          </div>

    </div>

    <br/>


    <div class="row">

          <div class="col-md-4 m-b-15">
              <p>Department:</p>
               <div class="p-relative">
                  {!! Form::select('department',$selectDepartments,0,['class' => 'form-control input-sm' ,'id' => 'department']) !!}
              </div>
          </div>

          <div class="col-md-4 m-b-15">
            <p>Position:</p>
              <div class="p-relative">
                  {!! Form::select('position',$selectPositions,0,['class' => 'form-control input-sm' ,'id' => 'position']) !!}
              </div>

          </div>

          <div class="col-md-4 m-b-15">
              <p>Created By:</p>
               <div class="p-relative">
                  {!! Form::select('created_by',$selectUsersCreatedBy,0,['class' => 'form-control input-sm' ,'id' => 'created_by']) !!}
              </div>
          </div>

    </div>

    <br/>

    <br/>


      <div class="row">


            <div class="col-md-4 m-b-15">
                <p></p><br/>
                <div class="p-relative">
                       <a type="#" id='submitUsersFilters' class="btn btn-sm col-md-4 m-b-15">Generate Report</a>
               </div>
            </div>


    </div>
    {!! Form::close() !!}

</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
        <table class="table tile table-striped" id="usersTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Cell Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Position</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@include('users.edit')
@endsection
@section('footer')

 <script>
    $(document).ready(function() {

   $("#submitUpdateUserForm").on('click',function(){

     $("#modalEditUser #ward").removeAttr("disabled");
     $("#modalEditUser #municipality").removeAttr("disabled");
     $("#modalEditUser #district").removeAttr("disabled");

   })



    var oUsersTable     = $('#usersTable').DataTable({
                "processing": true,
                "serverSide": false,
                "dom": 'Bfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/users-list')!!}",
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',{

                      extend : 'pdfHtml5',
                      title  : 'Siyaleader',
                      header : 'I am text in',
                    },
                ],
                 "columns": [

                    {data: 'id', name: 'users.id'},
                    {data: 'created_at', name: 'users.created_at'},
                    {data: 'name', name: 'users.name'},
                    {data: 'surname', name: 'users.surname'},
                    {data: 'cellphone', name: 'users.cellphone'},
                    {data: 'email', name: 'users.email'},
                    {data: 'active', name: 'users_statuses.name'},
                    {data: 'position', name: 'positions.name'},
                    {data: 'actions',  name: 'actions'},

               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1,8] },
                { "bSortable": false, "aTargets": [ 1,8 ] }
            ]

         });


     var defaultDate = $.datepicker.formatDate('yy-mm-dd', new Date());
     $("#fromDate").val(defaultDate);
     $("#toDate").val(defaultDate);

    $("#updateUserForm #province").change(function(){

        $.get("{{ url('/api/dropdown/districts/province')}}",
        { option: $(this).val()},
        function(data) {

        $('#updateUserForm #municipality').attr('disabled','disabled');
        $('#updateUserForm #ward').attr('disabled','disabled');
        $('#updateUserForm #district').empty();
        $('#updateUserForm #municipality').empty();
        $('#updateUserForm #ward').empty();
        $('#updateUserForm #district').removeAttr('disabled');
        $('#updateUserForm #district').append("<option value='0'>Select one</option>");
        $('#updateUserForm #municipality').append("<option value='0'>Select one</option>");
        $('#updateUserForm #ward').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#updateUserForm #district').append("<option value="+ key +">" + element + "</option>");
        });
        });

   });

    $("#updateUserForm #district").change(function(){
        $.get("{{ url('/api/dropdown/municipalities/district')}}",
        { option: $(this).val() },
        function(data) {

        $('#updateUserForm #ward').attr('disabled','disabled');
        $('#updateUserForm #municipality').empty();
        $('#updateUserForm #ward').empty();
        $('#updateUserForm #municipality').removeAttr('disabled');
        $('#updateUserForm #municipality').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#updateUserForm #municipality').append("<option value="+ key +">" + element + "</option>");
        });
        });
    });

    $("#updateUserForm #municipality").change(function(){
        $.get("{{ url('/api/dropdown/wards/municipality')}}",
        { option: $(this).val() },
        function(data) {
        $('#updateUserForm #ward').empty();
        $('#updateUserForm #ward').removeAttr('disabled');
        $('#updateUserForm #ward').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#updateUserForm #ward').append("<option value="+ key +">" + element + "</option>");
        });
        });
    });





    $("#filterUsersForm #province").change(function(){

        $.get("{{ url('/api/dropdown/districts/province')}}",
        { option: $(this).val()},
        function(data) {

        $('#filterUsersForm #district').empty();
        $('#filterUsersForm #municipality').empty();
        $('#filterUsersForm #ward').empty();
        $('#filterUsersForm #district').removeAttr('disabled');
        $('#filterUsersForm #district').append("<option value='0'>Select one</option>");
        $('#filterUsersForm #municipality').append("<option value='0'>Select one</option>");
        $('#filterUsersForm #ward').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#filterUsersForm #district').append("<option value="+ key +">" + element + "</option>");
        });
        });

   });

    $("#filterUsersForm #district").change(function(){
        $.get("{{ url('/api/dropdown/municipalities/district')}}",
        { option: $(this).val() },
        function(data) {
        $('#filterUsersForm #municipality').empty();
        $('#filterUsersForm #municipality').removeAttr('disabled');
        $('#filterUsersForm #municipality').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#filterUsersForm #municipality').append("<option value="+ key +">" + element + "</option>");
        });
        });
    });

    $("#filterUsersForm #municipality").change(function(){
        $.get("{{ url('/api/dropdown/wards/municipality')}}",
        { option: $(this).val() },
        function(data) {
        $('#filterUsersForm #ward').empty();
        $('#filterUsersForm #ward').removeAttr('disabled');
        $('#filterUsersForm #ward').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#filterUsersForm #ward').append("<option value="+ key +">" + element + "</option>");
        });
        });
    });


   $("#submitUsersFilters").on("click",function(){

        var fromDate   = $("#fromDate").val();
        var toDate     = $("#toDate").val();
        var status     = $("#status").val();
        var role       = $("#role").val();
        var gender     = $("#gender").val();
        var province   = $("#province").val();
        var district   = $("#district").val();
        var status     = $("#status").val();
        var gender     = $("#gender").val();
        var createdBy  = $("#created_by").val();
        var department = $("#department").val();
        var position   = $("#position").val();
        var token      = $('input[name="_token"]').val();
        var formData   = { position:position,createdBy:createdBy,department:department,district:district,province:province,fromDate:fromDate,toDate:toDate,status:status,role:role,gender:gender};

        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/filterUsersReports')!!}",
        beforeSend : function() {
            HoldOn.open({
                theme:"sk-rect",
                message: "<h4> generating report please wait... ! </h4>",
                content:"Your HTML Content",
                backgroundColor:"none repeat scroll 0 0 rgba(0, 0, 0, 0.8)",
                textColor:"white"
            });

        },
        success : function(dataSet){


          if ( $.fn.dataTable.isDataTable( '#usersTable' ) ) {
                    oUsersTable.destroy();
          }


          oUsersTable     = $('#usersTable').DataTable({
                "data": dataSet.data,
                "dom": 'Bfrtip',
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',{

                      extend : 'pdfHtml5',
                      title  : 'Siyaleader',
                      header : 'I am text in',
                    },

                ],
                "order" :[[0,"asc"]],
                 "columns": [

                    {data: 'id', name: 'users.id'},
                    {data: 'created_at', name: 'users.created_at'},
                    {data: 'name', name: 'users.name'},
                    {data: 'surname', name: 'users.surname'},
                    {data: 'cellphone', name: 'users.cellphone'},
                    {data: 'email', name: 'users.email'},
                    {data: 'active', name: 'users_statuses.name'},
                    {data: 'position', name: 'positions.name'},
                    {data: 'actions',  name: 'actions'},

               ],

         });

         $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();

            // Get the column API object
            var column = oUsersTable.column( $(this).attr('data-column') );

            // Toggle the visibility
            column.visible( ! column.visible() );
        });


          HoldOn.close();

        }
       })

     });





  });



     @if (count($errors) > 0)


        $('#updateUserForm #district').attr('disabled','disabled');
        $('#updateUserForm #municipality').attr('disabled','disabled');
        $('#updateUserForm #ward').attr('disabled','disabled');
        $('#modalEditUser').modal('show');

    @endif
</script>
@endsection
