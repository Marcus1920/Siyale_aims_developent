@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li><a href="{{ url('list-poi-users') }}">POI Listing</a></li>
    <li class="active">POI Edit Form</li>
</ol>
<h4 class="page-title">PERSONS OF INTEREST ASSOCIATES : {{ $poi->name }} {{ $poi->surname }}</h4>

<div class="col-xs-6 col-md-4 col-lg-3">

   <a class="btn btn-alt" href="{{ url('list-poi-users') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  BACK TO POI LISTING</a>
    
</div>


<!-- Basic with panel-->
<div class="block-area" id="basic">


    <div id="chart"></div>


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

                        {!! Form::hidden('poiID',$poi->id,['id' => 'poiID']) !!}

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

@endsection

@section('footer')

<script>

    var poi_user_id = $("#addAssociateForm #poiID").val();
    var doc_ref     = document.location.href;
    var doc_url     = doc_ref.substring( 0, doc_ref.indexOf( "view-poi-associates")) ;
  


var t = new NetChart({
        container: document.getElementById("chart"),
        area: { height: 800 },
        data: { 

            dataFunction: function(nodeList, success, error){
              
                jQuery.ajax({
                    url :"{{ url('getPoisAssociates/')}}/" + poi_user_id,
                    success: success,
                    error: error});
            }

        },
        navigation: { initialNodes: ["m-" + poi_user_id ], mode: "focusnodes" },
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

                                            $('#modalAddAssociate').modal('toggle');                                           

                                        }
                                    },
                                    {
                                        text: "View Profile",
                                        onInit: function (t, e) { e.innerHTML},
                                        onClick: function (t, e) { 
                                            var p_id = t.id;
                                            p_id     = p_id.replace("m-", "");
                                            doc_url += "edit-poi-user/" + p_id;
                                            location.reload();
                                            window.open(doc_url, '_blank');
                                           

                                        }
                                    },
                                    {
                                        text: "Last Seen",
                                        onInit: function (t, e) { e.innerHTML},
                                        onClick: function (t, e) { 
                                            var p_id = t.id;
                                            p_id     = p_id.replace("m-", "");
                                            doc_url += "poimap/" + p_id;
                                            location.reload();
                                            window.open(doc_url, '_blank');
                                           

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
                                       
                                        var response = confirm("Are you sure to delete assocation!");
                                        if (response == true) {

                                            var formData     =  { poi_id : poi_user_id,associate_id : target.id };
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
    var pic_doc_url = doc_ref.substring( 0, doc_ref.indexOf( "view-poi-associates")) ;
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


</script>



</script>
@endsection
