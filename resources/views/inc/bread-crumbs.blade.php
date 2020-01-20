<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{$breadcrumb['title']}}</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{url()->current()}}">{{Request::segment(1)}}</a></li>
                    <li class="active">{{$breadcrumb['subtitle']}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
