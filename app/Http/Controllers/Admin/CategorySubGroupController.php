<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateCategorySubGroupRequest;
use App\Http\Requests\Validations\UpdateCategorySubGroupRequest;
use App\Repositories\CategorySubGroup\CategorySubGroupRepository;

class CategorySubGroupController extends Controller
{
    use Authorizable;

    private $model_name;

    private $categorySubGroup;

    /**
     * construct
     */
    public function __construct(CategorySubGroupRepository $categorySubGroup)
    {
        parent::__construct();
        $this->model_name = trans('app.model.category_group');
        $this->categorySubGroup = $categorySubGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorySubGrps = $this->categorySubGroup->all();

        $trashes = $this->categorySubGroup->trashOnly();

        return view('admin.category.categorySubGroup', compact('categorySubGrps', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category._createSubGrp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategorySubGroupRequest $request)
    {
        $this->categorySubGroup->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $categorySubGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorySubGroup = $this->categorySubGroup->find($id);

        return view('admin.category._editSubGrp', compact('categorySubGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorySubGroupRequest $request, $id)
    {
        $this->categorySubGroup->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->categorySubGroup->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->categorySubGroup->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->categorySubGroup->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

}
