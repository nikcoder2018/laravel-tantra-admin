@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/lib/chosen/chosen.css')}}">
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
                      <div class="float-right">
                        <button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#addTaneyModal">
                          <i class="fa fa-plus-circle"></i> Add Taney
                        </button>
                        <button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#removeTaneyModal">
                          <i class="fa fa-trash-o"></i> Remove Taney
                        </button>
                      </div>
                  </div>
                  <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered" data-orderby="4">
              <thead>
                <tr>
                  <th></th>
                  <th>UserID</th>
                  <th>Email</th>
                  <th>Taney Balance</th>
                  <th>Total Taneys</th>
                </tr>
              </thead>
              <tbody>
                @if($playersTaney)
                  @foreach($playersTaney as $key=>$list)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$list->userId}}</td>
                      <td>{{$list->email}}</td>
                      <td>{{$list->cashBalance}}</td>
                      <td>{{$list->totaltaneys}}</td>
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

  <div class="modal fade" id="addTaneyModal" tabindex="-1" role="dialog" aria-labelledby="addTaneyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTaneyModalLabel">Add Taney</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(array('url' => 'taneys/add', 'id' => 'form-addtaney'))!!}
          @csrf
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-grop">
                <label for="userid" class="form-control-label">Select Account:</label>
                <select data-placeholder="Select Account" name="userid" id="userid" class="standardSelect" tabindex="1">
                  @if($players)
                    @foreach($players as $key=>$list)
                      <option value="{{$list->userId}}">{{$list->userId}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="taney" class="form-control-label">How much taney?</label>
                <input type="number" id="taney" name="taney" placeholder="Insert taney here" class="form-control" required>
              </div>
              <div class="alert alert-success" role="alert" style="display: none">

              </div>
              <div class="alert alert-danger" role="alert" style="display: none">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="modal fade" id="removeTaneyModal" tabindex="-1" role="dialog" aria-labelledby="removeTaneyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeTaneyModalLabel">Remove Taney</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(array('url' => 'taneys/remove', 'id' => 'form-removetaney'))!!}
          @csrf
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-grop">
                <label for="userid" class="form-control-label">Select Account:</label>
                <select data-placeholder="Select Account" name="userid" id="userid" class="standardSelect" tabindex="1">
                  @if($players)
                    @foreach($players as $key=>$list)
                      <option value="{{$list->userId}}">{{$list->userId}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="taney" class="form-control-label">How much taney to remove?</label>
                <input type="number" id="taney" name="taney" placeholder="Enter taney here" class="form-control" required>
              </div>
              <div class="alert alert-success" role="alert" style="display: none">

              </div>
              <div class="alert alert-danger" role="alert" style="display: none">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/js/lib/data-table/datatables-init.js')}}"></script>
  <script src="{{asset('assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>
  <script>
      jQuery(document).ready(function() {

          jQuery(".standardSelect").chosen({
              disable_search_threshold: 10,
              no_results_text: "Oops, nothing found!",
              width: "100%"
          });
      });
  </script>
@endsection
