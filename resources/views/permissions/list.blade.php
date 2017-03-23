@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-permissions') }}">Permission</a></li>
    <li class="active">Permissions</li>
</ol>

<h4 class="page-title">Permissions</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Permissions Listing</h3>

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
        <table class="table tile table-striped" id="permissionsTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>

@include('permissions.edit')

@endsection
@section('footer')

 <script>
    $(document).ready(function() {

        //associatesTable
      var oPoiTable     = $('#permissionsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/permissions-list')!!}",
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

                    {data: 'id', name: 'permissions.id'},
                    {data: 'name', name: 'permissions.name'},
                    {data: 'actions',  name: 'actions'}

               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1] }
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

    function launchPermissionsModal(id)
    {

       $(".modal-body #permissionId").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/permissions/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditPermission #name").val(data[0].name);

            }
            else {
               $("#modalEditPermission #name").val('');
            }

        }
    });

    }
</script>
@endsection
