<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubSubCategoryRequest;
use App\Http\Controllers\Controller;
use App\SubSubCategory;

class SubSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $subSubCategories  = SubSubCategory::select(array('id','name','created_at'))->where('sub_category','=',$id);
        return \Datatables::of($subSubCategories)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateSubSubCategoryModal({{$id}});" data-target=".SubSubCategoryEditModal">Edit</a>
                                                   <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchSubSubCatResponders({{$id}});" data-target=".modalSubSubResponder">Set Responders</a>

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
    public function store(SubSubCategoryRequest $request)
    {
        $SubSubCategory               = new SubSubCategory();
        $SubSubCategory->name         = $request['name'];
        $slug                         = preg_replace('/\s+/','-',$request['name']);
        $SubSubCategory->slug         = $slug;
        $SubSubCategory->sub_category = $request['subCatID'];
        $SubSubCategory->created_by  = \Auth::user()->id;
        $SubSubCategory->save();
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
        $SubSubCat    = SubSubCategory::where('id',$id)->first();
        return [$SubSubCat];
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
        $subSubCategory             = SubSubCategory::where('id',$request['subsubCategoryID'])->first();
        $subSubCategory->name       = $request['name'];
        $SubSubCategory->updated_by = \Auth::user()->id;
        $subSubCategory->save();
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
