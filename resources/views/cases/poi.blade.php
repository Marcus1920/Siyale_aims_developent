<!-- Modal Default -->
<div class="modal modalPoiCase" id="modalPoiCase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  id="closePOiCase" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='modalTitle'></h4>
            </div>
            <div class="row">
              <div class="col-md-6">

              </div>

            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'addCasePoi', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"poi_CaseForm" ]) !!}
                {!! Form::hidden('caseID',NULL,['id' => 'caseID']) !!}


                <div class="form-group">
                    {!! Form::label('Search Box', 'Search Box', array('class' => 'col-md-2 control-label')) !!}
                    <div class="col-md-6">
                      {!! Form::text('POISearch',NULL,['class' => 'form-control input-sm','id' => 'POISearch']) !!}
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                       <a type="#" id='submitPoiForm' class="btn btn-sm">Add</a>
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
