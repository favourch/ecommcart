<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.admin.customer.upload', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.upload_csv') }}
        </div>
        <div class="modal-body">
            <ul>
                <li>{!! trans('help.upload_rows', ['rows' => 40]) !!}</li>
                <li>{!! trans('help.download_template', ['url' => route('admin.admin.customer.downloadTemplate')]) !!}</li>
                <li>{!! trans('help.first_row_as_header') !!}</li>
                <li>{!! trans('help.invalid_rows_will_ignored') !!}</li>
            </ul>
            <span class="spacer20"></span>
            <div class="row">
                <div class="col-md-9 nopadding-right">
                    <input id="uploadFile" placeholder="{{ trans('app.placeholder.select_csv_file') }}" class="form-control" disabled="disabled" style="height: 28px;" />
                </div>
                <div class="col-md-3 nopadding-left">
                    <div class="fileUpload btn btn-primary btn-block btn-flat">
                      <span>{{ trans('app.form.select') }} CSV</span>
                      <input type="file" name="customers" id="uploadBtn" class="upload" />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.upload'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->