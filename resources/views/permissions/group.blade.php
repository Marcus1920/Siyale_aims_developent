@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-permissions') }}">Group Users</a></li>
    <li class="active">Group Users </li>
</ol>

<h4 class="page-title">Group Users</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Group Users Listing</h3>

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
        <table class="table tile table-striped" id="groupUsersTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>name</th>
                   
              </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('footer')

 <script>
    $(document).ready(function() {

        var group = {!! $group !!}

        //associatesTable
      var oPoiTable     = $('#groupUsersTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/group-users-list/')!!}" + '/'+group,
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
                    {data: 'name', name: 'users.name'},
                   

               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1] }
            ]

         });


 



  });



 
  
</script>
@endsection
