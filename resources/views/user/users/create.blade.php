@extends('layouts.app')

@section('title', trans('messages.add').' '.trans('messages.mainapp.menu.users'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.users') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('users.index') }}">{{ trans('messages.mainapp.menu.users') }}</a></li>
                        <li class="active">{{ trans('messages.add') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('users.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="add" action="{{ route('users.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">{{ trans('messages.name') }}</label>
                            <input id="name" type="text" name="name" placeholder="{{ trans('messages.name') }}" value="{{ old('name') }}" data-error=".name">
                            <div class="name">
                                @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="username">{{ trans('messages.users.username') }}</label>
                            <input id="username" type="text" name="username" placeholder="{{ trans('messages.users.username') }}" value="{{ old('username') }}" data-error=".username">
                            <div class="username">
                                @if($errors->has('username'))<div class="error">{{ $errors->first('username') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="email">{{ trans('messages.users.email') }}</label>
                            <input id="email" type="text" name="email" placeholder="{{ trans('messages.users.email') }}" value="{{ old('email') }}" data-error=".email">
                            <div class="email">
                                @if($errors->has('email'))<div id="name-error" class="error">{{ $errors->first('email') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="role">{{ trans('messages.users.role') }}</label>
                            <input id="role" type="text" name="role" value="{{ trans('messages.mainapp.role.Staff') }}" data-error=".role" readonly>
                            <div class="role">
                                @if($errors->has('role'))<div id="name-error" class="error">{{ $errors->first('role') }}</div>@endif
                            </div>
                        </div>
                    </div>
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
                                {{ trans('messages.save') }}<i class="mdi-content-save left"></i>
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
        $("#add").validate({
            rules: {
                name: {
                    required: true
                },
                username: {
                    required: true,
                    minlength: 6
                },
                email: {
                    required: true,
                    email: true
                },
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
