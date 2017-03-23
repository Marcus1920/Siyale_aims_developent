<!-- Modal Default -->
<div class="modal modalPoiAssociate" id="modalPoiAssociate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='modalTitle'></h4>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>

            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'addAssociatePoi', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"poi_CaseForm" ]) !!}
                {!! Form::hidden('poiID',NULL,['id' => 'poiID']) !!}


                <div class="form-group">
                    {!! Form::label('Search Box', 'Search Box', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('POISearch',NULL,['class' => 'form-control input-sm','id' => 'POISearch']) !!}
                    </div>
                </div>

                   <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                       <a type="#" id='submitAssociatePoiForm' class="btn btn-sm">Add</a>
                    </div>
                </div>

               <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">

                    </div>
                </div>

                {!! Form::close() !!}


                  <div class="table-responsive overflow">
                          <table class="table tile table-striped" id="associatesTable">
                              <thead>
                                <tr>
                                      <th>Actions</th>
                                      <th>Name</th>
                                      <th>Surname</th>
                                      <th>Cellphone</th>


                                </tr>
                              </thead>
                              <tbody id="associatesTableBody">

                              </tbody>
                          </table>
                  </div>

            </div>



        </div>
    </div>
</div>
