<?php
namespace App\Http\Controllers;
ini_set("memory_limit","256M");



use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\PoiRequest;
use App\Http\Controllers\Controller;
use App\UserRole;
use App\User;
use App\Position;
use App\Province;
use App\District;
use App\Municipality;
use App\Ward;
use App\Department;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\Title;
use App\Language;
use App\CaseResponder;
use App\UserStatus;
use App\Poi;
use App\PoiBankDetail;
use App\Bank;
use App\PoiAssociate;
use App\PoiPicture;
use App\PoiPictureType;
use App\PoiDriverLicence;
use App\PoiContactNumber;
use App\PoiAddress;
use App\PoiTravelMovement;
use App\PoiCriminalRecord;
use App\Affiliation;
use App\CaseReport;
use App\CasePoi;
use App\PoiVehicle;



class UserController extends Controller
{

     private $user;


    public function __construct(User $user)
    {

        $this->user = $user;

    }

     public function list_users()
    {

        $userAddUserPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',31)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

        return view('users.list',compact('userAddUserPermission'));

    }






    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

       $userEditUserPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',32)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();



        $users = \DB::table('users')
                        ->join('users_statuses', 'users.active', '=', 'users_statuses.id')
                        ->join('positions', 'users.position', '=', 'positions.id')
                        ->select(
                                    \DB::raw(
                                        "
                                         users.id,
                                         users.created_at,
                                         users.name,
                                         users.surname,
                                         users.email,
                                         users.cellphone,
                                         users_statuses.name as active,
                                         positions.name as position
                                        "
                                      )
                                );


                           return \Datatables::of($users)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateUserModal({{$id}});" data-target=".modalEditUser" >Edit</a>


