@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-provinces') }}">Provinces</a></li>
    <li><a href="{{ url('list-districts/'.$provinceObj->id.'') }}">{{ $provinceObj->name }}</a></li>
    <li><a href="{{ url('list-municipalities/'.$districtObj->id.'') }}">{{ $districtObj->name }}</a></li>
    <li><a href="#">{{ $municipalityObj->name }}</a></li>
    <li class="active">Wards Listing</li>
</ol>



<h4 class="page-title">{{ $municipalityObj->name }} WARDS</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Wards Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddWard">
     Add Ward
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
        <table class="table tile table-striped" id="wardsTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Name</th>
                    <th>Acronym</th>
                    <th>Actions</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@include('wards.edit')
@include('wards.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var municipality   = {!! $municipalityObj->id !!};
  var oTable     = $('#wardsTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/wards-list/" + municipality +"')!!}",
                 "columns": [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: function(d)
                {
                 return "<a href='{!! url('list-wards/" + d.id + "') !!}' class='btn btn-sm'>"+d.name+"</a>";

                },"name" : 'name'},
                {data: 'slug', name: 'slug'},
              {data: 'actions',  name: 'actions'},
               ],

            "aoColumnDefs": [
                { "bSearchable": false, "aTargets": [ 1] },
                { "bSortable": false, "aTargets": [ 1 ] }
            ]

         });

  });

   function launchUpdateWardModal(id)
    {

      $(".modal-body #wardID").val(id);

        $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/wards/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditWard #name").val(data[0].name);
               $("#modalEditWard #slug").val(data[0].slug);

            }
            else {
               $("#modalEditWard #name").val('');
               $("#modalEditWard #slug").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalAddWard').modal('show');

    @endif
</script>
@endsection
