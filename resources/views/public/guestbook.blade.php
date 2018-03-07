@extends('appPage')

@section('content')


    <div class="container">
    <h2>Guest Book</h2>
    <div class="guestbook">
        @forelse ($messages as $message)
        <div class="row">
            <div class="col-md-3">
                User : {{$message->User->username}}
                <a href="{!!  $message->ImageUrl()!!}" target="_blank"><img src="{!!  $message->ImageUrl()!!}" class="rounded preview" /></a><br>

                @if(\Illuminate\Support\Facades\Auth::user())
                    @if(!$message->hasResponse && \Illuminate\Support\Facades\Auth::user()->id == $message->user_id)
                        <a href="{!! route('edit', $message->id) !!}" class="btn btn-sm btn-primary">Edit</a>
                    @endif
                    <a href="{!! route('response', $message->id) !!}"  class="btn btn-sm btn-primary">Add response</a>
                @endif
            </div>
            <div class="col-md-9">
                {!!  $message->message!!}
            </div>
        </div>
        {!!\App\Helper::ShowResponses($message, 1)!!}
    @empty
        No messages.
    @endforelse
        {{  $messages->render('pagination::bootstrap-4')}}
    </div>
    </div>
    <br>
    <hr>
    <br>
    @if(\Illuminate\Support\Facades\Auth::user())
    <form action="{{ route('addMessage') }}" method="post" enctype="multipart/form-data" id="signupId">
        {{ csrf_field() }}
        <input type="hidden" name="action" value="add"/>
    <div class="container">
        <h2>Add message</h2>
        <div class="row">
            <div class="col-md-6">
                <textarea name="message" id="messageId" rows="5" cols="40" class="form-control"></textarea>
            </div>
            <div class="col-md-4"><input type="file" name="file" id="fileId" /></div>
            <div class="col-md-2">
                <button type="button" class="btn btn-default " id="addBtn">Submit</button>
                <div id="errorMsg" class="error-label"></div>
            </div>
        </div>
    </div>
    </form>
    @else
        <h2>Login or signup to add messages</h2>
    @endif
    <input type="hidden" id="validateMessageUrl" value="{{route('messageValidate')}}"/>
@endsection


@section('script')

<script>
    $(function() {
        $('#addBtn').on('click', checkInput);
    });

</script>

@endsection