                                        '
                                )->make(true);




     /*   return \Datatables::of($users)
                            ->addColumn('actions',function() use ($userEditUserPermission){
                              if(isset($userEditUserPermission) && $userEditUserPermission->permission_id =="32")
                              {
                                  return '

                                    <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateUserModal({{$id}});" data-target=".modalEditUser" >Edit</a>

                                        ';


                              }


                              }

                                )->make(true);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function responder()
    {
        $searchString = \Input::get('q');
        $contacts     = \DB::table('users')
            ->join('positions','users.position','=','positions.id')
            ->join('departments','users.department','=','departments.id')
            ->whereRaw("CONCAT(`users`.`name`, ' ', `users`.`surname`, ' ', `users`.`email`,' ', `positions`.`name`,' ', `departments`.`name`) LIKE '%{$searchString}%'")
            ->select(\DB::raw("
                               `users`.`id`,
                               `users`.`name`,
                               `users`.`surname`,
                               `users`.`email`,
                               `users`.`cellphone`,
                               `positions`.`name` as position,
                               `departments`.`name` as department

                              "))
            ->get();

        $data = array();

        if(count($contacts) > 0)
        {

           foreach ($contacts as $contact) {
            $data[]= array("name"=>"{$contact->name} {$contact->surname}<{$contact->cellphone}<'{$contact->position}'<'{$contact->department}'","id" =>"{$contact->id}");
           }


        }

        return $data;
    }


    public function getResponders(Request $request)
    {

        $subCategory        = $request['sub_category'];
        $subSubCategory     = $request['sub_sub_category'];


        if (sizeof($subSubCategory) > 0 && $subSubCategory != '0') {



          $objSubSubCategory     = SubSubCategory::where('slug','=',$subSubCategory)->first();
          $objSubCategory        = SubCategory::find($objSubSubCategory->id);
          $objCaseResponder      = CaseResponder::where('category','=',$objSubCategory->category)
                                                  ->where('sub_category','=',$objSubSubCategory->sub_category)
                                                  ->where('sub_sub_category','=',$objSubSubCategory->id)
                                                  ->first();


        if ( sizeof($objCaseResponder) > 0) {


          $firstResponders      = explode(",",$objCaseResponder->first_responder);
          $response             = array();


          foreach ($firstResponders as $firstResponder) {


             $user = \DB::table('users')
                        ->join('departments', 'users.department', '=', 'departments.id')
                        ->join('positions','users.position','=','positions.id')
                        ->where('users.id','=',$firstResponder)
                        ->select(\DB::raw(
                                    "
                                    `users`.`id`,
                                    `users`.`email`,
                                    (select CONCAT(`users`.`name`, ' ',`users`.`surname`) ) as names,
                                    `departments`.`name` as department,
                                    `positions`.`name` as position

                                    "
                                      )
                                )->first();

            $response[] = $user;

        }

        return $response;


        }


        }


        if (sizeof($subCategory) > 0 && sizeof($subSubCategory) == 0) {


            $objSubCategory = SubCategory::where('slug','=',$subCategory)->first();


            $allSubsCats    = SubCategory::where('name','=',$objSubCategory->name)->get();


            $response        = array();

            foreach ($allSubsCats as $sub_sub_cat) {


                $objCaseResponder   = CaseResponder::where('category','=',$sub_sub_cat->category)
                                            ->where('sub_category','=',$sub_sub_cat->id)
                                            ->first();



                if ( sizeof($objCaseResponder) > 0 && $objCaseResponder->sub_sub_category == 0) {



                    $firstResponders = explode(",",$objCaseResponder->first_responder);


                     foreach ($firstResponders as $firstResponder) {


                       $user = \DB::table('users')
                                  ->join('departments', 'users.department', '=', 'departments.id')
                                  ->join('positions','users.position','=','positions.id')
                                  ->where('users.id','=',$firstResponder)
                                  ->select(\DB::raw(
                                              "
                                              `users`.`id`,
                                              `users`.`email`,
                                              (select CONCAT(`users`.`name`, ' ',`users`.`surname`) ) as names,
                                              `departments`.`name` as department,
                                              `positions`.`name` as position

                                              "
                                                )
                                          )->first();

                      $response[] = $user;

                      }



              }






            }

            return $response;


        }



    }

     public function getPois(Request $request)
    {

      $objPois      = Poi::all();


        if ( sizeof($objPois) > 0) {


        $response             = array();


          foreach ($objPois as $objPoi) {



            $response[] = $objPoi;

        }

        return $response;


        }


       
    }


    public function getPoisAssociates($id,$responseJson = TRUE)
    {
        
        $response             = array();
        $responseNodes        = array();
        $responseLinks        = array();
        $nodeObj              = new \stdClass();
        $response             = $this->main_associate($id,$responseNodes,$responseLinks);
        $nodes_array["nodes"] = array_merge($responseNodes,$response["nodes"]);
        $nodes_array["links"] = array_merge($responseNodes,$response["links"]);
        $nodeObj->nodes       = array_merge($responseNodes,$response["nodes"]);
        $nodeObj->links       = array_merge($responseLinks,$response["links"]);

        if($responseJson) {

           return \Response::json($nodeObj);

        } else {

           return $nodes_array;

        }

    }



    public function getCasePoisAssociates($case_id,$responseJson = TRUE)
    {

        
        $response             = array();
        $responseNodes        = array();
        $responseLinks        = array();
        $nodeObj              = new \stdClass();
        $response             = $this->main_case_associate($case_id,$responseNodes,$responseLinks);
        $nodes_array["nodes"] = array_merge($responseNodes,$response["nodes"]);
        $nodes_array["links"] = array_merge($responseNodes,$response["links"]);
        $nodeObj->nodes       = array_merge($responseNodes,$response["nodes"]);
        $nodeObj->links       = array_merge($responseLinks,$response["links"]);

        
        if($responseJson) {

           return \Response::json($nodeObj);

        } else {

           return $nodes_array;

        }

    }


    public function getPoiCaseAssociates($case_id,$responseJson = TRUE,$poi_id)
    {

      
       
        $response             = array();
        $responseNodes        = array();
        $responseLinks        = array();
        $nodeObj              = new \stdClass();
        $response             = $this->main_poi_case_associate($case_id,$responseNodes,$responseLinks,$poi_id);


        if(sizeof($response) > 0) {

          $nodes_array["nodes"] = array_merge($responseNodes,$response["nodes"]);
          $nodes_array["links"] = array_merge($responseNodes,$response["links"]);


        } else {


          $nodes_array["nodes"] = $responseNodes;
          $nodes_array["links"] = $responseNodes;

        }


       
        $nodeObj->nodes       = $nodes_array["nodes"];
        $nodeObj->links       = $nodes_array["links"];

        
        if($responseJson) {

           return \Response::json($nodeObj);

        } else {

           return $nodes_array;

        }

    }

    public function getPoiCasesAssociates($poi_id)
    {

        $response       = array();
        $responseNodes  = array();
        $responseLinks  = array();
        $nodeObj        = new \stdClass();
        $response       = $this->main_poi_cases_associate($poi_id,$responseNodes,$responseLinks);
        $nodeObj->nodes = array_merge($responseNodes,$response["nodes"]);
        $nodeObj->links = array_merge($responseLinks,$response["links"]);
        return \Response::json($nodeObj);

    }

    public function main_poi_cases_associate($poi_id,$responseNodes,$responseLinks) {

       
        $result           = array();
        $poi              = Poi::find($poi_id);
        $poipicture       = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',1)->first();
        $associates_nodes = array();
        

        if(sizeof($poi) > 0) {
          
          $userObj          = new \stdClass();
          $userObj->id      = "m-".$poi->id;
          $userObj->name    = $poi->name." ".$poi->surname;
          $userObj->picture = $poipicture->poi_picture_url;
          $userObj->type    = "MAIN"; 
          $userObj->loaded  = TRUE;
          $responseNodes[]  = $userObj;   
          $main["nodes"]    = $responseNodes;
          $main["links"]    = $responseLinks;


        }


        $poi_cases_associations = $this->get_poi_cases_associatios($poi_id);

        if(sizeof($poi_cases_associations["nodes"]) > 0) {

          $associates_nodes["nodes"] = array_merge($poi_cases_associations["nodes"],$main["nodes"]);

        } else {

          $associates_nodes["nodes"] = array_merge($main["nodes"]);

        }

        if(sizeof($poi_cases_associations["links"]) > 0) {

            $associates_nodes["links"] = array_merge($poi_cases_associations["links"],$main["links"]);

        
        } else {

            $associates_nodes["links"] = array_merge($main["links"]);

        }
        


         return $associates_nodes;




    }


    public function poi_associatios_cases($poi,$case) {


      $responseNodes        = array();
      $responseLinks        = array();
      $response             = array();
      $nodes                = array();
      $links                = array();

      $cases = CasePoi::where('poi_id',$poi)->where('case_id','<>',$case)->get();

      if(sizeof($cases) > 0) {


        foreach ($cases as $case) {

            $result          = $this->construct_poi_case_associate_object($case);


            $responseNodes[] = $result["nodeObj"];
            $responseLinks[] = $result["linkObj"];

        
         
        
        }



        $nodes[] = $responseNodes;
        $links[] = $responseLinks;

        foreach ($nodes as $node) {

             foreach ($node as $value) {
               
                 $n[] = $value;
             }
                 
                    
          }

        foreach ($links as $link) {

             foreach ($link as $value) {
               
                 $l[] = $value;
             }
           
              
         }

          $uniqueNodes = array();
          foreach ($n as $object) {
              if (isset($uniqueNodes[$object->id])) {
                  continue;
              }
              $uniqueNodes[$object->id] = $object;
          }

          $nodeFinal = array();
          foreach ($uniqueNodes as $item) {

              $nodeFinal[] = $item;

          }


          $uniqueLinks = array();
          foreach ($l as $object) {
              if (isset($uniqueLinks[$object->id])) {
                  continue;
              }
              $uniqueLinks[$object->id] = $object;
          }

          $linkFinal = array();
          foreach ($uniqueLinks as $item) {

              $linkFinal[] = $item;

          }

        $response["nodes"] = $nodeFinal;
        $response["links"] = $linkFinal;


     

        } else {

            $response["nodes"] = $responseNodes;
            $response["links"] = $responseLinks;


        }


    
        return $response;


          

         





      }

    


    public function get_poi_cases_associatios($poi_id) {



      $objCasePoiAssociates = CasePoi::where('poi_id',$poi_id)->get();//59,56  


      
      $responseNodes        = array();
      $responseLinks        = array();
      $response             = array();
      $nodes                = array();
      $links                = array();
     

      $count = 0;


        if(sizeof($objCasePoiAssociates) > 0) {

            foreach ($objCasePoiAssociates as $CasePoiAssociate) {

                  $result          = $this->construct_poi_case_associate_object($CasePoiAssociate);
                  $responseNodes[] = $result["nodeObj"];
                  $responseLinks[] = $result["linkObj"];
                  $poi_associates  = array();
                  $poi_associates  = $this->getPoiCaseAssociates($CasePoiAssociate->case_id,FALSE,$poi_id);



                  //get all people related to that cases

                  if(sizeof($poi_associates) > 0) {
                    
                    $nodes[]  = $poi_associates['nodes'];
                    $links[]  = $poi_associates['links'];

                  } 

    
                 
                  $count++;

                
              
            }

           

            $nodes[] = $responseNodes;
            $links[] = $responseLinks;

            

          




     


    
             foreach ($nodes as $node) {

                 foreach ($node as $value) {
                   
                     $n[] = $value;
                 }
               
                  
             }

            foreach ($links as $link) {

                 foreach ($link as $value) {
                   
                     $l[] = $value;
                 }
               
                  
             }

            $uniqueNodes = array();
            foreach ($n as $object) {
                if (isset($uniqueNodes[$object->id])) {
                    continue;
                }
                $uniqueNodes[$object->id] = $object;
            }

            $nodeFinal = array();
            foreach ($uniqueNodes as $item) {

                $nodeFinal[] = $item;

            }




            $uniqueLinks = array();
            foreach ($l as $object) {
                if (isset($uniqueLinks[$object->id])) {
                    continue;
                }
                $uniqueLinks[$object->id] = $object;
            }

            $linkFinal = array();
            foreach ($uniqueLinks as $item) {

                $linkFinal[] = $item;

            }

        

              $response["nodes"] = $nodeFinal;
              $response["links"] = $linkFinal;


     

        } else {

            $response["nodes"] = $responseNodes;
            $response["links"] = $responseLinks;


        }


    
        return $response;


    }

    public function construct_poi_case_associate_object($CasePoiAssociate) {


        
        $userObj             = new \stdClass();
        $userObj->id         = "c-m-".$CasePoiAssociate->case_id;
        $userObj->name       = "Case Number: ".$CasePoiAssociate->case_id;
        $userObj->picture    = "images/poi/profile/node-icons-case.png";
        $userObj->type       = "Poi Association"; 
        $userObj->loaded     = TRUE;
        $linkObj             = new \stdClass();
        $linkObj->id         = $CasePoiAssociate->case_id;
        $linkObj->from       = "m-". $CasePoiAssociate->poi_id;
        $linkObj->to         = "c-m-". $CasePoiAssociate->case_id;
        $linkObj->type       = "Associated";
        $response["nodeObj"] = $userObj;
        $response["linkObj"] = $linkObj;


        return $response;
              


    }







    public function main_case_associate($case_id,$responseNodes,$responseLinks) {


        $result        = array();
        $case          = CaseReport::find($case_id);

        if(sizeof($case) > 0) {
          
          $userObj          = new \stdClass();
          $userObj->id      = "c-m-".$case->id;
          $userObj->name    = "Case Number: ".$case->id;
          $userObj->picture = "images/poi/profile/node-icons-case.png";
          $userObj->type    = "MAIN"; 
          $userObj->loaded  = TRUE;
          $responseNodes[]  = $userObj;   
          $main["nodes"]    = $responseNodes;
          $main["links"]    = $responseLinks;


        }

        $case_poi_associates = $this->get_case_my_associates($case_id);



    

        if(sizeof($case_poi_associates["nodes"]) > 0) {

          $associates_nodes["nodes"] = array_merge($case_poi_associates["nodes"],$main["nodes"]);

        } else {

          $associates_nodes["nodes"] = array_merge($main["nodes"]);

        }

        if(sizeof($case_poi_associates["links"]) > 0) {

            $associates_nodes["links"] = array_merge($case_poi_associates["links"],$main["links"]);

        
        } else {

            $associates_nodes["links"] = array_merge($main["links"]);

        }
        


         return $associates_nodes;

    }

    public function main_poi_case_associate($case_id,$responseNodes,$responseLinks,$poi_id) {


        $result           = array();
        $case             = CaseReport::find($case_id);
        $associates_nodes = array();



        $case_poi_associates = $this->get_poi_case_my_associates($case_id,$poi_id);

        if(sizeof($case_poi_associates["nodes"]) > 0) {

          $associates_nodes["nodes"] = $case_poi_associates["nodes"];

        }

        if(sizeof($case_poi_associates["links"]) > 0) {

            $associates_nodes["links"] = $case_poi_associates["links"];

        
        }  


         return $associates_nodes;

    }

    public function get_case_my_associates($case_id) {

      $objCasePoiAssociates = CasePoi::where('case_id',$case_id)->get();
      $responseNodes        = array();
      $responseLinks        = array();
      $response             = array();
      $nodes                = array();
      $links                = array();
        $poids              = array();


        if(sizeof($objCasePoiAssociates) > 0) {

            foreach ($objCasePoiAssociates as $CasePoiAssociate) {

                 $poids[]          = $CasePoiAssociate->poi_id;
                  $result          = $this->construct_case_associate_objects($CasePoiAssociate);
                  $responseNodes[] = $result["nodeObj"];
                  $responseLinks[] = $result["linkObj"];
                  $poi_associates  = $this->getPoisAssociates($CasePoiAssociate->poi_id,FALSE);
                  $nodes[]         = array_merge($poi_associates['nodes']);
                  $links[]         = array_merge($poi_associates['links'],$responseLinks);
                
              
            }



             foreach ($nodes as $node) {

                 foreach ($node as $value) {

                     $n[] = $value;
                 }


             }


            $unique = array();
            foreach ($n as $object) {
                if (isset($unique[$object->id])) {
                    continue;
                }
                $unique[$object->id] = $object;
            }

            $nodeFinal = array();
            foreach ($unique as $item) {

                $nodeFinal[] = $item;

            }

            foreach ($links as $link) {

                 foreach ($link as $value) {
                   
                     $l[] = $value;
                 }
               
                  
             }

            $uniqueLinks = array();
            foreach ($l as $object) {
                if (isset($uniqueLinks[$object->id])) {
                    continue;
                }
                $uniqueLinks[$object->id] = $object;
            }

            $linkFinal = array();
            foreach ($uniqueLinks as $item) {

                $linkFinal[] = $item;

            }

              $response["nodes"] = array_merge($nodeFinal);
              $response["links"] = array_merge($linkFinal);
     

        } else {

            $response["nodes"] = $responseNodes;
            $response["links"] = $responseLinks;


        }

        return $response;


    }


    public function get_poi_case_my_associates($case_id,$poi_id) {




      $objCasePoiAssociates = CasePoi::where('case_id',$case_id)->where('poi_id','<>',$poi_id)->get(); 


      $responseNodes        = array();
      $responseLinks        = array();
      $response             = array();
      $nodes                = array();
      $links                = array();


        if(sizeof($objCasePoiAssociates) > 0) {

            foreach ($objCasePoiAssociates as $CasePoiAssociate) {

                  $result          = $this->construct_case_associate_objects($CasePoiAssociate);
                  $responseNodes[] = $result["nodeObj"];
                  $responseLinks[] = $result["linkObj"];
                  $poiCases        = array(); 
                  $poiCases        = $this->getCasePois($CasePoiAssociate->case_id,$CasePoiAssociate->poi_id,$poi_id);



                
                 
                  

                  if(sizeof($poiCases) > 0) {
                  
                  
                    $nodes[]          = $poiCases['nodes'];
                    $links[]          = $poiCases['links'];
                  }

                 

                
              
            }


           
          $n = array();
          $l = array();
          

             foreach ($nodes as $node) {

                 foreach ($node as $value) {
                   
                     $n[] = $value;
                 }
               
                  
             }

            foreach ($links as $link) {

                 foreach ($link as $value) {
                   
                     $l[] = $value;
                 }
               
                  
             }

            $uniqueNodes = array();
            foreach ($n as $object) {
                if (isset($uniqueNodes[$object->id])) {
                    continue;
                }
                $uniqueNodes[$object->id] = $object;
            }

            $nodeFinal = array();
            foreach ($uniqueNodes as $item) {

                $nodeFinal[] = $item;

            }


            $uniqueLinks = array();
            foreach ($l as $object) {
                if (isset($uniqueLinks[$object->id])) {
                    continue;
                }
                $uniqueLinks[$object->id] = $object;
            }


            $linkFinal = array();
            foreach ($uniqueLinks as $item) {

                $linkFinal[] = $item;

            }

            $response["nodes"] = $nodeFinal;
            $response["links"] = $linkFinal;

          

            
     

        } else {

            $response["nodes"] = $responseNodes;
            $response["links"] = $responseLinks;


        }

       

        return $response;


    }


    public function getCasePois($case_id,$poi,$poi_id) {


      //Get all case associates
    
      $cases               = CasePoi::where("case_id",$case_id)->where("poi_id",'<>',$poi_id)->get();   
      $parentResponseNodes = array();
      $parentResponseLinks = array();
      $associates_nodes    = array();


      foreach ($cases as $case) {
        

             $response              = array();
             $poiObj                = Poi::find($case->poi_id);
             $poipicture            = PoiPicture::where('poi_id',$poiObj->id)->where('poi_picture_type',1)->first();
             $userObj               = new \stdClass();
             $userObj->id           = "m-".$poiObj->id;
             $userObj->name         = $poiObj->name." ".$poiObj->surname;
             $userObj->picture      = $poipicture->poi_picture_url;
             $userObj->type         = "Case Association";
             $userObj->loaded       = TRUE;
             $linkObj               = new \stdClass();
             $linkObj->id           = $poiObj->id;
             $linkObj->from         = "c-m-". $case_id;
             $linkObj->to           = "m-". $poiObj->id;
             $linkObj->type         = "Associated";
             $parentResponseNodes[] = $userObj;
             $parentResponseLinks[] = $linkObj;

             
             $childrenNodes         = $this->poi_associatios_cases($poiObj->id,$case->case_id);

             if(sizeof($childrenNodes) > 0) {

                  foreach ($childrenNodes['nodes'] as $assoc) {

                   $parentResponseNodes[] = $assoc;

                  }

                  foreach ($childrenNodes['links'] as $link) {

                   $parentResponseLinks[] = $link;


                  }

             }



            


      }



    if(sizeof($parentResponseNodes) > 0) {

       $associates_nodes["nodes"] = $parentResponseNodes;

    }

     if(sizeof($parentResponseLinks) > 0) {

       $associates_nodes["links"] = $parentResponseLinks;

    }


            

      

    return $associates_nodes;



    
    }


  public function construct_case_associate_objects($CasePoiAssociate) {

        $response            = array();
        $poiObj              = Poi::find($CasePoiAssociate->poi_id);
        $poipicture          = PoiPicture::where('poi_id',$poiObj->id)->where('poi_picture_type',1)->first();
        $userObj             = new \stdClass();
        $userObj->id         = "m-".$poiObj->id;
        $userObj->name       = $poiObj->name." ".$poiObj->surname;
        $userObj->picture    = $poipicture->poi_picture_url;
        $userObj->type       = "Case Association";
        $userObj->loaded     = TRUE;
        $linkObj             = new \stdClass();
        $linkObj->id         = $poiObj->id;
        $linkObj->from       = "c-m-". $CasePoiAssociate->case_id;
        $linkObj->to         = "m-". $poiObj->id;
        $linkObj->type       = "Associated";
        $response["nodeObj"] = $userObj;
        $response["linkObj"] = $linkObj;

        return $response;
              


    }



    public function main_associate($id,$responseNodes,$responseLinks) {


        $result        = array();
        $poi           = Poi::find($id);
        $poipicture    = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',1)->first();
        

        if(sizeof($poi) > 0) {
          
          $userObj          = new \stdClass();
          $userObj->id      = "m-".$poi->id;
          $userObj->name    = $poi->name." ".$poi->surname;
          $userObj->picture = $poipicture->poi_picture_url;
          $userObj->type    = "MAIN"; 
          $userObj->loaded  = TRUE;
          $responseNodes[]  = $userObj;   
          $main["nodes"]    = $responseNodes;
          $main["links"]    = $responseLinks;


        }


        $associates = $this->get_my_associates($poi->id);
        $parentObjs = PoiAssociate::where("associate_id",$id)->get();
        

        $count               = 0;
        $parentResponseNodes = array();
        $parentResponseLinks = array();

        foreach ($parentObjs as $parent) {


             $response              = array();
             $poiObj                = Poi::find($parent->poi_id);
             $poipicture            = PoiPicture::where('poi_id',$poiObj->id)->where('poi_picture_type',1)->first();
             $userObj               = new \stdClass();
             $userObj->id           = "m-".$poiObj->id;
             $userObj->name         = $poiObj->name." ".$poiObj->surname;
             $userObj->picture      = $poipicture->poi_picture_url;
             $userObj->type         = $parent->association_type;
             $userObj->loaded       = TRUE;
             $linkObj               = new \stdClass();
             $linkObj->id           = $poiObj->id;
             $linkObj->from         = "m-". $parent->associate_id;
             $linkObj->to           = "m-". $parent->poi_id;
             $linkObj->type         = $parent->association_type;
             $parentResponseNodes[] = $userObj;
             $parentResponseLinks[] = $linkObj;
              
             $parent_associates     = $this->get_my_associates($parent->poi_id,$parent->associate_id);
            

            foreach ($parent_associates['nodes'] as $assoc) {

             $parentResponseNodes[] = $assoc;

            }

            foreach ($parent_associates['links'] as $link) {

             $parentResponseLinks[] = $link;


            }


          
        }
        
        if(sizeof($associates["nodes"]) > 0) {

          $associates_nodes["nodes"] = array_merge($associates["nodes"],$main["nodes"]);

          if(sizeof($parentResponseNodes) > 0) {

             $associates_nodes["nodes"] = array_merge($associates["nodes"],$main["nodes"],$parentResponseNodes);

          }


        } else {

            $associates_nodes["nodes"] = array_merge($main["nodes"]);


            if(sizeof($parentResponseNodes) > 0) {

               $associates_nodes["nodes"] = array_merge($main["nodes"],$parentResponseNodes);


            }



        }


        if(sizeof($associates["links"]) > 0) {

          $associates_nodes["links"] = array_merge($associates["links"],$main["links"]);

          if(sizeof($parentResponseLinks) > 0) {

             $associates_nodes["links"] = array_merge($associates["links"],$main["links"],$parentResponseLinks);

          }


        } else {

            $associates_nodes["links"] = array_merge($main["links"]);


            if(sizeof($parentResponseLinks) > 0) {

               $associates_nodes["links"] = array_merge($main["links"],$parentResponseLinks);


            }



        }

      

        return $associates_nodes;

    }

    public function get_my_associates($poId,$exception = 0) {

      $objAssociates = PoiAssociate::where('poi_id',$poId)->get();
     
       if ($exception > 0) {
  
          $objAssociates = PoiAssociate::where('poi_id',$poId)->where('associate_id','<>',$exception)->get();

       }


        $responseNodes = array();
        $responseLinks = array();
        $response      = array();
        //$nodesArray    = array();

        if(sizeof($objAssociates) > 0) {

            foreach ($objAssociates as $associate) {

                  $result          = $this->construct_associate_objects($associate);
                  $responseNodes[] = $result["nodeObj"];
                  $responseLinks[] = $result["linkObj"];
                  $associates      = $this->get_my_associates($associate->associate_id,$exception);
                  if(sizeof($associates['nodes']) > 0){


                      $responseNodes = array_merge($responseNodes,$associates['nodes']);
                      $responseLinks = array_merge($responseLinks,$associates['links']);


                  }


            }



                $response["nodes"] = array_merge($responseNodes);
                $response["links"] = array_merge($responseLinks);
     

        } else {

            $response["nodes"] = $responseNodes;
            $response["links"] = $responseLinks;



        }

        return $response;


    }

    public function construct_associate_objects($associate) {


        $numberAssoc = PoiAssociate::where('poi_id',$associate->associate_id)->get()->count();

        
        $response              = array();
        $poiObj                = Poi::find($associate->associate_id);
        $poipicture            = PoiPicture::where('poi_id',$poiObj->id)->where('poi_picture_type',1)->first();
        $userObj               = new \stdClass();
        $userObj->id           = "m-".$poiObj->id;
        $userObj->name         = $poiObj->name." ".$poiObj->surname;
        $userObj->picture      = $poipicture->poi_picture_url;
        $userObj->type         = $associate->association_type;
        $userObj->number_assoc = $numberAssoc;
        
        $userObj->loaded       = TRUE;
        $linkObj               = new \stdClass();
        $linkObj->id           = $poiObj->id;
        $linkObj->from         = "m-". $associate->poi_id;
        $linkObj->to           = "m-". $poiObj->id;
        $linkObj->type         = $associate->association_type;
        $response["nodeObj"]   = $userObj;
        $response["linkObj"]   = $linkObj;

        return $response;
              


    }

    public function deleteAssociation(Request $request) {

     
      $PoiAssociateObj = PoiAssociate::where("poi_id",$request['poi_id'])->where("associate_id",$request['associate_id'])->first();
      $PoiAssociateObj->delete();


    }

    public function deleteCaseAssociation(Request $request) {

  
      $PoiCaseAssociateObj = CasePoi::where("poi_id",$request['poi_id'])->where("case_id",$request['case_id'])->first();
      $PoiCaseAssociateObj->delete();


    }




     public function searchPOI()
    {

        $searchString = \Input::get('q');
        $contacts     = \DB::table('poi')
                        ->whereRaw("CONCAT(`name`, ' ', `surname`, ' ', `email`) LIKE '%{$searchString}%'")
                        ->select(\DB::raw('*'))
                        ->get();

        $data = array();

        if(count($contacts) > 0)
        {

           foreach ($contacts as $contact) {
           $data[]= array("name"=>"{$contact->name} {$contact->surname} <{$contact->email}","id" =>"{$contact->email}","first_name" =>"{$contact->name}","surname" =>"{$contact->surname}","cellphone" =>"{$contact->contact_number_1}","email" => "{$contact->email}");
           }


        }

     
        return $data;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserRequest $request, User $user)
    {

        $role                              = UserRole::where('slug','=',$request['role'])->first();
        $user->role                        = $role->id;
        $title                             = Title::where('slug','=',$request['title'])->first();
        $user->title                       = $title->id;
        $language                          = Language::where('slug','=',$request['language'])->first();
        $user->language                    = $language->id;
        $user->gender                      = $request['gender'];
        $user->name                        = $request['name'];
        $user->surname                     = $request['surname'];
        $user->cellphone                   = $request['cellphone'];
        $user->alt_cellphone               = $request['alt_cellphone'];
        $user->id_number                   = $request['id_number'];
        $user->email                       = (empty($request['email']))? $request['cellphone']."@siyaleader.net":$request['email'];
        $user->active                      = 2;
        $user->alt_email                   = $request['alt_email'];
        $user->street_number               = $request['street_number'];
        $user->route                       = $request['route'];
        $user->locality                    = $request['locality'];
        $user->administrative_area_level_1 = $request['administrative_area_level_1'];
        $user->postal_code                 = $request['postal_code'];
        $user->country                     = $request['country'];
        $user->company                     = $request['company'];  
        $department                        = Department::where('slug','=',$request['department'])->first();
        $user->department                  = (sizeof($department) > 0)?$department->id:0;
        $position                          = Position::where('slug','=',$request['position'])->first();
        $user->position                    = (sizeof($position) > 0)?$position->id:0;
        $password                          = rand(1000,99999);
        $user->password                    = \Hash::make($password);
        $user->area                        = $request['area'];
        $user->api_key                     = uniqid();
        $user->created_by                  = \Auth::user()->id;

        if ($request['affiliation']) {

            $user->affiliation       = $request['affiliation'];

        }
         else {

            $user->affiliation = 1;

         }

        $user->save();

         \Session::flash('success', $request['name'].' '.$request['surname'].' user has been added successfully!');

        $data = array(
            'name'     =>$user->name,
            'username' =>$user->cellphone,
            'password' =>$password,
        );

    

        \Mail::send('emails.registrationConfirmation',$data, function($message) use ($user)
        {
            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($user->email)->subject("Siyaleader Notification - User Registration Confirmation: " .$user->name);

        });

        return redirect('list-users');

    }

    public function ak_img_resize($target, $newcopy, $w, $h, $ext) { 

      list($w_orig, $h_orig) = getimagesize($target); 
      $scale_ratio = $w_orig / $h_orig; 
      if (($w / $h) > $scale_ratio) { 
        $w = $h * $scale_ratio; 
      } else { 
        $h = $w / $scale_ratio; 
      } 
      $img = ""; 
      $ext = strtolower($ext); if ($ext == "gif"){ $img = imagecreatefromgif($target); } else if($ext =="png"){ $img = imagecreatefrompng($target); } else { $img = imagecreatefromjpeg($target); } $tci = imagecreatetruecolor($w, $h); // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
      imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig); imagejpeg($tci, $newcopy, 80); }





    public function save_poi(PoiRequest $request, Poi $poi)
    {


  
        $poi->name            = $request['name'];
        $poi->surname         = $request['surname'];
        $poi->nickname        = $request['nickname'];
        $poi->gender          = $request['gender'];
        $poi->ethnic_group_id = $request['ethnic_group'];
        $poi->weight          = $request['weight'];
        $poi->dependants      = $request['dependants'];
        $poi->document_type   = $request['document_type'];
        $poi->tax_number      = $request['tax_number'];


        if($request['language'] == '0') {
          $request['language'] = "EN";
        }
        $language             = Language::where('slug','=',$request['language'])->first();
        $poi->language        = $language->id;
       
        switch ($request['document_type']) {
          case '1':
            $poi->id_number      = $request['id_number'];
            break;

          case '2':
            $poi->passport_number = $request['passport_number'];
            break;
          
          
        }

      $poi->has_driver_licence = $request['has_driver_licence'];

      if ($request['has_driver_licence'] == 2) {

        $PoiDriverLicence = new PoiDriverLicence();


      }

    
        $poi->nationality = $request['nationality'];
        $poi->created_by  = \Auth::user()->id;
        $poi->email       = $request['email'];
        $poi->save();
     
  
        if (is_null($request['poi_profile_file'])) {

             $img_url                      = "images/poi/profile/no_photo.png";
             $poipicture                   = new PoiPicture();
             $poipicture->poi_id           = $poi->id;
             $poipicture->poi_picture_type = 1;
             $poipicture->poi_picture_url  = $img_url;
             $poipicture->created_by       = \Auth::user()->id;
             $poipicture->save();
           

        } else {

            $file_name             = $_FILES['poi_profile_file']['name'];
            $img_url               = "images/poi/profile/$poi->id/".$file_name;
            $target_file_directory = "images/poi/profile/$poi->id/";

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 400;
               $hmax         = 400;
               $kaboom       = explode(".", $file_name); 
               $fileExt      = end($kaboom);

               if(move_uploaded_file($_FILES["poi_profile_file"]["tmp_name"],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }

            } 


              $poipicture                   = new PoiPicture();
              $poipicture->poi_id           = $poi->id;
              $poipicture->poi_picture_type = 1;
              $poipicture->poi_picture_url  = $img_url;
              $poipicture->notes            = $request["profile_pic_note"];    
              $poipicture->created_by       = \Auth::user()->id;
              $poipicture->save();


         
        }

        //POI SCARS PICTURES
        if($request['scar_file']) {

          //Get Array Size
          $scar_array_size = sizeof($request['scar_file']);

          for ($i=0; $i < $scar_array_size ; $i++) { 
            
            $file_name             = $_FILES['scar_file']['name'][$i];
            $img_url               = "images/poi/scars/$poi->id/".$file_name;
            $target_file_directory = "images/poi/scars/$poi->id/";

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 600;
               $hmax         = 480;
               $fileExt      = 'jpg';

               if(move_uploaded_file($_FILES["scar_file"]["tmp_name"][$i],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }


                $poipicture                   = new PoiPicture();
                $poipicture->poi_id           = $poi->id;
                $poipicture->poi_picture_type = 2;
                $poipicture->poi_picture_url  = $img_url;
                $poipicture->notes            = $request['scar_pic_note'][$i];
                $poipicture->created_by       = \Auth::user()->id;
                $poipicture->save();





            } 

          }

        }


        if($request['tatoo_file']) {

          //Get Array Size
          $scar_array_size = sizeof($request['tatoo_file']);

          for ($i=0; $i < $scar_array_size ; $i++) { 
            
            $file_name             = $_FILES['tatoo_file']['name'][$i];
            $img_url               = "images/poi/tatoos/$poi->id/".$file_name;
            $target_file_directory = "images/poi/tatoos/$poi->id/";

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 600;
               $hmax         = 480;
               $fileExt      = 'jpg';

               if(move_uploaded_file($_FILES["tatoo_file"]["tmp_name"][$i],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }


                $poipicture                   = new PoiPicture();
                $poipicture->poi_id           = $poi->id;
                $poipicture->poi_picture_type = 3;
                $poipicture->poi_picture_url  = $img_url;
                $poipicture->notes            = $request['tatoo_pic_note'][$i];    
                $poipicture->created_by       = \Auth::user()->id;
                $poipicture->save();





            } 

          }

        }



         if (is_null($request['poi_doc_file'])) {

            $img_url = "default";

        } else {


            $file_name             = $_FILES['poi_doc_file']['name'];
            $img_url               = "images/poi/ID/$poi->id/".$file_name;
            $target_file_directory = "images/poi/ID/$poi->id/";

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 600;
               $hmax         = 480;
               $fileExt      = 'jpg';

               if(move_uploaded_file($_FILES["poi_doc_file"]["tmp_name"],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }

            } 


              $poipicture                   = new PoiPicture();
              $poipicture->poi_id           = $poi->id;
              $poipicture->poi_picture_type = 4;
              $poipicture->poi_picture_url  = $img_url;
              $poipicture->notes            = $request["id_pic_note"];    
              $poipicture->created_by       = \Auth::user()->id;
              $poipicture->save();


         
        }

        if (is_null($request['poi_vehicle_file'])) {

            $img_url = "default";

        } else {


            $file_name             = $_FILES['poi_vehicle_file']['name'];
            $img_url               = "images/poi/VEHICLE/$poi->id/".$file_name;
            $target_file_directory = "images/poi/VEHICLE/$poi->id/";

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory,0777,true);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 600;
               $hmax         = 480;
               $fileExt      = 'jpg';

               if(move_uploaded_file($_FILES["poi_vehicle_file"]["tmp_name"],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }

            } 


              $poipicture                   = new PoiPicture();
              $poipicture->poi_id           = $poi->id;
              $poipicture->poi_picture_type = 5;
              $poipicture->poi_picture_url  = $img_url;
              $poipicture->notes            = "";    
              $poipicture->created_by       = \Auth::user()->id;
              $poipicture->save();


         
        }


        if(!is_null($request['drivers_licence'])) {

                    for ($i=0; $i < sizeof($request['drivers_licence']) ; $i++) { 
              
                  $PoiDriverLicence                              = new PoiDriverLicence();
                  $PoiDriverLicence->poi_id                      = $poi->id;
                  $PoiDriverLicence->driver_licence_code         = $request['drivers_licence'][$i];
                  $PoiDriverLicence->drivers_licence_date_issued = $request['drivers_licence_date_issued'][$i];
                  $PoiDriverLicence->drivers_licence_expiry_date = $request['drivers_licence_expiry_date'][$i];
                  $PoiDriverLicence->created_by                  = \Auth::user()->id;
                  $PoiDriverLicence->save();

            }


        }


        if(!is_null($request['landline'])) {


            for ($i=0; $i < sizeof($request['landline']) ; $i++) { 
                  
                  $PoiContactNumber                 = new PoiContactNumber();
                  $PoiContactNumber->poi_id         = $poi->id;
                  $PoiContactNumber->contact_number = $request['landline'][$i];
                  $PoiContactNumber->type           = 1;
                  $PoiContactNumber->save();

            }


        }

        if(!is_null($request['mobile'])) {


            for ($i=0; $i < sizeof($request['mobile']) ; $i++) { 
                  
                  $PoiContactNumber                 = new PoiContactNumber();
                  $PoiContactNumber->poi_id         = $poi->id;
                  $PoiContactNumber->contact_number = $request['mobile'][$i];
                  $PoiContactNumber->imei_number    = $request['imei_number'][$i];
                  $PoiContactNumber->phone_type     = $request['phone_type'][$i];
                  $PoiContactNumber->type           = 2;
                  $PoiContactNumber->save();

            }


        }

       
        //Residential Address
       if(!is_null($request['resindential_line_1'])) {


          for ($i=0; $i < sizeof($request['resindential_line_1']) ; $i++) { 

            $res_address          = new PoiAddress();
            $res_address->line_1  = $request['resindential_line_1'][$i];
            $res_address->gps_lng = $request['reslong'][$i];
            $res_address->gps_lat = $request['reslat'][$i];
            $res_address->poi_id  = $poi->id;
            $res_address->type    = 1;
            $res_address->save();

        }



       }


      if(!is_null($request['workaddress_line_1'])) {


            for ($i=0; $i < sizeof($request['workaddress_line_1']) ; $i++) { 
                    
                    $res_address          = new PoiAddress();
                    $res_address->company = $request['company'][$i];
                    $res_address->period  = $request['period'][$i];
                    $res_address->line_1  = $request['workaddress_line_1'][$i];
                    $res_address->gps_lng = $request['worklong'][$i];
                    $res_address->gps_lat = $request['worklat'][$i];
                    $res_address->poi_id  = $poi->id;
                    $res_address->type    = 2;
                    $res_address->save();

            }


        }

        if(!is_null($request['travel_movement'])) {

            for ($i=0; $i < sizeof($request['travel_movement']) ; $i++) { 
              
                  $PoiTravelMovement             = new PoiTravelMovement();
                  $PoiTravelMovement->poi_id     = $poi->id;
                  $PoiTravelMovement->name       = $request['travel_movement'][$i];
                  $PoiTravelMovement->gps_lng    = $request['long'][$i];
                  $PoiTravelMovement->gps_lat    = $request['lat'][$i];
                  $PoiTravelMovement->date_seen  = $request['date_seen'][$i];
                  $PoiTravelMovement->created_by = \Auth::user()->id;
                  $PoiTravelMovement->save();


            }


        }

         if(!is_null($request['account_number'])) {

          for ($i=0; $i < sizeof($request['account_number']) ; $i++) { 
            
                $PoiBankDetail                 = new PoiBankDetail();
                $PoiBankDetail->poi_id         = $poi->id;
                $PoiBankDetail->account_number = $request['account_number'][$i];
                $PoiBankDetail->branch_code    = $request['branch_number'][$i];
                $PoiBankDetail->bank_id        = $request['banking_name'][$i];
                $PoiBankDetail->created_by     = \Auth::user()->id;
                $PoiBankDetail->save();

          }
        }



        if(!is_null($request['crime_description'])) {

          for ($i=0; $i < sizeof($request['crime_description']) ; $i++) { 
            
                $PoiCriminalRecord                                      = new PoiCriminalRecord();
                $PoiCriminalRecord->poi_id                              = $poi->id;
                $PoiCriminalRecord->description                         = $request['crime_description'][$i];
                $PoiCriminalRecord->police_station                      = $request['police_station'][$i];
                $PoiCriminalRecord->investigation_officer               = $request['investigation_officer'][$i];
                $PoiCriminalRecord->investigation_officer_mobile_number = $request['investigation_officer_mobile_number'][$i];
                $PoiCriminalRecord->sentence                            = $request['sentence'][$i];
                $PoiCriminalRecord->criminal_record_date                = $request['criminal_record_date'][$i];
                $PoiCriminalRecord->created_by      = \Auth::user()->id;
                $PoiCriminalRecord->save();

          }
        }



        if(!is_null($request['vehicle_make'])) {

              for ($i=0; $i < sizeof($request['vehicle_make']) ; $i++) { 
                  
                  $PoiVehicle                = new PoiVehicle();
                  $PoiVehicle->poi_id        = $poi->id;
                  $PoiVehicle->vehicle_make  = $request['vehicle_make'][$i];
                  $PoiVehicle->vehicle_color = $request['vehicle_color'][$i];
                  $PoiVehicle->vehicle_vin   = $request['vehicle_vin'][$i];
                  $PoiVehicle->vehicle_plate = $request['vehicle_plate'][$i];                   
                  $PoiVehicle->created_by    = \Auth::user()->id;
                  $PoiVehicle->save();

            }


        }
  
        $poi->save();
        \Session::flash('success', $request['name'].' '.$request['surname'].' POI has been added successfully!');

        return redirect('list-poi-users');

    }

    public function list_poi()
    {
      $pois = \DB::table('poi')
                        ->select(
                                    \DB::raw(
                                        "
                                         poi.id,
                                         poi.name,
                                         poi.surname,
                                         poi.email,
                                         poi.contact_number_1,
                                         poi.nationality,
                                         poi.gender

                                        "
                                      )
                                );
                 
        return \Datatables::of($pois)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" href="edit-poi-user/{{$id}}" >View / Edit</a>
                                                   <a class="btn btn-xs btn-alt" href="view-poi-associates/{{$id}}" >View / Add Associates</a>
                                                   <a class="btn btn-xs btn-alt" href="view-poi-cases-associates/{{$id}}" >View  Cases Association</a>


                                        '
                                )->make(true);


    }


    public function edit_poi($id) {



    $poi = \DB::table('poi')
                        ->join('poi_pictures', 'poi.id', '=', 'poi_pictures.poi_id')
                        ->where('poi.id',$id)
                        ->select(
                                    \DB::raw(
                                        "
                                         poi.id,
                                         poi.name,
                                         poi.surname,
                                         poi.nickname,
                                         poi.ethnic_group_id,
                                         poi.weight,
                                         poi.gender,
                                         poi.dependants,
                                         poi.birth_place,
                                         poi.nationality,
                                         poi.has_driver_licence,
                                         poi.document_type,
                                         poi.id_number,
                                         poi.passport_number,
                                         poi.has_driver_licence,
                                         poi.tax_number,
                                         poi.email,
                                         (SELECT `slug` FROM `languages` WHERE `id` = `poi`.language) as 'language'
                                        
                                      
                                       
                                        "
                                      )
                            )->first();



    
      //Determine if POI has Scar
      $poiscar = PoiPicture::where('poi_id',$id)
                              ->where('poi_picture_type',3)->count();

      if($poiscar > 0) {

          $poiscarpics = PoiPicture::where('poi_id',$id)
                                        ->where('poi_picture_type',3)->get();


          $poi->scars = $poiscarpics;

      }

      $poi_id_query = PoiPicture::where('poi_id',$id)
                              ->where('poi_picture_type',1)->count();




      if($poi_id_query > 0) {

          $poi_query = PoiPicture::where('poi_id',$id)
                                        ->where('poi_picture_type',1)->first();

          $poi->poidocid = $poi_query;

      }



      $poi_vehicle = PoiPicture::where('poi_id',$id)
                              ->where('poi_picture_type',5)->count();




    


    
      //Determine if POI has tatoos
      $poitatoo = PoiPicture::where('poi_id',$id)
                              ->where('poi_picture_type',2)->count();

      if($poitatoo > 0) {


          $poitatoopics = PoiPicture::where('poi_id',$id)
                                        ->where('poi_picture_type',2)->get();

          $poi->tatoos = $poitatoopics;


       }

      //Determine if POI has tatoos
       $poidriver = PoiDriverLicence::where('poi_id',$id)->count();

       if($poidriver > 0) {

          $poidrivers          = PoiDriverLicence::where('poi_id',$id)->get();  
          $poi->driverslicence = $poidrivers;


       }


      //Determine if POI has tatoos
      $poiidprofile = PoiPicture::where('poi_id',$id)
                              ->where('poi_picture_type',4)->count();


      if($poiidprofile > 0) {

          $poidprofileD = PoiPicture::where('poi_id',$id)
                                        ->where('poi_picture_type',4)->first();
          $poi->idpic = $poidprofileD;


       }


        //Determine if POI has landline
       $poicontactlandline = PoiContactNumber::where('poi_id',$id)->where('type',1)->count();

       if($poicontactlandline > 0) {

          $poilandines   = PoiContactNumber::where('poi_id',$id)->where('type',1)->get();  
          $poi->landline = $poilandines;


       }

      //Determine if POI has vehicles
       $poiVehicles = PoiVehicle::where('poi_id',$id)->count();

       if($poiVehicles > 0) {

          $poiVehicles   = poiVehicle::where('poi_id',$id)->get();

           $poiVehicles = \DB::table('poi_pictures')
                        ->join('poi_vehicles', 'poi_vehicles.poi_id', '=', 'poi_pictures.poi_id')
                        ->where('poi_pictures.poi_picture_type','=',5)
                        ->select(
                                    \DB::raw(
                                        "
                                         poi_vehicles.id,
                                         poi_vehicles.poi_id,
                                         poi_vehicles.vehicle_make,
                                         poi_vehicles.vehicle_color,
                                         poi_vehicles.vehicle_vin,
                                         poi_vehicles.vehicle_plate,
                                         poi_pictures.poi_picture_url,
                                         poi_pictures.poi_picture_type,
                                         poi_pictures.id as vehicle_id
                                       
                                      
                                       
                                        "
                                      )
                            )->get();



          $poi->vehicles = $poiVehicles;


       }

      //Determine if POI has mobile
       $poicontactmobile = PoiContactNumber::where('poi_id',$id)->where('type',2)->count();

       if($poicontactmobile > 0) {

          $poicontactmobiles = PoiContactNumber::where('poi_id',$id)->where('type',2)->get();  
          $poi->mobilenumber = $poicontactmobiles;


       }

      //Determine if POI has residential address
       $poiresidendialaddress = PoiAddress::where('poi_id',$id)->where('type',1)->count();

       if($poiresidendialaddress > 0) {

          $residendialaddress = PoiAddress::where('poi_id',$id)->where('type',1)->get();  
          $poi->residential   = $residendialaddress;


       }

       //Determine if POI has work address
       $poiworkaddress = PoiAddress::where('poi_id',$id)->where('type',2)->count();
       if($poiworkaddress > 0) {

          $workaddress = PoiAddress::where('poi_id',$id)->where('type',2)->get();  
          $poi->work   = $workaddress;

       }

      //Determine if POI has travel movement
       $poitravelmovement = PoiTravelMovement::where('poi_id',$id)->count();
       if($poitravelmovement > 0) {

          $travel = PoiTravelMovement::where('poi_id',$id)->get();  
          $poi->travelmovement   = $travel;

       }

       //Determine if POI has travel movement
       $PoiCriminalRecord = PoiCriminalRecord::where('poi_id',$id)->count();
       if($PoiCriminalRecord > 0) {

          $criminal = PoiCriminalRecord::where('poi_id',$id)->get();  
          $poi->criminal_records   = $criminal;

       }


       //dd($poi);

        return view('users.poieditregistration')->with('poi',$poi);

    }


    public function view_poi_associates($id) {

  
    $poi = \DB::table('poi')
                        ->join('poi_pictures', 'poi.id', '=', 'poi_pictures.poi_id')
                        ->where('poi.id','=',$id)
                        ->select(
                                    \DB::raw(
                                        "
                                         poi.id,
                                         poi.name,
                                         poi.surname,
                                         poi.nickname,
                                         poi.ethnic_group_id,
                                         poi.weight,
                                         poi.gender,
                                         poi.dependants,
                                         poi.birth_place,
                                         poi.nationality,
                                         poi.has_driver_licence,
                                         poi.document_type,
                                         poi.id_number,
                                         poi.passport_number,
                                         poi.has_driver_licence,
                                         poi.email,
                                         (SELECT `slug` FROM `languages` WHERE `id` = `poi`.language) as 'language'
                                        
                                      
                                       
                                        "
                                      )
                            )->first();

      $poi_id_query = PoiPicture::where('poi_id',$id)
                              ->where('poi_picture_type',1)->count();




      if($poi_id_query > 0) {

          $poi_query = PoiPicture::where('poi_id',$id)
                                        ->where('poi_picture_type',1)->first();

          $poi->poidocid = $poi_query;

      }


      //Determine if POI has associates

       $poi__associate_query = PoiAssociate::where('poi_id',$id)->count();
       $results = array();


      if($poi__associate_query > 0) {

         
          $associates = PoiAssociate::where('poi_id',$id)->get();

          foreach ($associates as $associate) {

               $assoc_pic_object                  = PoiPicture::where('poi_id',$associate->associate_id)->first();
               $assoc_poi_object                  = Poi::find($associate->associate_id);
               $assoc_poi_object->poi_picture_url = $assoc_pic_object->poi_picture_url;

               $sub_results = array();

               //Sub - Associates
               $sub_associates_no                 = PoiAssociate::where('poi_id',$associate->associate_id)->count();
               if($sub_associates_no > 0) {

                  $sub_associates = PoiAssociate::where('poi_id',$associate->associate_id)->get();

                  foreach ($sub_associates as $sub_associate) {
                    
                     $sub_assoc_pic_object                  = PoiPicture::where('poi_id',$sub_associate->associate_id)->first();
                     $sub_assoc_poi_object                  = Poi::find($sub_associate->associate_id);
                     $sub_assoc_poi_object->poi_picture_url = $sub_assoc_pic_object->poi_picture_url;
                      $sub_results[]                        = $sub_assoc_poi_object;


                  }

               }

               $assoc_poi_object->sub_associate   = $sub_results;
               $results[]                         = $assoc_poi_object;


          }

          $poi->assoc = $results;

      }
       
        
        return view('users.poiassociates')->with('poi',$poi);


    }

    public function view_case_poi_associates($case_id) {

        $case = CaseReport::find($case_id);
        return view('users.casepoiassociates')->with('case',$case);
    
    }


    public function view_poi_cases_associates($poi_id) {

        $poi = Poi::find($poi_id);
        return view('users.casestopeople')->with('poi',$poi);
    
    }


    public function edit_poi_save(Request $request) {

     
        

        $poi                  = Poi::find($request['poiID']);
        $poi->name            = $request['name'];
        $poi->surname         = $request['surname'];
        $poi->nickname        = $request['nickname'];
        $poi->gender          = $request['gender'];
        $poi->ethnic_group_id = $request['ethnic_group'];
        $poi->weight          = $request['weight'];
        $poi->dependants      = $request['dependants'];
        $poi->birth_place     = $request['birth_place'];
        $poi->nationality     = $request['nationality'];
        $poi->passport_number = $request['passport_number'];
        $poi->email           = $request['email'];



        if($request['poiProfileID'] <>"" && $request['profile_pic_note'] ) {

          $poipicture = PoiPicture::find($request['poiProfileID']);
          $poipicture->notes          = $request['profile_pic_note'];
          $poipicture->save();
        }

        if($request['poiID'] <>"" && $request['id_pic_note'] ) {


          $poipicture = PoiPicture::where("poi_id",$request['poiID'])->where("poi_picture_type",4)->first();
          $poipicture->notes          = $request['id_pic_note'];
          $poipicture->save();
        }

   

        if($request['language'] == '0') {

          $request['language'] = "EN";
        }
        $language             = Language::where('slug','=',$request['language'])->first();
        $poi->language        = $language->id;
       

        $poi->save();


        if (!is_null($request['poi_profile_file'])) {


            $file_name             = $_FILES['poi_profile_file']['name'];
            $img_url               = "images/poi/profile/$poi->id/".$file_name;
            $target_file_directory = "images/poi/profile/$poi->id/";


            

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 600;
               $hmax         = 480;
               $kaboom       = explode(".", $file_name); 
               $fileExt      = end($kaboom);

               if(move_uploaded_file($_FILES["poi_profile_file"]["tmp_name"],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }

            } 

           
            if($request['poiProfileID'] == "") {


                  $exist_profile_pic = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',1)->first();
                  $exist_profile_pic->delete();

                 
                  $poipicture                   = new PoiPicture();
                  $poipicture->poi_id           = $poi->id;
                  $poipicture->poi_picture_type = 1;
                  $poipicture->poi_picture_url  = $img_url;
                  $poipicture->notes            = $request['profile_pic_note'];
                  $poipicture->created_by       = \Auth::user()->id;
                  $poipicture->save();

              
            } else {



                $poipicture = PoiPicture::find($request['poiProfileID']);
                $poipicture->poi_picture_url = $img_url;
                $poipicture->notes          = $request['profile_pic_note'];
                $poipicture->save();

            }
            



         
        }


          //POI SCARS PICTURES
        if($request['scar_file']) {

          //Get Array Size
          $scar_array_size = sizeof($request['scar_file']);

          //Check Scars in DB
          $scars_key   = array();
          $scars_in_db = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',3)->get();
          
       

          if(sizeof($scars_in_db) > 0) {


          }

          foreach ($scars_in_db as $scar_in_db) {
            
              $scars_key[] = $scar_in_db->id;

          }

        

          for ($i=0; $i < $scar_array_size ; $i++) { 


                      $file_name             = $_FILES['scar_file']['name'][$i];
           
                        if(is_array($file_name)) {

                        $key                   = key($file_name);

                        if(($a = array_search($key, $scars_key)) !== false) {
                          unset($scars_key[$a]);
                        }

                        $file_name_scar        = $file_name[$key];
                        $img_url               = "images/poi/scars/$key/".$file_name_scar;
                        $target_file_directory = "images/poi/scars/$key/";

                        $poipicture = PoiPicture::find($key);
                        $poipicture->notes = $request['scar_pic_note'][$i];
                        $poipicture->save();
                       
                      
                          if($file_name_scar <> "") {

                              if(!is_dir($target_file_directory)) {

                                  mkdir($target_file_directory);

                              } 

                              if(is_dir($target_file_directory)) {
            
                                 $target_file  = $target_file_directory.$file_name_scar;
                                 $resized_file = $target_file_directory.$file_name_scar;
                                 $wmax         = 600;
                                 $hmax         = 480;
                                 $fileExt      = 'jpg';

                                 if(move_uploaded_file($_FILES["scar_file"]["tmp_name"][$i][$key],$img_url)) {

                                   $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                                 }

                                 $poipicture = PoiPicture::find($key);
                                 $poipicture->poi_picture_url = $img_url;
                                 $poipicture->save();
                              }
                         

                         

                          } 


                        } else {


                            $file_name             = $_FILES['scar_file']['name'][$i];
                            $img_url               = "images/poi/scars/$poi->id/".$file_name;
                            $target_file_directory = "images/poi/scars/$poi->id/";

                            if(!is_dir($target_file_directory)) {

                                mkdir($target_file_directory);

                            } 


                            if(is_dir($target_file_directory)) {


                               $target_file  = $target_file_directory.$file_name;
                               $resized_file = $target_file_directory.$file_name;
                               $wmax         = 600;
                               $hmax         = 480;
                               $fileExt      = 'jpg';

                               if(move_uploaded_file($_FILES["scar_file"]["tmp_name"][$i],$img_url)) {

                                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                               }



                                $poipicture                   = new PoiPicture();
                                $poipicture->poi_id           = $poi->id;
                                $poipicture->poi_picture_type = 3;
                                $poipicture->poi_picture_url  = $img_url;
                                $poipicture->notes            = $request['scar_pic_note'][$i];
                                $poipicture->created_by       = \Auth::user()->id;
                                $poipicture->save();







                            } 


                        }
          

          }


          if($scars_key) {

  
              foreach ($scars_key as $value) {
  
                  $picture = PoiPicture::find($value);
                  $picture->delete();
              }
          }
          



        }//END POI SCARS PICTURES


        //POI TATOOS PICTURES
        if($request['tatoo_file']) {

          //Get Array Size
          $tatoo_array_size = sizeof($request['tatoo_file']);

          //Check Scars in DB
          $tatoos_in_db = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',2)->get();
          $tatoos_key   = array();

          foreach ($tatoos_in_db as $tatoo_in_db) {
            
              $tatoos_key[] = $tatoo_in_db->id;

          }

          for ($i=0; $i < $tatoo_array_size ; $i++) { 
            
                      $file_name             = $_FILES['tatoo_file']['name'][$i];
           
                        if(is_array($file_name)) {

                        $key                   = key($file_name);

                        if(($a = array_search($key, $tatoos_key)) !== false) {
                          unset($tatoos_key[$a]);
                        }

                        $file_name_tatoo        = $file_name[$key];
                        $img_url               = "images/poi/tatoos/$key/".$file_name_tatoo;
                        $target_file_directory = "images/poi/tatoos/$key/";

                        $poipicture = PoiPicture::find($key);
                        $poipicture->notes = $request['tatoo_pic_note'][$i];
                        $poipicture->save();
                       
                      
                          if($file_name_tatoo <> "") {



                              if(!is_dir($target_file_directory)) {

                                  mkdir($target_file_directory);

                              } 

                              if(is_dir($target_file_directory)) {


                                 $target_file  = $target_file_directory.$file_name_tatoo;
                                 $resized_file = $target_file_directory.$file_name_tatoo;
                                 $wmax         = 600;
                                 $hmax         = 480;
                                 $fileExt      = 'jpg';

                                 if(move_uploaded_file($_FILES["tatoo_file"]["tmp_name"][$i][$key],$img_url)) {

                                   $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                                 }

                                 $poipicture = PoiPicture::find($key);
                                 $poipicture->poi_picture_url = $img_url;
                                 $poipicture->save();
                              }
                         

                         

                          } 


                        } else {



                            $file_name             = $_FILES['tatoo_file']['name'][$i];
                            $img_url               = "images/poi/scars/$poi->id/".$file_name;
                            $target_file_directory = "images/poi/scars/$poi->id/";

                            if(!is_dir($target_file_directory)) {

                                mkdir($target_file_directory);

                            } 


                            if(is_dir($target_file_directory)) {


                               $target_file  = $target_file_directory.$file_name;
                               $resized_file = $target_file_directory.$file_name;
                               $wmax         = 600;
                               $hmax         = 480;
                               $fileExt      = 'jpg';

                               if(move_uploaded_file($_FILES["tatoo_file"]["tmp_name"][$i],$img_url)) {

                                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                               }


                                $poipicture                   = new PoiPicture();
                                $poipicture->poi_id           = $poi->id;
                                $poipicture->poi_picture_type = 2;
                                $poipicture->poi_picture_url  = $img_url;
                                $poipicture->notes            = $request['tatoo_pic_note'][$i];
                                $poipicture->created_by       = \Auth::user()->id;
                                $poipicture->save();


                            } 


                        }
          

          }


          if($tatoos_key) {

  
              foreach ($tatoos_key as $value) {
  
                  $picture = PoiPicture::find($value);
                  $picture->delete();
              }
          }
          



        }//END POI TATOOS PICTURES


        //POI TATOOS PICTURES
        if($request['poi_vehicle_file']) {

          //Get Array Size
          $vehicles_array_size = sizeof($request['poi_vehicle_file']);

          //Check Scars in DB
          $vehicles_in_db = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',5)->get();
          $vehicles_key   = array();

          foreach ($vehicles_in_db as $vehicle_in_db) {
            
              $vehicles_key[] = $vehicle_in_db->id;

          }

          for ($i=0; $i < $vehicles_array_size ; $i++) { 
            
                      $file_name             = $_FILES['poi_vehicle_file']['name'][$i];
           
                        if(is_array($file_name)) {

                        $key                   = key($file_name);

                        if(($a = array_search($key, $tatoos_key)) !== false) {
                          unset($tatoos_key[$a]);
                        }

                        $file_name_tatoo        = $file_name[$key];
                        $img_url               = "images/poi/VEHICLES/$key/".$file_name_tatoo;
                        $target_file_directory = "images/poi/VEHICLES/$key/";

                       
                      
                          if($file_name_tatoo <> "") {



                              if(!is_dir($target_file_directory)) {

                                  mkdir($target_file_directory);

                              } 

                              if(is_dir($target_file_directory)) {


                                 $target_file  = $target_file_directory.$file_name_tatoo;
                                 $resized_file = $target_file_directory.$file_name_tatoo;
                                 $wmax         = 600;
                                 $hmax         = 480;
                                 $fileExt      = 'jpg';

                                 if(move_uploaded_file($_FILES["poi_vehicle_file"]["tmp_name"][$i][$key],$img_url)) {

                                   $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                                 }

                                 $poipicture = PoiPicture::find($key);
                                 $poipicture->poi_picture_url = $img_url;
                                 $poipicture->save();
                              }
                         

                         

                          } 


                        } else {



                            $file_name             = $_FILES['poi_vehicle_file']['name'][$i];
                            $img_url               = "images/poi/VEHICLES/$poi->id/".$file_name;
                            $target_file_directory = "images/poi/VEHICLES/$poi->id/";

                            if(!is_dir($target_file_directory)) {

                                mkdir($target_file_directory);

                            } 


                            if(is_dir($target_file_directory)) {


                               $target_file  = $target_file_directory.$file_name;
                               $resized_file = $target_file_directory.$file_name;
                               $wmax         = 600;
                               $hmax         = 480;
                               $fileExt      = 'jpg';

                               if(move_uploaded_file($_FILES["poi_vehicle_file"]["tmp_name"][$i],$img_url)) {

                                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

                               }


                                $poipicture                   = new PoiPicture();
                                $poipicture->poi_id           = $poi->id;
                                $poipicture->poi_picture_type = 5;
                                $poipicture->poi_picture_url  = $img_url;
                                $poipicture->notes            = "";
                                $poipicture->created_by       = \Auth::user()->id;
                                $poipicture->save();


                            } 


                        }
          

          }


          if($vehicles_key) {

  
              foreach ($vehicles_key as $value) {
  
                  $picture = PoiPicture::find($value);
                  $picture->delete();
              }
          }
          



        }//END POI TATOOS PICTURES


      if (!is_null($request['poi_doc_file'])) {

            $file_name             = $_FILES['poi_doc_file']['name'];
            $img_url               = "images/poi/ID/$poi->id/".$file_name;
            $target_file_directory = "images/poi/ID/$poi->id/";

            if(!is_dir($target_file_directory)) {

                mkdir($target_file_directory);

            } 


            if(is_dir($target_file_directory)) {


               $target_file  = $target_file_directory.$file_name;
               $resized_file = $target_file_directory.$file_name;
               $wmax         = 600;
               $hmax         = 480;
               $kaboom       = explode(".", $file_name); 
               $fileExt      = end($kaboom);

               if(move_uploaded_file($_FILES["poi_doc_file"]["tmp_name"],$img_url)) {

                 $this->ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

               }

            } 

            


            if($request['poiPicID'] == "") {


                  $exist_id_pic = PoiPicture::where('poi_id',$poi->id)->where('poi_picture_type',4)->first();
                  if($exist_id_pic) {

                    $exist_id_pic->delete();

                  }
                 
                  
                 
                  $poipicture                   = new PoiPicture();
                  $poipicture->poi_id           = $poi->id;
                  $poipicture->poi_picture_type = 4;
                  $poipicture->poi_picture_url  = $img_url;
                  $poipicture->notes            = $request['id_pic_note'];
                  $poipicture->created_by       = \Auth::user()->id;
                  $poipicture->save();

              
            } else {

                $poipicture                  = PoiPicture::find($request['poiPicID']);
                $poipicture->poi_picture_url = $img_url;
                $poipicture->notes           = $request['id_pic_note'];
                $poipicture->save();

            }

         
        }


       if(!is_null($request['drivers_licence'])) {

          //Find existing driving licence info
          $existing_drivers = PoiDriverLicence::where('poi_id',$poi->id)->get();

          if (sizeof($existing_drivers) > 0) {

              foreach ($existing_drivers as $existing_driver) {
                
                  $driver_object = PoiDriverLicence::find($existing_driver->id);
                  $driver_object->delete();
              }

          }



            for ($i=0; $i < sizeof($request['drivers_licence']) ; $i++) { 
              
                  $PoiDriverLicence                              = new PoiDriverLicence();
                  $PoiDriverLicence->poi_id                      = $poi->id;
                  $PoiDriverLicence->driver_licence_code         = $request['drivers_licence'][$i];
                  $PoiDriverLicence->drivers_licence_date_issued = $request['drivers_licence_date_issued'][$i];
                  $PoiDriverLicence->drivers_licence_expiry_date = $request['drivers_licence_expiry_date'][$i];
                  $PoiDriverLicence->created_by                  = \Auth::user()->id;
                  $PoiDriverLicence->save();

            }


        }

        if(!is_null($request['vehicle_make'])) {

          $existing_vehicles = PoiVehicle::where('poi_id',$poi->id)->get();

          if (sizeof($existing_vehicles) > 0) {

              foreach ($existing_vehicles as $existing_vehicle) {
                
                  $vehicle_object = PoiVehicle::find($existing_vehicle->id);
                  $vehicle_object->delete();
              }

          }



            for ($i=0; $i < sizeof($request['vehicle_make']) ; $i++) { 
              
                  $PoiVehicle                = new PoiVehicle();
                  $PoiVehicle->poi_id        = $poi->id;
                  $PoiVehicle->vehicle_make  = $request['vehicle_make'][$i];
                  $PoiVehicle->vehicle_color = $request['vehicle_color'][$i];
                  $PoiVehicle->vehicle_vin   = $request['vehicle_vin'][$i];
                  $PoiVehicle->vehicle_plate = $request['vehicle_plate'][$i];                   
                  $PoiVehicle->created_by    = \Auth::user()->id;
                  $PoiVehicle->save();

            }


        }





      if(!is_null($request['landline'])) {

          //Find existing driving licence info
          $existing_landlines = PoiContactNumber::where('poi_id',$poi->id)->where('type',1)->get();

          if (sizeof($existing_landlines) > 0) {

              foreach ($existing_landlines as $existing_landline) {
                
                  $driver_object = PoiContactNumber::find($existing_landline->id);
                  $driver_object->delete();
              }

          }



            for ($i=0; $i < sizeof($request['landline']) ; $i++) { 
              
                  $PoiContactNumber                 = new PoiContactNumber();
                  $PoiContactNumber->poi_id         = $poi->id;
                  $PoiContactNumber->contact_number = $request['landline'][$i];
                  $PoiContactNumber->type           = 1;
                  $PoiContactNumber->save();

            }


        }

      if(!is_null($request['mobile'])) {

          //Find existing driving licence info
          $existing_landlines = PoiContactNumber::where('poi_id',$poi->id)->where('type',2)->get();

          if (sizeof($existing_landlines) > 0) {

              foreach ($existing_landlines as $existing_landline) {
                
                  $driver_object = PoiContactNumber::find($existing_landline->id);
                  $driver_object->delete();
              }

          }

            for ($i=0; $i < sizeof($request['mobile']) ; $i++) { 
              
                  $PoiContactNumber                 = new PoiContactNumber();
                  $PoiContactNumber->poi_id         = $poi->id;
                  $PoiContactNumber->contact_number = $request['mobile'][$i];
                  $PoiContactNumber->imei_number    = $request['imei_number'][$i];
                  $PoiContactNumber->phone_type     = $request['phone_type'][$i];
                  $PoiContactNumber->type           = 2;
                  $PoiContactNumber->save();

            }


        }

     
 
         if(!is_null($request['company'])) {

          //Find existing driving licence info
          $existing_company = PoiAddress::where('poi_id',$poi->id)->where('type',2)->get();

          if (sizeof($existing_company) > 0) {

              foreach ($existing_company as $company) {

                  $object = PoiAddress::find($company->id);
                  $object->delete();
              }

          }

            for ($i=0; $i < sizeof($request['company']) ; $i++) { 
              
                    $res_address          = new PoiAddress();
                    $res_address->company = $request['company'][$i];
                    $res_address->period  = $request['period'][$i];
                    $res_address->line_1  = $request['workaddress_line_1'][$i];
                    $res_address->gps_lng = $request['worklong'][$i];
                    $res_address->gps_lat = $request['worklat'][$i];
                    $res_address->poi_id  = $poi->id;
                    $res_address->type    = 2;
                    $res_address->save();


            }

            

        }


        if($request['resindential_line_1'] <> "") {

          //Find existing work address
          $existing_residential_address = PoiAddress::where('poi_id',$poi->id)->where('type',1)->get();

          if (sizeof($existing_residential_address) > 0) {

              foreach ($existing_residential_address as $residential_address) {
                
                  $object = PoiAddress::find($residential_address->id);
                  $object->delete();
              }

          }


          for ($i=0; $i < sizeof($request['resindential_line_1']) ; $i++) { 

              $res_address          = new PoiAddress();
              $res_address->line_1  = $request['resindential_line_1'][$i];
              $res_address->gps_lng = $request['reslong'][$i];
              $res_address->gps_lat = $request['reslat'][$i];
              $res_address->poi_id  = $poi->id;
              $res_address->type    = 1;
              $res_address->save();

          }



        }

      if(!is_null($request['travel_movement'])) {

          $existing_travel_movement = PoiTravelMovement::where('poi_id',$poi->id)->get();

          if (sizeof($existing_travel_movement) > 0) {

              foreach ($existing_travel_movement as $travel_movement) {
                
                  $object = PoiTravelMovement::find($travel_movement->id);
                  $object->delete();
              }

          }

            for ($i=0; $i < sizeof($request['travel_movement']) ; $i++) { 
              
                  $PoiTravelMovement                  = new PoiTravelMovement();
                  $PoiTravelMovement->poi_id          = $poi->id;
                  $PoiTravelMovement->name            = $request['travel_movement'][$i];
                  $PoiTravelMovement->gps_lat         = $request['lat'][$i];
                  $PoiTravelMovement->gps_lng         = $request['long'][$i];
                  $PoiTravelMovement->date_seen       = $request['date_seen'][$i];
                  $PoiTravelMovement->created_by      = \Auth::user()->id;
                  $PoiTravelMovement->save();

            }

              



        }

        if(!is_null($request['crime_description'])) {

          $existing_criminal_records = PoiCriminalRecord::where('poi_id',$poi->id)->get();

          if (sizeof($existing_criminal_records) > 0) {

              foreach ($existing_criminal_records as $criminal_record) {
                
                  $object = PoiCriminalRecord::find($criminal_record->id);
                  $object->delete();
              }

          }

          for ($i=0; $i < sizeof($request['crime_description']) ; $i++) { 
            
                $PoiCriminalRecord                                      = new PoiCriminalRecord();
                $PoiCriminalRecord->poi_id                              = $poi->id;
                $PoiCriminalRecord->description                         = $request['crime_description'][$i];
                $PoiCriminalRecord->police_station                      = $request['police_station'][$i];
                $PoiCriminalRecord->investigation_officer               = $request['investigation_officer'][$i];
                $PoiCriminalRecord->investigation_officer_mobile_number = $request['investigation_officer_mobile_number'][$i];
                $PoiCriminalRecord->sentence                            = $request['sentence'][$i];
                $PoiCriminalRecord->criminal_record_date                = $request['criminal_record_date'][$i];
                $PoiCriminalRecord->created_by      = \Auth::user()->id;
                $PoiCriminalRecord->save();

          }
        }








      

        

        \Session::flash('flash_message','Profile successfully updated.');

        return redirect()->back();




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function resendPassword($id)
    {



        return redirect('list-users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id,User $user)
    {


      $userObj = User::find($id);

      $user = \DB::table('users')
                                      
                                    
                                      ->where('users.id','=',$id)
                                      ->select(
                                                \DB::raw("
                                                            users.id,
                                                            users.name,
                                                            users.active,
                                                            users.surname,
                                                            users.id_number,
                                                            users.cellphone,
                                                            users.dob,
                                                            users.gender,
                                                            users.email,
                                                            users.area,
                                                            users.street_number,
                                                            users.route,
                                                            users.locality,
                                                            users.administrative_area_level_1,
                                                            users.postal_code,
                                                            users.country,
                                                            users.company,
                                                            users.alt_email,
                                                            users.alt_cellphone
                                                          "
                                                ))
                                      ->first();


          if ($userObj->role > 0) {


             $role = UserRole::find($userObj->role);
             $user->role = $role->slug;


          }
          if ($userObj->role > 0) {


             $role = UserRole::find($userObj->role);
             $user->role = $role->slug;


          }
          if ($userObj->language > 0) {


             $language = Language::find($userObj->language);
             $user->language = $language->slug;


          }

          if ($userObj->affiliation > 0) {


             $affiliation = Affiliation::find($userObj->affiliation);
             $user->affiliation = $affiliation->slug;


          }

          if ($userObj->department > 0) {

             $department = Department::find($userObj->department);
             $user->department = $department->slug;

          }


          if ($userObj->position > 0) {

             $position = Position::find($userObj->position);
             $user->position = $position->slug;


          }

           if ($userObj->title > 0) {

             $title = Title::find($userObj->title);
             $user->title = $title->slug;


          }






       return [$user];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateUserRequest $request)
    {
        
        $user                              = User::where('id',$request['userID'])->first();
        $sendSMS                           = $user->status;
        $role                              = UserRole::where('slug','=',$request['role'])->first();
        $user->role                        = $role->id;
        $title                             = Title::where('slug','=',$request['title'])->first();
        $user->title                       = $title->id;
        $user->name                        = $request['name'];
        $user->surname                     = $request['surname'];
        $user->id_number                   = $request['id_number'];
        $user->alt_cellphone               = $request['alt_cellphone'];
        $user->alt_email                   = $request['alt_email'];
        $user->active                      = $request['status'];
        $user->department                  = $request['department'];
        $user->gender                      = $request['gender'];
        $user->street_number               = $request['street_number'];
        $user->route                       = $request['route'];
        $user->locality                    = $request['locality'];
        $user->administrative_area_level_1 = $request['administrative_area_level_1'];
        $user->postal_code                 = $request['postal_code'];
        $user->country                     = $request['country'];  
        $department                        = Department::where('slug','=',$request['department'])->first();
        $user->department                  = (sizeof($department) > 0)?$department->id:0;
        $position                          = Position::where('slug','=',$request['position'])->first();
        $user->position                    = (sizeof($position) > 0)?$position->id:0;
        $user->area                        = $request['area'];
        $user->api_key                     = uniqid();
        $user->created_by                  = \Auth::user()->id;
        
        if ($request['affiliation']) {

            $user->affiliation       = $request['affiliation'];

        }
         else {

            $user->affiliation = 1;

         }


        $user->updated_by    = \Auth::user()->id;
        $user->updated_at    =  \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
        $userStatusObj       = UserStatus::where('name','=','active')->first();
        $user->active        = $userStatusObj->id;
        $user->save();

         $data = array(
                    'name'      =>  $user->name

          );

         $cellphone = $user->cellphone;
         $language  = Language::find($user->language);


        if ( $sendSMS == 2) {



          switch ($language->name) {
            case 'English':
               \Mail::send('emails.registrationConfirmationSMS',$data, function($message) use ($cellphone)
                  {
                        $message->from('info@siyaleader.net', 'Siyaleader');
                        $message->to('cooluma@siyaleader.net')->subject("ACT: $cellphone" );

                  });
              break;

              case 'IsiZulu':
               \Mail::send('emails.registrationConfirmationSMSZulu',$data, function($message) use ($cellphone)
                  {
                        $message->from('info@siyaleader.net', 'Siyaleader');
                        $message->to('cooluma@siyaleader.net')->subject("ACT: $cellphone" );

                  });
              break;

            default:
              \Mail::send('emails.registrationConfirmationSMS',$data, function($message) use ($cellphone)
                {
                      $message->from('info@siyaleader.net', 'Siyaleader');
                      $message->to('cooluma@siyaleader.net')->subject("ACT: $cellphone" );

                });
              break;
          }


        }


        \Session::flash('success', 'well done! User '.$request['name'].' has been successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getHouseHolder()
    {
        $searchString   = \Input::get('q');
        $users          = \DB::table('users')
            
            ->join('users_roles','users.role','=','users_roles.id')
            ->whereRaw(
                            "CONCAT(`users`.`name`, ' ', `users`.`surname`, ' ', `users`.`cellphone`) LIKE '%{$searchString}%'")
            ->select(
                        array

                            (
                                'users.id as id',
                                'users.name as name',
                                'users_roles.name as role',
                                'users.surname as surname',
                                'users.username as username',
                                'users.cellphone as cellphone',
                                'users.area as area',
                                'users.company as company'
                             


                            )
                    )

            ->get();

        $data = array();

       foreach ($users as $user) {

            $data[] = array(
                                "name"              => "{$user->name} > {$user->surname} > {$user->cellphone}",
                                "id"                => "{$user->id}",
                                "hseName"           => "{$user->name}",
                                "hseSurname"        => "{$user->surname}",
                                "hseCellphone"      => "{$user->cellphone}",
                                "hseCompany"        => "{$user->company}",




                               


                            );
       }

        return $data;
    }

     public function getPoi()
    {
        $searchString   = \Input::get('q');
        $pois           = \DB::table('poi')
           
            ->whereRaw(
                            "CONCAT(`poi`.`name`,' ', `poi`.`surname`) LIKE '%{$searchString}%'")
            ->select(
                        array(
                                'poi.id as id',
                                'poi.name as name',
                                'poi.surname as surname'           


                            )
                    )

            ->get();

        $data = array();

       foreach ($pois as $poi) {

            $data[] = array(
                                "name"              => "{$poi->name} > {$poi->surname}",
                                "id"                => "{$poi->id}"
                               


                            );
       }

        return $data;
    }


       public function getCaseSearch()
    {
        $searchString = \Input::get('q');
        $cases        = \DB::table('cases')
           
            ->whereRaw(
                            "CONCAT(`cases`.`description`,' ', `cases`.`id`) LIKE '%{$searchString}%'")
            ->select(
                        array(
                                'cases.id as id',
                                'cases.description as name',
                                        


                            )
                    )

            ->get();

        $data = array();

       foreach ($cases as $case) {

            $data[] = array(
                                "name"              => "Case Number: {$case->id} > Description : {$case->name}",
                                "id"                => "{$case->id}"
                               


                            );
       }

        return $data;
    }





    public function getFieldWorker()
    {
        $searchString   = \Input::get('q');
        $users          = \DB::table('users')
            ->join('languages','users.language','=','languages.id')
            ->join('provinces','users.province','=','provinces.id')
            ->join('districts','users.district','=','districts.id')
            ->join('titles','users.title','=','titles.id')
            ->join('municipalities','users.municipality','=','municipalities.id')
            ->join('wards','users.ward','=','wards.id')
            ->join('users_roles','users.role','=','users_roles.id')
            ->where('users_roles.name','=',"Field Worker")
            ->whereRaw(
                            "CONCAT(`users`.`name`, ' ', `users`.`surname`, ' ', `users`.`cellphone`) LIKE '%{$searchString}%'")
            ->select(
                        array

                            (
                                'users.id as id',
                                'users.id_number as id_number',
                                'users.name as name',
                                'users_roles.name as role',
                                'users.surname as surname',
                                'users.username as username',
                                'users.cellphone as cellphone',
                                'languages.slug as language',
                                'provinces.slug as province',
                                'districts.slug as district',
                                'municipalities.slug as municipality',
                                'wards.slug as ward',
                                'titles.slug as title',
                                'users.area',
                                'users.house_number',
                                'users.gender',
                                'users.dob'
                            )
                    )

            ->get();

        $data = array();

       foreach ($users as $user) {

            $data[] = array(
                                "name"              => "{$user->name} > {$user->surname} > {$user->cellphone}",
                                "id"                => "{$user->id}",
                                "fldName"           => "{$user->name}",
                                "fldSurname"        => "{$user->surname}",
                                "fldIdNumber"       => "{$user->id_number}",
                                "fldCellphone"      => "{$user->cellphone}",
                                "fldLanguage"       => "{$user->language}",
                                "fldProvince"       => "{$user->province}",
                                "fldDistrict"       => "{$user->district}",
                                "fldMunicipality"   => "{$user->municipality}",
                                "fldWard"           => "{$user->ward}",
                                "fldArea"           => "{$user->area}",
                                "fldNumber"         => "{$user->house_number}",
                                "fldTitle"          => "{$user->title}",
                                "fldGender"         => "{$user->gender}",
                                "fldDob"            => "{$user->dob}"
                            );
       }

        return $data;
    }

    public function show(Request $request) {


        $fromDate      = $request['fromDate']." 00:00:00";
        $toDate        = $request['toDate']." 23:59:59";
        $province      = $request['province'];
        $district      = $request['district'];
        $status        = $request['status'];
        $role          = $request['role'];
        $gender        = $request['gender'];
        $created_by    = $request['createdBy'];
        $position      = $request['position'];
        $department    = $request['department'];

        if ($province == "0") {

            $province = "%";
        }

        if ($district == "0") {

            $district = "%";
        }

        if ($status == "0") {

            $status = "%";
        }

        if ($role == "0") {

            $role = "%";
        }

        if ($gender == "0") {

            $gender = "%";
        }


        if ($created_by == "0") {

            $created_by = "%";
        }

        if ($position == "0") {

            $position = "%";
        }

        if ($department == "0") {

            $department = "%";
        }






        $users = \DB::table('users')
            ->join('provinces', 'users.province', '=', 'provinces.id')
            ->join('districts', 'users.district', '=', 'districts.id')
            ->join('users_statuses', 'users.active', '=', 'users_statuses.id')
            ->join('users_roles', 'users.role', '=', 'users_roles.id')
            ->select(
                        \DB::raw(
                                    "
                                        users.id,
                                        users.name,
                                        users.created_at,
                                        users.surname,
                                        users.cellphone,
                                        users.email,
                                        users_statuses.name as active

                                    "
                                )
                        )
            ->whereBetween('users.created_at', array($fromDate,$toDate))
            ->where('provinces.slug','LIKE',$province)
            ->where('districts.slug','LIKE',$district)
            ->where('users_statuses.id','LIKE',$status)
            ->where('users_roles.slug','LIKE',$role)
            ->where('users.gender','LIKE',$gender)
            ->whereRaw("CONCAT(`users`.`name`, ' ', `users`.`surname`) LIKE '$created_by'")
            ->groupBy('users.id');

        return \Datatables::of($users)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateUserModal({{$id}});" data-target=".modalEditUser">Edit</a>')
                            ->make(true);



    }


    public function poimap($poi_id) {

      $movements      = array();     
      $poi_travements = PoiTravelMovement::where('poi_id',$poi_id)->get();

      return view('users.poimap',compact('poi_travements'));
    }
}
