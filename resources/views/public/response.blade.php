@extends('appPage')

@section('content')


    <form action="{{ route('addMessage') }}" method="post" enctype="multipart/form-data" id="signupId">
        {{ csrf_field() }}
        <input type="hidden" name="parentId" value="{{$message->id}}"/>
        <input type="hidden" name="action" value="response"/>
        <div class="container">
            <h2>Add response</h2>
            <div class="row">
                <div class="col-md-6">
                    <textarea name="message" id="messageId" rows="5" cols="40" class="form-control"></textarea>
                </div>
                <div class="col-md-4"><input type="file" name="file" id="fileId" /></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-default " id="addBtn">Add</button>
                    <div id="errorMsg" class="error-label"></div>
                </div>
                <div class="col-md-6">
                    <a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
                </div>

            </div>
        </div>
    </form>
    <input type="hidden" id="validateMessageUrl" value="{{route('messageValidate')}}"/>
@endsection


@section('script')

    <script>
        $(function() {
            $('#addBtn').on('click', checkInput);
        });

    </script>

@endsection
