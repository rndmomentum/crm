@if (Session::get('role_id') == 'ROD005')

  @extends('staff.app')

  @section('title')
  Staff Dashboard
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

  @section('content')

  <div class="col-md-12 pt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-xl-6 col-md-6 mb-4">
          <div class="card">
            <div class="card-header"><strong>Get Staff URL link</strong></div>
            <div class="card-body">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Link" aria-label="Recipient's username" aria-describedby="button-addon2" id="input" value="{{ Request::root() }}/invite/{{ Session::get('user_id') }}">
                <button class="btn btn-outline-secondary" type="button" id="clipboardCopy" data-clipboard-target="#post-shortlink">Copy</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Total User</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_count }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      {{-- <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                              bleble</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">RM </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Hukays</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div> --}}

    <div class="col-md-12 pt-3 table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Date</th>
              <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no = (10 * ($data->currentPage() - 1));

          @endphp
          
          @forelse ($data as $key => $p)
              <tr>
                <th scope="row">{{ ++$no }}</th>
                <td>{{ $p->name }}</td>
                <td>RM{{ $p->pay_price }}.00</td>
                <td>{{ date('d/m/Y', strtotime($p->created_at)) }}</td>
                <td>lor3m</td>
              </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No result founds for query</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $data->links() }}
    </div>

    <script>
      document.getElementById('clipboardCopy').addEventListener('click', clipboardCopy);
      async function clipboardCopy() {
        let text = document.querySelector("#input").value;
        await navigator.clipboard.writeText(text);
      }
    </script>
    
  </div>
  @endsection
@endif