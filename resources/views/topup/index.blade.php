@extends ('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endsection

@section ('content')
  @include('inc.bread-crumbs')
  <div class="content mt-3">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <strong class="card-title">Data Table</strong>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Transaction ID</th>
                    <th>Package</th>
                    <th>Account</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @if($topup)
                    @foreach($topup as $key=>$list)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$list->transaction_id}}</td>
                        <td>
                          {{App\TopupPackage::find($list->package_id)->first()->name}}
                        </td>
                        <td>{{$list->account_id}}</td>
                        <td>{{$list->payment_method}}</td>
                        <td>{{$list->amount}}</td>
                        <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d/m/Y')}}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div><!-- .animated -->
  </div><!-- .content -->
@endsection

@section('scripts')
  <script src="{{asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/pdfmake.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/datatables-init.js')}}"></script>
@endsection
