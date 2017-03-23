


            <!-- Modal Default -->
            <div class="modal fade modalCase modal-blue" id="modalCase" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"  id="closeProfileCase" aria-hidden="true">&times;</button>

                            <h4 class="modal-title" id='depTitle'>Case details</h4>

                        </div>
                        <div class="row">
                          <div class="col-md-6">

                            <a id="editCaseDiv" class="btn btn-xs btn-alt hidden" data-toggle="modal" onclick="launchCaseReportModal()" data-target=".modalCaseReport">Edit Case</a>
                            @if(isset($userAllocateCasesPermission) && $userAllocateCasesPermission->permission_id =='22')
                            <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchReferModal('Allocate');" data-target=".modalReferCase">Allocate Case</a>
                            @endif
                            <!-- <a id="allocateCaseDiv" class="btn btn-xs btn-alt hidden" data-toggle="modal" onclick="launchCaseAllocationModal()" data-target=".modalCaseAllocation">Allocate Case</a> -->
                            @if(isset($userCreateCasesPermission) && $userCreateCasesPermission->permission_id =='21')


                              <a id="createCaseDiv" class="btn btn-xs btn-alt hidden" data-toggle="modal" onclick="launchCreateCaseModal()" data-target=".modalCreateCase">Create Case</a>

                            @endif

                          </div>
                           <div class="col-md-6">
                           @if(isset($userAcceptCasesPermission) && $userAcceptCasesPermission->permission_id =='23')


                            <a id='acceptCaseClass' class="btn btn-xs btn-alt" onClick="acceptCase()">Accept Case</a>

                            @endif


                           @if(isset($userReferCasesPermission) && $userReferCasesPermission->permission_id =='24')


                            <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchReferModal('Refer');" data-target=".modalReferCase">Refer Case</a>

                            @endif
                           @if(isset($userAddCasesNotesPermission) && $userAddCasesNotesPermission->permission_id =='25')

                            <a class="btn btn-xs btn-alt" onClick="launchCaseNotesModal();">Add Case Note</a>
                            <!--{!! Forms::addData(18, "Add Case Note", "{'func': function() {alert('Awlo')}}") !!}-->
                            @endif
                           @if(isset($userAddCasesFilesPermission) && $userAddCasesFilesPermission->permission_id =='26')

                            <a class="btn btn-xs btn-alt" onClick="launchCaseFilesModal();">Attach File</a>
                            @endif
                           @if(isset($userViewWorkFlowPermission) && $userViewWorkFlowPermission->permission_id =='27')


                            <a  id="viewWorkFlow" class="btn btn-xs btn-alt hidden" onClick="launchWorkFlow();">View WorkFlow</a>

                            @endif

                           @if(isset($userCloseCasePermission) && $userCloseCasePermission->permission_id =='28')

                              <a id='closeCaseClass' class="btn btn-xs btn-alt" onClick="closeCase()">Close Case</a>
                            @endif
                           @if(isset($userRequestCaseClosurePermission) && $userRequestCaseClosurePermission->permission_id =='29')

                              <a id='requestCaseClosureClass' class="btn btn-xs btn-alt" onClick="launchRequestCaseClosureModal();">Request Case Closure</a>

                           @endif
                          </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="tile">
                                        <h2 class="tile-title">Case profile</h2>

                                  {!! Form::open(['url' => '#', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"caseProfileForm" ]) !!}
                                  {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}
                                  {!! Form::hidden('userID',NULL,['id' => 'userID']) !!}
                                  <div class="form-group">
                                      {!! Form::label('Case Number', 'Case Number', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('id',NULL,['class' => 'form-control input-sm','id' => 'id','disabled' => 'disabled']) !!}
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Date received', 'Date received', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('created_at',NULL,['class' => 'form-control input-sm','id' => 'created_at','disabled' => 'disabled']) !!}
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Date booked out', 'Date booked out', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('created_at',NULL,['class' => 'form-control input-sm','id' => 'created_at','disabled' => 'disabled']) !!}
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      {!! Form::label('Commencement date', 'Commencement date', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('created_at',NULL,['class' => 'form-control input-sm','id' => 'created_at','disabled' => 'disabled']) !!}
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Last Activity Datetime', 'Last Activity Datetime', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('last_at',NULL,['class' => 'form-control input-sm','id' => 'last_at','disabled' => 'disabled']) !!}
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      {!! Form::label('Description', 'Description', array('class' => 'col-md-3 control-label','disabled' => 'disabled')) !!}
                                      <div class="col-md-6">

                                        {!! Form::textarea('description', null, ['class' => 'form-control input-sm','id' => 'description','size' => '30x5','disabled' => 'disabled']) !!}
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      {!! Form::label('Client Name', 'Client Name', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('household',NULL,['class' => 'form-control input-sm','id' => 'household','disabled' => 'disabled']) !!}
                                          <div  id="launchUpdateUserModalHouseID" class="hidden">
                                            <a class="btn btn-xs btn-alt" id="launchUpdateUserModalHouse"  data-toggle="modal" data-id onClick="launchUpdateUserModal($(this).data('id'));" data-target=".modalEditUser">View More</a>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Client Cellphone', 'Client Cellphone', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                      {!! Form::text('householdCell',NULL,['class' => 'form-control input-sm','id' => 'householdCell','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Client reference number', 'Client reference number', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                      {!! Form::text('client_reference_number',NULL,['class' => 'form-control input-sm','id' => 'client_reference_number','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('SAPS Number', 'SAPS Number', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                      {!! Form::text('sapc_number',NULL,['class' => 'form-control input-sm','id' => 'sapc_number','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                   <div class="form-group">
                                      {!! Form::label('SAPS Station', 'SAPS Station', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                      {!! Form::text('saps_station',NULL,['class' => 'form-control input-sm','id' => 'saps_station','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>
                                   <div class="form-group">
                                      {!! Form::label('Investigation Officer', 'Investigation Officer', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                      {!! Form::text('investigation_officer',NULL,['class' => 'form-control input-sm','id' => 'investigation_officer','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                <div class="form-group">
                                  {!! Form::label('Investigation Cellphone', 'Investigation Cellphone', array('class' => 'col-md-3 control-label')) !!}
                                  <div class="col-md-6">
                                    {!! Form::text('investigation_cell',NULL,['class' => 'form-control input-sm','id' => 'investigation_cell','disabled' => 'disabled']) !!}
                                    <div id = "hse_error_saps_investigation_cellphone"></div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  {!! Form::label('Investigation Email', 'Investigation Email', array('class' => 'col-md-3 control-label')) !!}
                                  <div class="col-md-6">
                                    {!! Form::text('investigation_email',NULL,['class' => 'form-control input-sm','id' => 'investigation_email','disabled' => 'disabled']) !!}
                                    <div id = "hse_error_saps_investigation_email"></div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  {!! Form::label('Investigation Note', 'Investigation Note', array('class' => 'col-md-3 control-label')) !!}
                                  <div class="col-md-6">
                                    {!! Form::text('investigation_note',NULL,['class' => 'form-control input-sm','id' => 'investigation_note','disabled' => 'disabled']) !!}
                                    <div id = "hse_error_saps_investigation_note"></div>
                                  </div>
                                </div>
                                  <div class="form-group">
                                      {!! Form::label('Case Type', 'Case Type', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('case_type',NULL,['class' => 'form-control input-sm','id' => 'case_type','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                   <div class="form-group">
                                      {!! Form::label('Case Sub Type', 'Case Sub Type', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('case_sub_type',NULL,['class' => 'form-control input-sm','id' => 'case_sub_type','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                   <div class="form-group">
                                      {!! Form::label('Street Number', 'Street Number', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('street_number',NULL,['class' => 'form-control input-sm','id' => 'street_number','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Route', 'Route', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('route',NULL,['class' => 'form-control input-sm','id' => 'route','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Locality', 'Locality', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('locality',NULL,['class' => 'form-control input-sm','id' => 'locality','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Area', 'Area', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('administrative_area_level_1',NULL,['class' => 'form-control input-sm','id' => 'administrative_area_level_1','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                  <div class="form-group">
                                      {!! Form::label('Postal Code', 'Postal Code', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('postal_code',NULL,['class' => 'form-control input-sm','id' => 'postal_code','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>s


                                  <div class="form-group">
                                      {!! Form::label('Country', 'Country', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('country',NULL,['class' => 'form-control input-sm','id' => 'country','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Status', 'Status', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('status',NULL,['class' => 'form-control input-sm','id' => 'status','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>


                                  <div class="form-group">
                                      {!! Form::label('Captured by', 'Captured by', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        {!! Form::text('reporter',NULL,['class' => 'form-control input-sm','id' => 'reporter','disabled' => 'disabled']) !!}
                                        <a class="btn btn-xs btn-alt" data-toggle="modal" data-id  id="launchUpdateUserModalField" onClick="launchUpdateUserModal($(this).data('id'));" data-target=".modalEditUser">View More</a>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      {!! Form::label('Cellphone', 'Cellphone', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                      {!! Form::text('reporterCell',NULL,['class' => 'form-control input-sm','id' => 'reporterCell','disabled' => 'disabled']) !!}

                                      </div>
                                  </div>

                                  <div class="form-group">
                                  <div class="">
                                      {!! Form::label('Report Image', 'Report Image', array('class' => 'col-md-3 control-label')) !!}
                                      <div class="col-md-6">
                                        <a data-rel="gallery" id="CaseImageA" class="pirobox_gall img-popup" title="">
                                          <img src="#" alt="" class="superbox-img" id="CaseImage" width="220">
                                        </a>
                                      </div>

                                  </div>
                                  </div>
                                  <div class="form-group">
                                    {!! Form::label('Attach File', 'Case Attachments', array('class' => 'col-md-3 control-label')) !!}


                                  </div>

                                  <div id="fileManager"></div>


                              {!! Form::close() !!}

                            </div>
                            </div>

                            <div class="col-md-6">

                                 <!-- Start Tile Div -->
                                  <div class="tile">


                                    <h2 class="tile-title">Related Cases</h2>


                                      <div class="block-area">
                                      <div id="caseNotesNotification"></div>
                                      <div class="table-responsive overflow">
                                          <table class="table tile table-striped" id="relatedCasesTable">
                                              <thead>
                                                <tr>
                                                      <th>Case</th>
                                                      <th>Created at</th>
                                                      <th>Description</th>
                                                      <th>Relation</th>
                                                </tr>
                                              </thead>
                                          </table>
                                      </div>
                                      </div>

                                      <hr class="whiter10">

                                      <h2 class="tile-title">case notes</h2>

                                            <!-- Responsive Table -->
                                        <div class="block-area" id="responsiveTable">


                                            <div class="table-responsive overflow">
                                                <table class="table tile table-striped" id="caseNotesTable">
                                                    <thead>
                                                      <tr>
                                                            <th>Created at</th>
                                                            <th>Author</th>
                                                            <th>Note</th>
                                                      </tr>
                                                    </thead>
                                                </table>
                                            </div>


                                        </div>


                                      <hr class="whiter10">

                                      <h2 class="tile-title">PERSONS OF INTEREST</h2>
                                    @if(isset($userAddPoiPermission) && $userAddPoiPermission->permission_id =='30')

                                      <a class="btn btn-xs btn-alt" onClick="launchPersonOfInterestModal();">Add Person</a>

                                    @endif
                                        <!-- Responsive Table -->
                                        <div class="block-area" id="responsiveTable">


                                            <div class="table-responsive overflow">
                                                <table class="table tile table-striped" id="pointListTable">
                                                    <thead>
                                                      <tr>
                                                            <th>First Name</th>
                                                            <th>Surname</th>
                                                            <th>Cellphone</th>
                                                            <th>Actions</th>

                                                      </tr>
                                                    </thead>
                                                </table>
                                            </div>


                                        </div>

                                </div><!-- End Tile Div -->
                          </div>

                      </div>

                        <div class="row">
                        <div class="col-md-6">

                         <!-- Start Tile Div -->
                          <div class="tile">
                            <h2 class="tile-title">PEOPLE INVOLVED IN THE CASE</h2>

                                  <!-- Responsive Table -->
                              <div class="block-area" id="responsiveTable">

                                  @if(Session::has('successReferral2'))
                                  <div class="alert alert-info alert-dismissable fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      {{ Session::get('successReferral2') }}
                                  </div>
                                  @endif
                                  <div class="table-responsive overflow">
                                      <table class="table tile table-striped" id="caseResponders">
                                          <thead>
                                            <tr>
                                                  <th>Type</th>
                                                  <th>Name</th>
                                                  <th>Accepted</th>
                                                  <th>Actions</th>
                                            </tr>
                                          </thead>
                                      </table>
                                  </div>
                              </div>
                        </div><!-- End Tile Div -->

                        </div>
                         <div class="col-md-6">

                         <!-- Start Tile Div -->
                          <div class="tile">
                            <h2 class="tile-title">Case Activities</h2>

                                  <!-- Responsive Table -->
                              <div class="block-area" id="responsiveTable">

                                  @if(Session::has('successReferral1'))
                                  <div class="alert alert-info alert-dismissable fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      {{ Session::get('successReferral1') }}
                                  </div>
                                  @endif
                                  <div class="table-responsive overflow">
                                      <table class="table tile table-striped" id="caseActivities">
                                          <thead>
                                            <tr>
                                                  <th>Created At</th>
                                                  <th>activity</th>
                                            </tr>
                                          </thead>
                                      </table>
                                  </div>
                              </div>
                        </div><!-- End Tile Div -->

                        </div>
                      </div>

                  </div>
                </div>
            </div>
            </div>

