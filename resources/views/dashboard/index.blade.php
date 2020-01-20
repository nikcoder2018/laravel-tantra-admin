@extends ('layouts.app')

@section ('content')
  @include('inc.bread-crumbs')

  {{-- <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Dashboard</div>

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif

                      You are logged in!
                  </div>
              </div>
          </div>
      </div>
  </div> --}}
  <div class="content mt-3">
    <main role="main" class="inner cover">
      <h1 class="cover-heading">Welcome to Tantra Online Admin Panel</h1>
      <p class="lead">This project is not yet fully completed.</p>
      <div class="col-xl-4 col-lg-6">
          <div class="card">
              <div class="card-body">
                  <div class="stat-widget-one">
                      <div class="stat-icon dib"><i class="ti-light-bulb text-warning border-warning"></i></div>
                      <div class="stat-content dib">
                          <div class="stat-text">Total Users Online</div>
                          <div class="stat-digit">{{$serverPlayerOnline}}</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-4 col-lg-6">
          <div class="card">
              <div class="card-body">
                  <div class="stat-widget-one">
                      <div class="stat-icon dib"><i class="ti-user text-danger border-danger"></i></div>
                      <div class="stat-content dib">
                          <div class="stat-text">Total Users Account</div>
                          <div class="stat-digit">{{$totalAccounts}}</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-4 col-lg-6">
          <div class="card">
              <div class="card-body">
                @if($serverStatus==1)
                  <div class="stat-widget-one">
                      <div class="stat-icon dib"><i class="ti-face-smile text-success border-success"></i></div>
                      <div class="stat-content dib">
                          <div class="stat-text">Server Status</div>
                          <div class="stat-digit">Online</div>
                      </div>
                  </div>
                @else
                  <div class="stat-widget-one">
                      <div class="stat-icon dib"><i class="ti-face-sad text-danger border-danger"></i></div>
                      <div class="stat-content dib">
                          <div class="stat-text">Server Status</div>
                          <div class="stat-digit">Offline</div>
                      </div>
                  </div>
                @endif
              </div>
          </div>
      </div>
    </main>

  </div> <!-- .content -->
@endsection
