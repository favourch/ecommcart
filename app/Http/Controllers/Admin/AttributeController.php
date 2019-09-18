<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use App\Http\Requests\Validations\CreateAttributeRequest;
use App\Http\Requests\Validations\UpdateAttributeRequest;

class AttributeController extends Controller
{
    use Authorizable;

    private $model_name;

    private $attribute;

    /**
     * construct
     */
    public function __construct(AttributeRepository $attribute)
    {
        parent::__construct();

        $this->model_name = trans('app.model.attribute');

        $this->attribute = $attribute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->attribute->all();

        $trashes = $this->attribute->trashOnly();

        return view('admin.attribute.index', compact('attributes', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttributeRequest $request)
    {
        $this->attribute->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display all Attribute Values the specified Attribute.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function entities($id)
    {
        $entities = $this->attribute->entities($id);

        return view('admin.attribute.entities', $entities);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = $this->attribute->find($id);

        return view('admin.attribute._edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Attribute  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        $this->attribute->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->attribute->trash($id);

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
        $this->attribute->restore($id);

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
        $this->attribute->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Save sorting order for attributes by ajax
     */
    public function reorder(Request $request)
    {
        $this->attribute->reorder($request->all());

        return response('success!', 200);
    }

    /**
     * Response AJAX call to check if the attribute is a color/pattern type or not
     */
    public function ajaxGetParrentAttributeType(Request $request)
    {
        if ($request->ajax()){
            $type_id = $this->attribute->getAttributeTypeId($request->input('id'));

            if($type_id)
                return response("$type_id", 200);
        }

        return response('Not found!', 404);
    }

}
