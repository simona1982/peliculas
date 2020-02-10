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
                Detalle Usuario
            </div>
            <div class="panel-body">
                <div class="row">
					<div class="col-lg-6 col-lg-offset-3">
				        <div class="hpanel hgreen">
				            <div class="panel-body">
				            	
				                <span class="label label-primary pull-right">
				                	{{ $user->username }}
				                </span>
				                

				                <img alt="profile" 
				                	class="img-circle center-block" 
				                	src="{{ url('image-user', $user->picture) }}"
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
				                	<a href="#"> {{ $user->first_name }} {{ $user->last_name }}</a>
				                </h1>
				                <h3 class="text-muted font-bold text-center">
				                	
				                </h3>
				                <!--div class="text-muted font-bold m-b-xs"></div-->
				                
				                <br>

				                <!--div class="row">
	                                <div class="col-sm-4">
	                                    <div class="project-label">WEBSITE</div>
	                                    <small></small>
	                                </div>
	                                <div class="col-sm-4">
	                                    <div class="project-label">FAX</div>
	                                    <small></small>
	                                </div>
	                                <div class="col-sm-4">
	                                    <div class="project-label">ESTADO</div>
	                                    <small></small>
	                                </div>
	                            </div-->

	                            
				                <!--p>
				                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan.
				                </p-->
				                <!--pre></pre-->
				            </div>
				            <div class="panel-footer contact-footer">
				                <div class="row">
				                    <div class="col-md-4 border-right"> 
				                    	<div class="contact-stat"><span>Email: </span> <strong>{{ $user->email }}</strong></div> 
				                    </div>
				                    <div class="col-md-2 border-right"> 
				                    	<div class="contact-stat"><span>Usuario: </span> <strong>{{ $user->username }}</strong></div> 
				                    </div>
				                    <div class="col-md-2 border-right"> 
				                    	<div class="contact-stat"><span>Nombre(s): </span> <strong>{{ $user->first_name }}</strong></div> 
				                    </div>
				                    <div class="col-md-2"> 
				                    	<div class="contact-stat"><span>Apellido(s): </span> <strong>{{ $user->last_name }}</strong></div> 
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