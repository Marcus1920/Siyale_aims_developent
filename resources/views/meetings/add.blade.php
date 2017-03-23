<!-- Modal Default -->
<div class="modal fade modalAddMeeting" id="modalAddMeeting" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create New Meeting</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addMeeting', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addMeetingForm" ]) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}
            <div class="form-group">
                {!! Form::label('Venue', 'Venue', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::select('venue',$selectVenues,0,['class' => 'form-control' ,'id' => 'venue']) !!}
                    <div id='error_venue_meeting'></div>
               </div>
               <div class="col-md-2">
                    <a class="btn btn-sm" data-toggle="modal" onclick="launchVenueModal()" data-target=".modalAddVenue">
                        <i class="sa-plus"></i>
                    </a>
               </div>
            </div>

            <div class="form-group">
                {!! Form::label('Date', 'Date', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    <div class="input-icon datetime-pick date-only">
                      <input data-format="yyyy-MM-dd" type="text" id='date' name ='date' class="form-control input-sm" />
                      <span class="add-on">
                          <i class="sa-plus"></i>
                      </span>
                    </div>
                    <div id='error_meeting_date'></div>
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('Start Time', 'Start Time', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    <div class="input-icon datetime-pick time-only">
                        <input data-format="hh:mm:ss" type="text" id='start_time' name='start_time' class="form-control input-sm" />
                        <span class="add-on">
                            <i class="sa-plus"></i>
                        </span>
                    </div>
                    <div id='error_meeting_start_time'></div>
                </div>
            </div>

           <div class="form-group">
                {!! Form::label('End Time', 'End Time', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                        <div class="input-icon datetime-pick time-only">
                        <input data-format="hh:mm:ss" type="text" id='end_time' name='end_time' class="form-control input-sm" />
                        <span class="add-on">
                            <i class="sa-plus"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Title', 'Title', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('title',NULL,['class' => 'form-control input-sm','id' => 'title']) !!}
                  @if ($errors->has('title')) <p class="help-block red">*{{ $errors->first('title') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Description', 'Description', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                    <textarea rows="5" id="description" name="description" class="form-control" maxlength="500"></textarea>
                </div>
                <div id = "meeting_description"></div>
            </div>

            <div class="form-group">
                {!! Form::label('Facilitators', 'Facilitators', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('facilitators',NULL,['class' => 'form-control input-sm','id' => 'facilitators']) !!}

                </div>
            </div>


            <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitAddMeetingForm' class="btn btn-sm">Create Meeting</a>
                    </div>
            </div>

            </div>
            <div class="modal-footer">


            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
