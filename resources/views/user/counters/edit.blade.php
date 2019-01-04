@extends('layouts.app')

@section('title', trans('messages.edit').' '.trans('messages.mainapp.menu.counter'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.counter') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li><a href="{{ route('counters.index') }}">{{ trans('messages.mainapp.menu.counter') }}</a></li>
                        <li class="active">{{ trans('messages.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3" style="padding-top:10px;padding-bottom:10px">
                <a class="btn-floating waves-effect waves-light orange tooltipped right" href="{{ route('counters.index') }}" data-position="top" data-tooltip="{{ trans('messages.cancel') }}"><i class="mdi-navigation-arrow-back"></i></a>
                <form id="edit" action="{{ route('counters.update', ['counters' => $counter->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">{{ trans('messages.name') }}</label>
                            <input id="name" type="text" name="name" placeholder="{{ trans('messages.mainapp.menu.counter') }} {{ trans('messages.name') }}" value="{{ $counter->name }}" data-error=".name">
                            <div class="name">
                                @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
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
