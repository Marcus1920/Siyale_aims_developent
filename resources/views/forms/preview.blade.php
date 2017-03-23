<?php
  
?>
<!-- Modal Default -->
<div class="modal fade modalPreviewForm" id="modalPreviewForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Custom Form Preview</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'testForm', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"testCustomForm", 'style'=>"height: 100%", 'novalidate_'=>"" ]) !!}
            <div style="height: 100%; overflow-x: hidden; overflow-y: auto;"></div>
            </div>
            <div class="modal-footer">
							<div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    {{--<button type="submit" id='submitTestCustomForm' type="button" class="btn btn-sm">Test</button>--}}
                </div>
            	</div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script type="text/javascript">
function launchPreviewFormModal(id) {
	var symbols = { AUD: "$", BRL: "R$", CAD: "$", CNY: "�", EUR: "�", HKD: "$", INR: "?", JPY: "�", MXN: "$", NZD: "$", NOK: "kr", GBP: "&pound;", RUB: "?",SGD: "$", KRW: "?", SEK: "kr", CHF: "Fr", TRY: "?", USD: "$", ZAR: "R" }
	
	$.ajax({
		type    :"GET",
		dataType:"json",
		url     :"{!! url('/forms/"+ id + "')!!}",
		success :function(data) {
			console.log("data - ", data);
			if (data[0] !== null) {
				$("#modalPreviewForm .modal-title").text(data[0].name);
				$("#modalPreviewForm .modal-header i").remove();
				$("#modalPreviewForm .modal-header").append("<i>"+data[0].purpose+"</i>");
			}
			$("#modalPreviewForm .modal-body form div").empty();
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
					$(lbl).attr("for", data[1][i].name);
					//$(lbl).css("white-space", "nowrap");
					$(group).append(lbl);
					
					var div = document.createElement("div");
					div.className = "col-md-6";
					
					var input = null;
                    if (data[1][i].type == "text" && opts.lines && opts.lines > 1) {
                        input = document.createElement("textarea");
                        $(input).attr("rows", opts.lines);
                    }
					else if (data[1][i].type != "choice" && data[1][i].type != "rel" && opts.type != "select") input = document.createElement("input");
					else input = document.createElement("select");
					input.className = "form-control input-sm";
					input.name = data[1][i].name;
					input.id = data[1][i].name;
					///input.required = true;
					input.style.display = "inline-block";
					input.style.width = "initial";
					input.type = "text";
					
					$(input).attr("data-opts", data[1][i].options);
					
					if (data[1][i].type == "file") input.type = "file";
					
					if (data[1][i].type == "boolean") {
						if (opts.type == "") opts.type = "checkbox";
						if (opts.type == "checkbox") {
							$(div).append('<input id="'+data[1][i].name+'" name="'+data[1][i].name+'" style="opacity: 1" type="checkbox" value="1">');
						} else if (opts.type == "radio") {
							var wrapper = document.createElement("div");
							if (opts['false']) $(wrapper).append('<label style="">'+opts['false']+'<input name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="0"></label>');
							///if (opts['false']) $(wrapper).append('<label style="">A <input id="fffA" name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="0"></label>');
							$(wrapper).append("&nbsp;&nbsp;&nbsp;");
							if (opts['true']) $(wrapper).append('<label>'+opts['true']+'<input name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="1"></label>');
							///if (opts['true']) $(wrapper).append('<label style="">B <input id="fffB" name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="1"></label>');
							$(div).append(wrapper);
							
						} else if (opts.type == "select") {
							input.className = "form-control select-sm";
							input.id = data[1][i].name;
							input.style.width = "5em";
							if (opts['false']) $(input).append('<option value="0">'+opts['false']+'</option>');
							if (opts['true']) $(input).append('<option value="1">'+opts['true']+'</option>');
							
							$(div).append(input);
						}
					} else if (data[1][i].type == "choice") {
						input.className = "form-control select-sm";
						input.id = data[1][i].name;
						if (opts.multi == 1) {
							input.multiple = true;
						}
						if (opts.options && opts.options.length > 0) {
							//if (opts.multi) sel.size = opts.options.length;
							for (var oi = 0; oi < opts.options.length; oi++) {
								$(input).append('<option value="'+opts.options[oi]+'">'+opts.options[oi]+'</option>');
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
					} /*else if (data[1][i].type == "text" && opts.lines && opts.lines > 1) {
						//$(div).append('<textarea class="form-control" id="'+data[1][i].name+'" rows="'+opts.lines+'"></textarea>');
					} */else if (data[1][i].type == "rel") {
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
					$("#modalPreviewForm .modal-body div").first().append(group);
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
			
			/*$("#testCustomForm").validate({
				submitHandler: function(form) {
					console.log("submitHandler(form) form - ", form);
				}
			});*/
			
			var height = $(window).get(0).innerHeight - 200;
			console.log("  height - ", height, ", #modalPreviewForm .modal-body height - ", $("#modalPreviewForm .modal-body").height());
			if ($("#modalPreviewForm .modal-body").height() > height) $("#modalPreviewForm .modal-body").height( height );
			
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
			
			$('input').rules("add", {
				required: true, currency: true
			});
			
			
		}
	});
}

$(document).ready(function() {
	$("#submitTestCustomForm").on("click", function (ev) { 
		console.log("#submitTestCustomForm.click(ev) this - ", this);
		//ev.preventDefault();
		$("#testCustomForm").valid();
		//if (checkForm()) $("#updateCustomForm").submit();
		/*$("#testCustomForm").validate({
				submitHandler: function(form) {
					console.log("submitHandler(form) form - ", form);
				}
			});*/
			//$("#testCustomForm").submit();
	});
	
	//$("#testCustomForm").validate({
		/*submitHandler: function(form) {
			console.log("submitHandler(form) form - ", form);
		}*/
	//});
});

$().ready(function() {
	var valid = true;
	var opts = {};
	
	/*$.validator.addMethod("currency", function(value, element) {
		var elName = element.id;
		var err = {};
		var opts = JSON.parse($(element).attr("data-opts"));
		valid = true;
		//return 
		valid = this.optional(element) || /^[\-\+]{0,1}[\d\.]+$/.test(value);
		if (opts.max && value > Number(opts.max) && opts.min && value < Number(opts.min)) {
			err[elName] = opts.min+"> & <"+opts.max;
			//valid = false;
		} else if (opts.min && value < Number(opts.min)) {
			err[elName] = "> "+opts.min;
			//valid = false;
		} else if (opts.max && value > Number(opts.max)) {
			err[elName] = "< "+opts.max;
			//valid = false;
		}
		this.showErrors(err);
		this.defaultShowErrors();
		console.log("currency: valid - ",valid,", opts - ",opts,", elName - "+elName+", value - "+element.value+", element - ",element);
		return valid;
	}, "Monetary values only");*/
	
	/*$.validator.addMethod("number", function(value, element) {
		var elName = element.id;
		var err = {};
		var opts = JSON.parse($(element).attr("data-opts"));
		var valid = this.optional(element) || /^[0-9\ \-\+\.]+$/i.test(value);
		if ((opts.decimals) == 0) valid = this.optional(element) || /^[0-9\ \-\+]+$/i.test(value);
		if (!opts.negative && value.indexOf("-") != -1) {
			//valid = false;
			err[elName] = " > 0";
		}
		if (opts.max && value > Number(opts.max) && opts.min && value < Number(opts.min)) {
			err[elName] = opts.min+"> & <"+opts.max;
			//valid = false;
		} else if (opts.min && value < Number(opts.min)) {
			err[elName] = "> "+opts.min;
			//valid = false;
		} else if (opts.max && value > Number(opts.max)) {
			err[elName] = "< "+opts.max;
			//valid = false;
		}
		this.showErrors(err);
		this.defaultShowErrors();
		console.log("number: valid - ",valid,", opts - ",opts,", elName - "+elName+", value - "+element.value+", element - ", element);
		return valid;
	}, "Integer numbers only");*/
	
	$.validator.addMethod("EMAIL", function(value, element) {
		return this.optional(element) || /^[a-zA-z0-9._-]+@[a-zA-z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
	}, "Email Address is Invalid! Please enter a valid email address");
	$.validator.addMethod("PASSWORD", function(value, element) {
		return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/.test(value);
	}, "Passwords are 8-16 long with uppercase, lowercase and at least one number");
	$.validator.addMethod("SUBMIT", function(value, element) {
		return this.optional(element) || /^[^ ]$/.test(value);
	}, "You did not click the submit button");
});
</script>