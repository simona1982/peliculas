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
                Detalle Punto de Venta
            </div>
            <div class="panel-body">
            	<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
				        <div class="hpanel hgreen blog-box">

							<div class="panel-heading">
								
								@if(!is_null($point->user_id))

						            <div class="media clearfix">
						                <a class="pull-left">
						                    <img src="{{ url('image-user', $point->user->picture) }}" alt="profile-picture">
						                </a>
						                <div class="media-body">
						                    <small>Responsable: 
						                    	<span class="font-bold">
						                    		{{ title_case($point->user->first_name) }} {{ title_case($point->user->last_name) }}
						                    	</span> 
						                    </small>
						                    <br/>
						                    <small>Usuario:
						                    	<span class="text-muted">{{ $point->user->username }}</span>
						                    </small>
						                </div>
						            </div>
					            @else
									<h3 class="text-center"><a href="#"> Punto sin responsable </a></h3>
					            @endif
					        </div>
					         <div class="panel-image">
					         	<img alt="profile" 
				                	class="img-responsive" 
				                	src="{{ url('image-point', $point->picture) }}"
				                	/>

					            <div class="title">
					                <a href="#"> <h4>{{ $point->name }}</h4></a>
					                <small>{{ $point->location }}</small>
					            </div>
					        </div>
				            <div class="panel-body">
				            	<a href="blog_details.html"> <h4>{{ $point->name }}</h4></a>

				            	<p>
					                {{ $point->location }}
					            </p>

					            <br>

				            	<a href="{{ url()->previous() }}" class="btn btn-primary btn-xs">
				            		<font-awesome-icon :icon="['fas', 'undo']"></font-awesome-icon>
				            		Volver
				            	</a>
				                
				            </div>
				            <div class="panel-footer contact-footer">
				                <div class="row">
				                    <div class="col-md-12"> 
				                    	<div class="contact-stat">
				                    		<span>Tiene Sistema Pos: </span> 
				                    		@if ($point->sistemaPos === 1)
				                    			<strong>Si</strong>
				                    		@else
												<strong>No</strong>
				                    		@endif
				                    	</div> 
				                    </div>
				                    <!--div class="col-md-2 border-right"> 
				                    	<div class="contact-stat"><span>Usuario: </span> <strong></strong></div> 
				                    </div>
				                    <div class="col-md-2 border-right"> 
				                    	<div class="contact-stat"><span>Nombre(s): </span> <strong></strong></div> 
				                    </div>
				                    <div class="col-md-2"> 
				                    	<div class="contact-stat"><span>Apellido(s): </span> <strong></strong></div> 
				                    </div-->
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