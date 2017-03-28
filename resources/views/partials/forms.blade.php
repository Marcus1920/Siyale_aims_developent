<div class="modal fade modalFormsIn" id="modalFormsIn" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id='depTitle'>Forms</h4>
      </div>
      {{--<div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
          <a class="btn btn-sm" data-toggle="modal" onClick="launchAddContact();" data-target=".modalAddContact">Add Contact</a>
        </div>
      </div>--}}
      <div class="modal-body">
        <!-- Responsive Table -->
        <div class="block-area" id="responsiveTable">
          {{--@if(Session::has('successAddressBook'))
            <div class="alert alert-success alert-icon">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ Session::get('successAddressBook') }}
              <i class="icon">&#61845;</i>
            </div>
          @endif--}}
          <div class="table-responsive overflow">
            <table class="table tile table-striped" id="tblFormsIn">
              <thead>
              <tr>
                <th>Id</th>
                <th>Form</th>
                <th>Due Date</th>
                <th>Completed Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">

      </div>


    </div>
  </div>
</div>

<script type="text/javascript">
  function closeAssigned(id) {
    console.log("closeAssigned(id) id - ",id);
    $.ajax({
      type    :"GET",
      dataType:"json",
      url     :"closeAssigned/"+ id + "",
      success :function(data) {
        console.log("  data - ", data);
        $("#tblFormsIn").DataTable().draw();
      }
      , complete :function(data) {
        console.log("  data - ", data);
        $("#tblFormsIn").DataTable().draw();
      }
    });
  }

  function doAction(el, id, extra) {
		if (APP_DEBUG > 0) console.log("doAction(el, id, extra) id - ",id,", extra - ",extra);
    if (APP_DEBUG > 2) console.log("  el - ",el);
    if (typeof extra == "undefined") extra = {};
    var action = "";
    var idForm = -1;
    var assigned_id = -1;
    var what = "";
    if (el.type == "select-one") action = el.options[el.selectedIndex].value;
    if (extra['action2']) action = extra['action2'];
    if (extra['what']) what = extra['what'];
    if (extra['form_id']) idForm = extra['form_id'];
    if (extra['assigned_id']) assigned_id = extra['assigned_id'];
    if (APP_DEBUG > 2) console.log(", action - ",action,", what - ",what);
    if (what == "form") {
      if (action == "add") {
        $("#addNewForm").reset();
      } else if (action == "assign") {
        $(".modalAssignForm").modal();
        launchModalFormAssign(id);
      } else if (action == "delete") {
        $(".modalDeleteForm").modal();
        //$(".modalPreviewForm form").get(0).reset();
        launchModalDeleteForm(id);
      } else if (action == "edit") {
        $(".modalEditForm").modal({spinnerHtml: "Im spinning", showSpinner: true});
        $("#updateCustomForm").get(0).reset();
        launchUpdateFormModal(id, true);
      } else if (action == "preview") {
        ///$(".modalPreviewForm form").get(0).reset();
        $(".modalDataForm").modal();
		launchModalFormData(id, null, null, null, null, "previewform");
      } else if (action == "manage") {
        console.log(this);
        //return redirect("list-formsdata");
        $("#formId").val(id);
        $("#listForm").submit();
      }
    } else if (what == "data") {
      if (action == "close") {
        closeAssigned(assigned_id);
      } else if (action == "edit") {
        $(".modalDataForm").modal();
        //launchFormModal(id, true);
        launchModalFormData(id, idForm);
      } else if (action == "view") {
        $(".modalDataView").modal();
        launchModalDataView(id, idForm);
      } else if (action == "editform") {
        console.log(this);
        //return redirect("list-forms");
        var url = '{{url("list-forms")}}/';//+form_id;
        if (extra['form_id']) url += extra['form_id'];
        console.log("  url - "+url);
        window.location.href = url;
      }
    }
    el.selectedIndex = 0;
  }

  function getRelatedItems(field, el, val2) {
    if (APP_DEBUG > 0) console.log("getRelatedItems(field, el, val2) field - ",field,", val2 - ",val2,", el - ", el);
    var name = "";
    if (field['name']) name =field.name.replace(/_.*/,"");
    var opts = null;
    if (field['options']) opts = JSON.parse(field.options);
    else if (field['display']) opts = field;
    var table = opts.table;
    if (APP_DEBUG > 2) console.log("  name - ",name,", opts - ",opts);
    $.ajax({
			async: true,
      type    :"GET",
      dataType:"json",
      url     :"forms/database/data/"+ table + "",
      success :function(data) {
        if (APP_DEBUG > 1) console.log("  data - ", data);
        if (data) for (var i = 0; i < data.length; i++) {
          var sel = "";
          var text = "";
          var val = -1;
          if (data[i]['id']) val = data[i]['id'];
          //if (table.indexOf(name) != -1 && val == val2) sel = "selected";
          if (val == val2) sel = "selected"; // VD CHECK
          if (opts.display) for (var oi = 0; oi < opts.display.length; oi++) text += data[i][opts.display[oi]] + " ";
          text = text.replace(/([^\s]+)\s+$/, "$1");
          $(el).append('<option value="'+val+'" '+sel+'>'+text+'</option>');
          if (APP_DEBUG > 2) console.log("    "+i+", val - ",val,", text - ",text);
        }
      }
    });
  }

  function launchModalFormData(id, form_id, it, el, ajax, mode) {
    if (typeof ajax == "undefined" || ajax == null) ajax = 0;
    if (typeof mode == "undefined" || mode == null) mode = "dataform";
    //console.log("launchFormModal(id, edit) id - ",id,", edit - ",edit);
		if (APP_DEBUG > 0) console.log("launchModalFormData(id, form_id) id - ",id,", form_id - ",form_id,", it - ", it,", el - ",el,", ajax - ",ajax,", mode - ",mode);
    //if (it) it.func();
		if (APP_DEBUG > 2) console.log("  modal-body - ", $(el).parentsUntil(".modal"));
    $(el).parentsUntil(".modal").last().find("[name='id']").each(function(i) {
      console.log("  id.each(i) i - ",i,", this - ",this,", val - ",this.value);
    });
    var vall = $(el).parentsUntil(".modal").last().find("[name='id']").val();
    //editForm = edit;
    var symbols = { AUD: "$", BRL: "R$", CAD: "$", CNY: "�", EUR: "�", HKD: "$", INR: "?", JPY: "�", MXN: "$", NZD: "$", NOK: "kr", GBP: "&pound;", RUB: "?",SGD: "$", KRW: "?", SEK: "kr", CHF: "Fr", TRY: "?", USD: "$", ZAR: "R" }
    $(".modal-body #formId").val(form_id);
    $(".modal-body #formDataId").val(id);
    $(".modal-body #formAjax").val(ajax);
    if (ajax) {
      /*$("#submitDataForm").on("click",function(ev) {
       ev.preventDefault();
       submitData(ev);
       });*/
      $("#dataForm").on("submit",function(ev) {
        ev.preventDefault();
        submitData(ev);
      });
    }
    var theForm = null;
    var theBody = null;
    /*if (mode == "dataform") theForm = $("#modalDataForm");
    else if (mode == "previewform") theForm = $("#modalPreviewForm");*/
    theForm = $("#modalDataForm");
    theBody = theForm.find(".modal-body");
		if (APP_DEBUG > 2) console.log("  theForm - ",theForm,", .modal-body - ",theBody);
    var theURL = "/forms/";
    if (mode == "dataform") theURL += "data/";
    theURL += id;
    if (form_id) theURL += "/"+form_id;
    theURL = "{!! url('/')!!}"+theURL;
    $.ajax({
      type    :"GET",
      dataType:"json",
      url     :theURL,
      success :function(data) {
        if (APP_DEBUG > 1) console.log("data - ", data);
        if (theForm != null) {
          if (mode == "previewform") {
            $(theForm).find(".txtPreview").css("display", "inherit");
            $(theForm).find(".btnSubmit").on("click", function (ev) {
              console.log(".btnSubmit.click(ev) this - ", this);
              //ev.preventDefault();
              $("#dataForm").valid();
            });
          }
          if (data[0] !== null) {
            $(theForm).find(".modal-title").text(data[0].name);
            $(theForm).find(".modal-header i").remove();
            $(theForm).find(".modal-header").append("<i>"+data[0].purpose+"</i>");
          }
          //$(theForm).find(".modal-body .fields").empty();
          //$(theForm).find(".modal-body form div").empty();
          $(theForm).find(".modal-body div").first().empty();
        }
        var theRules = {};
        if (data[1] !== null) {
          var cnt = [];
          for (var i = 0; i < data[1].length; i++) {
          	var baseName = data[1][i].name.replace("[]", "");
          	if (typeof cnt[baseName] == "undefined") cnt[baseName] = 0;
            /*$(".modal-body").append('<div class="form-group"></div>');
             var group = $(".modal-body").find(".form-group").first();
             group.append("<label>RRR</label>");
             //lbl.text(data[1][i].label);
             //lbl.attr("class", "col-md-2 control-label");*/
            var opts = JSON.parse(data[1][i].options);
            if (APP_DEBUG > 1) console.log("  data[1]["+i+"] - ", data[1][i],", opts - ", opts);
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
            if (data[1][i].type != "choice" && data[1][i].type != "rel" && opts.type != "select" && opts['subtype'] != "select") input = document.createElement("input");
            else input = document.createElement("select");
            input.className = "form-control input-sm";
            var name = "data["+data[1][i].name+"]";
            //if (data[1][i].name.search(/\[\]/) != -1) name = "data["+data[1][i].name.replace("[]", "")+"]"+"["+cnt[data[1][i].name.replace("[]", "")]+"]";
            if (data[1][i].name.search(/\[\]/) != -1) name = "data["+data[1][i].name.replace("[]", "")+"]"+"["+cnt[baseName]+"]";
            input.name = name;
            if (data[1][i].name.search(/\[\]/) == -1) input.id = data[1][i].name;
            else input.id = data[1][i].name.replace("[]", i);
            ///input.required = true;
            input.style.display = "inline-block";
            input.style.width = "initial";
            ///input.type = "text";
            var val = "";
            if (data.length == 3 && data[2] !== null) {
              if (data[1][i].name.search(/\[\]/) == -1) val = data[2][data[1][i].name];
              else val = data[2][data[1][i].name.replace("[]", "")];
            }
            input.value = val;
            $(lbl).attr("for", input.id);
            $(input).attr("data-opts", data[1][i].options);

            if (data[1][i].type == "file") input.type = "file";

            if (data[1][i].type == "boolean") {
              if (opts.subtype == "") opts.subtype = "checkbox";
              if (opts.subtype == "checkbox") {
                var checked = "";
                if (val == 1) checked = "checked";
                $(div).append('<input id="'+data[1][i].name+'_" name="'+name+'" style="opacity: 1" type="text" value="0">');
                $(div).append('<input id="'+data[1][i].name+'" name="'+name+'" style="opacity: 1" type="checkbox" value="1" '+checked+'>');
              } else if (opts.subtype == "radio") {
                var wrapper = document.createElement("div");
                var labels = ["False", "True"];
                var checked = ["", ""];
                checked[val] = "checked";
                if (opts['false']) labels[0] = opts['false'];
                $(wrapper).append('<label style="">'+labels[0]+'<input name="'+name+'" style="opacity: 1" type="radio" value="0" '+checked[0]+'></label>');
                ///if (opts['false']) $(wrapper).append('<label style="">A <input id="fffA" name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="0"></label>');
                $(wrapper).append("&nbsp;&nbsp;&nbsp;");
                if (opts['true']) labels[1] = opts['true'];
                $(wrapper).append('<label>'+labels[1]+'<input name="'+name+'" style="opacity: 1" type="radio" value="1" '+checked[1]+'></label>');
                ///if (opts['true']) $(wrapper).append('<label style="">B <input id="fffB" name="'+data[1][i].name+'" style="opacity: 1" type="radio" value="1"></label>');
                $(div).append(wrapper);

              } else if (opts.subtype == "select") {
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
              $(div2).append(symbols[opts.iso]+" ");
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

              console.log("  opts['min'] (",opts['min'],") == false - ",(opts['min']== false));
              console.log("  !opts['min'] (",opts['min'],") - ",(!opts['min']));
              console.log("  !Boolean(opts['negative']) (",Boolean(opts['negative']),") - ",(!Boolean(opts['negative'])));
              if ((!opts['min'] || opts['min'] == "") && !Boolean(Number(opts['negative']))) opts['min'] = 0;
              if (opts['subtype'] == "spinner") {
              	var optsSpinner = { incremental: true };
              	if (typeof opts['increment'] != "undefined") optsSpinner['step'] = opts['increment'];
              	if (typeof opts['max'] != "undefined") optsSpinner['max'] = opts['max'];
              	if (typeof opts['min'] != "undefined") optsSpinner['min'] = opts['min'];
								//optsSpinner['numberFormat'] = "C";
								optsSpinner['page'] = new Number(optsSpinner['step'])*1;
								optsSpinner['page'] =6;
								console.log("  optsSpinner - ",optsSpinner);
              	$(input).spinner( optsSpinner );
              }

            } else if (data[1][i].type == "text" && opts.lines && opts.lines > 1) {
              $(div).append('<textarea class="form-control" id="'+data[1][i].name+'" name="'+name+'" rows="'+opts.lines+'">'+val+'</textarea>');
            } else if (data[1][i].type == "rel") {
              input.className = "form-control select-sm";
              input.id = data[1][i].name;
              //if (!vall && data[2][data[1][i].name]) vall = data[2][data[1][i].name];
              getRelatedItems(data[1][i], input, val[0]);
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
            $(theForm).find(".modal-body div").first().append(group);
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
            if (opts['increment']) title += ", in increments of "+opts['increment'];
            if (APP_DEBUG > 1) console.log("  Using name - ",name);
            $(input).attr("title", title);
            $(input).attr("data-original-title", title);
            if (title != "") $(input).tooltip({placement: "right", html: true, animation: true, template: '<div class="tooltip" role="tooltip" style="white-space: pre-wrap"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="background-color: rgba(128,128,128,0.75); "></div></div>',});
            cnt[baseName]++;
          }
          if (APP_DEBUG > 1) console.log("  cnt - ",cnt);
        }
        //updateFields(data[1]);

        /*$("#testCustomForm").validate({
         submitHandler: function(form) {
         console.log("submitHandler(form) form - ", form);
         }
         });*/

        var height = $(window).get(0).innerHeight - 200;
        //console.log("  height - ", height, ", #modalDataForm .modal-body height - ", $("#modalDataForm .modal-body").height());
        //if ($("#modalDataForm .modal-body").height() > height) $("#modalDataForm .modal-body").height( height );

        if (theForm != null) {
					if (APP_DEBUG > 2) console.log("  height - ", height, ", theForm .modal-body height - ", theForm.find(".modal-body").height());
          if (theForm.find(".modal-body").height() > height) theForm.find(".modal-body").height( height );
        }


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

  function launchModalDataView(id, form_id) {
		if (APP_DEBUG > 0) console.log("launchModalDataView(id, form_id) id - ",id,", form_id - ",form_id);
    $("#modalDataView .modal-body").empty();
    $.ajax({
      type    :"GET",
      dataType:"json",
      url     :"{!! url('/forms/data/"+ id + "/"+form_id+"')!!}",
      success :function(data) {
				if (APP_DEBUG > 1) console.log("data - ", data);
        if (data[0] !== null) {
          $("#modalDataView .modal-title").text(data[0].name);
          $("#modalDataView .modal-header i").remove();
          $("#modalDataView .modal-header").append("<i>"+data[0].purpose+"</i>");
        }

        if (data[1] !== null) {
          for (var i = 0; i < data[1].length; i++) {
            var opts = JSON.parse(data[1][i].options);
						if (APP_DEBUG > 2) console.log("    opts - ", opts);
            var wrapper = document.createElement('div');
            wrapper.style.clear = "both";
            wrapper.style.padding = "10px 0";
            var wLabel = document.createElement('div');
            wLabel.className = "col-md-3";
            var wVal = document.createElement('div');
            wVal.className = "col-md-9";
            wVal.style.whiteSpace = "pre";
            var label = data[1][i].label;
            $(wLabel).append('<b>'+label+'</b>');
            var val = "";
            var theName = data[1][i].name;
            if (data[2][theName]) val = data[2][theName];
            if (theName.search(/\[\]/) != -1) {
              theName = theName.replace("[]", "");
              val = data[2][theName];
              try {
                console.log("Trying to parse ",val,", for ",theName);
                val = JSON.parse(val);
                val = val[i];
              } catch (e) {
                val = "WtF";
              }
            }



            if (data[1][i].type == "boolean") {
              if (val == 0) val = opts[false];
              else if (val == 1) val = opts[true];
            }
						if (APP_DEBUG > 0) console.log("  val - ", val);
            if (Array.prototype.isPrototypeOf(val)) {
              if (data[1][i].type == "rel") {
                $(wVal).append(val[1]);
              } else {
                for (var vi = 0; vi < val.length; vi++) {
                  $(wVal).append(val[vi]);
                  if (vi < val.length - 1) $(wVal).append(', ');
                }
              }
            }
            else $(wVal).append(val);
            $(wVal).append('&nbsp;');
            $(wrapper).append(wLabel);
            $(wrapper).append(wVal);
            if (val) $("#modalDataView .modal-body").append(wrapper);
          }
        }
      }
    });
  }

  function launchModalFormAssign(form_id) {
    console.log("launchModalFormAssign(form_id) form_id - ",form_id);
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "{!! url('/users')!!}",
      success: function (data) {
        console.log("data - ", data);
        var users = data.data;
        console.log("users - ", users);
        $("#modalAssignForm .modal-body .form-group").first().iCheck("destroy");
        $("#modalAssignForm .modal-body .wrapper").empty();
        $("input[name='form_id']").val(form_id);
        for (var i = 0; i < users.length; i++) {
          var chkId = "chkUser"+i;
          var group = $("#modalAssignForm .modal-body .form-group").first().clone();
          $(group).css("display", "block");
          group.find(".control-label").text(users[i].name+" "+users[i].surname);
          group.find(".control-label").attr("for", chkId);
          group.find("input[type='checkbox']").get(0).id = chkId;
          group.find("input[type='checkbox']").iCheck("destroy");
          /*group.find("input[type='checkbox']").iCheck("destroy");
           group.find("input[type='checkbox']").iCheck({
           checkboxClass: 'icheckbox_minimal',
           radioClass: 'iradio_minimal'
           });*/
          group.find("input[type='checkbox']").val(users[i].id);
          $("#modalAssignForm .modal-body .wrapper").append(group);
        }
        $('.datetime').datetimepicker({ collapse: false, sideBySide: true });
        $('.date-only').datetimepicker({ pickTime: false });
        $('.time-only').datetimepicker({ pickDate: false });
      }
    });
  }

  function launchModalFormsIn() {
    var uid = {{\Auth::user()->id}};
    console.log("launchModalFormsIn() uid - ",uid);
    if (typeof oFormsInTable != "undefined") console.log("  oFormsInTable - ",oFormsInTable);

    /*$.ajax({
     type    :"GET",
     dataType:"json",
     url     :"{!! url('/forms/assigned/"+ uid +"')!!}",
     success: function(data) {
     console.log("success! data - ",data);


     }
     });*/

    if ( $.fn.dataTable.isDataTable( '#tblFormsIn' ) ) {
      oFormsInTable.destroy();
    }

    oFormsInTable = $('#tblFormsIn').DataTable({
      "processing": true,
      "serverSide": true,
      "dom": 'frtip',
      "order" :[[0,"desc"]],
      ajax: {
        url     :"{!! url('/forms/assigned/"+ uid +"')!!}"
        , complete: function() {
          console.log("complete!  - ");
        }
        , data: function(d) {

        }
        //, dataSrc: ""
      },
      "columns": [
        {data: "id", name: "id"},
        {data: "name", name: "forms.name"},
        {data: "due_at", name: "forms_assigned.due_at"},
        {data: "completed_at", name: "forms_assigned.completed_at"},
        {data: "status", name: "forms_assigned.status"},
        {data: "actions",  name: "actions"}
      ],

      "aoColumnDefs": [
        //{ "bSearchable": false, "aTargets": [3, 4, 5] },
        //{ "bSortable": false, "aTargets": [6] }
      ]

    });
  }

  function submitData(ev) {
    console.log("submitData(ev) ev - ", ev);
    /*//var action = $('#dataFom')
     var token    = $('#dataForm input[name="_token"]').val();
     var formId = $("#formId").val();
     var formDataId = $("#formDataId").val();
     var formData = {};
     //formData['_token'] = token;
     formData['formId'] = formId;
     formData['id'] = formDataId;
     $("#dataForm").find("[name^='data']").each(function(i, el) {
     console.log("  data.each("+i+") el - ",el);
     formData[el.name] = $(el).val();
     });*/
    var token    = $('#dataForm input[name="_token"]').val();
    var formData = $('#dataForm').serialize();
    console.log("  formData - ", formData);

    $.ajax({
      type    :"POST",
      data    : formData,
      headers : { 'X-CSRF-Token': token },
      url     :"{!! url('updateFormData')!!}",
      success : function(data, status) {
        console.log("AJAX Success: status - ",status,", data - ", data);
        if (data == "true") {
          $("#modalDataForm").modal("hide");
        } else {
          //redirect()->back()->withInput();
        }
      }
      , complete: function(jqXHR, status) {
        console.log("AJAX Complete: status - ",status);
      }
      , error: function(jqXHR, status, error) {
        console.log("AJAX Error!! status - ",status," error - ",error);
      }
    });

  }

  function updateFields(fields) {
    var form = $("#modalDataForm").first();
		if (APP_DEBUG > 0) console.log("updateFields(fields, form) fields - ",fields,", form - ", form);
    $(form).find("[name^='data']").each(function(i, el) {
			if (APP_DEBUG > 2) console.log("  data["+i+"] el: type - ",el.type,", ", el);
    });
  }

  $(document).ready(function() {
    $("#submitDataForm").on("click",function(ev) {
      console.log("#submitDataForm.onClick");
      //ev.preventDefault();
      //submitData(ev);
    });
  });
</script>