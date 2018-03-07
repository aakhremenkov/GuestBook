@extends('appPage')

@section("content")

    <form id="form_auth" name="form_auth" method="post" target="_top" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="container">
            <h2>Login</h2>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="login" required placeholder="E-mail or username" value="{{ old('login') }}"><br>
                    @if ($errors->has('login'))
                        <span class="necessarily"><strong>{{ $errors->first('login') }}</strong></span><br>
                    @endif
                    <input type="password" class="form-control" name="password" required placeholder="Password"
                           value="{{ old('password') }}"><br>
                    @if ($errors->has('password'))
                        <span class="necessarily"><strong>{{ $errors->first('password') }}</strong></span><br>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="errorMsg" class="error-label">
                        @if (count( $errors ) > 0)
                                Incorect Login or password.
                        @endif
                    </div>
                    <button type="submit" class="btn btn-default " id="addBtn">Submit</button>
                </div>
            </div>


        </div>
    </form>
@endsection