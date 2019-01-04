@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.reports.queue_list'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.reports.queue_list') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li>{{ trans('messages.mainapp.menu.reports.reports') }}</li>
                        <li class="active">{{ trans('messages.mainapp.menu.reports.queue_list') }}</li>
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
                        <div class="col s9">
                            <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.report') }}</span>
                        </div>
                        <div class="col s3">
                            <input id="date" class="right" type="text" placeholder="dd-mm-yyyy" value="{{ $date }}" onchange="datechange((this).value)" style="margin-bottom:0;height:1.5rem">
                        </div>
                    </div>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="report-table" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>{{ trans('messages.mainapp.menu.department') }}</th>
                                <th>{{ trans('messages.call.number') }}</th>
                                <th>{{ trans('messages.call.called') }}</th>
                                <th>{{ trans('messages.call.user') }}</th>
                                <th>{{ trans('messages.mainapp.menu.counter') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($queues as $queue)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $queue->department->name }}</td>
                                    <td>{{ ($queue->department->letter!='')?$queue->department->letter.'-':'' }}{{ $queue->number }}</td>
                                    <td>{{ $queue->called?'Yes':'No' }}</td>
                                    <td>{{ $queue->called?$queue->call->user->name:'NIL' }}</td>
                                    <td>{{ $queue->called?$queue->call->counter->name:'NIL' }}</td>
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
            picker = $('#date').pickadate({
                selectMonths: true,
                selectYears: 15,
                format: 'dd-mm-yyyy',
                clear: false,
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
        function datechange(value) {
            if(value!='') {
                $('body').removeClass('loaded');
                window.location = '{{ url('reports/queuelist') }}/'+value;
            }
        }
    </script>
@endsection
