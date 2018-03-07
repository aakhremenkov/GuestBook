@extends('appPage')

@section("header")
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
@endsection

@section("content")
    <form class="form-horizontal" method="POST" action="{{route('signup')}}" id="signupId">
        {{ csrf_field() }}

        <div class="container">
            <h2>Signup</h2>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="email" id="emailId" required placeholder="E-mail" value="{{ old('email') }}"><br>
                    @if ($errors->has('email'))
                        <span class="necessarily"><strong>{{ $errors->first('email') }}</strong></span><br>
                    @endif
                    <input type="text" class="form-control" name="username" id="usernameId" required placeholder="User name" value="{{ old('username') }}"><br>
                    @if ($errors->has('username'))
                        <span class="necessarily"><strong>{{ $errors->first('username') }}</strong></span><br>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">Birthdate</div>
                <div class="col-md-4">
                    <div class="input-append date" id="dp"  data-date="{{ date("d/m/Y")}}" data-date-format="dd/mm/yyyy">
                        <div class="form-group">
                            <input type="text" class="form-control add-on" id="birthdateId"
                                   placeholder="DD/MM/YYYY" value="{{ old('birthdate') }}" required  name="birthdate" readonly>
                        </div>
                    </div>
                    @if ($errors->has('birthdate'))
                        <span class="necessarily"><strong>{{ $errors->first('birthdate') }}</strong></span><br>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-2">Sex</div>
                <div class="col-md-4">
                    <select name="sex" id="sexId" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="errorMsg" class="error-label"></div>
                    <button type="button" class="btn btn-default " id="addBtn">Submit</button>
                </div>
            </div>



        </div>
    </form>
@endsection

@section('script')
    <script src="/js/bootstrap-datepicker.js"></script>
    <script>
        $(function() {
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear()-1, nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            window.prettyPrint && prettyPrint();
            var dtpicker = $('#dp').datepicker({
                onRender: function(date) {
                    return date.valueOf() > now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function(ev) {
                dtpicker.hide();
            }).data('datepicker');

            $('#addBtn').on('click', checkInput);
        });

        function checkInput()
        {
            var email = $('#emailId').val();
            var username = $('#usernameId').val();
            var birthdate = $('#birthdateId').val();

            $("#errorMsg").html('');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    type: "POST",
                    accept: "application/json",
                    dataType: "json",
                    data: {
                        'email': email,
                        'username': username,
                        'birthdate': birthdate
                    },
                    url: '{{route('signupValidate')}}',
                    statusCode: {
                        422: function(xhr, ajaxOptions, thrownError) {
                            var response =  JSON.parse(xhr.responseText);
                            if(response.hasOwnProperty('email')) {
                                $("#errorMsg").append(response.email[0] + "<br>");
                            }
                            if(response.hasOwnProperty('username')) {
                                $("#errorMsg").append(response.username[0] + "<br>");
                            }
                            if(response.hasOwnProperty('birthdate')) {
                                $("#errorMsg").append(response.birthdate[0] + "<br>");
                            }
                        }
                    },
                }
            ).done(function (res)  {
                if(res.hasOwnProperty('success')){
                    $('#signupId').submit();
                }
                else{
                    $("#errorMsg").html('Try to signup latter.');
                }
            });
        }
    </script>

@endsection
