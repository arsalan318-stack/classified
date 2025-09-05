@extends('user.navbar')
@section('content')
<livewire:chat.chat-inbox :conversationId="$conversationId"/>
@endsection