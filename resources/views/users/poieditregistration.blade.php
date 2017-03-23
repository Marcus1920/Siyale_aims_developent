@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-poi-users') }}">POI</a></li>
    <li class="active">POI Edit Form</li>
</ol>
<h4 class="page-title">PERSONS OF INTEREST</h4>

 @if(Session::has('flash_message'))
      <div class="alert alert-success alert-icon">

        {!! session('flash_message') !!}<i class="icon"></i>

      </div>
  @endif

<div class="col-xs-6 col-md-4 col-lg-3">

   <a class="btn btn-alt" href="{{ url('list-poi-users') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  BACK TO POI LISTING</a>
    
</div>



<div class="block-area">



     {!! Form::open(['url' => 'edit_poi', 'method' => 'post', 'class' => 'row form-columned', 'id'=>"poiEditForm",'files' => true ]) !!}

     {!! Form::hidden('poiID',$poi->id,['id' => 'poiID']) !!}

        @if(isset($poi->poidocid))
          {!! Form::hidden('poiProfileID',$poi->poidocid->id,['id' => 'poiProfileID']) !!}
         
        @endif

        @if(isset($poi->idpic))

         {!! Form::hidden('poiPicID',$poi->idpic->id,['id' => 'poiPicID']) !!}

        @endif

       <div class="tab-container tile">

            <ul class="nav tab nav-tabs">
                <li class="active"><a href="#personal">PERSONAL DETAILS</a></li>
                <li><a href="#scar">SCARS PICTURES</a></li>
                <li><a href="#tatoo">TATOOS PICTURES</a></li>
                <li><a href="#identification">IDENTIFICATION DOCUMENT</a></li>
                <li><a href="#driverlicence"> DRIVER LICENCE</a></li>
                <li><a href="#vehicles">  VEHICLES</a></li>
                <li><a href="#contact"> CONTACT DETAILS</a></li>
                <li><a href="#structeredaddress"> RESIDENTIAL ADDRESS</a></li>
                <li><a href="#workaddress"> WORK ADDRESS DETAILS</a></li>
                <li><a href="#travelmovements"> TRAVEL MOVEMENTS </a></li>
                <li><a href="#criminalrecords"> CRIMINAL RECORDS </a></li>
                <li><a href="#bankingdetails"> BANKING DETAILS </a></li>

            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="personal">

                    <hr class="whiter m-t-20" />
                    <h3 class="block-title">POI PERSON DETAILS</h3>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="fileupload fileupload-exists" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail form-control">
                                   @if(isset($poi->poidocid))
                                    <img src="{{ asset('/'.$poi->poidocid->poi_picture_url.'') }}"></img>
                                   @endif
                                </div>
                                
                                <div>
                                    <span class="btn btn-file btn-alt btn-sm">
                                        <span class="fileupload-new">Select image</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::file('poi_profile_file') !!}
                                    </span>
                                    <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>

                          <label>Notes</label>
                          <input type="text" name="profile_pic_note" value="{{$poi->poidocid->notes}}" class="form-control input-sm m-b-3"/>


                        </div>


                    </div>

                    <hr class="whiter m-t-20" />

                    <div class="">
                        <div class="col-md-4">

                            {!! Form::label('First Name', 'First Name', array('class' => '')) !!}
                            {!! Form::text('name',$poi->name,['class' => 'form-control input-sm m-b-10','id' => 'name']) !!}

                        </div>
                        <div class="col-md-4">

                            {!! Form::label('Surname', 'Surname', array('class' => '')) !!}
                            {!! Form::text('surname',$poi->surname,['class' => 'form-control input-sm m-b-10','id' => 'surname']) !!}

                        </div>
                        <div class="col-md-4">

                            {!! Form::label('Nickname', 'Nickname', array('class' => '')) !!}
                            {!! Form::text('nickname',$poi->nickname,['class' => 'form-control input-sm m-b-10','id' => 'nickname']) !!}

                        </div>

                          <div class="col-md-4">

                              {!! Form::label('Gender', 'Gender', array('class' => '')) !!}
                              {!! Form::select('gender',['1' => 'Male','2' => 'Female' ],$poi->gender,['class' => 'form-control input-sm' ,'id' => 'role']) !!}

                          </div>

                          <div class="col-md-4">
                              {!! Form::label('Race', 'Race', array('class' => '')) !!}
                              {!! Form::select('ethnic_group',['1' => 'Black','2' => 'Coloured','3' => 'White','4' => 'Indian','5'=>'Other'],$poi->ethnic_group_id,['class' => 'form-control input-sm m-b-10' ,'id' => 'ethnic_group']) !!}

                          </div>

                          <div class="col-md-4">
                              {!! Form::label('Weight', 'Weight', array('class' => '')) !!}
                              {!! Form::text('weight',$poi->weight,['class' => 'form-control input-sm m-b-10','id' => 'weight']) !!}

                          </div>

                          <div class="col-md-4">

                            {!! Form::label('Number of Dependants', 'Number of Dependants', array('class' => '')) !!}
                            {!! Form::selectRange('dependants',0, 50,$poi->dependants,['class' => 'form-control input-sm m-b-10' ,'id' => 'dependants']) !!}

                          </div>

                          <div class="col-md-4">

                              {!! Form::label('Birth Place', 'Birth Place', array('class' => '')) !!}
                              {!! Form::text('birth_place',$poi->birth_place,['class' => 'form-control input-sm m-b-10','id' => 'birth_place']) !!}

                          </div>

                         <div class="col-md-4">

                            {!! Form::label('Nationality', 'Nationality', array('class' => '')) !!}
                            {!! Form::select('nationality',$selectCountries,$poi->nationality,['class' => 'form-control input-sm m-b-10' ,'id' => 'nationality']) !!}
                            
                        
                         </div>
                          <div class="row">
                              <div class="col-md-4">
                                  {!! Form::label('Language Spoken', 'Language Spoken', array('class' => '')) !!}
                                  {!! Form::select('language',$selectLanguages,$poi->language,['class' => 'form-control input-sm m-b-10' ,'id' => 'language']) !!}
                                
                              </div>

                              <div class="col-md-4">
                                  {!! Form::label('Email Address', 'Email Address', array('class' => '')) !!}
                                  {!! Form::text('email',$poi->email,['class' => 'form-control input-sm m-b-10','id' => 'email']) !!}

                              </div>

                                <div class="col-md-4">

                                  {!! Form::label('Tax Number', 'Tax Number', array('class' => '')) !!}
                                  {!! Form::text('tax_number',$poi->tax_number,['class' => 'form-control input-sm m-b-10','id' => 'tax_number']) !!}

                              </div>
                          </div>
                    </div>

                </div>

                <div class="tab-pane" id="scar">

                      <div class="">
                            <h3 class="block-title">POI SCARS PICTURES</h3><br>

                            <span class="btn btn-file btn-alt btn-sm">             
                                <span class="fileupload-new" id="add-scar-pic"><i class="glyphicon glyphicon-plus"></i> Add Files</span>                     
                            </span>

                        <div>
                            <table class="table table-bordered tile" id="scars_pics_table">

                                <tbody class="files">

                                  @if(isset($poi->scars))

                                        @foreach ($poi->scars as $scar)
                                                              
                                              <tr>         
                                                  <td>
                                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-preview thumbnail form-control">
                                                          <img src="{{ asset('/'.$scar->poi_picture_url.'') }}"></img>
                                                      </div>
                                                      
                                                      <div>
                                                      <span class="btn btn-file btn-alt btn-sm">
                                                      <span class="fileupload-new"><i class="glyphicon glyphicon-plus"></i> Select File</span>
                                                      <span class="fileupload-exists">Change</span>
                                                      <input type="file" name="scar_file[][{{$scar->id}}]"/>
                                                      </span>
                                                      <a href="#" onclick="delete_row(this)" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
                                                      </div>
                                                      </div>
                                                  </td>
                                                  <td>
                                                     <span><button onclick="delete_row(this)" class='btn btn-primary'><i class='fa fa-trash-o fa-lg'></i> Delete</button></span>
                                                  </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  <label>Notes</label>
                                                  <input type="text" name="scar_pic_note[]" value="{{$scar->notes}}" class="form-control input-sm m-b-10"/>
                                                </td>
                                              </tr>
                                                   
                                        @endforeach

                                    @endif

                          
                             
                                              
                                </tbody>
                            </table>

                        </div>
                      </div>


                </div>

                <div class="tab-pane" id="tatoo">
                  <hr class="whiter m-t-20" />

                        <div class="">
                            <h3 class="block-title">POI TATOOS PICTURES</h3><br>

                            <span class="btn btn-file btn-alt btn-sm">             
                                <span class="fileupload-new" id="add-tatoo-pic"><i class="glyphicon glyphicon-plus"></i> Add Files</span>                     
                            </span>

            

                            <div>
                                <table class="table table-bordered tile" id="tatoos_pics_table">

                                    <tbody class="files">

                                        @if(isset($poi->tatoos))
                                            @foreach ($poi->tatoos as $tatoo)
                                                                  
                                                  <tr>         
                                                      <td>
                                                          <div class="fileupload fileupload-new" data-provides="fileupload">
                                                          <div class="fileupload-preview thumbnail form-control">
                                                              <img src="{{ asset('/'.$tatoo->poi_picture_url.'') }}"></img>
                                                          </div>
                                                          
                                                          <div>
                                                          <span class="btn btn-file btn-alt btn-sm">
                                                          <span class="fileupload-new"><i class="glyphicon glyphicon-plus"></i> Select File</span>
                                                          <span class="fileupload-exists">Change</span>
                                                          <input type="file" name="tatoo_file[][{{$tatoo->id}}]"/>          
                                                          </span>
                                                          <a href="#" onclick="delete_row(this)" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
                                                          </div>
                                                          </div>
                                                      </td>
                                                      <td>
                                                         <span><a onclick="delete_row(this)" class='btn btn-primary'>delete</a></span>
                                                      </td>


                                                  </tr>
                                                  <tr>
                                                    <td>
                                                      <label>Notes</label>
                                                      <input type="text" name="tatoo_pic_note[]" value="{{$tatoo->notes}}" class="form-control input-sm m-b-10"/>
                                                    </td>
                                                  </tr>


                                                  
                                                   
                                            @endforeach
                                        @endif
                                 

                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>


                </div>

                <div class="tab-pane" id="identification">


                  <div class="block-area">
                    <h3 class="block-title">POI IDENTIFICATION DOCUMENT </h3><br>
                    <div class="row">

                        <div class="col-md-4">

                            {!! Form::label('Document Type', 'Document Type', array('class' => '')) !!}
                            {!! Form::select('document_type',['0' => 'Select Document Type','1' => 'ID','2' =>'Passport'],$poi->document_type,['class' => 'form-control input-sm m-b-10' ,'id' => 'document_type']) !!}
                           
                        
                        </div>


                      
                        <div class="col-md-4 idnumber @if($poi->document_type == 2) hidden @endif">

                            {!! Form::label('ID Number', 'ID Number', array('class' => '')) !!}
                            {!! Form::text('id_number',$poi->id_number,['class' => 'form-control input-sm m-b-10','id' => 'id_number']) !!}
                       

                        </div>
                       
                        <div class="col-md-4 passportnumber @if($poi->document_type == 1) hidden @endif">

                            {!! Form::label('Passport Number', 'Passport Number', array('class' => '')) !!}
                            {!! Form::text('passport_number',$poi->passport_number,['class' => 'form-control input-sm m-b-10','id' => 'passport_number']) !!}

                        </div>
                      
                    </div>

    
                    <div class="row">
                      <div class="col-md-6">
                          <div class="fileupload fileupload-exists" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail form-control">
                                   @if(isset($poi->idpic))
                                    <img src="{{ asset('/'.$poi->idpic->poi_picture_url ) }}"></img>
                                   @endif
                                </div>
                                
                                <div>
                                    <span class="btn btn-file btn-alt btn-sm">
                                        <span class="fileupload-new">Select image</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::file('poi_doc_file') !!}
                                    </span>
                                    <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                            <label>Notes</label>
                            
                            <input type="text" name="id_pic_note"   @if(isset($poi->idpic)) value="{{$poi->idpic->notes}}" @endif class="form-control input-sm m-b-3"/>
                      </div>
                    </div>



                  </div>


                </div>

                <div class="tab-pane" id="vehicles">


                  <div class="block-area">
                    <h3 class="block-title">VEHICLES </h3><br>
                    <div class="row">

                        <div class="col-md-4">

                            {!! Form::label('Vehicle', 'Vehicle', array('class' => '')) !!}
                            {!! Form::select('has_vehicle',['0' => 'Has a vehicle ?','1' => 'No','2' => 'Yes'],0,['class' => 'form-control input-sm m-b-10' ,'id' => 'has_vehicle']) !!}
                           
                        
                        </div>        
                      
                    </div>
                    <div id="vehicles_container">


                              @if(isset($poi->vehicles))
                                      @foreach ($poi->vehicles as $vehicle)

                                        

                  <div class='row driver_line'>

                          <div class='col-md-4 driverlicencenumber'>
                            {!! Form::label("Vehicle Make", "Vehicle Make") !!}
                            <input name='vehicle_make[]' value='{{ $vehicle->vehicle_make }}' type='text' class='form-control input-sm m-b-10'/>
                          </div>

                         <div class='col-md-4 driverlicencenumber'>
                           {!! Form::label("Vehicle Color", "Vehicle Color") !!}
                           <input name='vehicle_color[]' type='text' value='{{ $vehicle->vehicle_color }}' class='form-control input-sm m-b-10'/>
                         </div>

                         <div class='col-md-4 driverlicencenumber'>
                          {!! Form::label("Vehicle VIN", "Vehicle VIN") !!}
                          <input name='vehicle_vin[]' type='text' value='{{ $vehicle->vehicle_vin }}' class='form-control input-sm m-b-10'/>
                         </div>
                   </div>

                   <div class='row driver_line'>
                     <div class='col-md-4 driverlicencenumber'>
                      {!! Form::label("Vehicle Number Plate", "Vehicle Number Plate") !!}
                      <input name='vehicle_plate[]' type='text' value='{{ $vehicle->vehicle_vin }}' class='form-control input-sm m-b-10'/>
                      </div>
                   </div>

                  <div class='row'>
                      <div class='col-md-6'>
                      <div class='fileupload fileupload-new doc_upload_image' data-provides='fileupload'>
                      <div class='fileupload-preview thumbnail form-control'>
                     
                                <img src="{{ asset('/'.$vehicle->poi_picture_url ) }}"></img>
                        

                      </div>
                      <div>
                      <span class='btn btn-file btn-alt btn-sm'>
                      <span class='fileupload-new'>Select image</span>
                      <span class='fileupload-exists'>Change</span>

                      <input type="file" name="poi_vehicle_file[][{{$vehicle->vehicle_id}}]"/>    
                     
                      </span>
                      <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
                      </div>
                      </div>
                      </div>
                  </div>


    
                                                                       
                  @endforeach

                    <div class="row">
                      <div class='col-md-4 driverlicencenumber'>

                         {!! Form::label('Vehicle', 'Vehicle', array('class' => '')) !!}
                         {!! Form::select('has_vehicle',['0' => 'Has a vehicle ?','1' => 'No','2' => 'Yes'],0,['class' => 'form-control input-sm m-b-10' ,'id' => 'has_vehicle']) !!}

                      </div>
        

                    </div>

                                    


                                  @endif

                          </div>

    
                    <div class="row">
                      <div class="col-md-6">
                          <div class="fileupload fileupload-exists" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail form-control">
                                   @if(isset($poi->idpic))
                                    <img src="{{ asset('/'.$poi->idpic->poi_picture_url ) }}"></img>
                                   @endif
                                </div>
                                
                                <div>
                                    <span class="btn btn-file btn-alt btn-sm">
                                        <span class="fileupload-new">Select image</span>
                                        <span class="fileupload-exists">Change</span>
                                        {!! Form::file('poi_doc_file') !!}
                                    </span>
                                    <a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                            <label>Notes</label>
                            
                            <input type="text" name="id_pic_note"   @if(isset($poi->idpic)) value="{{$poi->idpic->notes}}" @endif class="form-control input-sm m-b-3"/>
                      </div>
                    </div>



                  </div>


                </div>

                <div class="tab-pane" id="driverlicence">

                    <div class="">

                        <h3 class="block-title">POI DRIVER LICENCE</h3><br>
                          <div class="row">
                              <div class="col-md-4">

                                      {!! Form::label('Driver Licence', 'Driver Licence', array('class' => '')) !!}
                                      {!! Form::select('has_driver_licence',['0' => 'Please Select','1' => 'No','2' => 'Yes'],$poi->has_driver_licence,['class' => 'form-control input-sm m-b-10' ,'id' => 'has_driver_licence']) !!}
                                  
                              </div>
                          </div>
                          <div id="driver_licence_container">


                              @if(isset($poi->driverslicence))
                                      @foreach ($poi->driverslicence as $licence)

                                         <div class='row driver_line'>
                                              <div class='col-md-4 driverlicencenumber'>
                                                {!! Form::label("Driver Licence Code", "Driver Licence Code") !!}
                                                {!! Form::text('drivers_licence[]',$licence->driver_licence_code,['class' => 'form-control input-sm m-b-10','id' => '']) !!}
                                               
                                              </div>
                                              <div class='col-md-4 driverlicencenumber'>
                                                  {!! Form::label("Date Issued", "Date Issued") !!}
                                                  <div class="input-icon datetime-pick date-only">
                                                    <input data-format="yyyy-MM-dd" type="text" name="drivers_licence_date_issued[]"  value="{{ $licence->drivers_licence_date_issued }}" class="form-control input-sm m-b-10" />
                                                      <span class="add-on">
                                                          <i class="sa-plus"></i>
                                                      </span>
                                                  </div>
                                              </div>

                                              <div class='col-md-4 driverlicencenumber'>
                                                  {!! Form::label("Expiry Date", "Expiry Date") !!}
                                                  <div class="input-icon datetime-pick date-only">
                                                    <input data-format="yyyy-MM-dd" type="text" name="drivers_licence_expiry_date[]" value="{{ $licence->drivers_licence_expiry_date }}" class="form-control input-sm m-b-10" />
                                                      <span class="add-on">
                                                        <i class="sa-plus"></i>
                                                      </span>
                                                  </div>
                                              </div>
                     
                                        </div>
                                                                       
                                      @endforeach

                                      <div class="row">
                                        <div class='col-md-4 driverlicencenumber'>
                                          {!! Form::label("Other Driver Licence", "Other Driver Licence") !!}
                                          {!! Form::select("another_driver_licence",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10 another_driver_licence" ,"id" => "another_driver_licence","onChange" => "generate_driver_licence_html(this.value)"]) !!}
                                        </div>
                                      </div>

                                    


                                  @endif

                          </div>
                    </div>



                </div>

                <div class="tab-pane" id="contact">

                    <div class="">
      
                      <h3 class="block-title">CONTACT DETAILS</h3><br>

                      <div class="row">
                          <div class="col-md-4">

                                  {!! Form::label('Land Line Number', 'Land Line Number', array('class' => '')) !!}
                                  {!! Form::select('has__land_line_number',['0' => 'Please Select','1' => 'No','2' => 'Yes'],0,['class' => 'form-control input-sm m-b-10' ,'id' => 'has__land_line_number']) !!}
                                 
                              
                          </div>
                      </div>

                      <div id="landline_container">

                          @if(isset($poi->landline))
                                  @foreach ($poi->landline as $line)


                                        <div class='row'>
                                            <div class='col-md-4'>
                                               {!! Form::label("Land Line Number", "Land Line Number") !!}
                                               {!! Form::text('landline[]',$line->contact_number,['class' => 'form-control input-sm m-b-10']) !!}

                                            </div>
                                          
                                        </div>      
                                                                   
                                  @endforeach

                                  <div class="row">
                                     <div class='col-md-4'>
                                                {!! Form::label("Other Land Line Number", "Other Land Line Number") !!}
                                                {!! Form::select("another_land_line",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10 another_driver_licence" ,"id" => "another_land_line","onChange" => "generate_land_line_html(this.value)"]) !!}
                                      </div>
                                  </div>

                                


                              @endif

                      </div>

                      <div class="row">
                          <div class="col-md-4">

                                  {!! Form::label('Mobile Number', 'Mobile Number', array('class' => '')) !!}
                                  {!! Form::select('has__mobile_number',['0' => 'Please Select','1' => 'No','2' => 'Yes'],0,['class' => 'form-control input-sm m-b-10' ,'id' => 'has__mobile_number']) !!}
                                 
                              
                          </div>
                      </div>

                      <div id="mobile_container">

                          @if(isset($poi->mobilenumber))
                                  @foreach ($poi->mobilenumber as $mobile)


                                  <div class='row'>
                                      <div class='col-md-4'>
                                         {!! Form::label("Mobile Number", "Mobile Number") !!}
                                         {!! Form::text('mobile[]',$mobile->contact_number,['class' => 'form-control input-sm m-b-10']) !!}

                                      </div>
                                       <div class='col-md-4'>
                                         {!! Form::label("Phone Type", "Phone Type") !!} 
                                         {!! Form::select("phone_type[]",$selectPhoneTypes,$mobile->phone_type,["class" => "form-control input-sm m-b-10 " ,"id" => "phone_type[]"]) !!}

                                      </div>
                                    
                                  </div>
                                  <div class='row'>
                                     <div class='col-md-4'>
                                        {!! Form::label("IMEI number", "IMEI number") !!}
                                        {!! Form::text('imei_number[]',$mobile->imei_number,['class' => 'form-control input-sm m-b-10']) !!}
                                     </div>

                                  </div>      
                                                                   
                                  @endforeach

                                  <div class="row">

                                     <div class='col-md-4'>
                                                {!! Form::label("Other Mobile Number", "Other Mobile Number") !!}
                                                {!! Form::select("another_mobile",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10 another_mobile" ,"id" => "another_mobile","onChange" => "generate_mobile_html(this.value)"]) !!}
                                      </div>
                                  </div>


                              @endif


                      </div>
                  </div>


                </div>

        

              <div class="tab-pane" id="structeredaddress">


                  <div class="">
          

                      <h3 class="block-title">Residential Address</h3><br>

                      <div class="block-area">
                          <h3 class="block-title">Residential Address</h3><br>
                          <div class="row">

                              <div class="col-md-6">

                                  <div class="block-area" id="inline">
                                      <div class="row">
                                         
                                          <div class="form-group">
                                            {!! Form::label('Enter Last Seen Location', 'Last Seen Location', array('class' => 'col-md-3 control-label')) !!}
                                            
                                             {!! Form::hidden('latitude_res',NULL,['id' => 'latitude_res','class'   => 'latitude_res'])   !!}
                                             {!! Form::hidden('longitude_res',NULL,['id' => 'longitude_res','class' => 'longitude_res']) !!}
                                            
                                            <div class="col-md-6">     
                                              {!! Form::text('autocomplete_res',NULL,['class' => 'form-control input-sm','id' => 'autocomplete_res', "onfocus"=>"geolocate()"]) !!}

                                            </div>
                                          </div>          
                                          <div class="checkbox m-l-5 m-r-10">

                                             <a href="#"  id="addResAddress" class="btn btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Location</a>
                                             
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                    </div>

                  

                      <div id="res_address_container">
                        @if(isset($poi->residential))
                              @foreach ($poi->residential as $residential)


                                  <div class="row resaddress">
                                
                                      <div class="row">
                                        <div class="col-md-4">
                                        {!! Form::label("Residential Address", "Residential Address") !!}
                                        <input name='resindential_line_1[]' value='{{ $residential->line_1 }}'type='text' class='form-control input-sm m-b-10' >
                                        </div>
                                        <div class="col-md-4">
                                        {!! Form::label("GPS Coordinates", "GPS Coordinates") !!}
                                        <input name='resGPS[]' value='{{ $residential->gps_lat }} {{ $residential->gps_lng }}' type='text' class='form-control input-sm m-b-10' >
                                        </div>
                                        <div class="col-md-4">   
                                        <a href="#" id="removeResAddress" onClick="removeResAddress(this)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i> Remove Location</a>
                                        </div>
                                      </div>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <input name='reslat[]' value='{{ $residential->gps_lat }}'  type='hidden' > 
                                        <input name='reslong[]' value='{{ $residential->gps_lng }}' type='hidden' >
                                      </div>
                                    </div>
                                </div>


                               @endforeach
                        @else 

                            <div id="res_address_container">

                            </div>
                        @endif
                    

                    </div>




                </div>
                </div>

                <div class="tab-pane" id="workaddress">


                  <div class="">
          

                      <h3 class="block-title">WORK ADDRESS DETAILS</h3><br>

                      <div class="block-area">
                          <h3 class="block-title">WORK ADDRESS DETAILS</h3><br>
                          <div class="row">

                              <div class="col-md-6">

                                  <div class="block-area" id="inline">
                                      <div class="row">
                                         
                                          <div class="form-group">
                                            {!! Form::label('Enter Last Seen Location', 'Last Seen Location', array('class' => 'col-md-3 control-label')) !!}
                                            
                                             {!! Form::hidden('latitude_work',NULL,['id' => 'latitude_work','class'   => 'latitude_work'])   !!}
                                             {!! Form::hidden('longitude_work',NULL,['id' => 'longitude_work','class' => 'longitude_work']) !!}
                                            
                                            <div class="col-md-6">     
                                              {!! Form::text('autocomplete_work',NULL,['class' => 'form-control input-sm','id' => 'autocomplete_work', "onfocus"=>"geolocate()"]) !!}

                                            </div>
                                          </div>          
                                          <div class="checkbox m-l-5 m-r-10">

                                             <a href="#"  id="addWorkAddress" class="btn btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Location</a>
                                             
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                    </div>

                  

                      <div id="work_address_container">
                        @if(isset($poi->work))
                              @foreach ($poi->work as $work)


                                  <div class="row workaddress">
                                      <div class="col-md-4">
                                      {!! Form::label("Company Name", "Company Name") !!}
                                      {!! Form::text("company[]",$work->company,["class" => "form-control input-sm m-b-10","id" => "company"]) !!}
                                      </div>

                                      <div class="row">
                                        <div class="col-md-4">
                                        {!! Form::label("Period", "Period") !!}
                                        {!! Form::text("period[]",$work->period,["class" => "form-control input-sm m-b-10","id" => "period"]) !!}
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-4">
                                        {!! Form::label("Work Address", "Work Address") !!}
                                        <input name='workaddress_line_1[]' value='{{ $work->line_1 }}'type='text' class='form-control input-sm m-b-10' >
                                        </div>
                                        <div class="col-md-4">
                                        {!! Form::label("GPS Coordinates", "GPS Coordinates") !!}
                                        <input name='WorkGPS[]' value='{{ $work->gps_lat }} {{ $work->gps_lng }}' type='text' class='form-control input-sm m-b-10' >
                                        </div>
                                        <div class="col-md-4">   
                                        <a href="#" id="removeWorkAddress" onClick="removeWorkAddress(this)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i> Remove Location</a>
                                        </div>
                                      </div>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <input name='worklat[]' value='{{ $work->gps_lat }}'  type='hidden' > 
                                        <input name='worklong[]' value='{{ $work->gps_lng }}' type='hidden' >
                                      </div>
                                    </div>
                                </div>


                               @endforeach
                        @else 

                            <div id="work_address_container">

                            </div>
                        @endif
                    

                    </div>




                </div>
                </div>


                <div class="tab-pane" id="travelmovements">

                   <div class="">

                      <h3 class="block-title">TRAVEL MOVEMENTS</h3><br>

                       <div class="row">

                        <div class="col-md-6">

                            <div class="block-area" id="inline">
                                <div class="row">
                                   
                                    <div class="form-group">
                                      {!! Form::label('Enter Last Seen Location', 'Last Seen Location', array('class' => 'col-md-3 control-label')) !!}
                                      
                                       {!! Form::hidden('latitude',NULL,['id' => 'latitude','class'   => 'latitude'])   !!}
                                       {!! Form::hidden('longitude',NULL,['id' => 'longitude','class' => 'longitude']) !!}
                                      
                                      <div class="col-md-6">     
                                        {!! Form::text('autocomplete',NULL,['class' => 'form-control input-sm','id' => 'autocomplete', "onfocus"=>"geolocate()"]) !!}

                                      </div>
                                    </div>          
                                    <div class="checkbox m-l-5 m-r-10">

                                       <a href="#"  id="addLocation" class="btn btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Location</a>
                                       
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                        <div id="travel_movement_container">

                          @if(isset($poi->travelmovement))

                             @foreach ($poi->travelmovement as $movement)


                        

                             <div class="row">
                                <div class="col-md-4">
                                {!! Form::label("Travel Movement", "Travel Movement") !!}
                                <input name='travel_movement[]' value='{{$movement->name}}' type='text' class='form-control input-sm m-b-10' >
                                </div>
                                <div class="col-md-4">
                                {!! Form::label("GPS Coordinates", "GPS Coordinates") !!}
                                <input name='GPS[]' value='{{$movement->gps_lat}} {{$movement->gps_lng}}' type='text' class='form-control input-sm m-b-10' >
                                </div> 
                                <div class="col-md-4">     
                                <a href="#" id="removeLocation" onClick="removeLocation(this)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i> Remove Location</a>  
                                </div>
                                <div class="col-md-4">
                                    <div class="input-icon datetime-pick date-only">
                                      <input data-format="yyyy-MM-dd" type="text" id='date_seen' name ='date_seen[]' value='{{$movement->date_seen}}' class="form-control input-sm" />
                                      <span class="add-on">
                                          <i class="sa-plus"></i>
                                      </span>
                                   </div>
                                </div> 

                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                <input name='lat[]' value='{{$movement->gps_lat}}' type='hidden' >
                                <input name='long[]' value='{{$movement->gps_lng}}' type='hidden' >
                                </div> 
                              </div>


                              @endforeach
                          @else 
                      

                          <div id="travel_movement_container">

                          </div>

                          @endif

                        </div>
                   </div>



                </div>


                <div class="tab-pane" id="criminalrecords">

                   <div class="">
      
                      <h3 class="block-title">CRIMINAL RECORDS</h3><br>

                        <div id="criminal_record_container">

                            @if(isset($poi->criminal_records))

                               @foreach ($poi->criminal_records as $criminal)


                             
                                <div class="row">';
                                    <div class="col-md-4">';
                                        {!! Form::label("Crime Description", "Crime Description") !!}
                                        {!! Form::textarea("crime_description[]", $criminal->description, ["class" => "form-control input-sm m-b-10","id" => "crime_description","size" => "30x5"]) !!}
                                    </div> 
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    {!! Form::label("Police Station Name", "Police Station Name") !!}
                                    <input name='police_station[]' type='text' class='form-control input-sm m-b-10' value="{{ $criminal->police_station }}" >
                                  </div> 
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    {!! Form::label("Investigation Officer", "Investigation Officer") !!}
                                    <input name='investigation_officer[]' type='text' class='form-control input-sm m-b-10' value="{{ $criminal->investigation_officer }}">
                                  </div> 
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                      {!! Form::label("Investigation Offices mobile number", "Investigation Offices mobile number") !!}
                                      <input name='investigation_officer_mobile_number[]' type='text' class='form-control input-sm m-b-10' value="{{ $criminal->investigation_officer_mobile_number }}" >
                                  </div> 
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    {!! Form::label("Sentence for Crime", "Sentence for Crime") !!}
                                    {!! Form::textarea("sentence[]", $criminal->sentence , ["class" => "form-control input-sm m-b-10","id" => "sentence","size" => "30x5"]) !!}
                                  </div> 
                                </div>
                                <div class="row">
                                  <div class='col-md-4'>
                                      {!! Form::label("Conviction Date", "Conviction Date") !!}
                                      <div class="input-icon datetime-pick date-only">
                                        <input data-format="yyyy-MM-dd" type="text" name="criminal_record_date[]" class="form-control input-sm m-b-10" value="{{ $criminal->criminal_record_date }}"/>
                                        <span class="add-on">
                                          <i class="sa-plus"></i>
                                        </span>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                  {!! Form::label("Other Criminal Record", "Other Criminal Record") !!}
                                  {!! Form::select("other_criminal_record",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10" ,"id" => "other_criminal_record","onChange" => "generate_criminal_record_html(this.value)"]) !!}
                                  </div> 
                                </div>
                                
                                @endforeach

                            @else 

                             <div class="row">

                                <div class="col-md-4">

                                        {!! Form::label('Criminal Record', 'Criminal Record', array('class' => '')) !!}
                                        {!! Form::select('has_criminal_record',['0' => 'Please Select','1' => 'No','2' => 'Yes'],0,['class' => 'form-control input-sm m-b-10' ,'id' => 'has_criminal_record']) !!}
                                       
                                </div>
                            </div>
                            <div id="criminal_record_container">

                            </div>

                            @endif

                        </div>
                    </div>


                </div>




            </div>




       </div>


</div>


<div class="block-area" id="multi-column">

 
    <div class="">



        <div class="col-md-10">
            <button type="submit" class="btn btn-sm">Save Form</button>
        </div>
        {!! Form::close() !!}


</div>
</div>







<!-- Basic with panel-->


@endsection

@section('footer')
<script>
   $(document).ready(function() {


        $('.date-only').datetimepicker({
                pickTime: false
        });


    $("#has_driver_licence").change(function() {

        var selectedValue =$(this).val();
        generate_driver_licence_html(selectedValue);

        
    
    });

    $("#has__land_line_number").change(function() {

        var selectedValue =$(this).val();
        generate_land_line_html(selectedValue);
   
    
    });

      $("#has__mobile_number").change(function() {

        var selectedValue =$(this).val();
        generate_mobile_html(selectedValue);
   
    
    });


    $("#addLocation").click(function() {

        var latitude,location,longitude;

        response = {latitude:$("#latitude").val(), longitude:$("#longitude").val(),location:$("#autocomplete").val()};
        generate_travel_movement_html(response);
   
    
    });


    $("#has_criminal_record").change(function() {

        var selectedValue =$(this).val();
        generate_criminal_record_html(selectedValue);
   
    
    });

    $("#has_banking_detail").change(function() {

        var selectedValue =$(this).val();
        generate_banking_details_html(selectedValue);

    
    });



      $("#province").change(function(){

        $.get("{{ url('/api/dropdown/districts/province')}}",
        { option: $(this).val()},
        function(data) {
        $('#district').empty();
        $('#municipality').empty();
        $('#ward').empty();
        $('#district').removeAttr('disabled');
        $('#district').append("<option value='0'>Select one</option>");
        $('#municipality').append("<option value='0'>Select one</option>");
        $('#ward').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#district').append("<option value="+ key +">" + element + "</option>");
        });
        });

   })

    $("#district").change(function(){
        $.get("{{ url('/api/dropdown/municipalities/district')}}",
        { option: $(this).val() },
        function(data) {
        $('#municipality').empty();
        $('#municipality').removeAttr('disabled');
        $('#municipality').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#municipality').append("<option value="+ key +">" + element + "</option>");
        });
        });
    });

    $("#municipality").change(function(){
        $.get("{{ url('/api/dropdown/wards/municipality')}}",
        { option: $(this).val() },
        function(data) {
        $('#ward').empty();
        $('#ward').removeAttr('disabled');
        $('#ward').append("<option value='0'>Select one</option>");
        $.each(data, function(key, element) {
        $('#ward').append("<option value="+ key +">" + element + "</option>");
        });
        });
    });

    $("#has__work_address").change(function() {

        var selectedValue =$(this).val();
        generate_work_address_html(selectedValue);
   
    
    });

    $("#addWorkAddress").click(function() {

        var latitude,location,longitude;
        response = {latitude:$("#latitude_work").val(), longitude:$("#longitude_work").val(),location:$("#autocomplete_work").val()};
        generate_work_address_html(response);
   
    
    });



     $("#document_type").change(function() {

            var selectedValue =$(this).val();
           
            $(".doc_upload_image").removeClass("hidden");

           if (selectedValue == 1) {
                
                $(".idnumber").removeClass("hidden");
                $(".passportnumber").addClass("hidden");


           }

           if (selectedValue == 2) {

                $(".passportnumber").removeClass("hidden");
                $(".idnumber").addClass("hidden");
                
           }
        
    })

    $("#add-scar-pic").click( function(){

        var image_upload_template = "<tr>";
        image_upload_template +="<td>";
        image_upload_template += '<div class="fileupload fileupload-new" data-provides="fileupload">';
        image_upload_template += '<div class="fileupload-preview thumbnail form-control"></div>';
        image_upload_template += '<div>';
        image_upload_template += '<span class="btn btn-file btn-alt btn-sm">';
        image_upload_template += '<span class="fileupload-new"><i class="glyphicon glyphicon-plus"></i> Select File</span>';
        image_upload_template += '<span class="fileupload-exists">Change</span>';
        image_upload_template += '<input type="file" name="scar_file[]"/>';
        image_upload_template += '</span>';
        image_upload_template += '<a href="#" onclick=delete_row(this) class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>';
        image_upload_template += '</div>';
        image_upload_template += '</div>';
        image_upload_template += '</td>';
        image_upload_template +="<td>";
        image_upload_template +="<span><button onclick=delete_row(this) class='btn btn-primary'><i class='fa fa-trash-o fa-lg'></i> Delete</button></span>";
        image_upload_template += '</td>';
        image_upload_template += '</tr>';
        image_upload_template += '<tr>';
        image_upload_template += '<td>';
        image_upload_template += '<label>Notes</label>';
        image_upload_template += '<input type="text" name="scar_pic_note[]" class="form-control input-sm m-b-10"/>';
        image_upload_template += '</td>';
        image_upload_template += '</tr>';



          




        $("#scars_pics_table tbody").append(image_upload_template);

    });


    $("#add-tatoo-pic").click( function(){

            var image_upload_template = "<tr>";
            image_upload_template +="<td>";
            image_upload_template += '<div class="fileupload fileupload-new" data-provides="fileupload">';
            image_upload_template += '<div class="fileupload-preview thumbnail form-control"></div>';
            image_upload_template += '<div>';
            image_upload_template += '<span class="btn btn-file btn-alt btn-sm">';
            image_upload_template += '<span class="fileupload-new"><i class="glyphicon glyphicon-plus"></i> Select File</span>';
            image_upload_template += '<span class="fileupload-exists">Change</span>';
            image_upload_template += '<input type="file" name="tatoo_file[]"/>';
            image_upload_template += '</span>';
            image_upload_template += '<a href="#" onclick=delete_row(this) class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>';
            image_upload_template += '</div>';
            image_upload_template += '</div>';
            image_upload_template += '</td>';
            image_upload_template +="<td>";
            image_upload_template +="<span><button onclick=delete_row(this) class='btn btn-primary'><i class='fa fa-trash-o fa-lg'></i> Delete</button></span>";
            image_upload_template += '</td>';
            image_upload_template += '</tr>';
            image_upload_template += '<tr>';
            image_upload_template += '<td>';
            image_upload_template += '<label>Notes</label>';
            image_upload_template += '<input type="text" name="tatoo_pic_note[]" class="form-control input-sm m-b-10"/>';
            image_upload_template += '</td>';
            image_upload_template += '</tr>';
            $("#tatoos_pics_table tbody").append(image_upload_template);

    });

  })


function delete_row(node){

    $(node).closest('tr').remove();

}

function generate_driver_licence_html(val) {


       if(val == 2) {

            var driver_licence_html = "";
            driver_licence_html += "<div class='row driver_line'>";
            driver_licence_html += "<div class='col-md-4 driverlicencenumber'>";
            driver_licence_html += '{!! Form::label("Driver Licence Code", "Driver Licence Code") !!}';
            driver_licence_html += "<input name='drivers_licence[]' type='text' class='form-control input-sm m-b-10'/>";
            driver_licence_html += "</div>";
            driver_licence_html += "<div class='col-md-4 driverlicencenumber'>";
            driver_licence_html += '{!! Form::label("Date Issued", "Date Issued") !!}';
            driver_licence_html += '<div class="input-icon datetime-pick date-only">';
            driver_licence_html += '<input data-format="yyyy-MM-dd" type="text" name="drivers_licence_date_issued[]" class="form-control input-sm m-b-10" />';
            driver_licence_html += '<span class="add-on">';
            driver_licence_html += '<i class="sa-plus"></i>';
            driver_licence_html += '</span>';
            driver_licence_html += '</div>';
            driver_licence_html += "</div>";

            driver_licence_html += "<div class='col-md-4 driverlicencenumber'>";
            driver_licence_html += '{!! Form::label("Expiry Date", "Expiry Date") !!}';
            driver_licence_html += '<div class="input-icon datetime-pick date-only">';
            driver_licence_html += '<input data-format="yyyy-MM-dd" type="text" name="drivers_licence_expiry_date[]" class="form-control input-sm m-b-10" />';
            driver_licence_html += '<span class="add-on">';
            driver_licence_html += '<i class="sa-plus"></i>';
            driver_licence_html += '</span>';
            driver_licence_html += '</div>';
            driver_licence_html += "</div>";
            driver_licence_html += "<div class='col-md-4 driverlicencenumber'>";
            driver_licence_html += '{!! Form::label("Other Driver Licence", "Other Driver Licence") !!}';
            driver_licence_html += '{!! Form::select("another_driver_licence",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10 another_driver_licence" ,"id" => "another_driver_licence","onChange" => "generate_driver_licence_html(this.value)"]) !!}';
            driver_licence_html += "</div>";
            driver_licence_html += "</div>";

            $("#driver_licence_container").append(driver_licence_html);
            $('.date-only').datetimepicker({
                pickTime: false
            });


       }

           



}

function generate_land_line_html(val) {

   
     var land_line_html = "";

       if(val == 2) {

            land_line_html += "<div class='row'>";
            land_line_html += "<div class='col-md-4'>";
            land_line_html += '{!! Form::label("Land Line Number", "Land Line Number") !!}';
            land_line_html += "<input name='landline[]' type='text' class='form-control input-sm m-b-10' >";
            land_line_html += "</div>";
            land_line_html += "<div class='col-md-4'>";
            land_line_html += '{!! Form::label("Other Land Line Number", "Other Land Line Number") !!}';
            land_line_html += '{!! Form::select("another_land_line",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10 another_driver_licence" ,"id" => "another_land_line","onChange" => "generate_land_line_html(this.value)"]) !!}';
            land_line_html += "</div>";
            land_line_html += "</div>";

       
       }

       $("#landline_container").append(land_line_html);




           



}

function generate_travel_movement_html(response) {


    var work_address_html = "";

        work_address_html+='<div class="row">';

        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("Travel Movement", "Travel Movement") !!}';
        work_address_html+="<input name='travel_movement[]' value='" + response.location + "'type='text' class='form-control input-sm m-b-10' >";
        work_address_html+='</div>';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("GPS Coordinates", "GPS Coordinates") !!}';
        work_address_html+="<input name='GPS[]' value='" + response.latitude +''+ response.longitude + "'type='text' class='form-control input-sm m-b-10' >";
        work_address_html+='</div>'; 
        work_address_html+='<div class="col-md-4">';     
        work_address_html+='<a href="#" id="removeLocation" onClick="removeLocation(this)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i> Remove Location</a>';  
        work_address_html+='</div>'; 
        work_address_html+='<div class="col-md-4">'; 
        work_address_html+='<div class="input-icon datetime-pick date-only">'; 
        work_address_html+='<input data-format="yyyy-MM-dd" type="text"  name ="date_seen[]" class="form-control input-sm" />';
        work_address_html+='<span class="add-on">'; 
        work_address_html+='<i class="sa-plus"></i>'; 
        work_address_html+='</span>';
        work_address_html+='</div>';
        work_address_html+='</div>';
        work_address_html+='</div>';
        work_address_html+='<div class="row">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+="<input name='lat[]' value='"  + response.latitude  + "'type='hidden' >";
        work_address_html+="<input name='long[]' value='" + response.longitude + "'type='hidden' >";
        work_address_html+='</div>'; 
        work_address_html+='</div>';

        $("#travel_movement_container").append(work_address_html);

         $('.date-only').datetimepicker({
                pickTime: false
        });


}

function generate_mobile_html(val) {

   
     var mobile_html = "";

       if(val == 2) {

            mobile_html += "<div class='row'>";
            mobile_html += "<div class='col-md-4'>";
            mobile_html += '{!! Form::label("Mobile Number", "Mobile Number") !!}';
            mobile_html += "<input name='mobile[]' type='text' class='form-control input-sm m-b-10' >";
            mobile_html += "</div>";
            mobile_html += "<div class='col-md-4'>";
            mobile_html += '{!! Form::label("Phone Type", "Phone Type") !!}';
            mobile_html += '{!! Form::select("phone_type[]",$selectPhoneTypes,0,["class" => "form-control input-sm m-b-10 " ,"id" => "phone_type[]"]) !!}';
            mobile_html += "</div>";
            mobile_html += "</div>";
            mobile_html += "<div class='row'>";
            mobile_html += "<div class='col-md-4'>";
            mobile_html += '{!! Form::label("IMEI number", "IMEI number") !!}';
            mobile_html += "<input name='imei_number[]' type='text' class='form-control input-sm m-b-10' >";
            mobile_html += "</div>";
            mobile_html += "<div class='col-md-4'>";
            mobile_html += '{!! Form::label("Other Mobile Number", "Other Mobile Number") !!}';
            mobile_html += '{!! Form::select("another_mobile",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10 another_mobile" ,"id" => "another_mobile","onChange" => "generate_mobile_html(this.value)"]) !!}';
            mobile_html += "</div>";
            mobile_html += "</div>";

       
       }

       $("#mobile_container").append(mobile_html);


}



function generate_work_address_html(response) {

    var work_address_html = "";
        work_address_html+='<div class="row workaddress">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("Company Name", "Company Name") !!}';
        work_address_html+='{!! Form::text("company[]",NULL,["class" => "form-control input-sm m-b-10","id" => "company"]) !!}';
        work_address_html+='</div>';
        work_address_html+='<div class="row">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("Period", "Period") !!}';
        work_address_html+='{!! Form::text("period[]",NULL,["class" => "form-control input-sm m-b-10","id" => "period"]) !!}';
        work_address_html+='</div>';
        work_address_html+='</div>';
        work_address_html+='<div class="row">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("Work Address", "Work Address") !!}';
        work_address_html+="<input name='workaddress_line_1[]' value='" + response.location + "'type='text' class='form-control input-sm m-b-10' >";
        work_address_html+='</div>';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("GPS Coordinates", "GPS Coordinates") !!}';
        work_address_html+="<input name='WorkGPS[]' value='" + response.latitude +''+ response.longitude + "'type='text' class='form-control input-sm m-b-10' >";
        work_address_html+='</div>'; 
        work_address_html+='<div class="col-md-4">';     
        work_address_html+='<a href="#" id="removeWorkAddress" onClick="removeWorkAddress(this)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i> Remove Location</a>';  
        work_address_html+='</div>'; 
        work_address_html+='</div>';
        work_address_html+='<div class="row">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+="<input name='worklat[]' value='"  + response.latitude  + "'type='hidden' >";
        work_address_html+="<input name='worklong[]' value='" + response.longitude + "'type='hidden' >";
        work_address_html+='</div>'; 
        work_address_html+='</div>';

        $("#work_address_container").append(work_address_html);
        $('.date-only').datetimepicker({
                pickTime: false
        });


}

function generate_res_address_html(val) {


    var work_address_html = "";
        work_address_html+='<div class="row resaddress">';
        work_address_html+='<div class="row">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("Residential Address", "Residential Address") !!}';
        work_address_html+="<input name='resindential_line_1[]' value='" + response.location + "'type='text' class='form-control input-sm m-b-10' >";
        work_address_html+='</div>';
        work_address_html+='<div class="col-md-4">';
        work_address_html+='{!! Form::label("GPS Coordinates", "GPS Coordinates") !!}';
        work_address_html+="<input name='resGPS[]' value='" + response.latitude +''+ response.longitude + "'type='text' class='form-control input-sm m-b-10' >";
        work_address_html+='</div>'; 
        work_address_html+='<div class="col-md-4">';     
        work_address_html+='<a href="#" id="removeResAddress" onClick="removeResAddress(this)" class="btn btn-sm"><i class="fa fa-minus" aria-hidden="true"></i> Remove Location</a>';  
        work_address_html+='</div>'; 
        work_address_html+='</div>';
        work_address_html+='<div class="row">';
        work_address_html+='<div class="col-md-4">';
        work_address_html+="<input name='reslat[]' value='"  + response.latitude  + "'type='hidden' >";
        work_address_html+="<input name='reslong[]' value='" + response.longitude + "'type='hidden' >";
        work_address_html+='</div>'; 
        work_address_html+='</div>';
        work_address_html+='<hr class="whiter m-t-20" />';

        $("#res_address_container").append(work_address_html);

         $('.date-only').datetimepicker({
                pickTime: false
        });


}

 $("#addResAddress").click(function() {

        var latitude,location,longitude;
        response = {latitude:$("#latitude_res").val(), longitude:$("#longitude_res").val(),location:$("#autocomplete_res").val()};
        generate_res_address_html(response);
   
    
    });




function removeLocation(node) {

    $(node).closest('.row').remove();

}

function removeWorkAddress(node) {

    $(node).closest('.workaddress').remove();

}

function removeResAddress(node) {

    $(node).closest('.resaddress').remove();

}




function generate_criminal_record_html(val) {


    var work_address_html = "";

       if(val == 2) {

            work_address_html+='<div class="row">';
            work_address_html+='<div class="col-md-4">';
            work_address_html+='{!! Form::label("Crime Description", "Crime Description") !!}';
            work_address_html+='{!! Form::textarea("crime_description[]", null, ["class" => "form-control input-sm m-b-10","id" => "crime_description","size" => "30x5"]) !!}';
            work_address_html+='</div>'; 
            work_address_html+='</div>';
            work_address_html+='<div class="row">';
            work_address_html+='<div class="col-md-4">';
            work_address_html+='{!! Form::label("Police Station Name", "Police Station Name") !!}';
            work_address_html+="<input name='police_station[]' type='text' class='form-control input-sm m-b-10' >";
            work_address_html+='</div>'; 
            work_address_html+='</div>';
            work_address_html+='<div class="row">';
            work_address_html+='<div class="col-md-4">';
            work_address_html+='{!! Form::label("Investigation Officer", "Investigation Officer") !!}';
            work_address_html+="<input name='investigation_officer[]' type='text' class='form-control input-sm m-b-10' >";
            work_address_html+='</div>'; 
            work_address_html+='</div>';
            work_address_html+='<div class="row">';
            work_address_html+='<div class="col-md-4">';
            work_address_html+='{!! Form::label("Investigation Offices mobile number", "Investigation Offices mobile number") !!}';
            work_address_html+="<input name='investigation_officer_mobile_number[]' type='text' class='form-control input-sm m-b-10' >";
            work_address_html+='</div>'; 
            work_address_html+='</div>';
            work_address_html+='<div class="row">';
            work_address_html+='<div class="col-md-4">';
            work_address_html+='{!! Form::label("Sentence for Crime", "Sentence for Crime") !!}';
            work_address_html+='{!! Form::textarea("sentence[]", null, ["class" => "form-control input-sm m-b-10","id" => "sentence","size" => "30x5"]) !!}';
            work_address_html+='</div>'; 
            work_address_html+='</div>';
            work_address_html+='<div class="row">';
            work_address_html += "<div class='col-md-4'>";
            work_address_html += '{!! Form::label("Expiry Date", "Expiry Date") !!}';
            work_address_html += '<div class="input-icon datetime-pick date-only">';
            work_address_html += '<input data-format="yyyy-MM-dd" type="text" name="criminal_record_date[]" class="form-control input-sm m-b-10" />';
            work_address_html += '<span class="add-on">';
            work_address_html += '<i class="sa-plus"></i>';
            work_address_html += '</span>';
            work_address_html += '</div>';
            work_address_html += "</div>";
            work_address_html+='</div>';
            work_address_html+='<div class="row">';
            work_address_html+='<div class="col-md-4">';
            work_address_html+='{!! Form::label("Other Criminal Record", "Other Criminal Record") !!}';
            work_address_html+='{!! Form::select("other_criminal_record",["0" => "Please Select","1" => "No","2" => "Yes"],0,["class" => "form-control input-sm m-b-10" ,"id" => "other_criminal_record","onChange" => "generate_criminal_record_html(this.value)"]) !!}';
            work_address_html+='</div>'; 
            work_address_html+='</div>';

       }

       $("#criminal_record_container").append(work_address_html);

        $('.date-only').datetimepicker({
                pickTime: false
        });


}

</script>
@endsection
