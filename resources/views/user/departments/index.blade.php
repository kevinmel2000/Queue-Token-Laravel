@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.department'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.department') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">{{ trans('messages.mainapp.menu.department') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <a class="btn-floating waves-effect waves-light tooltipped" href="{{ route('departments.create') }}" data-position="top" data-tooltip="{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.department') }}"><i class="mdi-content-add left"></i></a>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="department-table" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>{{ trans('messages.name') }}</th>
                                <th>{{ trans('messages.department.letter') }}</th>
                                <th>{{ trans('messages.department.start') }}</th>
                                <th style="width:63px">{{ trans('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->letter }}</td>
                                    <td>{{ $department->start }}</td>
                                    <td>
                                        <a class="btn-floating btn-action waves-effect waves-light orange tooltipped" href="{{ route('departments.edit', ['departments' => $department->id]) }}" data-position="top" data-tooltip="{{ trans('messages.edit') }}"><i class="mdi-editor-mode-edit"></i></a>
                                        <a class="btn-floating btn-action waves-effect waves-light red tooltipped frmsubmit" href="{{ route('departments.destroy', ['departments' => $department->id]) }}" data-position="top" data-tooltip="{{ trans('messages.delete') }}" method="DELETE"><i class="mdi-action-delete"></i></a>
                                    </td>
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
            $('#department-table').DataTable({
                "oLanguage": {
                    "sLengthMenu": "Show _MENU_",
                    "sSearch": "Search"
                },
                "columnDefs": [{
                    "targets": [ -1 ],
                    "searchable": false,
                    "orderable": false
                }]
            });
        });
    </script>
@endsection
