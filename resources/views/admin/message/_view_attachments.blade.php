<ul class="mailbox-attachments clearfix">
  @foreach($message->attachments as $attachment)
    <li>
      <span class="mailbox-attachment-icon small"><i class="fa fa-paperclip"></i></span>
      <div class="mailbox-attachment-info">
        <a href="{{ route('attachment.download', $attachment) }}" class="mailbox-attachment-name"><i class="fa fa-file"></i> {{ $attachment->name }}</a>
          <span class="mailbox-attachment-size">
            {{ get_formated_file_size($attachment->size) }}
            <a href="{{ route('attachment.download', $attachment) }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
          </span>
      </div>
    </li>
  @endforeach
</ul>