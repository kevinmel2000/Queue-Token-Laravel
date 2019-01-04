@extends('layouts.app')

@section('title', trans('messages.mainapp.menu.dashboard'))

@section('css')
    <link href="{{ asset('assets/css/materialize-colorpicker.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
    <div id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title col s5" style="margin:.82rem 0 .656rem">{{ trans('messages.mainapp.menu.dashboard') }}</h5>
                    <ol class="breadcrumbs col s7 right-align">
                        <li class="active">{{ trans('messages.mainapp.menu.dashboard') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="card-stats">
            @can('access', \App\Models\User::class)
                <div class="row">
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content light-blue darken-2 white-text">
                                <p class="card-stats-title truncate"><i class="mdi-social-group-add"></i> {{ trans('messages.today_queue') }}</p>
                                <h4 class="card-stats-number">{{ $today_queue }}</h4>
                                </p>
                            </div>
                            <div class="card-action light-blue darken-4">
                                <div class="center-align">
                                    <a href="{{ route('reports::queue_list', ['date' => \Carbon\Carbon::now()->format('d-m-Y')]) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content green lighten-1 white-text">
                                <p class="card-stats-title truncate"><i class="mdi-communication-call-missed"></i> {{ trans('messages.today_missed') }}</p>
                                <h4 class="card-stats-number">{{ $missed }}</h4>
                                </p>
                            </div>
                            <div class="card-action green darken-2">
                                <div class="center-align">
                                    <a href="{{ route('reports::missed_show', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'user' => 'all', 'counter' => 'all', 'type' => 'missed']) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content blue-grey white-text">
                                <p class="card-stats-title truncate"><i class="mdi-action-trending-up"></i> {{ trans('messages.today_served') }}</p>
                                <h4 class="card-stats-number">{{ $served }}</h4>
                                </p>
                            </div>
                            <div class="card-action blue-grey darken-2">
                                <div class="center-align">
                                    <a href="{{ route('reports::missed_show', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'user' => 'all', 'counter' => 'all', 'type' => 'all']) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card hoverable">
                            <div class="card-content orange darken-2 white-text">
                                <p class="card-stats-title truncate"><i class="mdi-image-timer"></i> {{ trans('messages.over_time') }}</p>
                                <h4 class="card-stats-number">{{ $overtime }}</h4>
                                </p>
                            </div>
                            <div class="card-action orange darken-4">
                                <div class="center-align">
                                    <a href="{{ route('reports::missed_show', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'user' => 'all', 'counter' => 'all', 'type' => 'overtime']) }}" style="text-transform:none;color:#fff">{{ trans('messages.more_info') }} <i class="mdi-navigation-arrow-forward"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('access', \App\Models\User::class)
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable waves-effect waves-dark teal lighten-3 white-text" style="display:inherit">
                            <span class="chart-title">{{ trans('messages.queue_details') }}</span>
                            <div class="trending-line-chart-wrapper">
                                <canvas id="queue-details-chart" height="155" style="height:308px"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card-panel hoverable waves-effect waves-dark" style="display:inherit">
                            <span class="chart-title">{{ trans('messages.today_yesterday') }}</span>
                            <div class="trending-line-chart-wrapper">
                                <canvas id="today-vs-yesterday-chart" height="155" style="height:308px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="row">
                <div class="col s12">
                    <div class="card hoverable waves-effect waves-dark" style="display:inherit">
                        <div class="card-move-up black-text">
                            <div class="move-up">
                                <div>
                                    <span class="chart-title">{{ trans('messages.dashboard.notification') }}</span>
                                </div>
                                <div class="trending-line-chart-wrapper">
                                    <p>{{ trans('messages.dashboard.preview') }}:</p>
                                    <span style="font-size:{{ $setting->size }}px;color:{{ $setting->color }}">
                                        <marquee>{{ $setting->notification }}</marquee>
                                    </span>
                                    <p></p>
                                    <form id="noti" action="{{ route('dashboard_store') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="input-field col s12 m8">
                                                <label for="notification">{{ trans('messages.dashboard.notification_text') }}</label>
                                                <input id="notification" name="notification" type="text" placeholder="{{ trans('messages.dashboard.notification_placeholder') }}" data-error=".errorNotification" value="{{ $setting->notification }}">
                                                <div class="errorNotification"></div>
                                            </div>
                                            <div class="input-field col s12 m1">
                                                <label for="size">{{ trans('messages.font_size') }}</label>
                                                <input id="size" name="size" type="number" placeholder="Size" max="60" min="15" size="2" data-error=".errorSize" value="{{ $setting->size }}">
                                                <div class="errorSize"></div>
                                            </div>
                                            <div class="input-field col s12 m2">
                                                <label for="color">{{ trans('messages.color') }}</label>
                                                <input id="color" type="text" placeholder="Color" name="color" data-error=".errorColor" value="{{ $setting->color }}">
                                                <div class="errorColor"></div>
                                            </div>
                                            <div class="input-field col s12 m1">
                                                <button class="btn waves-effect waves-light right submit" type="submit" style="padding:0 1.3rem">{{ trans('messages.go') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/materialize-colorpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/chartjs/chart.min.js') }}"></script>
    <script>
        $(function() {
            $('#color').colorpicker();
        });

        @can('access', \App\Models\User::class)
            $("#noti").validate({
                rules: {
                    notification: {
                        required: true,
                        minlength: 5
                    },
                    size: {
                        required: true,
                        digits: true
                    },
                    color: {
                        required: true
                    }
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

           $(function() {
                var todayVsYesterdayCartData = {
                    labels: [@foreach ($counters as $indx => $counter)
                            @if($indx==0) <?php echo "'$counter->name'"; ?>
                            @else <?php echo ", '$counter->name'"; ?>
                            @endif
                        @endforeach],
                    datasets: [
                      {
                          label: "Today",
                          fillColor: "rgba(0,176,159,0.75)",
                          strokeColor: "rgba(220,220,220,0.75)",
                          highlightFill: "rgba(0,176,159,0.9)",
                          highlightStroke: "rgba(220,220,220,9)",
                          data: [@foreach ($today_calls as $indx => $today_call)
                                  @if($indx==0) <?php echo "'$today_call'"; ?>
                                  @else <?php echo ", '$today_call'"; ?>
                                  @endif
                              @endforeach]
                      },
                      {
                          label: "Yesterday",
                          fillColor: "rgba(151,187,205,0.75)",
                          strokeColor: "rgba(220,220,220,0.75)",
                          highlightFill: "rgba(151,187,205,0.9)",
                          highlightStroke: "rgba(220,220,220,0.9)",
                          data: [@foreach ($yesterday_calls as $indx => $yesterday_call)
                                  @if($indx==0) <?php echo "'$yesterday_call'"; ?>
                                  @else <?php echo ", '$yesterday_call'"; ?>
                                  @endif
                              @endforeach]
                      }
                    ]
                };

                var queueDetailsChartData = [
                  {
                      value: "{{ $today_queue }}",
                      color: "#00c0ef",
                      highlight: "#00c0ef",
                      label: "In Queue"
                  },
                  {
                      value: "{{ $missed }}",
                      color: "#00a65a",
                      highlight: "#00a65a",
                      label: "Missed"
                  },
                  {
                      value: "{{ $served }}",
                      color: "#f39c12",
                      highlight: "#f39c12",
                      label: "Served"
                  },
                  {
                      value: "{{ $overtime }}",
                      color: "#dd4b39",
                      highlight: "#dd4b39",
                      label: "Overtime"
                  }
                ];

                var todayVsYesterdayCart = new Chart($("#today-vs-yesterday-chart").get(0).getContext("2d")).Bar(todayVsYesterdayCartData,{
                    responsive:true
                });

                var queueDetailsChart = new Chart($("#queue-details-chart").get(0).getContext("2d")).Pie(queueDetailsChartData,{
                    responsive:true
                });
            });
        @endcan
    </script>
@endsection
