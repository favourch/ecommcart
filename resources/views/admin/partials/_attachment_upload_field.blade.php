<div class="row">
    <div class="col-md-9 nopadding-right">
        <input id="uploadFile" placeholder="{{ trans('app.placeholder.attachments') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
        <div class="fileUpload btn btn-primary btn-block btn-flat">
          	<span>{{ trans('app.form.upload') }}</span>
            <input type="file" name="attachments[]" id="uploadBtn" class="upload" multiple />
      	</div>
    </div>
</div>