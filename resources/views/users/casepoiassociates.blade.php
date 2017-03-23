@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('home') }}">Cases Listing</a></li>
    <li class="active">Case POI Association</li>
</ol>
<h4 class="page-title">CASE NUMBER : {{ $case->id }} </h4>

<div class="col-xs-6 col-md-4 col-lg-3">

   <a class="btn btn-alt" href="{{ url('home') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  BACK TO CASES LISTING</a>
    
</div>


<!-- Basic with panel-->
<div class="block-area" id="basic">


    <div id="chart"></div>


    <!-- Modal Default -->
    <div class="modal fade modalCaseAddAssociate" id="modalCaseAddAssociate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id=''>Add POI Associate</h4>
            </div>
           
            <div class="modal-body">

                {!! Form::open(['url' => 'add_case_poi_associate', 'method' => 'post', 'class' => '', 'id'=>"addCaseAssociateForm" ]) !!}

                    {!! Form::hidden('caseID',$case->id,['id' => 'caseID']) !!}

                    <div class="form-group">
                        <label for="">Search POI</label>
                        {!! Form::text('poi_associate',NULL,['class' => 'form-control input-sm m-b-4','id' => 'poi_associate']) !!}
                    </div>
                    
             
                    <a id='addCasePoiAssociate' class="btn btn-sm">ADD POI ASSOCIATION</a>

                {!! Form::close() !!}
               
            </div>

            <div class="modal-footer">

            </div>


        </div>
    </div>

        <!-- Modal Default -->
    <div class="modal fade modalAddAssociate" id="modalAddAssociate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id=''>Add POI Associate</h4>
                </div>
               
                <div class="modal-body">

                    {!! Form::open(['url' => 'add_poi_associate', 'method' => 'post', 'class' => '', 'id'=>"addAssociateForm" ]) !!}

                        {!! Form::hidden('poiID',NULL,['id' => 'poiID']) !!}

                        <div class="form-group">
                            <label for="">Search POI</label>
                            {!! Form::text('poi_associate',NULL,['class' => 'form-control input-sm m-b-4','id' => 'poi_associate']) !!}
                        </div>
                        
                        <div class="form-group">
                             <label for="">Type of Association</label>
                            {!! Form::text('poi_association_type',NULL,['class' => 'form-control input-sm m-b-4','id' => 'poi_association_type']) !!}

                        </div>

                        <a id='addPoiAssociate' class="btn btn-sm">ADD POI ASSOCIATION</a>

                    {!! Form::close() !!}
                   
                </div>

                <div class="modal-footer">

                </div>


            </div>
        </div>
    </div>








</div>

</div>
                
</div>

@endsection

@section('footer')

