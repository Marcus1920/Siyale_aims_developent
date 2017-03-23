<!-- Modal Default -->
<div class="modal fade modalAssignForm" id="modalAssignForm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Assign Form</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'assignForm', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"testCustomForm", 'style'=>"height: 100%", 'novalidate_'=>"" ]) !!}
        form_id {!! Form::text("form_id", null, array('class'=>"form-control", 'style'=>"width: 10em")) !!}

        <div>
          {!! Form::label('selDueDate', 'Due Date', array('class' => 'col-md-2 control-label')) !!}
          {!! Form::text("due_date", null, array('class'=>"date-only form-control", 'data-format'=>"yyyy-MM-dd",'id'=>"selDueDate", 'style'=>"width: 10em")) !!}
        </div>
        <div class="form-group">
          {!! Form::label('chkUser', 'Name', array('class' => 'col-md-2 control-label')) !!}
          <div class="col-md-10">
            {!! Form::checkbox('users[]',-1, false,['id'=>'chkUser']) !!}
          </div>
        </div>
        <div style="height: 100%; overflow-x: hidden; overflow-y: auto;" class="wrapper">

        </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
            <button type="submit" id='submitAssignForm' type="button" class="btn btn-sm">Assign</button>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>