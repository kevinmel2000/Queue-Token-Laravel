@extends('layouts.app')

@section('title', trans('messages.edit').' '.trans('messages.mainapp.menu.department'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.department') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('departments.index') }}">{{ trans('messages.mainapp.menu.department') }}</a></li>
                        <li class="active">{{ trans('messages.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('departments.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="edit" action="{{ route('departments.update', ['departments' => $department->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">{{ trans('messages.name') }}</label>
                            <input id="name" type="text" name="name" placeholder="{{ trans('messages.mainapp.menu.department') }} {{ trans('messages.name') }}" value="{{ $department->name }}" data-error=".name">
                            <div class="name">
                                @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="letter">{{ trans('messages.department.letter') }}</label>
                            <input id="letter" type="text" name="letter" placeholder="{{ trans('messages.department.letter') }}" value="{{ $department->letter }}" data-error=".letter">
                            <div class="letter">
                                @if($errors->has('letter'))<div class="error">{{ $errors->first('letter') }}</div>@endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="start">{{ trans('messages.department.start') }}</label>
                            <input id="start" type="text" name="start" placeholder="{{ trans('messages.department.start') }}" value="{{ $department->start }}" data-error=".start">
                            <div class="start">
                                @if($errors->has('start'))<div class="error">{{ $errors->first('start') }}</div>@endif
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
        $("#edit").validate({
            rules: {
                name: {
                    required: true
                },
                start: {
                    required: true,
                    digits: true
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
