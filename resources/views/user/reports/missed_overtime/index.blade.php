@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.reports.missed').' / '.trans('messages.mainapp.menu.reports.overtime').' '.trans('messages.report'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.reports.missed') }} / {{ trans('messages.mainapp.menu.reports.overtime') }} {{ trans('messages.report') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li>{{ trans('messages.mainapp.menu.reports.reports') }}</li>
                        <li class="active">{{ trans('messages.mainapp.menu.reports.missed') }} / {{ trans('messages.mainapp.menu.reports.overtime') }} {{ trans('messages.report') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <div class="row">
                        <div class="input-field col s12 m2">
                            <label for="date">{{ trans('messages.starting') }} {{ trans('messages.date') }}</label>
                            <input id="date" type="text" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="input-field col s12 m3">
                            <label for="user" class="active">{{ trans('messages.mainapp.menu.users') }}</label>
                            <select id="user" class="browser-default">
                                <option value="all">{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.users') }}</option>
                                @foreach($users as $cuser)
                                    <option value="{{ $cuser->id }}">{{ $cuser->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field col s12 m3">
                            <label for="counter" class="active">{{ trans('messages.mainapp.menu.counter') }}</label>
                            <select id="counter" class="browser-default">
                                <option value="all">{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.counter') }}</option>
                                @foreach($counters as $counter)
                                    <option value="{{ $counter->id }}">{{ $counter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field col s12 m3">
                            <label for="type" class="active">{{ trans('messages.type') }}</label>
                            <select id="type" class="browser-default">
                                <option value="all">{{ trans('messages.all') }} {{ trans('messages.types') }}</option>
                                <option value="missed">{{ trans('messages.mainapp.menu.reports.missed') }}</option>
                                <option value="overtime">{{ trans('messages.mainapp.menu.reports.overtime') }}</option>
                            </select>
                        </div>
                        <div class="input-field col s12 m1">
                            <button id="gobtn" class="btn waves-effect waves-light right disabled" onclick="gobtn()">{{ trans('messages.go') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#date').pickadate({
                selectMonths: true,
                selectYears: 15,
                format: 'dd-mm-yyyy',
                clear: false,
                onSet: function(ele) {
                    if(ele.select) {
                        this.close();
                    }
                },
                closeOnSelect: true,
                onClose: function() {
                    document.activeElement.blur();
                }
            });
        });

        $('#date, #user, #counter, #type').change(function(event){
            var date = $('#date').val();
            var user = $('#user').val();
            var counter = $('#counter').val();
            var type = $('#type').val();

            action = '{{ url('reports/missed-overtime') }}/'+date+'/'+user+'/'+counter+'/'+type;

            if(date=='' || user=='' || counter=='' || type=='') {
                $('#gobtn').addClass('disabled');
            } else {
                $('#gobtn').removeClass('disabled');
            }
        });

        function gobtn() {
            if (!$('#gobtn').hasClass('disabled')) {
                $('body').removeClass('loaded');
                window.location = action;
            }
        }
    </script>
@endsection
