@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
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
                  <th></th>
                  <th>UserID</th>
                  <th>Email</th>
                  <th>Date Registered</th>
                  <th>Activation</th>
                </tr>
              </thead>
              <tbody>
                @if($players)
                  @foreach($players as $key=>$list)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$list->userid}}</td>
                      <td>{{$list->email}}</td>
                      <td>{{$list->date_registered}}</td>
                      <td>{{$list->activated}}</td>
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
