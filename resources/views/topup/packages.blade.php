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
              <strong class="card-title">Packages List</strong>
              <div class="float-right">
                <button type="button" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#newPackageModal">
                  <i class="fa fa-plus-circle"></i> New Package
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Taney</th>
                    <th>Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @if($packages)
                    @foreach($packages as $key=>$list)
                      <tr>
                        <td>{{++$key}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->description}}</td>
                        <td>{{$list->price}}</td>
                        <td>{{$list->taney}}</td>
                        <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d/m/Y')}}</td>
                        <td>
                          <button type="button" class="btn btn-primary btn-sm" onclick="showFreebies({{$list->id}})"><i class="fa fa-gift"></i> Freebies</button>
                          <button type="button" class="btn btn-danger btn-sm" onclick="archivePackage({{$list->id}})"><i class="fa fa-archive"></i> Archive</button>
                        </td>
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

  <div class="modal fade" id="newPackageModal" tabindex="-1" role="dialog" aria-labelledby="newPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newPackageModalLabel">New Package</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(array('url' => 'topup/packages/store', 'id' => 'form-newpackage'))!!}
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-5 col-md-border">
                <div class="form-group">
                  <label for="package_name" class=" form-control-label">Package Name:</label>
                  <input type="text" id="packagename" name="packagename" placeholder="New Topup Package" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="package_description" class=" form-control-label">Description:</label>
                  <textarea id="description" name="description" rows="3" cols="80" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="package_price" class=" form-control-label">Price $:</label>
                  <input type="number" id="price" name="price" placeholder="0.00" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="package_taney" class=" form-control-label">Taney:</label>
                  <input type="number" id="taney" name="taney" placeholder="0.00" class="form-control" required>
                </div>
              </div>
              <div class="col-md-7 col-md-border">
                <div class="col-md-12">
                  <h3>Add Freebies</h3><hr>
                  <div class="row">
                    <div id="f-input-data">
                      <div class="form-group col-md-2">
                        <input type="text" id="f-item-name" placeholder="Name" class="form-control form-control-sm" autofocus>
                      </div>
                      <div class="form-group col-md-2">
                        <input type="number" onKeyPress="if(this.value.length==4) return false;" id="f-item-index" placeholder="Index" class="form-control form-control-sm">
                      </div>
                      <div class="form-group col-md-2">
                        <input type="number" id="f-item-count" placeholder="Count" class="form-control form-control-sm">
                      </div>
                      <div class="form-group col-md-2">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="f-isbundle" value="true">
                          <label class="custom-control-label" for="f-isbundle">Bundle?</label>
                        </div>
                      </div>
                      <div class="form-group col-md-2">
                        <input type="number" id="f-item-qty" style="display:none" placeholder="Qty" class="form-control form-control-sm">
                      </div>
                      <div class="form-group col-md-2">
                        <button type="button" class="btn btn-outline-success btn-sm" id="btnAddFreebie"><i class="fa fa-plus"></i> Add</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <ul class="list-group" id="listFreebies">
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="alert alert-success" role="alert" style="display: none">

            </div>
            <div class="alert alert-danger" role="alert" style="display: none">

            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="modal fade" id="showFreebiesModal" tabindex="-1" role="dialog" aria-labelledby="showFreebiesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showFreebiesModalLabel">Show Freebies</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
            <div class="col-md-12">
              <ul class="list-group" id="listFreebies">
              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
      </div>
    </div>
  </div>

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
