@extends('adminlte::page')

@section('title', 'Urnas')

@section('content_header')
    <h1>Urna {{$urn->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Urnas</a></li>
        <li class="active">{{$urn->title}}}</li>
    </ol>
@stop

@section('content')
    @if(isset($errors) && count($errors->all()) > 0 )
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Aviso. </strong>
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
    @endif
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="box box-default">
                    <div class="box-header with-border">
                    <h3 class="box-title">Candidatos</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                        <div class="chart-responsive">
                            <canvas id="pieChart" height="200" width="150" style="width: 106px; height: 155px;"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6 col-sm-12">
                        <ul id="legend" class="chart-legend clearfix">
                            {{-- <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                            <li><i class="fa fa-circle-o text-green"></i> IE</li>
                            <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                            <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                            <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                            <li><i class="fa fa-circle-o text-gray"></i> Navigator</li> --}}
                        </ul>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">

                    <!-- /.footer -->
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="box box-default col-md-6">
                    <div class="box-header with-border">
                    <h3 class="box-title">Candidatos</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="progress" >
                            <p class="text-center">
                                <strong>Progresso por candidato</strong>
                            </p>
                        </div>
                    </div>
                    <div class="box-footer no-padding">

                    </div>
            </div>
        </div>

    </div>

@stop

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
<script src="https://adminlte.io/themes/AdminLTE/bower_components/chart.js/Chart.js"></script>
<script>
    var ballots = {!! json_encode($ballots)!!};
    var total = {!! json_encode($urn->ballots->count())!!};
    var colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'];
    var textColor = ['red', 'green', 'yellow', 'aqua', 'light-blue', 'gray']
      // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [];

  for(var i= 0; i < ballots.length; i++){
      PieData.push({
        value    : ballots[i].total,
        color    : colors[i],
        highlight: colors[i],
        label    : ballots[i].candidate.name
      });
      $("#legend").append('<li><i class="fa fa-circle-o text-'+ textColor[i]+'"></i> '+ballots[i].candidate.name +'</li>');
      $("#progress").append(`<div class="progress-group">
            <span class="progress-text">${ballots[i].candidate.name}</span>
            <span class="progress-number"><b>${ballots[i].total}</b>/${total}</span>

            <div class="progress sm">
              <div class="progress-bar progress-bar-${textColor[i]}" style="width: ${ (ballots[i].total/total)*100 }%"></div>
            </div>
          </div>`);
  }



  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%> users'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------


</script>
@stop
