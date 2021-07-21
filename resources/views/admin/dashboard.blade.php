@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@include('layouts.navbar')
@section('content')

<div class="col-md-12">     
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Je</h1>
    <p class="lead">{{ $greetings }}</p>
  </div>

  @if ($message = Session::get('updateprofile'))
  <div class="alert alert-info alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif

  <div class="row">
    <!-- Show data in table --------------------------------------------------->
    <div class="col-md-8 pb-4">
      <div class="card bg-white shadow px-4 py-4">

        <h5 class="text-center pb-4">{{ $product->name }}</h5>

        <p>Date : <b>{{ $date_today }}</b> &nbsp;&nbsp; Time : <b>{{ $current_time }}</b> &nbsp;&nbsp; Report Hours : <b>{{ $duration }}</b></p>
        <div class="table-responsive">
          <table class="table text-center">
            <thead class="thead">
              <tr>
                <th class="text-left">Package</th>
                <th>Registration [A]</th>
                <th>Updated Paid Ticket [B]</th>
                <th>Updated Free Ticket [C]</th>
                <th>Total Registration</th>
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
                <td class="text-left">{{ $package1 }}</td>
                <td>
                  {{ number_format($registration1) }}
                </td>
                <td>{{ number_format($paidticket1) }}</td>
                <td>{{ number_format($freeticket1) }}</td>
                <td>{{ number_format($totalpackage1) }}</td>
              </tr>
              <tr>
                <td class="text-left">{{ $package2 }}</td>
                <td>
                  {{ number_format($registration2) }}
                </td>
                <td>{{ number_format($paidticket2) }}</td>
                <td>{{ number_format($freeticket2) }}</td>
                <td>{{ number_format($totalpackage2) }}</td>
              </tr>
              <tr>
                <td class="text-left">{{ $package3 }}</td>
                <td>
                  {{ number_format($registration3) }}
                </td>
                <td>{{ number_format($paidticket3) }}</td>
                <td>{{ number_format($freeticket3) }}</td>
                <td>{{ number_format($totalpackage3) }}</td>
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
                <th colspan="4" class="text-right">Grand Total</th>
                {{-- <th>{{ number_format($totalregister) }}</th>
                <th>{{ number_format($totalpaid) }}</th>
                <th>{{ number_format($totalfree) }}</th> --}}
                <th class="table-active">{{ number_format($totalpackage1 + $totalpackage2 + $totalpackage3) }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">Updated Ticket [B+C]</h6>
        <b class="display-6 pb-3">{{ number_format($totalticket) }}</b>
      </div>
      <br>
      <div class="card border-0 shadow text-center text-danger" style="height: 117px">
        <h6 class="pt-4">Pending Ticket [A-B]</h6>
        <b class="display-6 pb-3">{{ number_format($pendingticket) }}</b>
      </div>
      <br>
      <div class="card border-0 gradient-3 shadow text-center" style="height: 117px">
        <h6 class="pt-4">Overall Ticket [A+C]</h6>
        <b class="display-6 pb-3">{{ number_format($totalticket + $pendingticket) }}</b>
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

  <br>
  {{-- @if(Auth::user()->user_id == 'ROD003' || Auth::user()->user_id == 'ROD004' )
  @else --}}
  <h4 class="border-bottom pb-3">Total Collection</h4>

  <div class="row pt-2">
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">{{ $package1 }}</h6>
        <b class="display-6 pb-3">RM {{ number_format($collection1) }}</b>
      </div>
    </div>
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">{{ $package2 }}</h6>
        <b class="display-6 pb-3">RM {{ number_format($collection2) }}</b>
      </div>
    </div>
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">{{ $package3 }}</h6>
        <b class="display-6 pb-3">RM {{ number_format($collection3) }}</b>
      </div>
    </div>
    <div class="col-md-3 pb-4">
      <div class="card border-0 gradient-2 shadow text-center" style="height: 117px">
        <h6 class="pt-4">Total Collection</h6>
        <b class="display-6 pb-3">RM {{ number_format($collection1 + $collection2 + $collection3) }}</b>
      </div>
    </div>
  </div>
  {{-- @endif --}}
      
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
