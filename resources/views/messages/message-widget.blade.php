<div class="s-widgets">
    <div class="m-5">
        <a href="#" class="btn btn-sm btn-block">Compose Message</a>
    </div>

    <div class="list-group m-t-10 list-group-flat">
        <a href="{{ url('/all-messages') }}" class="list-group-item active">Inbox<span class="badge badge-trp">{{ count($noInboxMessages,0) }}</span></a>
        <a href="#" class="list-group-item">Important<span class="badge badge-trp"></span></a>
        <a href="#" class="list-group-item">Starred<span class="badge badge-trp"></span></a>
        <a href="#" class="list-group-item">Drafts<span class="badge badge-trp"></span></a>
        <a href="#" class="list-group-item">Sent Mail</a>
        <a href="#" class="list-group-item">Spam<span class="badge badge-trp"></span></a>
    </div>
</div>
