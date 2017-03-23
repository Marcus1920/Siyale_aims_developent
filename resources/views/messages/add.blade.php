
<!-- Modal Default -->
<div class="modal fade compose-message" id="compose-message" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeCaseMessage" aria-hidden="true">&times;</button>
                <h4 class="modal-title">NEW MESSAGE</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => 'addCaseMessage', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addCaseMessage"]) !!}
                {!! Form::hidden('uid',Auth::user()->id,['id' => 'uid']) !!}
                {!! Form::hidden('to',NULL,['id' => 'to']) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}

                <div class="form-group">
                    {!! Form::label('To', 'To', array('class' => 'col-md-2 control-label')) !!}

                    <div class="col-md-10">
                        {!! Form::text('msgTo',NULL,['class' => 'form-control input-sm','id' => 'msgTo']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Subject', 'Subject', array('class' => 'col-md-2 control-label')) !!}

                    <div class="col-md-10">
                        {!! Form::text('msgSubject',NULL,['class' => 'form-control input-sm','id' => 'msgSubject']) !!}
                    </div>
                </div>
                 <div class="form-group">
                    {!! Form::label('Message', 'Message', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-10">
                        <textarea rows="5" id="msg" name="msg" class="sms form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitAddCaseMessageForm' class="btn btn-sm">Send Message</a>
                    </div>
                </div>

            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
