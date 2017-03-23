<!-- Modal Default -->
<div class="modal modalCreateCase" id="modalCreateCase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create Case</h4>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>

            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'createCase', 'method' => 'POST', 'class' => 'form-horizontal', 'id'=>"CreateCaseForm" ]) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}


                <div class="form-group">
                    {!! Form::label('Description', 'Description', array('class' => 'col-md-3 control-label','disabled' => 'disabled')) !!}
                    <div class="col-md-6">
                      {!! Form::textarea('description', null, ['class' => 'form-control input-sm','id' => 'description','size' => '30x5']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-8">
                       <a type="#" id='submitCreateCaseForm' class="btn btn-sm">Create Case</a>
                    </div>
                </div>

               <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">

                    </div>
                </div>

                {!! Form::close() !!}

            </div>



        </div>
    </div>
</div>
