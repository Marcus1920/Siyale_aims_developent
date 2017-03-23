<!-- Modal Default -->
<div class="modal fade modalAddCaseFilesModal" id="modalAddCaseFilesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeCaseFile" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Attach Case File</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['url' => 'addCaseFile', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addCaseFileForm",'files' => 'true' ]) !!}
                {!! Form::hidden('uid',Auth::user()->id,['id' => 'uid']) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}

                <div class="form-group">
                    {!! Form::label('Attach File', 'Attach File', array('class' => 'col-md-2 control-label')) !!}
                    <div class="fileupload fileupload-new row" data-provides="fileupload">
                        <div class="input-group col-md-6">
                            <div class="uneditable-input form-control">
                                <i class="fa fa-file m-r-5 fileupload-exists"></i>
                                <span class="fileupload-preview"></span>
                            </div>
                            <div class="input-group-btn">
                                <span class="btn btn-file btn-alt btn-sm">
                                <span class="fileupload-new">Select file</span>
                                <span class="fileupload-exists">Change</span>
                                <input type="file" name="caseFile" id="caseFile"/>
                            </span>
                            </div>

                            <a href="#" class="btn btn-sm btn-gr-gray fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    {!! Form::label('Your Note', 'Your Note', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-10">
                        <textarea rows="5" id="fileNote" name="fileNote" class="sms form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitAddCaseFileForm' class="btn btn-sm">Attach File</a>
                    </div>
                </div>

            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
