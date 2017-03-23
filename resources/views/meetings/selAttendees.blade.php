<!-- Modal Default -->
<div class="modal fade modalSelectAttendees" id="modalSelectAttendees" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeSelAttendees" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select/Add Attendees</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addMeetingAttendee', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addMeetingAttendeeForm" ]) !!}
            {!! Form::hidden('meetingID',NULL,['id' => 'meetingID']) !!}

            <div id='captureAttendeeSearch'>
                <div class="form-group">
                    {!! Form::label('Attendee', 'Attendee', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('attendees',NULL,['class' => 'form-control input-sm','id' => 'attendees']) !!}

                    </div>
                </div>
            </div>
            <div id='captureAttendee'>
                <div class="form-group">
                    {!! Form::label('First Name', 'First Name', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('first_name',NULL,['class' => 'form-control input-sm','id' => 'first_name','disabled' => 'disabled']) !!}
                       <div id='error_first_name'></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Surname', 'Surname', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('surname',NULL,['class' => 'form-control input-sm','id' => 'surname','disabled' => 'disabled']) !!}
                      <div id='error_surname'></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Cellphone', 'Cellphone', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('cellphone',NULL,['class' => 'form-control input-sm','id' => 'cellphone','disabled' => 'disabled']) !!}
                     <div id='error_cellphone'></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Email', 'Email', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('email',NULL,['class' => 'form-control input-sm','id' => 'email','disabled' => 'disabled']) !!}
                      <div id='error_email'></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitAddMeetingAttendeeForm' class="btn btn-sm">Add</a>
                    </div>
            </div>

            </div>
            <div class="modal-footer">


            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
