<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AttributeValue\AttributeValueRepository;
use App\Http\Requests\Validations\CreateAttributeValueRequest;
use App\Http\Requests\Validations\UpdateAttributeValueRequest;

class AttributeValueController extends Controller
{
    private $model_name;

    private $attribute_value;

    /**
     * construct
     */
    public function __construct(AttributeValueRepository $attribute_value)
    {
        parent::__construct();

        $this->model_name = trans('app.model.attribute_value');

        $this->attribute_value = $attribute_value;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $attribute = $this->attribute_value->create($id);

        return view('admin.attribute-value._create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttributeValueRequest $request)
    {
        $this->attribute_value->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display all Attribute Values the specified Attribute.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attributeValue = $this->attribute_value->find($id);

        return view('admin.attribute-value._show', compact('attributeValue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributeValue = $this->attribute_value->find($id);

        $this->authorize('update', $attributeValue);

        $attribute = $this->attribute_value->getAttribute($attributeValue->attribute_id);

        return view('admin.attribute-value._edit', compact('attributeValue', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeValueRequest $request, $id)
    {
        $attributeValue = $this->attribute_value->find($id);

        $this->authorize('update', $attributeValue);

        $this->attribute_value->update($request, $id);

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
        $attributeValue = $this->attribute_value->find($id);

        $this->authorize('delete', $attributeValue);

        $this->attribute_value->trash($id);

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
        $this->attribute_value->restore($id);

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
        $this->attribute_value->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Save sorting order for attributes by ajax
     */
    public function reorder(Request $request)
    {
        $this->attribute_value->reorder($request->all());

        return response('success!', 200);
    }

}
