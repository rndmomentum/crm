@extends('layouts.app')

@section('title')
    Dashboard
@endsection

<style>
  .card {
    overflow: hidden;
  }

  .card-block .rotate {
    z-index: 8;
    float: right;
    height: 100%;
  }

  .card-block .rotate i {
    color: rgba(20, 20, 20, 0.15);
    position: absolute;
    left: 0;
    left: auto;
    right: -10px;
    bottom: 0;
    display: block;
    -webkit-transform: rotate(-44deg);
    -moz-transform: rotate(-44deg);
    -o-transform: rotate(-44deg);
    -ms-transform: rotate(-44deg);
    transform: rotate(-44deg);
  }
</style>

@include('layouts.navbar')
@section('content')
@include('layouts.sidebar')
<div class="row py-4">     
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        {{-- <p class="lead">{{ $greetings }}, {{ Auth::user()->name }}.</p>
      </div> --}}

      @if ($message = Session::get('updateprofile'))
      <div class="alert alert-info alert-block">
          <button type="button" class="close" data-bs-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      @endif

      <div class="row pt-5">
        <!-- Show data in table --------------------------------------------------->
        <div class="col-md-12">
          <div class="card bg-white px-4 py-4">

            <h5 class="text-center pb-4">{{ $product->name }}</h5>

            <p>Date : <b>{{ $date_today }}</b> &nbsp;&nbsp; Time : <b>{{ $current_time }}</b> &nbsp;&nbsp; Report Hours : <b>{{ $duration }}</b></p>
            
            <div class="table-responsive">
            <table class="table text-center">
              <thead class="thead">
                <tr>
                  <th class="text-left">Package</th>
                  <th>Registration [A]</th>
                  <th>Updated Ticket [B]</th>
                  <th>Free Ticket [C]</th>
                </tr>
              </thead>
              <tbody>
              {{-- @foreach ($package as $packages) --}}
                {{-- <tr>
                  <td class="text-left">{{ $packages->name }}</td>
                  <td>
                    {{ number_format($registration) }}
                  </td>
                  <td>{{ number_format($paidticket) }}</td>
                  <td>{{ number_format($freeticket) }}</td>
                </tr> --}}
              {{-- @endforeach --}}
                <tr>
                  <td class="text-left">Solidariti</td>
                  <td>
                    {{ number_format($registration1) }}
                  </td>
                  <td>{{ number_format($paidticket1) }}</td>
                  <td>{{ number_format($freeticket1) }}</td>
                </tr>
                <tr>
                  <td class="text-left">Sustain</td>
                  <td>
                    {{ number_format($registration2) }}
                  </td>
                  <td>{{ number_format($paidticket2) }}</td>
                  <td>{{ number_format($freeticket2) }}</td>
                </tr>
                <tr>
                  <td class="text-left">Growth</td>
                  <td>
                    {{ number_format($registration3) }}
                  </td>
                  <td>{{ number_format($paidticket3) }}</td>
                  <td>{{ number_format($freeticket3) }}</td>
                </tr>
              </tbody>
              <tfoot>
                {{-- <tr>
                  <th class="text-left">Today's Collection</th>
                  <th>{{ number_format($register) }}</th>
                  <th>{{ number_format($paid) }}</th>
                  <th class="border-right">{{ number_format($free) }}</th>
                </tr> --}}
                <tr>
                  <th class="text-left">Grand Total</th>
                  <th>{{ number_format($totalregister) }}</th>
                  <th>{{ number_format($totalpaid) }}</th>
                  <th>{{ number_format($totalfree) }}</th>
                </tr>
                <tr>
                  <th></th>
                  <th class="text-right">Ticket Sold [B+C]</th>
                  <th colspan="2">{{ number_format($totalticket) }}</th>
                </tr>
                <tr>
                  <th></th>
                  <th class="text-right">Pending Ticket [A-B]</th>
                  <th class="text-danger" colspan="2">{{ number_format($pendingticket) }}</th>
                </tr>
                <tr>
                  <th></th>
                  <th class="text-right">Overall Ticket [A+C]</th>
                  <th class="table-active" colspan="2">{{ $totalticket + $pendingticket}}</th>
                </tr>
              </tfoot>
            </table>
            </div>
          </div>
        </div>

        <!-- Show data in bar chart --------------------------------------------------->
        {{-- <div class="col-md-5">
          <div class="card bg-white shadow px-2 py-2">
            <div id="chartdata" ></div>
          </div>
        </div> --}}

        <!-- Show data in line graph --------------------------------------------------->

        {{-- <figure class="highcharts-figure">
          <div id="container"></div>
        </figure> --}}

      </div>
      
    </main>
  </div>
</div>

<!-- Function to show bar chart ----------------------------------------------------->
{{-- <script>
  Highcharts.chart('chartdata', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Magic Number'
    },
    subtitle: {
        text: 'Profit of Momentum Internet'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Profit (RM)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="padding:3">RM </td>' +
            '<td style="padding:3"><b> {point.y:.2f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Month',
        data: [
            {{$jan}},
            {{$feb}},
            {{$mar}},
            {{$apr}},
            {{$may}},
            {{$jun}},
            {{$jul}},
            {{$aug}},
            {{$sep}},
            {{$oct}},
            {{$nov}},
            {{$dec}}
          ]

    }]
  });
</script> --}}

<!-- Function to show line graph ----------------------------------------------------->
{{-- <script>
  Highcharts.chart('container', {

  title: {
    text: 'Magic Number'
  },

  subtitle: {
    text: 'Profit of Momentum Internet'
  },

  yAxis: {
    title: {
      text: ''
    }
  },

  xAxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
  },

  // xAxis: {
  //   accessibility: {
  //     rangeDescription: 'Range: 2010 to 2017'
  //   }
  // },

  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
  },

  plotOptions: {
    spline: {
      marker: {
        radius: 4,
        lineColor: '#303030',
        lineWidth: 1
      }
    }
    // series: {
    //   label: {
    //     connectorAllowed: false
    //   },
    //   pointStart: 2021
    // }
  },

  series: [{
    name: 'Profit (RM)',
    data: [
            {{$jan}},
            {{$feb}},
            {{$mar}},
            {{$apr}},
            {{$may}},
            {{$jun}},
            {{$jul}},
            {{$aug}},
            {{$sep}},
            {{$oct}},
            {{$nov}},
            {{$dec}}
          ]
  }],

  responsive: {
    rules: [{
      condition: {
        maxWidth: 800
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom'
        }
      }
    }]
  }

});
</script> --}}
@endsection
