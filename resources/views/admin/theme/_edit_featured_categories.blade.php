<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::open(['route' => 'admin.appearance.update.featuredCategories', 'method' => 'PUT', 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.featured_categories') }}
        </div>
        <div class="modal-body">
            <div class="form-group">
              {!! Form::label('featured_categories[]', trans('app.form.categories').'*') !!}
              {!! Form::select('featured_categories[]', $categories , array_keys($featured_categories), ['class' => 'form-control select2-normal', 'multiple' => 'multiple', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->