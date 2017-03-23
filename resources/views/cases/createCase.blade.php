<!-- Modal Default -->
<div class="modal modalCreateCaseAgent" id="modalCreateCaseAgent" tabindex="-1" role="dialog" aria-hidden="true">
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
                {!! Form::open(['url' => 'createCaseAgent', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"CreateCaseAgentForm" ]) !!}
                {!! Form::hidden('hseHolderId',NULL,['id' => 'hseHolderId']) !!}



               <div class="form-group">
                    {!! Form::label('Search Client', 'Search Client', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('hsecellphone',NULL,['class' => 'form-control input-sm','id' => 'hsecellphone']) !!}

                  </div>
                </div>

                
                <div class="form-group">
                    {!! Form::label('Cell Number', 'Cell Number', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('cellphone',NULL,['class' => 'form-control input-sm','id' => 'cellphone','disabled']) !!}
                      <div id = "hse_error_cellphone"></div>

                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Client Name', 'Client Name', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name','disabled']) !!}
                      <div id = "hse_error_name"></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Client Surname', 'Client Surname', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('surname',NULL,['class' => 'form-control input-sm','id' => 'surname','disabled']) !!}
                     <div id = "hse_error_surname"></div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Company', 'Company', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('company',NULL,['class' => 'form-control input-sm','id' => 'company','disabled']) !!}
                     <div id = "hse_error_surname"></div>
                    </div>
                </div>

              

            <hr class="whiter m-t-20">
            <hr class="whiter m-b-20">

            <div class="form-group">
              {!! Form::label('Enter Address', 'Enter Address', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('autocomplete',NULL,['class' => 'form-control input-sm','id' => 'autocomplete', "onfocus"=>"geolocate()"]) !!}

              </div>
            </div>


            <div class="form-group">
              {!! Form::label('Street Number', 'Street Number', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('street_number',NULL,['class' => 'street_number form-control input-sm','id' => 'street_number']) !!}

              </div>
            </div>


            <div class="form-group">
              {!! Form::label('Route', 'Route', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('route',NULL,['class' => 'route form-control input-sm','id' => 'route']) !!}

              </div>
            </div>


            <div class="form-group">
              {!! Form::label('Locality', 'Locality', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('locality',NULL,['class' => 'locality form-control input-sm','id' => 'locality']) !!}

              </div>
            </div>


            <div class="form-group">
              {!! Form::label('Area', 'Area', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('administrative_area_level_1',NULL,['class' => 'administrative_area_level_1 form-control input-sm','id' => 'administrative_area_level_1']) !!}

              </div>
            </div>



            <div class="form-group">
              {!! Form::label('Postal Code', 'Postal Code', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('postal_code',NULL,['class' => 'postal_code form-control input-sm','id' => 'postal_code']) !!}

              </div>
            </div>


               <div class="form-group">
              {!! Form::label('Country', 'Country', array('class' => 'col-md-3 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('country',NULL,['class' => 'country form-control input-sm','id' => 'country']) !!}

              </div>
            </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

                <div class="form-group">
                  {!! Form::label('Client Reference Number', 'Client Reference Number', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('client_reference_number',NULL,['class' => 'form-control input-sm','id' => 'client_reference_number']) !!}
                    <div id = "hse_error_client_reference_number"></div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('SAPS Station', 'SAPS Station', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('saps_station',NULL,['class' => 'form-control input-sm','id' => 'saps_station']) !!}
                    <div id = "hse_error_saps_station"></div>
                  </div>
                </div>

                 <div class="form-group">
                  {!! Form::label('SAPS CAS Ref No', 'SAPS CAS Ref No', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('saps_case_number',NULL,['class' => 'form-control input-sm','id' => 'saps_case_number']) !!}
                    <div id = "hse_error_saps_case_number"></div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('Investigation Officer', 'Investigation Officer', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('investigation_officer',NULL,['class' => 'form-control input-sm','id' => 'investigation_officer']) !!}
                    <div id = "hse_error_saps_investigation_officer"></div>
                  </div>
                </div>

                 <div class="form-group">
                  {!! Form::label('Investigation Cellphone', 'Investigation Cellphone', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('investigation_cell',NULL,['class' => 'form-control input-sm','id' => 'investigation_cell']) !!}
                    <div id = "hse_error_saps_investigation_cellphone"></div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('Investigation Email', 'Investigation Email', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('investigation_email',NULL,['class' => 'form-control input-sm','id' => 'investigation_email']) !!}
                    <div id = "hse_error_saps_investigation_email"></div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('Investigation Note', 'Investigation Note', array('class' => 'col-md-3 control-label')) !!}
                  <div class="col-md-6">
                    {!! Form::text('investigation_note',NULL,['class' => 'form-control input-sm','id' => 'investigation_note']) !!}
                    <div id = "hse_error_saps_investigation_note"></div>
                  </div>
                </div>


                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


                <div class="form-group">
                    {!! Form::label('Case Type', 'Case Type', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('case_type',$selectCasesTypes,0,['class' => 'form-control input-sm' ,'name' => 'case_type','id' => 'case_type']) !!}
                    <div id = "hse_error_type"></div>
                  </div>
                </div>

                <div class="form-group hidden" id="sub_case_type_id">
                    {!! Form::label('Case Sub Type', 'Case Sub Type', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                    {!! Form::select('case_sub_type',$selectCasesTypes,0,['class' => 'form-control input-sm' ,'name' => 'case_sub_type','id' => 'case_sub_type']) !!}
                    <div id = "hse_error_sub_type"></div>
                  </div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">


                <div class="form-group">
                    {!! Form::label('Problem Description', 'Problem Description', array('class' => 'col-md-3 control-label')) !!}
                    <div class="col-md-6">
                        <textarea rows="5" id="description" name="description" class="form-control" maxlength="500"></textarea>
                    </div>
                    <div id = "hse_error_description"></div>
                </div>

                <hr class="whiter m-t-20">
                <hr class="whiter m-b-20">

                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-8">
                       <a type="#" id='submitCreateCaseAgentForm' class="btn btn-sm">Create Case</a>
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
