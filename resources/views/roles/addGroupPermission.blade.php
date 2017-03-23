<!-- Modal Default -->
<div class="modal fade modalSelectGroupPermissions" id="modalSelectGroupPermissions" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closePerm" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Permission(s)</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'addGroupPermission', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"addGroupPermissionsForm" ]) !!}
            {!! Form::hidden('groupID',NULL,['id' => 'groupID']) !!}

          

         <!--Responsive Table
         <div class="block-area" id="responsiveTable">
             <div id="MeetingAttendeeNotification"></div>
             <div class="table-responsive overflow">
                 <table class="table tile table-striped" id="groupPermissionsTable">
                     <thead>
                       <tr>
                             <th><a id='selecctall' data-value='0'>select/All</a></th>
                             <th>Permission</th>
         
                       </tr>
                     </thead>
                 </table>
             </div>
         </div>
          -->
             <div class="table-responsive overflow">
                <table class="table tile table-striped" id="allPermissionsTable">
                    <thead>
                      <tr>
                            <th><a id='selecctallpermissions' data-value='0'>select/All</a></th>
                            <th>name</th>
                            
                      </tr>
                    </thead>
                </table>
            </div>






            <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a type="#" id='submitAddPermissionsGroupForm' class="btn btn-sm">Add</a>
                    </div>
            </div>

            </div>
            <div class="modal-footer">


            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
