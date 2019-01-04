@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.reports.monthly').' '.trans('messages.report'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.reports.monthly') }} {{ trans('messages.report') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li>{{ trans('messages.mainapp.menu.reports.reports') }}</li>
                        <li class="active">{{ trans('messages.mainapp.menu.reports.monthly') }} {{ trans('messages.report') }}</li>
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
                        <div class="input-field col s12 m3">
                            <label for="sdate">{{ trans('messages.starting') }} {{ trans('messages.date') }}</label>
                            <input id="sdate" class="date" type="text" placeholder="dd-mm-yyyy" value="{{ $sdate }}">
                        </div>
                        <div class="input-field col s12 m3">
                            <label for="edate">{{ trans('messages.ending') }} {{ trans('messages.date') }}</label>
                            <input id="edate" class="date" type="text" placeholder="dd-mm-yyyy" value="{{ $edate }}">
                        </div>
                        <div class="input-field col s12 m5">
                            <label for="department" class="active">{{ trans('messages.mainapp.menu.department') }}</label>
                            <select id="department" class="browser-default">
                                @if(is_object($sdepartment))
                                    <option value="all">{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.department') }}</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}"{!! $department->id==$sdepartment->id?' selected':'' !!}>{{ $department->name }}</option>
                                    @endforeach
                                @else
                                    <option value="all" selected>{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.department') }}</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                @endif
                            </select>
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
                                <th>{{ trans('messages.call.user') }}</th>
                                <th>{{ trans('messages.call.number') }}</th>
                                <th>{{ trans('messages.mainapp.menu.department') }}</th>
                                <th>{{ trans('messages.mainapp.menu.counter') }}</th>
                                <th>{{ trans('messages.call.called') }} {{ trans('messages.date') }}</th>
                                <th>{{ trans('messages.issue') }} {{ trans('messages.time') }}</th>
                                <th>{{ trans('messages.call.called') }} {{ trans('messages.time') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calls as $call)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $call->user->name }}</td>
                                    <td>{{ ($call->department->letter!='')?$call->department->letter.'-':'' }}{{ $call->number }}</td>
                                    <td>{{ $call->department->name }}</td>
                                    <td>{{ $call->counter->name }}</td>
                                    <td>{{ $call->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $call->queue->created_at->format('h:i:s A') }}</td>
                                    <td>{{ $call->created_at->format('h:i:s A') }}</td>
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
            $('.date').pickadate({
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
            $('#report-table').DataTable({
                "oLanguage": {
                    "sLengthMenu": "Show _MENU_",
                    "sSearch": "Search"
                }
            });
        });

        $('#sdate, #edate, #department').change(function(event){
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            var department = $('#department').val();

            action = '{{ url('reports/monthly/') }}/'+department+'/'+sdate+'/'+edate;

            if(sdate=='' || edate=='' || department=='') {
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
