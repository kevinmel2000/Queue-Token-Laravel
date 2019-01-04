@extends('vendor.installer.layouts.master')

@section('title', trans('messages.final.title'))
@section('container')
    <p class="paragraph">{{ trans('messages.final.finished') }}</p>
    <div class="buttons">
        <a href="{{ route('main') }}" class="button">{{ trans('messages.final.exit') }}</a>
    </div>
@stop
