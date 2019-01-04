@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.reports.user_report'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.reports.user_report') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li>{{ trans('messages.mainapp.menu.reports.reports') }}</li>
                        <li class="active">{{ trans('messages.mainapp.menu.reports.user_report') }}</li>
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
                        <div class="input-field col s12 m6">
                            <label for="user" class="active">{{ trans('messages.call.user') }}</label>
                            <select id="user" class="browser-default">
                                <option value="">{{ trans('messages.select') }} {{ trans('messages.call.user') }}</option>
                                @foreach($users as $cuser)
                                    @if($cuser->id==$suser->id)
                                        <option value="{{ $cuser->id }}" selected>{{ $cuser->name }}</option>
                                    @else
                                        <option value="{{ $cuser->id }}">{{ $cuser->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field col s12 m5">
                            <label for="date">{{ trans('messages.date') }}</label>
                            <input id="date" type="text" placeholder="dd-mm-yyyy" value="{{ $date }}">
                        </div>
                        <div class="input-field col s12 m1">
                            <button id="gobtn" class="btn waves-effect waves-light right disabled" onclick="gobtn()">{{ trans('messages.go') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.report') }}</span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="report-table" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>{{ trans('messages.mainapp.menu.department') }}</th>
                                <th>{{ trans('messages.call.number') }}</th>
                                <th>{{ trans('messages.mainapp.menu.counter') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calls as $call)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $call->department->name }}</td>
                                    <td>{{ ($call->department->letter!='')?$call->department->letter.'-':'' }}{{ $call->number }}</td>
                                    <td>{{ $call->counter->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            $('#date').pickadate({
                selectMonths: true,
                selectYears: 15,
                format: 'dd-mm-yyyy',
                clear: false,
                closeOnSelect: true,
                onSet: function(ele) {
                    if(ele.select) {
                        this.close();
                    }
                },
                onClose: function() {
                    document.activeElement.blur();
                }
            });
            $('#report-table').DataTable({
                "oLanguage": {
                    "sLengthMenu": "Show _MENU_",
                    "sSearch": "Search"
                }
            });
        });

        $('#user, #date').change(function(event){
            var user = $('#user').val();
            var date = $('#date').val();

            action = '{{ url('reports/user/') }}/'+user+'/'+date;

            if(user=='' || date=='') {
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
