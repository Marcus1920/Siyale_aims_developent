<!-- Modal Default -->
<div class="modal fade modalAddWorkflow" id="modalAddWorkflow" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  id="closeAddWorkFlow" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Add workflow</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addWorkFlow', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"workFlowAddForm" ]) !!}
            {!! Form::hidden('subCatID',NULL,['id' => 'subCatID']) !!}

            <div class="form-group">
                {!! Form::label('Name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                   <a type="#" id='submitAddWorkFlow' class="btn btn-sm">Add workflow</a>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
