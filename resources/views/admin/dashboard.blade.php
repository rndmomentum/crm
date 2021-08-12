@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')

<div class="col-md-12">     
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <p class="lead">{{ $greetings }}</p>
  </div>

  @if ($message = Session::get('updateprofile'))
  <div class="alert alert-info alert-block">
      <button type="button" class="close" data-bs-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
  </div>
  @endif

  <div class="row pb-2">
    @if ( Auth::user()->user_id == 'UID001' )
    
      <div class="col-md-6 pb-3">
        <div class="card border-0 shadow text-center text-success" style="height: 117px">
          <h6 class="pt-4">Today's Registration</h6>
          <b class="display-6 pb-3">+{{ number_format($total_now) }}</b>
        </div>
      </div>
    
      <div class="col-md-6 pb-3">
        <div class="card border-0 shadow text-center text-success" style="height: 117px">
          <h6 class="pt-4">Yesterday's Registration</h6>
          <b class="display-6 pb-3">+{{ number_format($total_yesterday) }}</b>
        </div>
      </div>
    
    @else
    @endif

    <!-- Show data in table --------------------------------------------------->
    <div class="col-md-8 pb-4">
      <div class="card bg-white shadow px-4 py-4">

        <h5 class="text-center py-4">{{ $product->name }}</h5>

        <p>Date : <b>{{ $date_today }}</b> &nbsp;&nbsp; Report Hours : <b>{{ $duration }}</b></p>

        <div class="table-responsive pb-4">
          <table class="table text-center">
            <thead class="thead">
              <tr>
                <th class="text-left">Package</th>
                <th>Registration [A]</th>
                <th>Updated Paid Ticket [B]</th>
                <th>Updated Free Ticket [C]</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < $count_package; $i++)
              <tr>
                <td class="text-left">{{ $package[$i]->name }}</td>
                <td>
                  {{ number_format($registration[$i]) }}
                </td>
                <td>{{ number_format($paidticket[$i]) }}</td>
                <td>{{ number_format($freeticket[$i]) }}</td>
              </tr>
              @endfor
            </tbody>
          </table>
        </div>

        {{-- @if ( Auth::user()->user_id == 'UID001' )
          <div class="table-responsive pb-4">
            <table class="table table-sm table-bordered text-center">
              <thead class="thead">
                <tr>
                  <th class="text-center" rowspan="2">Time</th>       
                  <th colspan="3">Registration [A]</th>
                  <th colspan="3">Updated Paid Ticket [B]</th>
                  <th colspan="3">Updated Free Ticket [C]</th>       
                </tr>
                <tr>
                  @for ($i = 0; $i < $count_package; $i++)
                    <th>{{ $package[$i]->name }}</th>
                  @endfor
                  @for ($i = 0; $i < $count_package; $i++)
                    <th>{{ $package[$i]->name }}</th>
                  @endfor
                  @for ($i = 0; $i < $count_package; $i++)
                    <th>{{ $package[$i]->name }}</th>
                  @endfor
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th class="text-left">12:00 am - 08:00 am</th>                  
                  @for ($i = 0; $i < $count_package; $i++)
                    <td>{{ number_format($registration[$i]) }}</td>
                    <td>{{ number_format($paidticket[$i]) }}</td>
                    <td>{{ number_format($freeticket[$i]) }}</td>
                  @endfor
                </tr>
                <tr>
                  <th class="text-left">08:00 am - 09:00 am</th>
                </tr>
                <tr>
                  <th class="text-left">09:00 am - 10:00 am</th>
                </tr>
                <tr>
                  <th class="text-left">10:00 am - 11:00 am</th>
                </tr>
                <tr>
                  <th class="text-left">11:00 am - 12:00 pm</th>
                </tr>
                <tfoot>
                  <tr> 
                    <th class="text-left">Total Yesterday</th>
                  </tr>
                </tfoot>
              </tbody>
            </table>
          </div>
        @else
        @endif --}}

      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">Total Updated Ticket [B+C]</h6>
        <b class="display-6 pb-3">{{ number_format($totalticket) }}</b>
      </div>
      <br>
      <div class="card border-0 shadow text-center text-danger" style="height: 117px">
        <h6 class="pt-4">Total Pending Ticket [A-B]</h6>
        <b class="display-6 pb-3">{{ number_format($pendingticket) }}</b>
      </div>
      <br>
    </div>

  </div>

  <h4 class="border-bottom pb-3">Overall Registration</h4>

  <div class="row py-2">
    @for ($i = 0; $i < $count_package; $i++)
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">{{ $package[$i]->name }}</h6>
        <b class="display-6 pb-3">{{ number_format($totalpackage[$i]) }}</b>
      </div>
    </div>
    @endfor

    <div class="col-md-3 pb-4">
      <div class="card border-0 gradient-2 shadow text-center" style="height: 117px">
        <h6 class="pt-4">Total</h6>
        <b class="display-6 pb-3">{{ number_format($totalregister) }}</b>
      </div>
    </div>
  </div>

  <h4 class="border-bottom pb-3">Overall Collection</h4>

  <div class="row pt-2">
    @for ($i = 0; $i < $count_package; $i++)
    <div class="col-md-3 pb-4">
      <div class="card border-0 shadow text-center" style="height: 117px">
        <h6 class="pt-4">{{ $package[$i]->name }}</h6>
        <b class="display-6 pb-3">RM {{ number_format($collection[$i]) }}</b>
      </div>
    </div>
    @endfor

    <div class="col-md-3 pb-4">
      <div class="card border-0 gradient-2 shadow text-center" style="height: 117px">
        <h6 class="pt-4">Total</h6>
        <b class="display-6 pb-3">RM {{ number_format($totalcollection) }}</b>
      </div>
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
