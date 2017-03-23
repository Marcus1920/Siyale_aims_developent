@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-provinces') }}">Provinces</a></li>
    <li><a href="{{ url('list-districts/'.$provinceObj->id.'') }}">{{ $provinceObj->name }}</a></li>
    <li><a href="#">{{ $districtObj->name }}</a></li>
    <li class="active">Municipalities Listing</li>
</ol>



<h4 class="page-title">{{ $districtObj->name }} MUNICIPALITIES</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">
    <h3 class="block-title">Municipalities Listing</h3>
    <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddMunicipality">
     Add Municipality
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
        <table class="table tile table-striped" id="municipalitiesTable">
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
@include('municipalities.edit')
@include('municipalities.add')
@endsection

@section('footer')

 <script>
  $(document).ready(function() {

  var district   = {!! $districtObj->id !!};
  var oTable     = $('#municipalitiesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'T<"clear">lfrtip',
                "order" :[[0,"desc"]],
                "ajax": "{!! url('/municipalities-list/" + district +"')!!}",
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

   function launchUpdateMunicipalityModal(id)
    {

      $(".modal-body #municipalityID").val(id);

        $.ajax({
        type    :"GET",
        dataType:"json",
        url     :"{!! url('/municipalities/"+ id + "')!!}",
        success :function(data) {

            if(data[0] !== null)
            {

               $("#modalEditMunicipality #name").val(data[0].name);
               $("#modalEditMunicipality #slug").val(data[0].slug);

            }
            else {

               $("#modalEditMunicipality #name").val('');
               $("#modalEditMunicipality #slug").val('');
            }

        }
    });

    }

    @if (count($errors) > 0)

      $('#modalAddMunicipality').modal('show');

    @endif
</script>
@endsection
