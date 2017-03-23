<!-- Modal Default -->
<div class="modal fade modalSubSubResponder" id="modalSubSubResponder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>Sub Sub Category Responders</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addSubSubCategoryResponder', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"SubSubCategoryResponderForm" ]) !!}
            {!! Form::hidden('deptID',$deptObj->id) !!}
            {!! Form::hidden('catID',$catObj->id) !!}
            {!! Form::hidden('subCatID',$subCatObj->id) !!}
            {!! Form::hidden('subsubCategoryID',NULL,['id' => 'subsubCategoryID']) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}

            <div class="form-group">
                {!! Form::label('First Responder', 'First Responder', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('firstResponder',NULL,['class' => 'form-control input-sm','id' => 'firstResponder']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Second Responder', 'Second Responder', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('secondResponder',NULL,['class' => 'form-control input-sm','id' => 'secondResponder']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Third Responder', 'Third Responder', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-10">
                  {!! Form::text('thirdResponder',NULL,['class' => 'form-control input-sm','id' => 'thirdResponder']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitUpdateCategoryForm' type="button" class="btn btn-sm">Save Changes</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
