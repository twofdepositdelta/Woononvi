@extends('back.layouts.master')
@section('title', 'Chat Support')
@section('content')
<div class="chat-wrapper">
    <div class="chat-sidebar card">
        @include('back.pages.support.chat.chat-sidebar-single')
        @include('back.pages.support.chat.chat-search')
        @include('back.pages.support.chat.chat-all-list')
    </div>
    @include('back.pages.support.chat.chat-main')
</div>
@endsection
