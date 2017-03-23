<!-- Modal Default -->
<div class="modal fade modalEditUser" id="modalEditUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='depTitle'>User</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url' => 'updateUser', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"updateUserForm" ]) !!}
            {!! Form::hidden('userID',NULL,['id' => 'userID']) !!}
            {!! Form::hidden('id',Auth::user()->id) !!}
            <div class="form-group">
                {!! Form::label('User Type', 'User Type', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::select('role',$selectRoles,0,['class' => 'form-control input-sm' ,'id' => 'role']) !!}
                  @if ($errors->has('role')) <p class="help-block red">*{{ $errors->first('role') }}</p> @endif
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('User Status', 'User Status', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::select('status',$selectUserStatuses,0,['class' => 'form-control input-sm' ,'id' => 'status']) !!}
                  @if ($errors->has('status')) <p class="help-block red">*{{ $errors->first('status') }}</p> @endif
              </div>
            </div>



            <div class="form-group">
                {!! Form::label('Title', 'Title', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::select('title',['0' => 'Select/All','Mr' => 'Mr','Mrs' => 'Mrs','Miss' => 'Miss','Ms' => 'Ms'],0,['class' => 'form-control' ,'id' => 'title']) !!}
                  @if ($errors->has('title')) <p class="help-block red">*{{ $errors->first('title') }}</p> @endif
                </div>
            </div>

             <div class="form-group">
                {!! Form::label('Gender', 'Gender', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                {!! Form::select('gender',['0' => 'Select/All','1' => 'Male','2' => 'Female'],0,['class' => 'form-control' ,'id' => 'gender']) !!}
                @if ($errors->has('gender')) <p class="help-block red">*{{ $errors->first('gender') }}</p> @endif
              </div>
            </div>

             <div class="form-group">
                {!! Form::label('Preferred Language', 'Preferred Language', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                {!! Form::select('language',$selectLanguages,0,['class' => 'form-control' ,'id' => 'language']) !!}
                @if ($errors->has('language')) <p class="help-block red">*{{ $errors->first('language') }}</p> @endif
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('First Name', 'First Name', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('name',NULL,['class' => 'form-control input-sm','id' => 'name']) !!}
                  @if ($errors->has('name')) <p class="help-block red">*{{ $errors->first('name') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Surname', 'Surname', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('surname',NULL,['class' => 'form-control input-sm','id' => 'surname']) !!}
                  @if ($errors->has('surname')) <p class="help-block red">*{{ $errors->first('surname') }}</p> @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('ID No', 'ID No', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('id_number',NULL,['class' => 'form-control input-sm','id' => 'id_number']) !!}
                  @if ($errors->has('id_number')) <p class="help-block red">*{{ $errors->first('id_number') }}</p> @endif
                </div>
            </div>
            <hr class="whiter m-t-20">
            <hr class="whiter m-b-20">

            <div class="form-group">
                {!! Form::label('Cell Number', 'Cell Number', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('cellphone',NULL,['class' => 'form-control input-sm','id' => 'cellphone','disabled']) !!}
                  @if ($errors->has('Cellphone')) <p class="help-block red">*{{ $errors->first('Cellphone') }}</p> @endif
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('Alternative Cell Number', 'Alternative Cell Number', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('alt_cellphone',NULL,['class' => 'form-control input-sm','id' => 'alt_cellphone']) !!}
                  @if ($errors->has('alt_cellphone')) <p class="help-block red">*{{ $errors->first('alt_cellphone') }}</p> @endif
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('Email', 'Email', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('email',NULL,['class' => 'form-control input-sm','id' => 'email','disabled']) !!}
                  @if ($errors->has('email')) <p class="help-block red">*{{ $errors->first('email') }}</p> @endif
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('Alternative Email', 'Alternative Email', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::text('alt_email',NULL,['class' => 'form-control input-sm','id' => 'alt_email']) !!}
                  @if ($errors->has('alt_email')) <p class="help-block red">*{{ $errors->first('alt_email') }}</p> @endif
              </div>
            </div>

            <hr class="whiter m-t-20">
            <hr class="whiter m-b-20">


            <div class="form-group">
              {!! Form::label('Street Number', 'Street Number', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">
                  
                {!! Form::text('street_number',NULL,['class' => 'form-control input-sm','id' => 'street_number']) !!}
                
               
              </div>
            </div>


            <div class="form-group">
              {!! Form::label('Road', 'Road', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">
                  
                {!! Form::text('route',NULL,['class' => 'form-control input-sm','id' => 'route']) !!}
                
               
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('Locality', 'Locality', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">
                  
                {!! Form::text('locality',NULL,['class' => 'form-control input-sm','id' => 'locality']) !!}
                
               
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('Area', 'Area', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">
                  
                {!! Form::text('administrative_area_level_1',NULL,['class' => 'form-control input-sm','id' => 'administrative_area_level_1']) !!}
                
               
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('Postal Code', 'Postal Code', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">
                  
                {!! Form::text('postal_code',NULL,['class' => 'form-control input-sm','id' => 'postal_code']) !!}
                
               
              </div>
            </div>

               <div class="form-group">
              {!! Form::label('Country', 'Country', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">
                  
                {!! Form::text('country',NULL,['class' => 'form-control input-sm','id' => 'country']) !!}
                
               
              </div>
            </div>



           



            <hr class="whiter m-t-20">
            <hr class="whiter m-b-20">



            <div class="form-group">
                {!! Form::label('Company', 'Company', array('class' => 'col-md-2 control-label')) !!}
              <div class="col-md-6">     
                {!! Form::text('company',NULL,['class' => 'company form-control input-sm','id' => 'company']) !!}

              </div>
            </div>


            <div class="form-group">
                {!! Form::label('Department', 'Department', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::select('department',$selectDepartments,0,['class' => 'form-control input-sm' ,'id' => 'department']) !!}
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('Position', 'Position', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::select('position',$selectPositions,0,['class' => 'form-control input-sm' ,'id' => 'position']) !!}
              </div>
            </div>

              <div class="form-group">
                {!! Form::label('Affiliation', 'Affiliation', array('class' => 'col-md-2 control-label')) !!}
                <div class="col-md-6">
                  {!! Form::select('affiliation',$selectAffiliations,0,['class' => 'form-control input-sm' ,'id' => 'affiliation']) !!}
              </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" id='submitUpdateUserForm' type="button" class="btn btn-sm">Save Changes</button>
                </div>
            </div>
            </div>
            <div class="modal-footer">

            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
