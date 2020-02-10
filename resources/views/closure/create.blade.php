@extends('layouts.dashboard')

@section('title')
<div class="normalheader ">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <font-awesome-icon icon="arrow-up"></font-awesome-icon>
                    <!--i class="fa fa-arrow-up"></i-->
                </div>
            </a>

            <!--div id="hbreadcrumb" class="pull-right m-t-lg">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li>
                        <span>App views</span>
                    </li>
                    <li class="active">
                        <span>File manager</span>
                    </li>
                </ol>
            </div-->
            <h2 class="font-light m-b-xs">
                Cierre de Ventas
            </h2>
            <small>Show you files in a nica manager design.</small>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="hpanel">
            <div class="panel-body">
                <upload-closure></upload-closure>
            </div>
        </div>

        <div class="hpanel">
            <div class="panel-body">
                <h3>6 GB used</h3>
                <p>It is 65% of all your storage</p>
                <div class="progress full m-t-xs">
                    <div style="width: 65%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class=" progress-bar progress-bar-info">
                        65%
                    </div>
                </div>
                <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit vestibulum adipiscing elit.</small>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-3">
                <div class="hpanel">
                    <div class="panel-body file-body">
                        <i class="fa fa-file-pdf-o text-info"></i>
                    </div>
                    <div class="panel-footer">
                        <a href="#">Document_2016.doc</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--div class="row">
    <div class="col-lg-12">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide">
                        <font-awesome-icon icon="chevron-up"></font-awesome-icon>
                    </a>
                    <a class="closebox">
                        <font-awesome-icon icon="times"></font-awesome-icon>
                    </a>
                </div>
                Crear Cierre
            </div>
            <div class="panel-body">
                <new-form-closure url-save="{{ route('closures.store') }}"></new-form-closure>
            </div>
        </div>
    </div>
</div-->
@endsection
