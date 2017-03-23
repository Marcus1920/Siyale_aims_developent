@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-relationships') }}">Relationships</a></li>
    <li class="active">Relationships Listing</li>
</ol>

<h4 class="page-title">RELATIONSHIPS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Relationships Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddRelationship">
     Add Relationship
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
        <table class="table tile table-striped" id="relationshipsTable">
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
@include('relationships.edit')
@include('relationships.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var oTable     = $('#relationshipsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/relationships-list/')!!}",
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

   function launchUpdateRelationshipModal(id)
    {

       $(".modal-body #relationshipID").val(id);
       $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/relationships/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditRelationship #name").val(data[0].name);

            }
            else {
               $("#modalEditRelationship #name").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalRelationship').modal('show');

    @endif


</script>
@endsection
