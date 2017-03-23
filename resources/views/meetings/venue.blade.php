<!-- Modal Default -->
<div class="modal fade modalAddVenue" id="modalAddVenue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  id="closeVenueModal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Venue</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addVenue', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addVenueForm" ]) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}

            <div class="form-group">
                {!! Form::label('Name', 'Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name']) !!}
                  <div id='error_venue_id'></div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Address', 'Address', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('address',NULL,['class' => 'form-control input-sm','id' => 'address']) !!}
                  @if ($errors->has('address')) <p class="help-block red">*{{ $errors->first('address') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitAddVenueForm' class="btn btn-sm">Add Venue</a>
                    </div>
            </div>

            </div>
            <div class="modal-footer">


            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
