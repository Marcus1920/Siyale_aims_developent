<?php
  
?>
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
            {!! Form::hidden('id',Auth::user()->id) !!}
            <div style="border: 0px solid red; float: left; width: 50%">
            	<div class="form-group">
                {!! Form::label('name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('name',(Request::old("name")?Request::old("name"):null),['class' => 'form-control input-sm','id' => 'name']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
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
	          <hr/>
            <div style="clear: both; white-space: nowrap">
            	<h3 class="block-title">Fields</h3>
	            
            </div>
            <!--<span id="cntFields">0</span>-->
            <div class="form-group" id="formFields" style="overflow-y: auto">
            @if (!is_null(Input::old("field")))
            	@foreach (Input::old("field") as $i=>$field)
            		@include('forms.field')
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