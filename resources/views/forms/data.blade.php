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
	<a class="btn btn-sm" data-toggle="modal" data-target=".modalDataForm" style="margin-top: -0.25em; padding: 0.25em" id="btnAdd">
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

@include('forms.data.form')
@include('forms.data.view')
@endsection

@section('footer')
<script>
var editForm = false;
function doAction(el, id, form_id) {
	var action = el.options[el.selectedIndex].value;
	console.log("doAction(el, id, form_id) id - ",id,", form_id - ",form_id,", action - ",action,", el - ",el);
	if (action == "edit") {
		$(".modalDataForm").modal();
		//launchFormModal(id, true);
		launchFormModal(id);
	} else if (action == "view") {
		$(".modalDataView").modal();
		launchModalView(id);
	} else if (action == "editform") {
		console.log(this);
		//return redirect("list-forms");
		var url = '{{url("list-forms")}}/'+form_id;
		console.log("  url - "+url);
		window.location.href = url;
	}
	el.selectedIndex = 0;
}

//function launchFormModal(id, edit) {
function launchFormModal(id, form_id) {
	//console.log("launchFormModal(id, edit) id - ",id,", edit - ",edit);
	console.log("launchFormModal(id, form_id) id - ",id,", form_id - ",form_id);
	//editForm = edit;
	var symbols = { AUD: "$", BRL: "R$", CAD: "$", CNY: "¥", EUR: "€", HKD: "$", INR: "?", JPY: "¥", MXN: "$", NZD: "$", NOK: "kr", GBP: "&pound;", RUB: "?",SGD: "$", KRW: "?", SEK: "kr", CHF: "Fr", TRY: "?", USD: "$", ZAR: "R" }
	$(".modal-body #formId").val(form_id);
	$(".modal-body #formDataId").val(id);
	$.ajax({
		type    :"GET",
		dataType:"json",
		url     :"{!! url('/forms/data/"+ id + "/"+form_id+"')!!}",
		success :function(data) {
			console.log("data - ", data);
			if (data[0] !== null) {
				$("#modalDataForm .modal-title").text(data[0].name);
				$("#modalDataForm .modal-header i").remove();
				$("#modalDataForm .modal-header").append("<i>"+data[0].purpose+"</i>");
			}
			$("#modalDataForm .modal-body .fields").empty();
			var theRules = {};
			if (data[1] !== null) {
				for (var i = 0; i < data[1].length; i++) {
					/*$(".modal-body").append('<div class="form-group"></div>');
					var group = $(".modal-body").find(".form-group").first();
					group.append("<label>RRR</label>");
					//lbl.text(data[1][i].label);
					//lbl.attr("class", "col-md-2 control-label");*/
					var opts = JSON.parse(data[1][i].options);
					console.log("  data[1]["+i+"] - ", data[1][i],", opts - ", opts);
					var group = document.createElement("div");
					group.className = "form-group clearfix";
					var lbl = document.createElement("label");
					lbl.className = "col-md-2 control-label";
					lbl.innerText = data[1][i].label;
					///$(lbl).attr("for", data[1][i].name);
					//$(lbl).css("white-space", "nowrap");
					$(group).append(lbl);
					
					var div = document.createElement("div");
					div.className = "col-md-6";
					
					var input = null;
					if (data[1][i].type != "choice" && data[1][i].type != "rel" && opts.type != "select") input = document.createElement("input");
					else input = document.createElement("select");
					input.className = "form-control input-sm";
					input.name = "data["+data[1][i].name+"]";
					input.id = data[1][i].name;
					///input.required = true;
					input.style.display = "inline-block";
					input.style.width = "initial";
					input.type = "text";
					var val = "";
					if (data[2] !== null) val = data[2][data[1][i].name];
					input.value = val;
					$(lbl).attr("for", input.id);
					$(input).attr("data-opts", data[1][i].options);
					
					if (data[1][i].type == "file") input.type = "file";
					
					if (data[1][i].type == "boolean") {
						if (opts.type == "") opts.type = "checkbox";
						if (opts.type == "checkbox") {
							var checked = "";
							if (val == 1) checked = "checked";
							$(div).append('<input id="'+data[1][i].name+'" name="'+data[1][i].name+'" style="opacity: 1" type="checkbox" value="1" '+checked+'>');
						} else if (opts.type == "radio") {
							var wrapper = document.createElement("div");
							var labels = ["False", "True"];
							var checked = ["", ""];
							checked[val] = "checked";
							if (opts['false']) labels[0] = opts['false'];
							$(wrapper).append('<label style="">'+labels[0]+'<input name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="0" '+checked[0]+'></label>');
							///if (opts['false']) $(wrapper).append('<label style="">A <input id="fffA" name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="0"></label>');
							$(wrapper).append("&nbsp;&nbsp;&nbsp;");
							if (opts['true']) labels[1] = opts['true'];
							$(wrapper).append('<label>'+labels[1]+'<input name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="1" '+checked[1]+'></label>');
							///if (opts['true']) $(wrapper).append('<label style="">B <input id="fffB" name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="1"></label>');
							$(div).append(wrapper);
							
						} else if (opts.type == "select") {
							input.className = "form-control select-sm";
							input.id = data[1][i].name;
							input.style.width = "5em";
							if (opts['false']) {
								if (val == 0) $(input).append('<option selected value="0">'+opts['false']+'</option>');
								else $(input).append('<option value="0">'+opts['false']+'</option>');
							}
							if (opts['true']) {
								if (val == 1) $(input).append('<option selected value="1">'+opts['true']+'</option>');
								else $(input).append('<option value="1">'+opts['true']+'</option>');
							}
							
							$(div).append(input);
						}
					} else if (data[1][i].type == "choice") {
						input.className = "form-control select-sm";
						input.id = data[1][i].name;
						if (opts.multi == 1) {
							input.multiple = true;
							input.name += "[]";
						} 
						if (opts.options && opts.options.length > 0) {
							//if (opts.multi) sel.size = opts.options.length;
							for (var oi = 0; oi < opts.options.length; oi++) {
								if (opts.multi == 1) {
									var sel = "";
									for (var vi = 0; vi < val.length; vi++) {
										if (val[vi] == opts.options[oi]) sel = "selected";
									}
									$(input).append('<option '+sel+' value="'+opts.options[oi]+'">'+opts.options[oi]+'</option>');
								} else {
								if (val == opts.options[oi]) $(input).append('<option selected value="'+opts.options[oi]+'">'+opts.options[oi]+'</option>');
								else $(input).append('<option value="'+opts.options[oi]+'">'+opts.options[oi]+'</option>');
								}
							}
						}
						
						$(div).append(input);
					} else if (data[1][i].type == "currency") {
						var div2 = document.createElement("div");
						input.style.textAlign = "right";
						$(div2).append(symbols[opts.type]+" ");
						$(div2).append(input);
						$(input).attr("placeholder", "sdjsldsh");
						//$(input).attr("required", "required");
						//$(input).attr("digits", "digits");
						//$(input).attr("data-rule-requiredd", "true");
						//$(input).attr("data-rule-currency", "true");
						//$(input).attr("data-type", "currency");
						$(input).attr("data-rule-number", "true");
						$(div).append(div2);
					} else if (data[1][i].type == "datetime") {
						if (opts.subtype == "datetime") $(input).attr("data-format", "yyyy-MM-dd hh:mm:ss");
						else if (opts.subtype == "date") $(input).attr("data-format", "yyyy-MM-dd");
						else if (opts.subtype == "time") $(input).attr("data-format", "hh:mm:ss");
						var div2 = document.createElement("div");
						div2.className = "input-icon datetime-pick ";
						if (opts.subtype == "date") div2.className += "date-only";
						else if (opts.subtype == "time") div2.className += "time-only";
						else div2.className += "datetime";
						$(div2).append(input);
						$(div2).append('<span class="add-on"><i class="sa-plus"></i></span>');
						$(div).append(div2);
					} else if (data[1][i].type == "number") {
						var len = 0;
						//if (opts.min) 
						var inputNum = $(div).append(input).find("input").last();
						console.log("inputNum - ", inputNum);
						//$(input).attr("data-rule-number", "true");
						//$(input).rules("add", { required: true, digits: true });
						/*$(input).rules("add", {
							required: true, currency: true
						});*/
						if ((opts.decimals) == 0) $(input).attr("data-rule-digits", "true");
						else $(input).attr("data-rule-number", "true");
					} else if (data[1][i].type == "text" && opts.lines && opts.lines > 1) {
						$(div).append('<textarea class="form-control" id="'+data[1][i].name+'" name="data['+data[1][i].name+']" rows="'+opts.lines+'">'+val+'</textarea>');
					} else if (data[1][i].type == "rel") {
						input.className = "form-control select-sm";
						input.id = data[1][i].name;
						getRelatedItems(opts, input);
						$(div).append(input);
					}	else $(div).append(input);
					if (opts.min && opts.max) $(input).attr("data-rule-range", [opts.min, opts.max]);
					else if (opts.min) $(input).attr("data-rule-min", opts.min);
					else if (opts.max) $(input).attr("data-rule-max", opts.max);
					$(div).find("input").iCheck("destroy");
					$(div).find("input").iCheck({
		    checkboxClass: 'icheckbox_minimal',
		    radioClass: 'iradio_minimal'
	});
					$(group).append(div);
					$("#modalDataForm .modal-body div").first().append(group);
					$('.datetime').datetimepicker({ collapse: false, sideBySide: true });
					$('.date-only').datetimepicker({ pickTime: false });
					$('.time-only').datetimepicker({ pickDate: false });
					
					var title = data[1][i].desc;
					if (title) title += "\n";
					if (opts.lines) title += opts.lines+" line(s), ";
					if (opts.min || opts.max) {
						if (opts.min && opts.max) title += " > "+opts.min+" & < "+opts.max;
						else if (opts.min) title += " > "+opts.min;
						else if (opts.max) title += " < "+opts.max;
						if (data[1][i].type == "text") title += " characters";
					}
					$(input).attr("title", title);
					$(input).attr("data-original-title", title);
					if (title != "") $(input).tooltip({placement: "right", html: true, animation: true, template: '<div class="tooltip" role="tooltip" style="white-space: pre-wrap"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="background-color: rgba(128,128,128,0.75); "></div></div>',});
				}
			}
			updateFields(data[1]);
			
			/*$("#testCustomForm").validate({
				submitHandler: function(form) {
					console.log("submitHandler(form) form - ", form);
				}
			});*/
			
			var height = $(window).get(0).innerHeight - 200;
			console.log("  height - ", height, ", #modalDataForm .modal-body height - ", $("#modalDataForm .modal-body").height());
			if ($("#modalDataForm .modal-body").height() > height) $("#modalDataForm .modal-body").height( height );
			
			jQuery.validator.setDefaults({
				debug: true
				, success: "valid"
			});
			
			$("#testCustomForm").validate({
			onfocusout: function(el, ev) {
				console.log("onfocusout(el, ev) el - , ",el);
				//$(el.form).valid();
				//if (el.value != "") 
				$(el).valid();
			}
			, onkeyup: function(el, ev) {
				console.log("onkeyup(el, ev) el - , ", el,", ev - ", ev);
				$(el).valid();
			}
			/*, rules: {
				"nolimitss": {
					//required: true
				}
				, "checkcode": {
					//required: true
				}
			}*/
			, rules: theRules
		});
			
			/*$('input').rules("add", {
				required: true, currency: true
			});*/
			
			
		}
	});
}

function btnAdd(ev) {
	var form_id = -1;
	var selForm = $("#selForm").get(0);
	form_id = selForm.options[selForm.selectedIndex].value;
	console.log("btnAdd() form_id - "+form_id);
	//doAction("edit", form_id);
	launchFormModal(-1, form_id);
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

function updateFields(fields) {
	var form = $("#modalDataForm").first();
	console.log("updateFields(fields, form) fields - ",fields,", form - ", form);
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
