@extends('layouts.app')

@section('title', trans('messages.change').' '.trans('messages.users.password'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.users') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('users.index') }}">{{ trans('messages.mainapp.menu.users') }}</a></li>
                        <li class="active">{{ trans('messages.change') }} {{ trans('messages.users.password') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('users.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="pass" action="{{ route('post_user_password', ['users' => $cuser->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="password">{{ trans('messages.users.password') }}</label>
                            <input id="password" type="password" name="password" placeholder="{{ trans('messages.users.password') }}" value="{{ old('password') }}" data-error=".password">
                            <div class="password">
                                @if($errors->has('password'))<div id="name-error" class="error">{{ $errors->first('password') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="password_confirmation">{{ trans('messages.users.confirm') }} {{ trans('messages.users.password') }}</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ trans('messages.users.confirm') }} {{ trans('messages.users.password') }}" value="{{ old('password_confirmation') }}" data-error=".password_confirmation">
                            <div class="password_confirmation">
                                @if($errors->has('password_confirmation'))<div id="name-error" class="error">{{ $errors->first('password_confirmation') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light right" type="submit">
                                {{ trans('messages.update') }}<i class="mdi-action-swap-vert left"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#pass").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection
