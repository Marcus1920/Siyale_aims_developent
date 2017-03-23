<!-- Modal Default -->
<div class="modal fade modalAddContact" id="modalAddContact" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeAddContact" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Contact</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['url' => 'addContact', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addContactForm" ]) !!}
                {!! Form::hidden('uid',Auth::user()->id,['id' => 'uid']) !!}
                <div class="form-group">
                    {!! Form::label('First Name', 'First Name', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-10">
                      {!! Form::text('FirstName',NULL,['class' => 'form-control input-sm','id' => 'FirstName']) !!}
                      <div id='error_firstname'></div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Surname', 'Surname', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-10">
                      {!! Form::text('Surname',NULL,['class' => 'form-control input-sm','id' => 'Surname']) !!}
                      <div id='error_surname'></div>
                    </div>
                </div>
               <div class="form-group">
                  {!! Form::label('Email Address', 'Email Address', array('class' => 'col-md-2 control-label')) !!}
                  <div class="col-md-10">
                    {!! Form::text('email',NULL,['class' => 'form-control input-sm','id' => 'email']) !!}
                    <div id='error_email'></div>
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('Cellphone', 'Cellphone', array('class' => 'col-md-2 control-label')) !!}
                  <div class="col-md-10">
                    {!! Form::text('cellphone',NULL,['class' => 'form-control input-sm','id' => 'cellphone']) !!}
                    <div id='error_cellphone'></div>
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('Relationship', 'Relationship', array('class' => 'col-md-2 control-label')) !!}
                  <div class="col-md-10">
                    {!! Form::select('relationship',$selectRelationships,0,['class' => 'form-control input-sm' ,'id' => 'relationship']) !!}
                    @if ($errors->has('relationship')) <p class="help-block red">*{{ $errors->first('relationship') }}</p> @endif
                </div>
              </div>
              <div class="form-group">
                  <div class="col-md-offset-2 col-md-10">
                      <a type="#" id='submitAddContact' class="btn btn-sm">Add Contact</a>
                  </div>
              </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
