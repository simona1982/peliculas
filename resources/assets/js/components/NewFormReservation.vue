<template>
	<!-- Wrapper -->
	<div id="wrapper-new-form-reservation">
		<form name="newFormReservation" method="POST" id="newFormReservation" v-on:submit.prevent="handleSubmit">
	        <div class="row">
	            <div class="col-lg-4">
	                <!--i class="pe-7s-user fa-5x text-muted">text-center </i-->
	                <div class="picture-user">
	                    <div class="picture-user">
		              		<file-field @sendPicture="getPicture" :url="uploadImageUserUrl" ></file-field>
		                </div>
	                </div>

	            </div>
	            <div class="col-lg-8">

	            	<!-- Cliente -->
	            	<div class="hpanel">
						<div class="panel-heading">
		                   <span class="font-extra-bold">Cliente</span> 
		                </div>
						<div class="panel-body">
							<!--label for="point_selected">Punto</label-->
	                        <v-select v-model="client_selected" label="full_name" :options="options1">
	                            <template slot="option" slot-scope="option">
	                                <img :src="path1 + option.picture" class="img-circle m-b" width="50px" height="50px">
	                                <strong>&nbsp; &nbsp;{{ option.full_name }}</strong>
	                            </template>
	                        </v-select>
						</div>
					</div>
						
					<!-- Punto -->
					<div class="hpanel">
						<div class="panel-heading">
		                    <!--div class="panel-tools">
		                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
		                        <a class="closebox"><i class="fa fa-times"></i></a>
		                    </div-->
		                   <span class="font-extra-bold">Punto</span> 
		                </div>
						<div class="panel-body">
							<!--label for="point_selected">Punto</label-->
	                        <v-select v-model="point_selected" label="name" :options="options">
	                            <template slot="option" slot-scope="option">
	                                <img :src="path + option.picture" class="img-circle m-b" width="50px" height="50px">
	                                <strong>&nbsp; &nbsp;{{ option.name }}</strong>
	                            </template>
	                        </v-select>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-lg-6">
							<label for="phone">Fecha Reserva *</label>
							<datepicker placeholder="Seleccione Fecha" 
								:full-month-name="true"
								:bootstrap-styling="true"
								:clear-button="true"
								input-class="form-control"
								:language="languages[language]"
								format="d MMMM yyyy"
								v-model="reservation_date">
							</datepicker>

							<span class="text-danger" v-for="error in errors.reservation_date">
	                        	{{ error }}
	                        </span>
						</div>

						<div class="form-group col-lg-6">
							<label for="phone">Hora Reserva *</label>
							<vue-clock-picker v-model="reservation_time" input-class="form-control"></vue-clock-picker>
							<span class="text-danger" v-for="error in errors.reservation_time">
	                        	{{ error }}
	                        </span>
						</div>
					</div>

	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label for="phone">Telefono </label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="phone"
	                            id="phone" 
	                            v-model="phone"
	                            placeholder="4433610">
	                        <span class="text-danger" v-for="error in errors.phone">
	                        	{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                       <label for="movil">Movil *</label>
	                       <input 
	                            type="text" 
	                            class="form-control" 
	                            name="movil"
	                            id="movil" 
	                            v-model="movil"
	                            placeholder="3003454561">
	                        <span class="text-danger" v-for="error in errors.movil">
	                        	{{ error }}
	                        </span>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-6">
	                        <label for="email">Email</label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="email"
	                            id="email" 
	                            v-model="email"
	                            placeholder="avelasquez@gmail.com">
	                        <span class="text-danger" v-for="error in errors.email">
	                        	{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
							<label for="quantity">Cantidad Invitados</label>
							<input 
								id="quantity" 
								type="text" 
								class="form-control"
								value="" 
								name="quantity"
								>
							<span class="text-danger" v-for="error in errors.quantity">
	                        	{{ error }}
	                        </span>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-6">
	                        <label for="validity_end">Decoración</label>
	                        <div class="radio radio-info radio-inline">
	                            <input type="radio" id="inlineRadio1" value="true" name="decoration" v-model="decoration">
	                            <label for="inlineRadio1"> Si </label>
	                        </div>
	                        <div class="radio radio-inline">
	                            <input type="radio" id="inlineRadio2" value="false" name="decoration" v-model="decoration">
	                            <label for="inlineRadio2"> No </label>
	                        </div>

	                        <span class="text-danger" v-for="error in errors.sitemaPos">
	                            {{ error }}
	                        </span>
	                    </div>
	                </div>
	                <div>
	                    <button class="btn btn-primary m-t-n-xs" type="submit">
	                        <font-awesome-icon icon="check"></font-awesome-icon>
	                        <strong> Crear</strong>
	                    </button>
	                </div>
	            </div>
	        </div>
	    </form> 

	    <div class="m-t-md">
	        <p class="text-info">
	            Campos marcados con * son de caracter obligatorio.
	        </p>
	    </div>
	</div>
</template>

<script>
	
	import { uploadImageUserUrl, uploadImagePointPathUrl, uploadImageClientPathUrl, apiDomain } from './../config'
	import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
	import * as lang from "vuejs-datepicker/src/locale";

	export default {
		props: ['urlSave'],
		data: function (){
			return {
				/*defaultHour:new Date().getHours(),
           	 	defaultMinute:new Date().getMinutes(),*/
				language: "es",
  				languages: lang,
				uploadImageUserUrl,
				path: uploadImagePointPathUrl,
				path1: uploadImageClientPathUrl,
				picture: null,
				url: this.urlSave,
				client_selected: {},
				point_selected: {},
				phone: '',
				movil: '',
				email: '',
				decoration: true,
				quantity: 0,
				reservation_time: '',
				reservation_date: '',
				options: [],
				options1: [],
				errors: [],
			}
		},
		created(){

			//Cargo los puntos
            var url = apiDomain + 'points-sale/all-points'
            axios.get(url).
                then(response => {
                    if(response.status === 200){
                        this.options = response.data.data
                    }
                })

            //Cargo los clientes
           	var url = apiDomain + 'clients/all-clients'
            axios.get(url).
                then(response => {
                    if(response.status === 200){
                        this.options1 = response.data.data
                    }
                })
        },
		methods: {
			handleSubmit: function() {

				this.quantity = $('#quantity').val()
				
				axios.post(this.url, {

						picture: this.picture,
						client_id: (Object.entries(this.client_selected).length === 0)? null: this.client_selected.id,
						point_id: (Object.entries(this.point_selected).length === 0)? null: this.point_selected.id,
						phone: this.phone,
						movil: this.movil,
						email: this.email,
						decoration: this.decoration,
						quantity: this.quantity,
						reservation_time: this.reservation_time,
						reservation_date: this.reservation_date,

					}).then(response => {
						if(response.status === 200){
							
							this.picture = null;
							this.client_id = {};
							this.point_id = {};
							this.phone = '';
							this.movil = '';
							this.email = '';
							this.decoration = true;
							this.quantity = 0;
							this.reservation_time = '';
							this.reservation_date = '';
						
							this.errors = [];
							toastr.success('Nuevo Reservación creada con exíto');

							window.location.href = apiDomain + 'reservations'
						}
					}).catch(error => {
						this.errors = error.response.data.errors;
						var message = error.response.data.message;
						toastr.error(message);
					});
				
			},
			getPicture: function(imageData){
				//console.log(imageData)
        		this.picture = imageData
        	}
		}
	}
	
</script>

<style>

.picture-user{
	width: 100%;
	height:550px;
	display:flex;

	flex-direction:column;
	flex-wrap:nowrap;

	justify-content: center;
	align-items:center;
	align-content:center;
}

.dropdown li {
  border-bottom: 1px solid rgba(112, 128, 144, 0.1)
}

.dropdown li a {
  padding: 10px 20px;
  display: flex;
  width: 100%;
  align-items: center;
  font-size: 1.25em;
}

.dropdown li img {
    margin-top:15px;
}

</style>