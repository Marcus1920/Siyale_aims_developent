@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-provinces') }}">Provinces</a></li>
    <li class="active">Provinces Listing</li>
</ol>

<h4 class="page-title">PROVINCES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Provinces Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddProvince">
     Add Province
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
        <table class="table tile table-striped" id="provincesTable">
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
@include('provinces.edit')
@include('provinces.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var oTable     = $('#provincesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/provinces-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-districts/" + d.id + "') !!}' class='btn btn-sm'>" + d.name + "</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateProvinceModal(id)
    {

       $(".modal-body #provinceID").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/provinces/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditProvince #name").val(data[0].name);

            }
            else {
               $("#modalEditProvince #name").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalDepartment').modal('show');

    @endif


</script>
@endsection
