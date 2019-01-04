@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.users'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.users') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">{{ trans('messages.mainapp.menu.users') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <a class="btn-floating waves-effect waves-light tooltipped" href="{{ route('users.create') }}" data-position="top" data-tooltip="{{ trans('messages.add') }} {{ trans('messages.mainapp.menu.users') }}"><i class="mdi-content-add left"></i></a>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="user-table" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>{{ trans('messages.name') }}</th>
                                <th>{{ trans('messages.users.username') }}</th>
                                <th>{{ trans('messages.users.email') }}</th>
                                <th>{{ trans('messages.users.role') }}</th>
                                <th style="width:63px">{{ trans('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $tuser)
                                <tr{!! ($tuser->id==$user->id)?' class="orange lighten-4"':'' !!}>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tuser->name }}</td>
                                    <td>{{ $tuser->username }}</td>
                                    <td>{{ $tuser->email }}</td>
                                    <td>{{ $tuser->role_text }}</td>
                                    @if($tuser->id==$user->id)
                                        <td>
                                            <a class="btn-floating btn-action waves-effect waves-light orange disabled" href="javascript:void(0);"><i class="mdi-communication-vpn-key"></i></a>
                                            <a class="btn-floating btn-action waves-effect waves-light red disabled" href="javascript:void(0);"><i class="mdi-action-delete"></i></a>
                                        </td>
                                    @else
                                        <td>
                                            <a class="btn-floating btn-action waves-effect waves-light orange tooltipped" href="{{ route('get_user_password', ['users' => $tuser->id]) }}" data-position="top" data-tooltip="{{ trans('messages.change') }} {{ trans('messages.users.password') }}"><i class="mdi-communication-vpn-key"></i></a>
                                            <a class="btn-floating btn-action waves-effect waves-light red tooltipped frmsubmit" href="{{ route('users.destroy', ['users' => $tuser->id]) }}" data-position="top" data-tooltip="{{ trans('messages.delete') }}" method="DELETE"><i class="mdi-action-delete"></i></a>
                                        </td>
                                    @endif
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
            $('#user-table').DataTable({
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
