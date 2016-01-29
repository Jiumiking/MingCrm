@extends('layouts.simple')

@section('content')
<div class="login-container">
    <div class="row">
        <div class="col-sm-6">
            <!-- Errors container -->
            <div class="errors-container">
                @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>
            <!-- Add class "fade-in-effect" for login form effect -->
            <form class="login-form fade-in-effect" role="form" method="POST" id="login" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="login-header">
                    <a href="login" class="logo">
                        <img src="/images/logo@2x.png" alt="" width="80" />
                        <span>欢迎登录</span>
                    </a>
                    {{--<p>Dear user, log in to access the admin area!</p>--}}
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Username</label>
                    <input type="text" class="form-control input-dark" name="email" id="email" value="{{ old('email') }}" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <input type="password" class="form-control input-dark" name="password" id="password" autocomplete="off" />
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class=" input-dark" name="remember" id="remember"> Remember Me
                            {{--<input class="form-control" type="hidden">--}}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        登录
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($)
    {
        // Reveal Login form
        setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
        // Validation and Ajax action
        $("form#login").validate({
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: 'Please enter your username.'
                },

                password: {
                    required: 'Please enter your password.'
                }
            },
        });

        // Set Form focus
        $("form#login .form-group:has(.form-control):first .form-control").focus();
    });
</script>
@endsection
