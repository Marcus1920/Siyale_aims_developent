<!-- Modal Default -->
<div class="modal modalReferCase" id="modalReferCase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  id="closeReferCase" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='modalTitle'></h4>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>
               <div class="col-md-6">
                 <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchAddressBookModal();" data-target=".modalAddressBook">Address Book</a>

              </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'escalateCase', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"escalateCaseForm" ]) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
                {!! Form::hidden('modalType',NULL,['id' => 'modalType']) !!}


                <div class="form-group">
                    {!! Form::label('Search Box', 'Search Box', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('addresses',NULL,['class' => 'form-control input-sm','id' => 'addresses']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Message', 'Message', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-8">
                        <textarea rows="5" id="message" name="message" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                       <a type="#" id='submitEscalateCaseForm' class="btn btn-sm"></a>
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
