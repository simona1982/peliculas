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
                Detalle Cliente
            </div>
            <div class="panel-body">
                <div class="row">
					<div class="col-lg-6 col-lg-offset-3">
				        <div class="hpanel hgreen">
				            <div class="panel-body">
				            	
				                <span class="label label-primary pull-right">
				                	{{ $client->type_identification }} - {{ $client->identification }}
				                </span>
				                

				                <img alt="profile" 
				                	class="img-circle center-block" 
				                	src="{{ url('image-client', $client->picture) }}"
				                	width="300px" height="300px" />

				                <br>
				                <br>
								
								<!--div class="col-sm-4 pull-right"-->
	                            <div class="project-action m-t-md pull-right">
	                                <div class="btn-group">
	                                	<a href="{{ url()->previous() }}" class="btn btn-xs btn-primary">
	                                		<font-awesome-icon :icon="['fas', 'undo']"></font-awesome-icon>
									    	Vover
									    </a> 
	                                </div>
	                            </div>
	                            <!--/div-->

				                <h1 class="font-bold text-center">
				                	<a href="#"> {{ $client->first_name }} {{ $client->last_name }}</a>
				                </h1>
				                <h3 class="text-muted font-bold text-center">
				                	
				                </h3>
				                <!--div class="text-muted font-bold m-b-xs"></div-->
				                
				                <br>

				            </div>
				            <div class="panel-footer contact-footer">
				                <div class="row">
				                    <div class="col-md-4 border-right"> 
				                    	<div class="contact-stat"><span>Email: </span> <strong>{{ $client->email }}</strong></div> 
				                    </div>
				                    <div class="col-md-2 border-right"> 
				                    	<div class="contact-stat"><span>Telefono: </span> <strong>{{ $client->phone_number }}</strong></div> 
				                    </div>
				                    <div class="col-md-2 border-right"> 
				                    	<div class="contact-stat"><span>Movil: </span> <strong>{{ $client->phone_movil }}</strong></div> 
				                    </div>
				                    <div class="col-md-2"> 
				                    	<div class="contact-stat"><span>Cumpleaños: </span> <strong>{{ $client->birthday }}</strong></div> 
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
            </div>
        </div>
    </div>
</div>

@endsection