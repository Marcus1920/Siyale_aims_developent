@extends('master')

@section('content')
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-forms') }}">Forms</a></li>
    <li class="active">Forms Data Listing</li>
</ol>

<h4 class="page-title">Forms Data</h4>
<div class="block-area" id="alternative-buttons">
	<h3 class="block-title" style="line-height: 1.75em;">Forms Data Listing</h3>
	{!! Form::select('selForm',$forms, "",['class' => 'form-control select-sm','id' => 'selForm', 'style'=>"display: initial; height: auto; line-height: 1.75em !important; margin: 0 0.75em; padding: 0; width: 10em"]) !!}
	<a class="btn btn-sm" data-toggle="modall" data-target=".modalDataForm" style="margin-top: -0.25em; padding: 0.25em" id="btnAdd">
     Add Data
  </a>
</div>

<!-- Responsive Table -->
<div class="block-area" id="responsiveTable">
	<div class="table-responsive">
		@if(Session::has('success'))
      <div class="alert alert-success alert-icon">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
        <i class="icon">&#61845;</i>
      </div>
    @elseif(Session::has('failure'))
      <div class="alert alert-warning alert-icon">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('failure') }}
        <i class="icon">&#61845;</i>
      </div>
    @endif
		<table class="table tile table-striped" id="formsTable">
			<thead>
				<tr>
					<th style="width: 3em;">id</th>
					<th style="">Created</th>
					<th style="">Frm ID</th>
					<th style="width: 25%;">Form</th>
					<th style="width: 40%;">Data</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

@endsection

@section('footer')
<script>
var editForm = false;
function btnAdd(ev) {
	var form_id = -1;
	var selForm = $("#selForm").get(0);
	form_id = selForm.options[selForm.selectedIndex].value;
	console.log("btnAdd() form_id - "+form_id);
	//doAction("edit", form_id);
	$(".modalDataForm").modal();
	launchModalFormData(-1, form_id);
}



function selectForm(el) {
	var form_id = -1;
	var form_name = "";
	if (Object.prototype.isPrototypeOf(el)) {
		form_id = el.options[el.selectedIndex].value;
		form_name = el.options[el.selectedIndex].text;
	}
	console.log("selectForm(el) form_id - ",form_id,", form_name - ",form_name,", el - ", el);
	console.log("iii - is ", Object.prototype.isPrototypeOf(el));
	form_name = form_name.replace(/ \(\d+\)/, "");
	/////if (form_id != -1) $("input[type='search']").val(form_name);
	//else $("input[type='search']").val("");
	/*$("input[type='search']").blur();
	$("input[type='search']").change();
	$("input[type='search']").trigger("search");
	$("input[type='search']").blur();*/
	/*$('#formsTable').DataTable().data().filter( function(v, i) {
		console.log("filter(v, i) i - "+i+", v - ",v);
		if (v.form_id == 4) return true;
		else return false;
	} ).draw();*/
	if (form_id != -1) $('#formsTable').DataTable().column(2).search(form_id).draw();
	else $('#formsTable').DataTable().column(2).search("").draw();
}



$(function() {
    var oForm = $('#formsTable').DataTable({
        "autoWidth":false,
        processing: true,
        serverSide: true,
        ajax: {
					url: '{!! route("formsdata.data") !!}'
					, data: function(d) {
					}
        },
        columns: [
            { data: 'id', name: 'forms_data.id' },
            { data: 'created_att', name: "created_att", searchable: false, className:"created_at" },
            { data: 'form_id', name: 'form_id', searchable: true, visible: false },
            { data: 'name', searchable: true },
            { data: 'data', name: 'data', searchable: true, className: "data" },
            { data: 'actions',  name: 'actions' }
            //{ data: 'updated_at', name: 'updated_at' }
        ]
				, initComplete: function () {
					console.log("initComplete");
					this.api().columns().every(function () {
						console.log("  every() this - ",this);
						var column = this;
						var input = document.createElement("input");
						$(input).appendTo($(column.footer()).empty())
						.on('change', function () {
							column.search($(this).val(), false, false, true).draw();
						});
					});
				}
        , "aoColumnDefs": [
					//{ "bSearchable": true, "aTargets": [ 1 ] },
					//{ "bSearchable": false, "aTargets": [ 4 ] },
					{ "bSortable": false, "aTargets": [  ] }
				]
    });
    console.log("$.fn.dataTable.ext - ",$.fn.dataTable.ext);
    $.fn.dataTable.ext.search.push(
    	/*function(settings, searchDataa, index, rowData, counter) {
				console.log("search() settings - ",settings,", searchData - ",searchData,", index - ",index,", rowData - ",rowData,", counter - ",counter);
				return false;
    	}*/
    	/*function(settings, searchDataa, index) {
    		return false;
			}*/
    );
    
    $("#selForm").on("change", function(e) { selectForm(e.currentTarget); });
    /*$("#selForm").on("change", function(e) { 
    	var form_id = e.currentTarget.options[e.currentTarget.selectedIndex].value;
			var form_name = e.currentTarget.options[e.currentTarget.selectedIndex].text;
			var oForm = {id: form_id, name: form_name}
    	selectForm(oForm); 
    });
    */
    $("#formsTable_wrapper .row").first().css("margin-top", "-4.75em");
    $("#formsTable_wrapper .row").first().css("float", "right");
    $("#formsTable_wrapper .row").first().find(".col-sm-6").css("width", "auto");
    @if(isset($form_id) && $form_id != -1)
    	$("#selForm").val("{{ $form_id }}");
    	$("#selForm").trigger("change");
    	//selectForm("{{ $form_id }}");
    	oForm.draw();
    @endif
    
    $("#btnAdd").on("click", btnAdd);
});
</script>

<style type="">
.row { margin: 0;}
</style>
@endsection
