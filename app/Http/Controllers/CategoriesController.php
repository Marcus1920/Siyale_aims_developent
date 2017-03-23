<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {

        $categories = Category::select(array('id','name','created_at'))->where('department','=',$id);
        return \Datatables::of($categories)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateCategoryModal({{$id}});" data-target=".modalEditCategory">Edit</a>')
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
    public function store(CategoryRequest $request)
    {
         $category             = new Category();
         $category->name       = $request['name'];
         $slug                 = preg_replace('/\s+/','-',$request['name']);
         $category->slug       = $slug.$request['deptID'];
         $category->department = $request['deptID'];
         $category->created_by = \Auth::user()->id;
         $category->save();
        \Session::flash('success', $request['name'].' category has been successfully added!');
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
        $cat    = Category::where('id',$id)->first();
        return [$cat];
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
        $category             = Category::where('id',$request['categoryID'])->first();
        $category->name       = $request['name'];
        $category->updated_by = \Auth::user()->id;
        $category->save();
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
