@extends('master')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="#">Reports</a></li>
    <li class="active">Reports</li>
</ol>

<h4 class="page-title">Reports</h4>
<!-- Alternative -->
<div class="block-area" id="alternative-buttons">


<h3 class="block-title">FILTERS</h3>

{!! Form::open(['url' => '#', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>"filterReportsForm" ]) !!}
<div class="row">
      <div class="col-md-4 m-b-15">
          <p>From:</p>
          <div class="input-icon datetime-pick date-only">
              <input data-format="yyyy-MM-dd" type="text" id='fromDate' name ='fromDate' class="form-control input-sm" />
              <span class="add-on">
                  <i class="sa-plus"></i>
              </span>
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>To:</p>
          <div class="input-icon datetime-pick date-only">
              <input data-format="yyyy-MM-dd" type="text" value ="" id='toDate' name ='toDate' class="form-control input-sm" />
              <span class="add-on">
                  <i class="sa-plus"></i>
              </span>
          </div>
      </div>
</div>
<br/>

<div class="row">

      <div class="col-md-4 m-b-15">
          <p>Precinct:</p>
           <div class="p-relative">
              {!! Form::select('precinct',$selectMunicipalities,0,['class' => 'form-control input-sm' ,'id' => 'precinct']) !!}
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>Business Unit:</p>
          <div class="p-relative">
              {!! Form::select('department',$selectDepartments,0,['class' => 'form-control input-sm' ,'id' => 'department']) !!}
          </div>
      </div>

</div>

<br/>

<div class="row">

      <div class="col-md-4 m-b-15">
          <p>Category:</p>
           <div class="p-relative">
              {!! Form::select('category',$selectCategories,0,['class' => 'form-control input-sm' ,'id' => 'category']) !!}
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>Status:</p>
          <div class="p-relative">
              {!! Form::select('status',[
                                          '0'                 => 'Select / All',
                                          'Pending'           => 'Pending',
                                          'Pending Closure'   => 'Pending Closure',
                                          'Referred'          => 'Referred',
                                          'Resolved'          => 'Resolved'
                                        ],0,['class' => 'form-control input-sm' ,'id' => 'status']) !!}
          </div>
      </div>

      <div class="col-md-4 m-b-15">
          <p>Reporter:</p>
           <div class="p-relative">
              {!! Form::select('reporter',$selectReporters,0,['class' => 'form-control input-sm' ,'id' => 'reporter']) !!}
          </div>
      </div>

</div>

<br/>

<br/>


  <div class="row">

      <div class="col-md-4 m-b-15">
          <p>Type of Report:</p>
           <div class="p-relative">
              {!! Form::select('typeReporter',['1' => "Tabular Report",'2' => "Pie Chart Report"],0,['class' => 'form-control input-sm' ,'id' => 'typeReporter']) !!}
          </div>
      </div>

        <div class="col-md-4 m-b-15">
            <p></p><br/>
            <div class="p-relative">
                   <a type="#" id='submitFilters' class="btn btn-sm">Generate Report</a>
           </div>
        </div>


</div>
{!! Form::close() !!}

</div>



<!-- Responsive Table -->
<div class="block-area hidden" id="responsiveTable">


    <h3 class="block-title">Toggle columns</h3>

    <div>
        Toggle column:
        <a class="toggle-vis" data-column="0">ID</a>
        -
        <a class="toggle-vis" data-column="1">Created At</a>
        -
        <a class="toggle-vis" data-column="2">Description</a>
        -
        <a class="toggle-vis" data-column="3">Business Unit</a>
        -
        <a class="toggle-vis" data-column="4">Precinct</a>
        -
        <a class="toggle-vis" data-column="5">Reporter</a>
        -
        <a class="toggle-vis" data-column="6">Category</a>
        -
        <a class="toggle-vis" data-column="7">Priority</a>
        -
        <a class="toggle-vis" data-column="8">Severity</a>
        -
        <a class="toggle-vis" data-column="9">Status</a>
    </div>
    <br/>

    <h3 class="block-title">Export options</h3>

    <div class="table-responsive overflow">
        <table class="table tile table-striped" id="reportsTable">
            <thead>
              <tr>
                    <th>Id</th>
                    <th>Created At</th>
                    <th>Description </th>
                    <th>Precinct</th>
                    <th>Business Unit</th>
                    <th>Reporter</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Severity</th>
                    <th>Status</th>
              </tr>
            </thead>

        </table>
    </div>

</div>

<br/>
<!-- <div class="block-area">
  <div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h2 class="tile-title">Pie Chart</h2>
            <div class="tile-config dropdown">
                <a data-toggle="dropdown" href="" class="tooltips tile-menu" title="Options"></a>
                <ul class="dropdown-menu pull-right text-right">
                    <li><a href="">Refresh</a></li>
                    <li><a href="">Settings</a></li>
                </ul>
            </div>
            <div class="p-10">
                <div id="pie-chart" class="main-chart" style="height: 300px"></div>
            </div>
        </div>
    </div>
  </div>
 </div>
 -->
@endsection

@section('footer')

 <script>
 $(document).ready(function() {

  var defaultDate = $.datepicker.formatDate('yy-mm-dd', new Date());
  $("#fromDate").val(defaultDate);
  $("#toDate").val(defaultDate);
  var oReportsTable;

  });


</script>
@endsection
