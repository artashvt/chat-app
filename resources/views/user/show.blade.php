@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- DIRECT CHAT SUCCESS -->
            <div class="card card-success card-outline direct-chat direct-chat-success">
                <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages"></div>
                    <!--/.direct-chat-messages-->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="{{'/messages'}}" method="post" id="chat-form">
                        <input type="hidden" id="id" name="user_id" value="{{request('id')}}">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-success btn-send">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/socket.io.min.js') }}"></script>
    <script>const roomId = '{{$roomId}}'</script>
    <script>const socket = io('{{env('NODE_HOST')}}');</script>
    <script>const authToken = '{{env('NODE_AUTH_TOKEN')}}';</script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
