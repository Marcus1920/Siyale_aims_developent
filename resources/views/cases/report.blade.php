<!-- Modal Default -->
<div class="modal modalCaseReport" id="modalCaseReport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close"  id="closeCaseReportModal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id='depTitle'>Edit Case details</h4>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>
               <div class="col-md-6">


              </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'captureCaseUpdate', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"caseReportCaseForm" ]) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
                {!! Form::hidden('hseHolderId',NULL,['id' => 'hseHolderId']) !!}



                <div class="form-group">
                    {!! Form::label('Search Field', 'Search Field', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('hsecellphone',NULL,['class' => 'form-control input-sm','id' => 'hsecellphone']) !!}

                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('Title', 'Title', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                  {!! Form::select('title',$selectTitles,0,['class' => 'form-control' ,'id' => 'title','disabled']) !!}
                  <div id = "error_title"></div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('Gender', 'Gender', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                  {!! Form::select('gender',['0' => 'Select/All','1' => 'Male','2' => 'Female'],0,['class' => 'form-control' ,'id' => 'gender']) !!}
                  <div id = "error_gender"></div>
                </div>
              </div>

               <div class="form-group">
                  {!! Form::label('Date of Birth', 'Date of Birth', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                  <div class="input-icon datetime-pick date-only">
                    <input data-format="yyyy-MM-dd" type="text" id='dob' name ='dob' class="form-control input-sm" />
                    <span class="add-on">
                        <i class="sa-plus"></i>
                    </span>
                </div>
                </div>
              </div>


                <div class="form-group">
                    {!! Form::label('Hse Cell Number', 'Hse Cell Number', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('cellphone',NULL,['class' => 'form-control input-sm','id' => 'cellphone','disabled']) !!}
                      <div id = "error_cellphone"></div>

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Hse Holder Name', 'Hse Holder Name', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name','disabled']) !!}
                      <div id = "error_name"></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Hse Holder Surname', 'Hse Holder Surname', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('surname',NULL,['class' => 'form-control input-sm','id' => 'surname','disabled']) !!}
                     <div id = "error_surname"></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Hse Holder ID Number', 'Hse Holder ID Number', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('id_number',NULL,['class' => 'form-control input-sm','id' => 'id_number']) !!}
                      <div id = "error_id_number"></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Preferred Language', 'Preferred Language', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('language',$selectLanguages,0,['class' => 'form-control' ,'id' => 'language','disabled']) !!}
                    <div id = "error_language"></div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('Position', 'Position', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::select('position',$selectPositions,0,['class' => 'form-control input-sm' ,'id' => 'position','disabled']) !!}
                    <div id = "error_position"></div>
                  </div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

                <div class="form-group">
                    {!! Form::label('Hse Number', 'Hse Number', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('house_number',NULL,['class' => 'form-control input-sm','id' => 'house_number','disabled']) !!}
                      @if ($errors->has('house_number')) <p class="help-block red">*{{ $errors->first('house_number') }}</p> @endif
                    </div>
                </div>


                 <div class="form-group">
                  {!! Form::label('Province', 'Province', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::select('province',$selectProvinces,0,['class' => 'form-control' ,'id' => 'province','disabled']) !!}
                    <div id = "error_province"></div>
                  </div>
                </div>



                <div class="form-group">
                  {!! Form::label('District', 'District', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::select('district',$selectDistricts,0,['class' => 'form-control input-sm' ,'id' => 'district','disabled']) !!}
                   <div id = "error_district"></div>
                  </div>
               </div>

                <div class="form-group">
                    {!! Form::label('Municipality', 'Municipality', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::select('municipality',$selectMunicipalities,0,['class' => 'form-control input-sm' ,'name' => 'municipality','id' => 'municipality','disabled']) !!}
                    <div id = "error_municipality"></div>
                  </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Ward', 'Ward', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::select('ward',$selectWards,0,['class' => 'form-control input-sm' ,'name' => 'ward','id' => 'ward','disabled']) !!}
                    <div id = "error_ward"></div>
                  </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Area', 'Area', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('area',NULL,['class' => 'form-control input-sm','id' => 'area','disabled']) !!}
                      @if ($errors->has('area')) <p class="help-block red">*{{ $errors->first('area') }}</p> @endif
                  </div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


                <div class="form-group">
                    {!! Form::label('Case Priority', 'Case Priority', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('priority',$selectPriorities,0,['class' => 'form-control input-sm' ,'name' => 'priority','id' => 'priority']) !!}
                    <div id = "error_priority"></div>
                  </div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


                <div class="form-group">
                    {!! Form::label('Problem Description', 'Problem Description', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        <textarea rows="5" id="description" name="description" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                       <a type="#" id='submitCaseReportCaseForm' class="btn btn-sm">Save Changes</a>
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