<script type="application/javascript">

    var case_id = $("#addCaseAssociateForm #caseID").val();
    var doc_ref = document.location.href;
    var doc_url = doc_ref.substring( 0, doc_ref.indexOf( "view-case-poi-associates")) ;
  
    var t = new NetChart({
        container: document.getElementById("chart"),
        area: { height: 800 },
        data: { 

            dataFunction: function(nodeList, success, error){
              
                jQuery.ajax({
                    url :"{{ url('getCasePoisAssociates/')}}/" + case_id,
                    success: success,
                    error: error});
            }

        },
        navigation: { initialNodes: ["c-m-" + case_id ], mode: "focusnodes" },
        style: {
            node: { imageCropping: true },
            nodeStyleFunction: nodeStyle,
            linkStyleFunction: linkStyle
        },
        nodeMenu: {
                     enabled: true,
                     showData: false,
                      buttons: [
                                    
                                    {
                                        text: "Add Associate",
                                        onInit: function (t, e) { e.innerHTML},
                                        onClick: function (t, e) { 

                                            var p_id = t.id;

                                            if(p_id.indexOf('c') != -1) {

                                                p_id = p_id.replace("c-m-", "");
                                            }else {

                                                p_id     = p_id.replace("m-", "");
                                            }


                                            if(p_id == case_id) {

                                                 $('#modalCaseAddAssociate').modal('toggle');
                                                 

                                            } else {

                                                                                                                                   
                                                 $('#addAssociateForm #poiID').val(p_id);
                                                 $('#modalCaseAddAssociate').modal('toggle');                                        
                                                 $('#modalAddAssociate').modal('toggle');                                           


                                            }


                                        }
                                    },
                                    {
                                        text: "View Profile",
                                        onInit: function (t, e) { e.innerHTML},
                                        onClick: function (t, e) { 
                                            var p_id = t.id;

                                            if(p_id.indexOf('c') != -1) {

                                                p_id = p_id.replace("c-m-", "");
                                            }else {

                                                p_id     = p_id.replace("m-", "");
                                            }

                                            if(p_id == case_id) {

                                                //launchCaseModal(case_id);

                                            }
                                            else {

                                                 doc_url += "edit-poi-user/" + p_id;
                                                 location.reload();
                                                 window.open(doc_url, '_blank');
                                            }
                                           
                                           
                                           

                                        }
                                    },
                                    {
                                        text: "Last Seen",
                                        onInit: function (t, e) { e.innerHTML},
                                        onClick: function (t, e) {
                                            var p_id = t.id;
                                            if(p_id.indexOf('c') != -1) {

                                                p_id = p_id.replace("c-m-", "");
                                            }else {

                                                p_id     = p_id.replace("m-", "");
                                            }



                                            if(p_id == case_id) {


                                            }else {

                                                doc_url += "poimap/" + p_id;
                                                location.reload();
                                                window.open(doc_url, '_blank');

                                            }

                                            
                                           

                                        }
                                    },

                                    "focus", 
                                    "lock",
                                    "expand"
                                ]
                    
        },
        linkMenu: {
                     enabled: true,
                     showData: false,
                     buttons: [
                                {
                                    text: "Remove Association",
                                    onClick: function (target, element) {

                                      if(target.data.type == 'Associated') {


                                        var response = confirm("Are you sure to delete case association!");
                                        if (response == true) {

                                            var formData     =  { case_id : case_id,poi_id : target.id };
                                            $.ajax({
                                                  type    :"GET",
                                                  data    : formData,
                                                  url     :"{!! url('/deleteCaseAssociation')!!}",
                                                  success : function(data){

                                                    location.reload();
                                      
                                                  }
                                                 });

                                           
                                        } 


                                      } else {
                                             

                                            var from = target.data.from;
                                             from    = from.replace("m-", "");
                                            var to   = target.data.to;
                                             to      = to.replace("m-", "");


                                            var response = confirm("Are you sure to delete poi assocation!");

                                            if (response == true) {

                                                var formData     =  { poi_id : from,associate_id : to };
                                                $.ajax({
                                                      type    :"GET",
                                                      data    : formData,
                                                      url     :"{!! url('/deleteAssociation')!!}",
                                                      success : function(data){

                                                        location.reload();
                                          
                                                      }
                                                     });

                                               
                                            } 



                                      }
                                       


                                    }
                                }
                              ]
                     
        },
        linkLabel:{
                padding: 3,
                borderRadius: 999,  
                textStyle:{font:"12px Arial", fillColor: "#09c"},
                backgroundStyle:{fillColor:"#f3f3f3", lineColor:"#09c"}
        },
        events: {
            onClick: function (event) {
                if (event.clickItem && event.clickItem.text && event.clickItem.text.indexOf("Name:") === 0) {
                    alert("You clicked on the name item.");
                }
            }
        }
});
function nodeStyle(node) {

    node.label      = node.data.name;
    var doc_ref     = document.location.href;
    var pic_doc_url = doc_ref.substring( 0, doc_ref.indexOf( "view-case-poi-associates")) ;
    node.image      = pic_doc_url + node.data.picture;
    if (node.data.type == "MAIN") {
        node.items.push({
            image: pic_doc_url + "images/icons.png",
            imageSlicing: [0, 0, 16, 16],
            px: -0.7, py: -0.7, x: 0, y: 0
        });
    } else {

         if(node.data.number_assoc >= 1) {

            node.items.push({
            image: pic_doc_url + "images/transparent.png",
            imageSlicing: [0, 0, 16, 16],
            px: -0.7, py: -0.7, x: 0, y: 0
        });


        }


    }






}
function linkStyle(link){
      
    link.label = link.data.type;
    

}
function nodeMenu(data, node) {
      return "<div>" + data.name + "</div>";
}



  $("#addCasePoiAssociate").on("click",function(){

     

        var caseID               = $("#addCaseAssociateForm #caseID").val();
        var poi_associate        = $("#addCaseAssociateForm #poi_associate").val();
        var token                = $('input[name="_token"]').val();
        var formData             = {

                                            caseID:caseID,
                                            poi_associate:poi_associate,
                                            
                                          
                                         
                                  };


        $.ajax({
        type    :"POST",
        data    : formData,
        headers : { 'X-CSRF-Token': token },
        url     :"{!! url('/addCaseAssociatePoi')!!}",
        success : function(response){

          if (response.status == 'ok') {
            $('#addCaseAssociateForm')[0].reset();

            location.reload();
           

          }

        }

      


    })

    });


</script>




@endsection



