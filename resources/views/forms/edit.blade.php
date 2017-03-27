<?php
	use App\Http\Controllers\DatabaseController AS DbController;
	$dbTables = DbController::getTables(true);
	//array_unshift($dbTables, "-- None --");
$dbTables = array_merge(array(''=>"-- None --"), $dbTables);
	//echo "errors<pre>".print_r($errors, 1)."</pre>";
	//echo "field<pre>".print_r(Input::old("field"), 1)."</pre>";
	//ini_set("memory_limit", "256M");
	//die(phpinfo());
	$dbTable = "";
	//$dbTable = "cases";
	$tips = array(
		'btnAddField'=>"Add a new field"
		, 'btnUpdateFields'=>"Update existing fields to match current database info"
		, 'chkSystem'=>"Include system fields"
		, 'chkOverwrite'=>"Overwrite any existing customizations"
      , 'slug'=>"Leave blank to use default value"
	);
	//die("\$dbTables<pre>".print_r($dbTables,1)."</pre>");
?>
<!-- Modal Default -->
<div class="modal fade modalEditForm" id="modalEditForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Custom Form</h4>
            </div>
            <div class="modal-body" style="padding-bottom: 0">
            {!! Form::open(['url' => 'updateForm', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"updateCustomForm" ]) !!}
            {!! Form::hidden('formId',NULL,['id' => 'formId']) !!}
            {!! Form::hidden('id',Auth::user()->id,[]) !!}
            <div style="border: 1px solid red; float: left; width: 50%">
            	<div class="form-group">
                    {!! Form::label('name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-4">
                      {!! Form::text('name',(Request::old("name")?Request::old("name"):null),['class' => 'form-control input-sm','id' => 'name']) !!}
                      @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                    </div>
                    {!! Form::label('txtSlug', 'Acronym', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-4">
                        {!! Form::text('slug',(Request::old("slug")?Request::old("slug"):null),['class' => 'form-control input-sm','id' => 'txtSlug', 'title'=>"$tips[slug]"]) !!}
                        @if ($errors->has('slug')) <p class="help-block red">*{{ $errors->first('slug') }}</p> @endif
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('purpose', 'Purpose', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-10">
                      {!! Form::text('purpose',NULL,['class' => 'form-control input-sm','id' => 'purpose']) !!}
                      @if ($errors->has('purpose')) <p class="help-block red">*{{ $errors->first('purpose') }}</p> @endif
                    </div>
                </div>
            </div>
            <div style="border: 1px solid green; float: right; width: 50%">
            	<div class="">
		            {!! Form::label('selTable', 'Table', array('class' => 'col-md-3 control-label')) !!}
		            <div class="col-md-9" >
		            {!! Form::select('table',$dbTables, $dbTable != "" ? $dbTable : NULL,['class' => 'form-control select-sm','id' => 'selTable', 'style'=>"", 'onchange'=>"selectTable(this.options[this.selectedIndex].value, false)"]) !!}
		          	</div>
		          	<div class="form-group" style="clear: both">
                        <div class="">
                            {!! Form::label('chkSystem', 'System', array('class' => 'col-md-3 control-label', 'title'=>"$tips[chkSystem]", 'style'=>"float: left", 'data-placement'=>"bottom")) !!}
                            <div class="col-md-1">
                                {!! Form::checkbox('chkSystem',1, false,['id'=>'chkSystem']) !!}
                            </div>
                            {!! Form::label('chkOverwrite', 'Overwrite', array('class' => 'col-md-3 control-label', 'title'=>"$tips[chkOverwrite]", 'style'=>"float: left")) !!}
                            <div class="col-md-1">
                                {!! Form::checkbox('chkOverwrite',1, false,['id'=>'chkOverwrite']) !!}
                            </div>
                        </div>
	                </div>
                </div>
            </div>
            <hr/>
            <div style="clear: both; white-space: nowrap">
            	<h3 class="block-title">Fields</h3>
	            <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddField" id="btnAddField" title="{{$tips['btnAddField']}}">Add Field</a>
	            <a class="btn btn-sm" data-toggle="modal" data-target=".modalAddField" id="btnUpdateFields" title="{{$tips['btnUpdateFields']}}">Update Fields</a>
            </div>
            <!--<span id="cntFields">0</span>-->
            <div class="form-group" id="formFields" style="overflow-y: auto">
            @if (!is_null(Input::old("field")))
            	@foreach (Input::old("field") as $i=>$field)
            		@include('forms.field')
            		<script>
            		console.log("JSON - ", JSON);
            			var val = JSON.parse('{!! json_encode($field) !!}');
            			console.log("Updating old field with ", val);
            			$(document).ready(function() {
            				var el = $("#formFields .fieldTemplate").get({{$i}});
										updateField(el, JSON.parse('{!! json_encode($field) !!}'), {{$i}});
            			});
            		</script>
            	@endforeach
            @endif
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitUpdateCustomForm' type="button" class="btn btn-sm">Save Changes</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script type="text/javascript">
var cntFields = 0;
var cntSubFields = 0;
var tablename = "";
var form_id =-1;


function launchUpdateFormModal(id, clear) {
	console.log("launchUpdateFormModal(id) id - "+id+", clear - ",clear,", fields - ",$("#formFields .fieldTemplate").length);
	if (APP_DEBUG > 2) console.log(", this - ",this);
	//$(".modalAJAX").modal({ escapeClose: false, clickClose: true, showClose: true });
	$(".modal-body #formId").val(id);
	//$("#formFields").remove(".fieldTemplate");
	if (clear) $("#formFields .fieldTemplate").remove();
	/*$("#cntFields").text($(".fieldTemplate").length);*/
	cntFields = 0;
	$.ajax({
		async: true,
		type    :"GET",
		dataType:"json",
		url     :"{!! url('/forms/"+ id + "')!!}",
		success :function(data) {
          if (APP_DEBUG > 2) console.log("data - ", data);
			if(data[0] !== null) {
				$("#modalEditForm #name").val(data[0].name);
				$("#modalEditForm #purpose").val(data[0].purpose);
				$("#modalEditForm #txtSlug").val(data[0].slug);
        if (data[0].table) $("#selTable").val(data[0].table);
        else $("#selTable").val("");
			}
			else {
				$("#modalEditForm #name").val('');
			}
			if(data[1] !== null) {
			  var notadded = [];
			  var ii = 0;
				for (var i = 0; i < data[1].length; i++) {
				  var orderfloor = Math.floor(data[1][i]['order']);
                  if (APP_DEBUG > 2) console.log("  Adding field: i - ",i,", field - ",data[1][i],", order floor - ",orderfloor," = order = ",(orderfloor == data[1][i]['order']));
					if (data[1][i]['order'] == orderfloor) {
					  addField(ii, data[1][i]);
					  ii++;
          }
					else {
            notadded.push(i);
          }
				}
							if (APP_DEBUG > 2) console.log("  not added - ",notadded);
        for (var i = 0; i < notadded.length; i++) {
          $("#formFields .fieldTemplate").each(function(i2, el) {
            var orderfloor = Math.floor(data[1][notadded[i]]['order']);
            if ($(el).find("[id^=fieldOrder]").val() == orderfloor) addSubField(el,null, data[1][notadded[i]]);
          });
        }
				updateFields();
			}
			/*$(".fieldTemplateClone").each(function(i, el) {
				//var el = this;
				console.log(".fieldTemplate(i, el) i - "+i+", el - ", el);
				$(el).find("[name*='field']").each(function(i2, el2) {
					console.log("  field(i2, el2) i - "+i2+", el2 - ", el2);
					el2.name = el2.name.replace("[]", "["+i+"]");
					el2.id= el2.id + i;
					var lbl = $(el2).parent().find("label").first();
					lbl = $(el2).siblings("label").first();
					if (lbl.length == 0) lbl = $(el2).parent().parent().find("label").first();
					if (lbl.length == 0) lbl = $(el2).parent().parent().parent().find("label").first();
					console.log("  lbl - ", lbl);
					console.log("  lbl.text() - ", lbl.text());
					console.log("  lbl.val() - ", lbl.val());
					console.log("  for - ", lbl.attr("for"));
					lbl.attr("for", el2.id);
					console.log("  for - ", lbl.attr("for"));
				});
			});*/
			$("#chkSystem").off("ifChanged");
			$("#chkSystem").on("ifChanged", function(ev) {
				var selTable = $("#selTable").get(0);
				//var tbl = selTable.options[selTable.selectedIndex].text;
				var tbl = $("#selTable").val();
				//alert("chkSystem.changed() tbl - "+tbl);
				if (tbl != "0") selectTable(tbl);
			});

			//console.log("selTable - ",$("#selTable"));
			if (data[1].length > 0) for (var i = 0; i < data[1].length; i++) {
				for (var i2 = 0; i2 < $("#selTable").get(0).options.length; i2++) {
					//console.log("selTable.options["+i2+"] - ",$("#selTable").get(0).options[i2]);
					if ($("#selTable").get(0).options[i2].value == data[1][i].table) {
						//console.log("Setting it");
						$("#selTable").get(0).selectedIndex = i2;
					}
				}
			}
			if (data[1].length == 0) {
			  if ($("#selTable").val()) selectTable($("#selTable").val());
      }
			//$("#selTable").get(0).selectedIndex = 5;
			$("a[title!=''],input[title!=''],label[title!='']").tooltip( {placement:"top", track: true } );
			var height = 0;
			$(".form-group").each( function(index) { height += $(this).height(); } );
          if (APP_DEBUG > 2) console.log("  height after adding - ", height);
			$("#formFields .form-group").each( function(index) { height -= $(this).height(); } );
			height = $(window).get(0).innerHeight - 300;
          if (APP_DEBUG > 2) console.log("Setting height: window.height - ", $(window).height(), ", form-group height - ",height);
			$("#formFields").height( height );
			updateFieldss();
		}
	});
}

function addChoice(template, val, index) {
	console.log("addChoice(template, val, index) template - ",template,", val - ",val,", index - ",index);
	//if (typeof index == "undefined") index = "";
	var choices = $(template).find("#optsChoices");
	if (typeof index == "undefined") {
		index = getFieldIndex(choices);
	}
	console.log("  index - ",index);
	var wrapper = document.createElement("div");
	var choice = document.createElement("input");
	choice.className = "form-control input-sm";
	choice.name = "field["+index+"][opts][choice][options][]";
	if (val) choice.value = val;
	wrapper.appendChild(choice);
	choices.append(wrapper);
	///updateFields();
	//updateFieldss();
    //updateField(template);
}

function addChoiceRel(template, val, display) {
	if (APP_DEBUG > 0) console.log("addChoiceRel(template, val) display - ",display);
	if (APP_DEBUG > 2) console.log(", template - ",template,", val - ",val);
    var displayFields = $(template).find(".displayFields");
	var wrapper = document.createElement("div");
	var label = document.createElement("label");
	var choice = document.createElement("input");
	$(choice).css("opacity", "1");
	choice.name = "field[][opts][rel][display][]";
	choice.type = "checkbox";

	label.className = "col-md-4 control-label";
	if (val) {
		choice.value = val.name;
		label.innerText = val.name;
		if (typeof display != "undefined") {
			///console.log("  Looping thru display - ", display);
			for (var i = 0; i < display.length; i++) {
				///console.log("    ",display[i]," == ",val.name);
				if (display[i] == val.name) choice.checked = true;
			}
		}
	}
	wrapper.className = "clearfix";
	$(wrapper).css("clear","both");
	wrapper.appendChild(choice);
	if (APP_DEBUG > 2) console.log("  label - ", label);
	wrapper.appendChild(label);
	displayFields.append(wrapper);
	updateField(template);
}

function addField(index, vals) {
	if (APP_DEBUG > 0) console.log("addField(index, vals) index - ",index,", vals - ", vals);
	cntFields++;
	/*$("#cntFields").text(cntFields);*/
	var template = $(".fieldTemplate").clone().get(0);
	//template.className = "fieldTemplateClone";
	//template.css("display: block !important");
	//template.disabled = false;
	////$(template).find("#fieldType").removeAttr("disabled");
	///template.style.display = "block";
	$("#formFields").append(template);

	template.style.display = "block";

	///$(template).on("mousedown", startDrag);
	/////$(template).find(".options").find("[class^='opts']").hide();
	updateField(template, vals, index);
	/*$(template).find("input").on("ifClicked", function(ev) {
		console.log("Checkbox clicked");
	});
	$(template).find("input").on("ifChecked", function(ev) {
		console.log("Checked");
	});
	$(template).find("input").on("ifUnchecked", function(ev) {
		console.log("Unchecked");
	});
	$(template).find("input").on("ifClicked", function(ev) {
		console.log("Clicked");
	});*/

	/*$(template).find("input").iCheck("destroy");
	$(template).find("input").iCheck({
		    checkboxClass: 'icheckbox_minimal',
		    radioClass: 'iradio_minimal',
		    increaseArea: '50%' // optional
	});*/

	//$(template).find("input").iCheck("check");
	//$(template).find("input").iCheck("destroy");
	//$(template).find("input").iCheck("enable");
	//$(template).find("input").iCheck("update");

	//$(template).find("a[title!=''],input[title!=''],label[title!='']").tooltip( {placement:"right", track: true } );
	/*$(template).find("[id^='fieldType']").on("change", function(ev) {
		console.log("fieldType.change: ev - ", ev, ", this - ",this);
		selectType(template, this.options[this.selectedIndex].value);
	});
	$(template).find("[id^='btnAddChoice']").on("click", function(ev) {
		addChoice(template);
	});*/
	if (!vals) template.scrollIntoView();
	else if (vals.type == "rel") {
		var opts = JSON.parse(vals.options);
		selectTable(opts.table, true, $(template).find(".optsRelated").get(0), opts, false, index);
		////updateField(template, vals, index);
	}
}

/**
 * addSubField
 * @param parent
 * @param index
 * @param vals
 */
function addSubField(parent, index, vals) {
  if (APP_DEBUG > 0) console.log("addSubField(field,index, vals) index - ",index,", vals - ", vals,",field - ",parent);
  cntSubFields++;
  /*var indexMain = -1;
  if (index) indexMain*/
  if (!index) index = $("#formFields .fieldTemplate").length+1;
  //if (!index) index = $(parent).find(".fieldTemplate").length;
  if (!vals) {
    vals = {};
    vals['name'] = $(parent).find("input[id^='fieldName']").val();
    vals['order'] = $(parent).find("input[id^='fieldOrder']").val()+"."+($(parent).find(".wInputs .fieldTemplate").length+1);
    //vals['type'] $(template).find("[id^='fieldType']").val()
    vals['type'] = "";
  }
	if (APP_DEBUG > 2) console.log("  index - ",index,", vals - ",vals);
  var template = $(".fieldTemplate").clone().get(0);
  $(parent).find(".wInputs").append(template);
  $(template).find(".addsub").remove();
  $(template).find(".wInputs").remove();
  //$(template).find("#fieldName").parentsUntil(".col-md-6").parent().remove();
  //$(template).find("#fieldName").parentsUntil(".form-group").parent().remove();
  //$(template).find("#fieldName").parentsUntil(".form-group").parent().hide();
  $(template).find("[class^='optSub']").show();
  template.style.clear = "both";
  template.style.display = "block";

  updateField(template, vals, index);
  /*if (index) {
    $(template).find("[name^='field[']").each(function (i, el) {
      console.log("    subfield element ",i," ",el);
      el.name = el.name.replace(/\[\d*\]/, "["+index+"]");
      el.id += index;
    });

  }
  if (vals['index']) $(template).find("input[id^='fieldOrder']").val(vals['index']);
  */
  if (typeof vals['type'] != "undefined") selectType(template, vals['type']);
}

function checkForm() {
	console.log("checkForm()");
	var valid = true;
	$("#formFields .fieldTemplate").each(function(i, template) {
		console.log("  .fieldTemplate: i - "+i+", this - ", this);
		$(this).find(".invalid").hide();
		$(this).find(".invalid").each(function() {
			if ($(this).prev().val() == "") {
				$(this).show();
				template.scrollIntoView();
				//valid = false;
			}
		});
		//var inputs = $(this).find("[class^='opts']").filter(":visible").find("input");
		var opts = $(this).find("[class^='opts']").filter(":visible");
		//console.log("    inputs - ", inputs);
		/*inputs.each(function(i2, input) {
			console.log("    inputs["+i2+"] - ", input);
		});*/
		opts.find("input").removeClass("error");
		/*if (opts.find("[id^=txtMin]")[0] && opts.find("[id^=txtMax]")[0]) {
			var min = opts.find("[id^=txtMin]")[0];
			var max = opts.find("[id^=txtMax]")[0];
			console.log("    min - ",$(min).val(),", max - ", $(max).val());
			if (Number($(min).val()) > Number($(max).val())) {
				$(min).addClass("error");
				$(max).addClass("error");
				valid = false;
				min.scrollIntoView();
			}
		}*/
	});
	//valid = false;
	return valid;
}

function duplicateField(field) {
	//var field = $("#formFields").find(".fieldTemplate").get(index);
	var vals = { type: "" }
	var type = $(field).find("[id^=fieldType]").val();
	var newfield = $(field).clone(true).get(0);
	console.log("duplicateField(index) vals - ", vals);
	$("#formFields").append(newfield);
	newfield.scrollIntoView();
	updateFields();
	$(newfield).find("input").iCheck("update");
	/*$(newfield).find("input").iCheck({
		    checkboxClass: 'icheckbox_minimal',
		    radioClass: 'iradio_minimal'
	});*/
	$(newfield).find("[id^=fieldType]").val(type);
	$(newfield).find("[id^=fieldId]").val("");
}

function deleteField(field) {
	console.log("deleteField(field) field - "+field);
	//$("#formFields").find(".fieldTemplateClone")[1].remove();
	//var field = $("#formFields").find(".fieldTemplate").get(index);
	$(field).remove();
	updateFields();
}

function getFieldIndex(template, container) {
	if (APP_DEBUG > 0) console.log("getFieldIndex(template) template - ", template);
	if (APP_DEBUG > 2) console.log("  Searching for index");
	//var tt = $(template).closest('[name|="field"]');
	var fieldTemplate = $(template).parents('.fieldTemplate').get(0);
	if (APP_DEBUG > 2) console.log("  fieldTemplate - ",fieldTemplate);
	var field = $(fieldTemplate).find('[name*="field"]').get(0);
	if (APP_DEBUG > 2) console.log("  field - ",field);
	var index = -1;
	if (typeof field != "undefined") {
		var regex = /field\[(\d+)\]/g.exec(field.name);
      if (APP_DEBUG > 2) console.log("  regex - ",regex);
		index = regex[1];
	}
	if (APP_DEBUG > 2) console.log("  index - ",index);
	if (index == -1) {
	  index = $("#formFields .fieldTemplate").length;
      /*$("#formFields .fieldTemplate").each(function(i,el) {
        console.log("    Checking field ",i);
      });*/
  }
	if (APP_DEBUG > 2) console.log("  returning ",index);
	return index;
}

function getFieldIndexSub(template) {
  console.log("getFieldIndexSub(template) template - ", template);
}

function orderDown(e) {

}

function orderUp(e) {

}

function reorder(dir, el) {
	console.log("reorder(dir, el) dir - "+dir+", el - ", el);
	var elParent = $(el).parent();
	console.log("  elParent - ",elParent);
	var fields = elParent.find(".fieldTemplate");
	/*var index2 = 0;
	if (dir > 0) index2 = index-1;
	else if (dir < 0) index2 = index+1;
	var el1 = fields.get(index);
	var el2 = fields.get(index2);
	swapElements(el1, el2);
	updateFields();*/
	var el2 = null;
	fields.each(function(i) {
		if (this == el) {
			var index2 = 0;
			if (dir > 0) index2 = i-1;
			else if (dir < 0) index2 = i+1;
			el2 = fields.get(index2);
			console.log("  GotCHA! el2 - ",el2);
		}
	});

	if (el2 != null) {
      var order = [];

      order.push($(el).find("[id^=fieldOrder]").val());
      order.push($(el2).find("[id^=fieldOrder]").val());
      console.log("  order - ", order);
      swapElements(el, el2);
      $(el).find("[id^=fieldOrder]").val(order[1]);
      $(el2).find("[id^=fieldOrder]").val(order[0]);
    }
	updateFieldss();
}

function selectTable(name, rel, template, opts, refresh, index) {
	var chkSystem = $("#chkSystem").get(0).checked;
	var form_id = $(".modal-body #formId").val();
	//var index = $(template).closest('.fieldTemplate');
  var tStart = new Date().getTime();
	if (APP_DEBUG > 0) console.log("selectTable(name, rel) (",tStart,") form_id - "+form_id+", index - "+index+", name - "+name+", rel - "+rel+", opts - ",opts,", template - ",template,", chkSystem - "+chkSystem);
	if (typeof index == "undefined") {
		index = getFieldIndex(template);
	}
	if (!refresh) {
		if (rel && template) $(template).find(".displayFields").empty();
		else if (!rel) $("#formFields .fieldTemplate").remove();
	}
	if (name == "0") return;
	if (name != null) tablename = name;
	$(template).find(".wLoader").css("display", "inherit");
	$.ajax({
		type    :"GET",
		dataType:"json",
		url     :"{!! url('/forms/database/tables/"+ tablename + "/"+form_id+"')!!}",
		success :function(data) {
          var tSuccess = new Date().getTime();
          var tSince = tSuccess - tStart;
          if (APP_DEBUG > 1) console.log("selectTable() SUCCESS (",tSuccess,", ",tSince,"ms since ",tStart,"), name - ",name);
          if (APP_DEBUG > 1) console.log("data - ", data);
			if(data !== null) {
				var systemTables = ["active","created_at", "created_by", "id","remember_token", "updated_at", "updated_by"];
				var i2 = 0;
				for (var i = 0; i < data.columns.length; i++) {
					var col_tmp = data.columns[i];
					var col = { id: col_tmp.id, label: col_tmp.label, name: col_tmp.name, type: col_tmp.type, len: col_tmp.length};
					if (col_tmp.field_id) col.id = col_tmp.field_id;
					if (col.type == "integer") col.type = "number";
					else if (col.type == "string") col.type = "text";
					else if (col.type == "date" || col.type == "datetime" || col.type == "time") {
						col.type = "datetime";
						col.options = JSON.stringify({subtype: col_tmp.type});
					}
					var isSystem = false;
					for (var j = 0; j < systemTables.length; j++) if (systemTables[j] == col.name) isSystem = true;
					//if (i > 5) continue;
					if (isSystem == false || (chkSystem)) {
						if (refresh) {
							var el = null;
							$("#formFields .fieldTemplate").each(function(i) {
								//if (col.name == $(this).find("[id*='fieldName']").val()) {
								if ((col.id != -1 && col.id == $(this).find("[id*='fieldId']").val()) || col.name == $(this).find("[id*='fieldName']").val()) {
									el = this;
								}
							});
							if (el) {
                              if (APP_DEBUG > 1) console.log("  Updating for ",col);
								updateField(el, col, i2);
							} else {
                              if (APP_DEBUG > 1) console.log("  Adding for ",col);
								addField(i, col);
							}
						} else {
							if (rel) {
                              if (APP_DEBUG > 1) console.log("  Adding choice for ",col);
								if (opts) addChoiceRel(template, col, opts.display);
								else addChoiceRel(template, col);
							}
							else addField(i, col);
						}
						i2++;
					}
				}
				updateFieldss();
			}
            var tEnd = new Date().getTime();
            tSince = tEnd - tStart;
          if (APP_DEBUG > 1) console.log("selectTable() SUCCESS END (",tEnd,", ",tSince,"ms since ",tStart,"), name - ",name);
			///updateField(template, null, index);
          $(template).find(".wLoader").css("display", "none");
		}
	});
}

function selectType(template, selection) {
	///console.log("selectType(template, selection) template - ", template,", selection - ", selection);
	if (APP_DEBUG > 0) console.log("selectType(template, selection) selection - ", selection);
	$(template).find(".options").find("[class^='opts']").hide();
	///$(template).find(".options").find("[class^='opts']").show();
	if (selection != "") {
	  selection = selection[0].toUpperCase()+selection.substr(1);
    $(template).find(".options").find("[class^='opts"+selection+"']").show();
  }

	//$(template).find(".options").find("[class^='opts']:not([class^='opts"+selection+"'])").hide();
	/*$(template).find(".options").find("[class^='opts']").not("[class^='opts"+selection+"']").hide();
  $(template).find(".options").find("[class^='opts']:hidden").find("[name^='field']").attr("disabled", "disabled");
  $(template).find(".options").find("[class^='opts']:visible").find("[name^='field']").attr("disabled", null);*/
  //$(template).find(".options").find("[class^='opts']").show();
}

function swapElements(obj1, obj2) {
	// save the location of obj2
	var parent2 = obj2.parentNode;
	var next2 = obj2.nextSibling;
	// special case for obj1 is the next sibling of obj2
	if (next2 === obj1) {
		// just put obj1 before obj2
		parent2.insertBefore(obj1, obj2);
	} else {
		// insert obj2 right before obj1
		obj1.parentNode.insertBefore(obj2, obj1);

		// now insert obj1 where obj2 was
		if (next2) {
			// if there was an element after obj2, then insert obj1 right before that
			parent2.insertBefore(obj1, next2);
		} else {
			// otherwise, just append as last child
			parent2.appendChild(obj1);
		}
	}
}

function updateField(template, vals, index) {
	var tStart = new Date().getTime();
	//console.log("updateField(template, vals, index) vals - ",vals,",index - ", index,", template - ",template);
	if (APP_DEBUG > 0) console.log("updateField(template, vals, index) vals - ",vals,",index - ", index);
	if (template == null) return;
	if (typeof index == "undefined") {
		index = getFieldIndex(template);
	}
	if (APP_DEBUG > 2) console.log("  index - ",index);
	if (typeof index != "undefined") $(template).find("[name*='field']").each(function(i2, el2) {
		el2.name = el2.name.replace(/\[\d*\]/, "["+index+"]");
		if (el2.id != "") el2.id = el2.id.replace(/\d*$/, index);
	});
	if (template.className.search("fieldTemplate") != -1) {
		$(template).find(".sort_asc").off("click");
		$(template).find(".sort_desc").off("click");
		$(template).find(".delete").off("click");
		$(template).find(".duplicate").off("click");
		$(template).find(".addsub").off("click");
		$(template).find(".sort_asc").on("click", function(e) {
			reorder(1, template);
		});
		$(template).find(".sort_desc").on("click", function(e) {
			reorder(-1, template);
		});
		$(template).find(".delete").on("click", function(e) {
			deleteField(template);
		});
		$(template).find(".duplicate").on("click", function(e) {
			duplicateField(template);
		});
		$(template).find(".addsub").on("click", function(e) {
			addSubField(template);
		});
        $(template).find("[id^='btnAddChoice']").on("click", function(ev) {
            addChoice(template);
        });
	}
	if (APP_DEBUG > 1) console.log("  updateField since A: "+(new Date().getTime()-tStart)+"ms");
	if (vals) {
		if (vals.id) $(template).find("[id^=fieldId]").val(vals.id);
		if (vals.name) $(template).find("[id^=fieldName]").val(vals.name);
		if (vals.label) $(template).find("[id^=fieldLabel]").val(vals.label);
		if (vals.desc) $(template).find("[id^=fieldDesc]").val(vals.desc);
		if (typeof vals.order != "undefined") $(template).find("[id^=fieldOrder]").val(vals.order);
		else if (typeof index != "undefined") $(template).find("[id^=fieldOrder]").val(index);
		if (vals.type) {
			$(template).find("[id^=fieldType]").val(vals.type);
			selectType(template, vals.type);
		}
		if (vals.opts && !vals.options) vals.options = vals.opts[val.type];
		if (vals.options) {
			var opts = vals.options;
			if (!Object.prototype.isPrototypeOf(opts)) opts = JSON.parse(opts);
          if (APP_DEBUG > 2) console.log("  Updating options - ",vals.options," ("+vals.options.length+"), opts - ",opts," ("+opts.length+")");
			for (var prop in opts) {
				var f = $(template).find("[name$='[opts]["+vals.type+"]["+prop+"]']");
              if (APP_DEBUG > 3) console.log("    f (before) - ", f);
				if (f.length == 1) {
					if (APP_DEBUG > 3) console.log("    f.val (before) - ", f.val());
					if ((f[0].type == "checkbox" || f[0].type == "radio") && f[0].value == opts[prop]) {
						console.log("    Check it");
						//f.iCheck("destroy");
						//f.iCheck("destroy");
						//f.iCheck("destroy");
						f.iCheck("check");
						f.iCheck("update");
					}
					else f.val(opts[prop]);
                  if (APP_DEBUG > 3) console.log("    f.val (after) - ", f.val());
				}
				else {
					for (var fi = 0; fi < f.length; fi++) {
						//f.iCheck("check");
						if ((f[fi].type == "checkbox" || f[fi].type == "radio") && f[fi].value == opts[prop]) $(f[fi]).iCheck("check");
					}
					//f.val(opts[prop]);
				}
				if (prop == "options" && vals.type && vals.type == "choice") {
					var choices = opts[prop];
					for (var ci = 0; ci < choices.length; ci++) if (choices[ci] != "") addChoice(template, choices[ci], index);
				}
			}
		}
		if (vals.len) {
			$(template).find("[id^=txtMax]").val(vals.len);
		}
	} else {
		selectType(template, "");
    }
	if (APP_DEBUG > 1) console.log("  updateField since Ba: "+(new Date().getTime()-tStart)+"ms");
	$(template).find("input").iCheck("destroy");
	$(template).find("input[type='radio']").iCheck({
		    checkboxClass: 'icheckbox_minimal',
		    radioClass: 'iradio_minimal'
		    , increaseArea: '20%'
	});
	if (APP_DEBUG > 1) console.log("  updateField since C: "+(new Date().getTime()-tStart)+"ms");
	var toTip = $(template).find("[title!='']");
	toTip = $(template).find("[data-original-title!='']");
	if (APP_DEBUG > 2) console.log("  Tipping "+toTip.length+" elements, APP_DEBUG - ",APP_DEBUG," > 2 - ", (APP_DEBUG > 2));
	//////console.log("toTip - ",toTip);
	if (APP_DEBUG > 1) console.log("  updateField since D: "+(new Date().getTime()-tStart)+"ms");
	toTip.each(function(i) {
      if (typeof $(toTip[i]).attr("data-original-title") == "undefined") return;
      //console.log("  In tip loop, APP_DEBUG - ",APP_DEBUG," > 2 - ", (APP_DEBUG > 2));
		if (APP_DEBUG > 3) console.log("    Tipping ",i," - ",$(toTip[i]).attr("data-original-title"));
		$(this).tooltip("destroy");
		$(this).tooltip( {placement:"right", track: true } );
	});
	if (APP_DEBUG > 1) console.log("  updateField since Z: "+(new Date().getTime()-tStart)+"ms");
  $(template).find("[id^='fieldType']").on("change", function(ev) {
    console.log("fieldType.change: ev - ", ev, ", this - ",this);
    selectType(template, this.options[this.selectedIndex].value);
  });
    var tEnd = new Date().getTime();
    var tTotal = tEnd - tStart;
	if (APP_DEBUG > 0) console.log("  updateField end: "+tTotal+"ms");
}

function updateFieldss() {
	if (APP_DEBUG > 0) console.log("updateFieldss() this - ",this);
	var fields = $("#formFields").find(".fieldTemplate");
	fields.each(function(index) {
			if (APP_DEBUG > 2) console.log("Updating field "+index+" of "+fields.length+", ordering buttons - ",$(this).find(".sort_asc").length);
		/*if (index == 0) $(this).find(".sort_asc").css("visibility","hidden");
		else $(this).find(".sort_asc").css("visibility","visible");
		if (index > 0 && index == fields.length-1) $(this).find(".sort_desc").css("visibility","hidden");
		else $(this).find(".sort_desc").css("visibility","visible");*/
		var order = $(this).find("[id^=fieldOrder]").val();
        if (order == 0) $(this).find(".sort_asc").css("visibility","hidden");
        else $(this).find(".sort_asc").css("visibility","visible");
		//$(this).find("[id^=fieldOrder]").val(index);
	});

	fields.each(function(i, el) {
		/////$(el).iCheck("destroy");
		/////console.log("  fields.each(i, el) i - ",i,", el - ",el);
		el.style.display = "block";
		//var el = this;
		///console.log(".fieldTemplate(i, el) i - "+i+", el - ", el);
		$(el).find("[name*='field']").each(function(i2, el2) {
			/////console.log("  field(i2, el2) i - "+i2+", el2 - ", el2);
			/////el2.name = el2.name.replace(/\[\d*\]/, "["+i+"]");
			if (el2.id != "") {
				/////el2.id = el2.id.replace(/\d*$/, i);
				var lbl = $(el2).parent().find("label").first();
				lbl = $(el2).siblings("label").first();
				if (lbl.length == 0) lbl = $(el2).parent().parent().find("label").first();
				if (lbl.length == 0) lbl = $(el2).parent().parent().parent().find("label").first();
				if (lbl.length == 0) lbl = $(el2).parent().parent().parent().parent().find("label").first();
				/////console.log("  lbl - ", lbl);
				///console.log("  lbl.text() - ", lbl.text());
				///console.log("  lbl.val() - ", lbl.val());
				///console.log("  for - ", lbl.attr("for"));
				lbl.attr("for", el2.id);
				/////console.log("  for - ", lbl.attr("for"));
			}
		});
		var selType = $(el).find("[id^='fieldType']").get(0);
		///selectType(el, selType.options[selType.selectedIndex].value);
			if (APP_DEBUG > 2) console.log("Adding click handler to btnAddChoice");
		$(el).find("[id^='btnAddChoice']").on("click", function(ev) {
			addChoice(el);
		});
		/*$(el).iCheck("destroy");
		$(el).iCheck({
			    checkboxClass: 'icheckbox_minimal',
			    radioClass: 'iradio_minimal',
			    //increaseArea: '50%' // optional
		});*/
		$(el).iCheck("update");
		//$(el).find(".iCheck-helper").css("position", "relative");
	});
	//$("input").iCheck("destroy");
	//$("input").iCheck({
			  //checkboxClass: 'icheckbox_minimal',
			  //radioClass: 'iradio_minimal',
			  //increaseArea: '20%' // optional
	//});
	/*$(".iCheck-helper").css("position", "relative");
	$("input").iCheck("destroy");
	//$("input").iCheck("update");
	$("input").iCheck({
			    checkboxClass: 'icheckbox_minimal',
			    radioClass: 'iradio_minimal',
			    //increaseArea: '50%' // optional
		});*/
}

function updateSubfield() {

}

$(document).ready(function() {
	$("#btnAddField").on("click", function (ev) { addField(); });
	$("#btnUpdateFields").on("click", function (ev) {
		var table = $("#selTable").get(0).options[$("#selTable").get(0).selectedIndex].value;
		// selectTable(name, rel, template, opts, refresh, index)
		selectTable(table, false, null, null, true);
	});

	//$("input[type=checkbox]").iCheck("destroy");
	////$("input").iCheck("destroy");

	$("#submitUpdateCustomForm").on("click", function (ev) {
		ev.preventDefault();
		if (checkForm()) $("#updateCustomForm").submit();
	});

	$(document).on("ifChecked", function(ev) {
		console.log("ifChecked(ev) ev - ",ev);
	});
	$(document).on("ifUnchecked", function(ev) {
		console.log("ifUnchecked(ev) ev - ",ev);
	});

});
</script>

<style type="">
#formFields {
    position: relative;
    display: block;
    /*padding: 20px 5px 20px 5px;
    margin: 20px;*/
    /*width: 200px;
    height: 200px;*/
    border: 1px solid black;
}
/*.fieldTemplate, .fieldTemplate label {
	font-size: small !important;
}*/
.fieldTemplateClone {
    position: relative;
    top: 0;
    display: table;
    /*margin-bottom: 2px;
    height: 25px;*/
    clear: both;
}
.fieldTemplate.drag { z-index: 99; color: red; }
</style>