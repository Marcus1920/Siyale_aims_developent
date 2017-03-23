<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Controllers\Controller;
use App\SubCategory;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $subCategories = SubCategory::select(array('id','name','created_at'))->where('category','=',$id);
        return \Datatables::of($subCategories)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateSubCategoryModal({{$id}});" data-target=".modalEditSubCategory">Edit</a>
                                                   <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchSubCatResponders({{$id}});" data-target=".modalSubResponder">Set Responders</a>
                                                   <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchWorkFlow({{$id}});" data-target=".modalWorkflows">Add Workflow</a>

                                                   ')
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SubCategoryRequest $request)
    {
         $Subcategory           = new SubCategory();
         $Subcategory->name     = $request['name'];
         $slug                  = preg_replace('/\s+/','-',$request['name']);
         $Subcategory->slug     = $slug;
         $Subcategory->category = $request['subCatID'];
         $Subcategory->created_by  = \Auth::user()->id;
         $Subcategory->save();
        \Session::flash('success', $request['name'].' has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $SubCat    = SubCategory::where('id',$id)->first();
        return [$SubCat];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $subCategory             = SubCategory::where('id',$request['subCategoryID'])->first();
        $subCategory->name       = $request['name'];
        $subCategory->updated_by = \Auth::user()->id;
        $subCategory->save();
        \Session::flash('success', $request['name'].' has been successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
