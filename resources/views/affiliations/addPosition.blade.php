<!-- Modal Default -->
<div class="modal modalAddAffiliationPosition" id="modalAddAffiliationPosition" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Add Affiliation Position</h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['url' => 'addAffiliationPosition', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"AddAffiliationPositionForm" ]) !!}
                {!! Form::hidden('affiliationID',$affiliationObj->id,['id' => 'affiliationID']) !!}

                <div class="form-group">
                    {!! Form::label('Search Position', 'Search Position', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('affiliationPositions',NULL,['class' => 'form-control input-sm','id' => 'affiliationPositions']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" type="button" class="btn btn-sm">Add Position</button>

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
