<?php
/**
 * Created by PhpStorm.
 * User: Vaughan Durno
 * Date: 2017/03/22
 * Time: 1:50 PM
 */
?>
<div class="modal fade modalDeleteForm" id="modalDeleteForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" style="padding-bottom: 0">
                Delete Stufff
                {!! Form::open(['url' => 'deleteForm', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"deleteForm" ]) !!}
                <div class="form-group">
                    {!! Form::text('formId',NULL,['class' => 'form-control input-sm','id' => 'formId']) !!}
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" id='submitDeleteCustomForm' type="button" class="btn btn-sm">Delete Form</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    function launchModalDeleteForm(id) {
    	console.log("launchModalDeleteForm(id) id - "+id);
        $(".modalDeleteForm #formId").val(id);
    }
</script>