<!-- Modal Default -->
<div class="modal fade modalCaseCloseRequestModal" id="modalCaseCloseRequestModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeCaseClosure" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Case Closure Request Note</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'requestCaseClosure', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"caseClosureForm" ]) !!}
                {!! Form::hidden('uid',Auth::user()->id,['id' => 'uid']) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
                <div class="form-group">
                    {!! Form::label('Your Note', 'Your Note', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-10">
                        <textarea rows="5" id="caseNote" name="caseNote" class="sms form-control" maxlength="500"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitCaseClosureForm' class="btn btn-sm">Request Case Closure</a>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
