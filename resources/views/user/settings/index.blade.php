@extends('layouts.app')

@section('title', trans('messages.settings'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.settings') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">{{ trans('messages.settings') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.mainapp.menu.account') }}</span>
                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        <form id="account" action="{{ route('post_settings') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="name">{{ trans('messages.name') }}</label>
                                    <input id="name" type="text" name="name" placeholder="{{ trans('messages.name') }}" value="{{ $user->name }}" data-error=".name">
                                    <div class="name">
                                        @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="username">{{ trans('messages.users.username') }}</label>
                                    <input id="username" type="text" name="username" placeholder="{{ trans('messages.users.username') }}" value="{{ $user->username }}" data-error=".username">
                                    <div class="username">
                                        @if($errors->has('username'))<div class="error">{{ $errors->first('username') }}</div>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="role">{{ trans('messages.users.role') }}</label>
                                    <input id="role" type="text" placeholder="{{ trans('messages.users.role') }}" value="{{ $user->role_text }}" data-error=".role" readonly>
                                    <div class="role">
                                        @if($errors->has('role'))<div class="error">{{ $errors->first('role') }}</div>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="email">{{ trans('messages.users.email') }}</label>
                                    <input id="email" type="text" name="email" placeholder="{{ trans('messages.users.email') }}" value="{{ $user->email }}" data-error=".email">
                                    <div class="email">
                                        @if($errors->has('email'))<div id="name-error" class="error">{{ $errors->first('email') }}</div>@endif
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
                                        {{ trans('messages.update') }}<i class="mdi-action-swap-vert left"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @can('access', $settings)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.company.company') }} {{ trans('messages.settings') }}</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <form id="company" action="{{ route('post_company') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="name">{{ trans('messages.name') }}</label>
                                        <input id="name" type="text" name="name" placeholder="{{ trans('messages.name') }}" value="{{ $settings->name }}" data-error=".cname">
                                        <div class="cname">
                                            @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="email">{{ trans('messages.users.email') }}</label>
                                        <input id="email" type="text" name="email" placeholder="{{ trans('messages.users.email') }}" value="{{ $settings->email }}" data-error=".cemail">
                                        <div class="cemail">
                                            @if($errors->has('email'))<div id="name-error" class="error">{{ $errors->first('email') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="address">{{ trans('messages.company.address') }}</label>
                                        <textarea id="address" class="materialize-textarea" name="address" placeholder="{{ trans('messages.company.address') }}" data-error=".address" style="min-height:67px">{{ $settings->address }}</textarea>
                                        <div class="address">
                                            @if($errors->has('address'))<div class="error">{{ $errors->first('address') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="phone">{{ trans('messages.company.phone') }}</label>
                                        <input id="phone" type="text" name="phone" placeholder="{{ trans('messages.company.phone') }}" value="{{ $settings->phone }}" data-error=".phone">
                                        <div class="phone">
                                            @if($errors->has('phone'))<div id="name-error" class="error">{{ $errors->first('phone') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="location">{{ trans('messages.company.location') }}</label>
                                        <input id="location" type="text" name="location" placeholder="{{ trans('messages.company.location') }}" value="{{ $settings->location }}" data-error=".location">
                                        <div class="location">
                                            @if($errors->has('location'))<div id="name-error" class="error">{{ $errors->first('location') }}</div>@endif
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
            @endcan
        </div>
        @can('access', $settings)
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.set') }} {{ trans('messages.mainapp.menu.reports.missed') }} {{ trans('messages.and') }} {{ trans('messages.mainapp.menu.reports.overtime') }}</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <form id="overmissed" action="{{ route('post_over_missed') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="over_time">{{ trans('messages.mainapp.menu.reports.overtime') }} ({{ trans('messages.in_seconds') }})</label>
                                        <input id="over_time" type="text" name="over_time" placeholder="{{ trans('messages.in_seconds') }}" value="{{ $settings->over_time }}" data-error=".over_time">
                                        <div class="over_time">
                                            @if($errors->has('over_time'))<div class="error">{{ $errors->first('over_time') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="missed_time">{{ trans('messages.mainapp.menu.reports.missed') }} {{ trans('messages.time') }} ({{ trans('messages.in_seconds') }})</label>
                                        <input id="missed_time" type="text" name="missed_time" placeholder="{{ trans('messages.in_seconds') }}" value="{{ $settings->missed_time }}" data-error=".missed_time">
                                        <div class="missed_time">
                                            @if($errors->has('missed_time'))<div class="error">{{ $errors->first('missed_time') }}</div>@endif
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
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.change') }} {{ trans('messages.default') }} {{ trans('messages.language') }}</span>
                            <div class="divider" style="margin:10px 0 10px 0"></div>
                            <form id="languagefrm" action="{{ route('post_locale') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="language" class="active">{{ trans('messages.select') }} {{ trans('messages.language') }}</label>
                                        <select id="language" class="browser-default" name="language" data-error=".language">
                                            @foreach($languages as $language)
                                                @if($language->id==$settings->language_id)
                                                    <option value="{{ $language->id }}" selected>{{ trans('messages.locales.'.$c_locale.'.'.$language->code) }}</option>
                                                @else
                                                    <option value="{{ $language->id }}">{{ trans('messages.locales.'.$c_locale.'.'.$language->code) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="language">
                                            @if($errors->has('language'))<div class="error">{{ $errors->first('language') }}</div>@endif
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
            </div>
        @endcan
    </div>
@endsection

@section('script')
    <script>
        $("#account").validate({
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
                    minlength: 6
                },
                password_confirmation: {
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
        @can('access', $settings)
            $("#company").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        email: true
                    }
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
            $("#overmissed").validate({
                rules: {
                    over_time: {
                        required: true,
                        digits: true
                    },
                    missed_time: {
                        required: true,
                        digits: true
                    }
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
            $("#languagefrm").validate({
                rules: {
                    language: {
                        required: true,
                        digits: true
                    }
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
        @endcan
    </script>
@endsection
