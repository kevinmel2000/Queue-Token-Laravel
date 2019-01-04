@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.reports.statistical').' '.trans('messages.report'))

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.reports.statistical') }} {{ trans('messages.report') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li><a href="{{ route('dashboard') }}">{{ trans('messages.mainapp.menu.dashboard') }}</a></li>
                        <li>{{ trans('messages.mainapp.menu.reports.reports') }}</li>
                        <li class="active">{{ trans('messages.mainapp.menu.reports.statistical') }} {{ trans('messages.report') }}</li>
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
                            <label for="date">{{ trans('messages.date') }}</label>
                            <input id="date" type="text" placeholder="dd-mm-yyyy" value="{{ $date }}">
                        </div>
                        <div class="input-field col s12 m3">
                            <label for="user" class="active">{{ trans('messages.mainapp.menu.users') }}</label>
                            <select id="user" class="browser-default">
                                @if(is_object($suser))
                                    <option value="all">{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.users') }}</option>
                                    @foreach($users as $cuser)
                                        <option value="{{ $cuser->id }}"{!! $cuser->id==$suser->id?' selected':'' !!}>{{ $cuser->name }}</option>
                                    @endforeach
                                @else
                                    <option value="all" selected>{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.users') }}</option>
                                    @foreach($users as $cuser)
                                        <option value="{{ $cuser->id }}">{{ $cuser->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="input-field col s12 m3">
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
                        <div class="input-field col s12 m3">
                            <label for="counter" class="active">{{ trans('messages.mainapp.menu.counter') }}</label>
                            <select id="counter" class="browser-default">
                                @if(is_object($scounter))
                                    <option value="all">{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.counter') }}</option>
                                    @foreach($counters as $counter)
                                        <option value="{{ $counter->id }}"{!! $counter->id==$scounter->id?' selected':'' !!}>{{ $counter->name }}</option>
                                    @endforeach
                                @else
                                    <option value="all" selected>{{ trans('messages.all') }} {{ trans('messages.mainapp.menu.counter') }}</option>
                                    @foreach($counters as $counter)
                                        <option value="{{ $counter->id }}">{{ $counter->name }}</option>
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
                    <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.avg_time') }}</span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <div><canvas id="avg" style="height:249px;width:547px" height="249" width="547"></canvas></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.min_time') }}</span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <div><canvas id="min" style="height:249px;width:547px" height="249" width="547"></canvas></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.max_time') }}</span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <div><canvas id="max" style="height:249px;width:547px" height="249" width="547"></canvas></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <span style="line-height:0;font-size:22px;font-weight:300">{{ trans('messages.count_perday') }}</span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <div><canvas id="ttcount" style="height:249px;width:547px" height="249" width="547"></canvas></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs/chart.min.js') }}"></script>
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

        $('#date, #user, #department, #counter').change(function(event){
            var date = $('#date').val();
            var user = $('#user').val();
            var department = $('#department').val();
            var counter = $('#counter').val();

            action = '{{ url('reports/statistical') }}/'+date+'/'+user+'/'+department+'/'+counter;

            if(date=='' || user=='' || department=='' || counter=='') {
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
    <script>
        $(function() {
            var avgData = {
              labels: [
                @foreach($reports as $key => $report)
                    @if($key==1)
                        "{{ date('M', strtotime($date)).' '.$key }}"
                    @else
                        ,"{{ date('M', strtotime($date)).' '.$key }}"
                    @endif
                @endforeach
              ],
              datasets: [
                {
                  label: "Average Waiting Time (Min)",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [
                    @foreach($reports as $key => $report)
                        @if($key==1)
                            "{{ $report['avg'] }}"
                        @else
                            ,"{{ $report['avg'] }}"
                        @endif
                    @endforeach
                  ]
                },
              ]
            };

            var minData = {
              labels: [
                @foreach($reports as $key => $report)
                    @if($key==1)
                        "{{ date('M', strtotime($date)).' '.$key }}"
                    @else
                        ,"{{ date('M', strtotime($date)).' '.$key }}"
                    @endif
                @endforeach
              ],
              datasets: [
                {
                  label: "Minimum Waiting Time (Min)",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [
                    @foreach($reports as $key => $report)
                        @if($key==1)
                            "{{ $report['min'] }}"
                        @else
                            ,"{{ $report['min'] }}"
                        @endif
                    @endforeach
                  ]
                },
              ]
            };

            var maxData = {
              labels: [
                @foreach($reports as $key => $report)
                    @if($key==1)
                        "{{ date('M', strtotime($date)).' '.$key }}"
                    @else
                        ,"{{ date('M', strtotime($date)).' '.$key }}"
                    @endif
                @endforeach
              ],
              datasets: [
                {
                  label: "Maximum Waiting Time (Min)",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [
                    @foreach($reports as $key => $report)
                        @if($key==1)
                            "{{ $report['max'] }}"
                        @else
                            ,"{{ $report['max'] }}"
                        @endif
                    @endforeach
                  ]
                },
              ]
            };

             var ttcounData = {
              labels: [
                @foreach($reports as $key => $report)
                    @if($key==1)
                        "{{ date('M', strtotime($date)).' '.$key }}"
                    @else
                        ,"{{ date('M', strtotime($date)).' '.$key }}"
                    @endif
                @endforeach
              ],
              datasets: [
                {
                  label: "Total Count In Per day",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [
                    @foreach($reports as $key => $report)
                        @if($key==1)
                            "{{ $report['count'] }}"
                        @else
                            ,"{{ $report['count'] }}"
                        @endif
                    @endforeach
                  ]
                },
              ]
            };

            var areaChartOptions = {
              //Boolean - If we should show the scale at all
              showScale: true,
              //Boolean - Whether grid lines are shown across the chart
              scaleShowGridLines: true,
              //String - Colour of the grid lines
              scaleGridLineColor: "rgba(0,0,0,.05)",
              //Number - Width of the grid lines
              scaleGridLineWidth: 1,
              //Boolean - Whether to show horizontal lines (except X axis)
              scaleShowHorizontalLines: true,
              //Boolean - Whether to show vertical lines (except Y axis)
              scaleShowVerticalLines: true,
              //Boolean - Whether the line is curved between points
              bezierCurve: true,
              //Number - Tension of the bezier curve between points
              bezierCurveTension: 0.3,
              //Boolean - Whether to show a dot for each point
              pointDot: true,
              //Number - Radius of each point dot in pixels
              pointDotRadius: 4,
              //Number - Pixel width of point dot stroke
              pointDotStrokeWidth: 1,
              //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
              pointHitDetectionRadius: 20,
              //Boolean - Whether to show a stroke for datasets
              datasetStroke: true,
              //Number - Pixel width of dataset stroke
              datasetStrokeWidth: 2,
              //Boolean - Whether to fill the dataset with a color
              datasetFill: false,//()
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
              //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: false,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true
            };

            var AveregeChartCanvas = $("#avg").get(0).getContext("2d");
            var avg = new Chart(AveregeChartCanvas);
            avg.Line(avgData, areaChartOptions);

            var MinChartCanvas = $("#min").get(0).getContext("2d");
            var min = new Chart(MinChartCanvas);
            min.Line(minData, areaChartOptions);

            var MaxChartCanvas = $("#max").get(0).getContext("2d");
            var max = new Chart(MaxChartCanvas);
            max.Line(maxData, areaChartOptions);

            var TtcountChartCanvas = $("#ttcount").get(0).getContext("2d");
            var ttcount = new Chart(TtcountChartCanvas);
            ttcount.Line(ttcounData, areaChartOptions);
        });
    </script>
@endsection
