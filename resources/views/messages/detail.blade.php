@extends('master')

@section('content')

<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li class="active">Console</li>
</ol>

<h4 class="page-title">Messages</h4>

<div id="caseNotifyMessage"><div>

 <div class="listview list-click">
        <header class="listview-header media">
            <ul class="list-inline pull-right m-t-5 m-b-0">
                <li class="pagin-value hidden-xs">35-70</li>
                <li>
                    <a href="messages.html" title="Previous" class="tooltips">
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
                <li class="m-r-10">
                    <a href="{{ url('/all-messages') }}" title="Back to Inbox" class="tooltips">
                        <i class="sa-list-back"></i>
                    </a>
                </li>
                <li>
                    <a href="" title="Delete" class="tooltips">
                        <i class="sa-list-delete"></i>
                    </a>
                </li>
            </ul>

            <div class="clearfix"></div>
        </header>

        <h2 class="page-title">{{ $msgObj->subject }}</h2>

        <div class="media message-header o-visible">
            <img src="{{ url('img/profile-pics/7.png') }}" alt="" class="pull-left" width="40">
            <div class="pull-right dropdown m-t-10">
                <a href="" data-toggle="dropdown" class="p-5">Options</a>
                <ul class="dropdown-menu text-right">
                    <li><a href="" data-toggle="modal" data-subject="{{ $msgObj->subject }}" data-dest="{{ $msgObj->from }}" data-name="{{$sender->name}} {{$sender->surname}}" data-target=".compose-message" onClick="launchMessageModalW(this);">Reply</a></li>
                </ul>
            </div>
            <div class="media-body">
                <span class="f-bold pull-left m-b-5">{{ $sender->name }} {{ $sender->surname }}</span>
                <div class="clearfix"></div>
                <span class="dropdown m-t-5">
                    To <a href="" class="underline">Me</a> on {{ $msgObj->created_at }}
                </span>
            </div>
        </div>

        <div class="p-15">
            {!! html_entity_decode($msgObj->message) !!}
        </div>

    <hr class="whiter">


</div>


@endsection

@section('footer')

@endsection

