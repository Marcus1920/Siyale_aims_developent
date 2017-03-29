<?php
  $title = "Custom Form Preview";
  
?>
<!-- Modal Default -->
<div class="modal fade modalDataForm" id="modalDataForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="txtPreview" style="color: #20FF26; display: none; float: right; font-size: 1.5em; margin: 0; padding: 0 1.5em;">PREVIEW</h3>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'updateFormData', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"dataForm", 'style'=>"height: 100%" ]) !!}
            {!! Form::hidden('formId',NULL,['class' => 'form-control input-sm','id' => 'formId']) !!}
            {!! Form::hidden('id',NULL, ['class' => 'form-control input-sm', 'id'=>"formDataId"]) !!}
            {!! Form::hidden('ajax',NULL, ['class' => 'form-control input-sm', 'id'=>"formAjax"]) !!}
            	<div class="fields" style="height: 100%; overflow-x: hidden; overflow-y: auto;"></div>
            	<div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <!--<button type="submit" id='submitDataForm' type="button" class="btn btn-sm">Save Changes</button>-->
                    <button id='submitDataForm' class="btn btn-sm btnSubmit">Save Changes</button>
                    <!--<input type="submit" id='submitDataForm' value="Save Changes" class="btn btn-sm">-->
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
		//opts.find("input").removeClass("error");
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

$(document).ready(function() {
	/*$("#submitDataForm").on("click", function (ev) {
		console.log("#submitDataForm.click(ev) this - ", this);
		ev.preventDefault();
		//$("#dataForm").valid();
		//if (checkForm()) 
		$("#dataForm").submit();
		///$("#dataForm").validate({
		///		submitHandler: function(form) {
		///			console.log("submitHandler(form) form - ", form);
		///		}
		///	});
			//$("#testCustomForm").submit();
	});*/
	
	//$("#testCustomForm").validate({
		/*submitHandler: function(form) {
			console.log("submitHandler(form) form - ", form);
		}*/
	//});
});
</script>