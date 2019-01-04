@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.call'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.call') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li class="active">{{ trans('messages.mainapp.menu.call') }}</li>
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
                        <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.call.new_call') }}</span>
                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        <form id="new_call" action="{{ route('post_call') }}" method="post">
                            {{ csrf_field() }}
                            @if(!$user->is_admin)
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="user">{{ trans('messages.call.user') }}</label>
                                        <input id="user" type="hidden" name="user" value="{{ $user->id }}" data-error=".user">
                                        <input type="text" data-error=".user" value="{{ $user->name }}" readonly>
                                        <div class="user">
                                            @if($errors->has('user'))<div class="error">{{ $errors->first('user') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="user" class="active">{{ trans('messages.call.user') }}</label>
                                        <select id="user" class="browser-default" name="user" data-error=".user">
                                            <option value="">{{ trans('messages.select') }} {{ trans('messages.call.user') }}</option>
                                            @foreach($users as $cuser)
                                                <option value="{{ $cuser->id }}"{!! $cuser->id==old('user')?' selected':'' !!}>{{ $cuser->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="user">
                                            @if($errors->has('user'))<div class="error">{{ $errors->first('user') }}</div>@endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="department" class="active">{{ trans('messages.mainapp.menu.department') }}</label>
                                    <select id="department" class="browser-default" name="department" data-error=".department">
                                        <option value="">{{ trans('messages.select') }} {{ trans('messages.mainapp.menu.department') }}</option>
                                        @foreach($departments as $department)
                                            @if(session()->has('department') && ($department->id==session()->get('department')))
                                                <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                            @else
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="department">
                                        @if($errors->has('department'))<div class="error">{{ $errors->first('department') }}</div>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="counter" class="active">{{ trans('messages.mainapp.menu.counter') }}</label>
                                    <select id="counter" class="browser-default" name="counter" data-error=".counter">
                                        <option value="">{{ trans('messages.select') }} {{ trans('messages.mainapp.menu.counter') }}</option>
                                        @foreach($counters as $counter)
                                            @if(session()->has('counter') && ($counter->id==session()->get('counter')))
                                                <option value="{{ $counter->id }}" selected>{{ $counter->name }}</option>
                                            @else
                                                <option value="{{ $counter->id }}">{{ $counter->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="counter">
                                        @if($errors->has('counter'))<div class="error">{{ $errors->first('counter') }}</div>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right" type="submit">
                                        {{ trans('messages.call.call_next') }}<i class="mdi-navigation-arrow-forward right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.call.click_department') }}</span>
                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        @foreach($departments as $department)
                            <span class="btn waves-effect waves-light" onclick="call_dept({{ $department->id }})" style="margin-bottom:10px;margin-right:5px;text-transform:none">{{ $department->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content" style="font-size:14px">
                        <span class="card-title" style="line-height:0;font-size:22px">{{ trans('messages.call.todays_queue') }}</span>
                        <div class="divider" style="margin:10px 0 10px 0"></div>
                        <table id="call-table" class="display" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('messages.mainapp.menu.department') }}</th>
                                    <th>{{ trans('messages.call.number') }}</th>
                                    <th>{{ trans('messages.call.called') }}</th>
                                    <th>{{ trans('messages.mainapp.menu.counter') }}</th>
                                    <th>{{ trans('messages.call.recall') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('print')
    @if(session()->has('department_name'))
        <style>#printarea{display:none;text-align:center}@media print{#loader-wrapper,header,#main,footer,#toast-container{display:none}#printarea{display:block;}}@page{margin:0}</style>
        <div id="printarea" style="line-height:1.25">
            <span style="font-size:27px; font-weight: bold">{{ $company_name }}</span><br>
            <span style="font-size:25px">{{ session()->get('department_name') }}</span><br>
            <span style="font-size:20px">Your Token Number</span><br>
            <span><h3 style="font-size:70px;font-weight:bold;margin:0;line-height:1.5">{{ session()->get('number') }}</h3></span>
            <span style="font-size:20px">Please wait for your turn</span><br>
            <span style="font-size:20px">Total customer(s) waiting: {{ session()->get('total')-1 }}</span><br>
            <span style="float:left">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span><span style="float:right">{{ \Carbon\Carbon::now()->format('h:i:s A') }}</span>
        </div>
        <script>
            window.onload = function(){window.print();}
        </script>
    @endif
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $("#new_call").validate({
            rules: {
                user: {
                    required: true,
                    digits: true
                },
                department: {
                    required: true,
                    digits: true
                },
                counter: {
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
        function call_dept(value) {
            $('body').removeClass('loaded');
            var myForm1 = '<form id="hidfrm1" action="{{ url('calls/dept') }}/'+value+'" method="post">{{ csrf_field() }}</form>';
            $('body').append(myForm1);
            myForm1 = $('#hidfrm1');
            myForm1.submit();
        }

        function recall(call_id) {
            $('body').removeClass('loaded');
            var data = 'call_id='+call_id+'&_token={{ csrf_token() }}';
            $.ajax({
                type:"POST",
                url:"{{ route('post_recall') }}",
                data:data,
                cache:false,
                success: function(response) {
                    location.reload();
                }
            });
        }

        $(function() {
            var calltable = $('#call-table').dataTable({
                "oLanguage": {
                    "sLengthMenu": "Show _MENU_",
                    "sSearch": "Search"
                },
                "columnDefs": [{
                    "targets": [ -1 ],
                    "searchable": false,
                    "orderable": false
                }],
                "ajax": "{{ url('assets/files/call') }}",
                "columns": [
                    { "data": "id" },
                    { "data": "department" },
                    { "data": "number" },
                    { "data": "called" },
                    { "data": "counter" },
                    { "data": "recall" }
                ]
            });

            setInterval(function(){
                calltable.api().ajax.reload(null,false);
            }, 3000);
        });
    </script>
@endsection
