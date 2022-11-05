@extends('voyager::auth.master')

@section('content')
    <div class="login-container">


        @if(!$errors->isEmpty())
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    <li>3개월이 지나서 비밀번호를 변경하셔야 합니다.</li>
                </ul>
            </div>
        @endif
        <p>비밀번호 변경</p>

        <form action="{{ route('voyager.pwchange.update') }}" method="POST">
            {{ csrf_field() }}


            <div class="form-group form-group-default" id="passwordGroup">
                <label>{{ __('voyager::generic.password') }}</label>
                <div class="controls">
                    <input type="password" name="new_password" placeholder="{{ __('voyager::generic.password') }}" class="form-control" >
                </div>
            </div>

            <div class="form-group form-group-default" id="passwordGroup">
                <label>비밀번호 확인</label>
                <div class="controls">
                    <input type="password" name="new_confirm_password" class="form-control" >
                </div>
            </div>

            <button type="submit" class="btn btn-block login-button">
                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                <span class="signin">비밀번호 수정</span>
            </button>

        </form>

        <div style="clear:both"></div>



    </div> <!-- .login-container -->
@endsection

@section('post_js')

    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev){
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
            document.getElementById('passwordGroup').classList.remove("focused");
        });

    </script>
@endsection
