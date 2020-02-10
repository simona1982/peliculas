@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide">
                        <font-awesome-icon icon="chevron-up"></font-awesome-icon>
                        <!--i class="fa fa-chevron-up"></i-->
                    </a>
                    <a class="closebox">
                        <font-awesome-icon icon="times"></font-awesome-icon>
                        <!--i class="fa fa-times"></i-->
                    </a>
                </div>
                Editar Cliente
            </div>
            <div class="panel-body">
                <edit-form-client 
                    id="{{ $client->id }}"
                    url-save="{{ route('clients.update', ['client' => $client->id]) }}" 
                    url-client="{{ url('image-client', ['filename' => $client->picture]) }}">
                </edit-form-client>
            </div>
        </div>
    </div>
</div>
@endsection