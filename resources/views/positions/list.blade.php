@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-positions') }}">Positions</a></li>
    <li class="active">Positions Listing</li>
</ol>

<h4 class="page-title">POSITIONS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Positions Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" onClick="launchAddPositionModal();" data-target=".modalAddPosition">
     Add Position
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
        <table class="table tile table-striped" id="positionsTable">
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
@include('positions.edit')
@include('positions.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var oTable     = $('#positionsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/positions-list/')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='#' class='btn btn-sm'>" + d.name + "</a>";

                },"name" : 'name'},

              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 3] },
                { "bSortable": false, "aTargets": [ 3 ] }
            ]

         });

  });

   function launchUpdatePositionModal(id)
    {

       $(".modal-body #positionID").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/positions/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalPosition #name").val(data[0].name);

            }
            else {
               $("#modalPosition #name").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalPosition').modal('show');

    @endif


</script>
@endsection
