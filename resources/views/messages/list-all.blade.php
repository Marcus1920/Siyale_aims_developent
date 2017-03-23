
@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li><a href="#">Library</a></li>
    <li class="active">Data</li>
</ol>

<h4 class="page-title b-0">Messages</h4>

<div class="message-list list-container">
    <header class="listview-header media">
        <input type="checkbox" class="pull-left list-parent-check" value="">

        <ul class="list-inline pull-right m-t-5 m-b-0">
            <li class="pagin-value hidden-xs">35-70</li>
            <li>
                <a href="" title="Previous" class="tooltips">
                    <i class="sa-list-back"></i>
                </a>
            </li>
            <li>
                <a href="" title="Next" class="tooltips">
                    <i class="sa-list-forwad"></i>
                </a>
            </li>
        </ul>

        <ul class="list-inline list-mass-actions pull-left">
            <li>
                <a  href="#" title="Add" class="tooltips">
                    <i class="sa-list-add"></i>
                </a>
            </li>
            <li>
                <a href="" title="Refresh" class="tooltips">
                    <i class="sa-list-refresh"></i>
                </a>
            </li>
            <li class="show-on" style="display: none;">
                <a href="" title="Move" class="tooltips">
                    <i class="sa-list-move"></i>
                </a>
            </li>
            <li class="show-on" style="display: none;">
                <a href="" title="Delete" class="tooltips">
                    <i class="sa-list-delete"></i>
                </a>
            </li>
        </ul>

        <input class="input-sm col-md-4 pull-right message-search" type="text" placeholder="Search....">

        <div class="clearfix"></div>
    </header>

    @foreach ($msgs as $msg)

        <?php $bold = ($msg->read == 0)? "f-bold" : ""; ?>
        <div class="media">
        <input type="checkbox" class="pull-left list-check">

        <a class="media-body" href="{{ url('message-detail/') }}/{{ $msg->id }}">
            <div class="pull-left list-title">
                <span class="t-overflow {{ $bold }}">{{ $msg->originator }}</span>
            </div>
            <div class="pull-right list-date">{{ $msg->created_at }}</div>
            <div class="media-body hidden-xs">
                <span class="t-overflow">{{ $msg->message }}</span>
            </div>
        </a>
    </div>

    @endforeach

<!-- Compose -->
<div class="modal fade" id="compose-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">NEW MESSAGE</h4>
            </div>
            <div class="modal-header p-0">
                <input type="text" class="form-control input-sm input-transparent" placeholder="To...">
            </div>
            <div class="modal-header p-0">
                <input type="text" class="form-control input-sm input-transparent" placeholder="Subject...">
            </div>
            <div class="p-relative">
                <div class="message-options">
                    <img src="img/icon/tile-actions.png" alt="">
                </div>
                <textarea class="message-editor" placeholder="Message..."></textarea>
            </div>
            <div class="modal-footer m-0">
                <button class="btn">Send</button>
                <button class="btn">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')

@endsection


