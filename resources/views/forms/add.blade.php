<!-- Modal Default -->
<div class="modal fade modalAddForm" id="modalAddForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Form</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addForm', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addNewForm" ]) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}
            <div class="form-group">
                {!! Form::label('txtName', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'txtName']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('txtPurpose', 'Purpose', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('purpose',NULL,['class' => 'form-control input-sm','id' => 'txtPurpose']) !!}
                  @if ($errors->has('purpose')) <p class="help-block red">*{{ $errors->first('purpose') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('txtTable', 'Table', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                    {!! Form::select('table',$dbTables, null,['class' => 'form-control input-sm','id' => 'txtTable', 'style'=>"width: auto"]) !!}
                    @if ($errors->has('table')) <p class="help-block red">*{{ $errors->first('table') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('txtSlug', 'Acronym', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('slug',NULL,['class' => 'form-control input-sm','id' => 'txtSlug']) !!}
                  @if ($errors->has('slug')) <p class="help-block red">*{{ $errors->first('slug') }}</p> @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitAddForm' type="button" class="btn btn-sm">Add Form</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">

            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>