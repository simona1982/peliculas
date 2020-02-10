<template>
	<!-- Wrapper -->
	<div id="wrapper-new-form-client">
		<form name="newFormClient" method="POST" id="newFormClient" v-on:submit.prevent="handleSubmit">
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
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label for="type_identification">Tipo de Documento</label>
	                        <select 
                            	class="form-control m-b" 
                            	name="type_identification"
                            	v-model="type_identification">
		                        <option value="cc">Cédula de Ciudadanía</option>
		                        <option value="ce">Cédula de Extranjería</option>
		                        <option value="passport">Pasaporte</option>
		                        <option value="nit">NIT</option>
		                    </select>
	                        <span class="text-danger" v-for="error in errors.type_identification">
	                        	{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                       	<label for="identification">No Identificación</label>
                            <input 
                            	type="text" 
                            	class="form-control" 
                            	placeholder="14590849" 
                            	id="identification"
                            	name="identification"
                            	v-model="identification">
	                        <span class="text-danger" v-for="error in errors.identification">
	                        	{{ error }}
	                        </span>
	                    </div>
	                </div>
	                <div class="row">
						<div class="form-group col-lg-6">
	                        <label for="first_name">Nombre(s) *</label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="first_name"
	                            id="first_name" 
	                            v-model="first_name"
	                            placeholder="Andres">
                            <span class="text-danger" v-for="error in errors.first_name">
                        		{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                       <label for="last_name">Apellido(s) *</label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="last_name"
	                            id="last_name" 
	                            v-model="last_name"
	                            placeholder="Velasquez Delgado">
	                        <span class="text-danger" v-for="error in errors.last_name">
                        		{{ error }}
	                        </span>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-6">
	                        <label for="phone_number">Teléfono de Casa</label>
                            <input 
                            	type="text"
                            	class="form-control" 
                            	placeholder="4433610" 
                            	id="phone_number"
                            	name="phone_number"
                            	v-model="phone_number">
	                        <span class="text-danger" v-for="error in errors.phone_number">
                        		{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label for="phone_movil">Móvil</label>
                            <input 
                            	type="text"
                            	class="form-control" 
                            	placeholder="3126674648" 
                            	id="phone_movil"
                            	name="phone_movil"
                            	v-model="phone_movil">
	                        <span class="text-danger" v-for="error in errors.phone_movil">
                        		{{ error }}
	                        </span>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-6">
	                        <label for="email">Email Address</label>
                            <input 
                            	type="email"
                            	class="form-control" 
                            	placeholder="panda.velasquez.1982@gmail.com" 
                            	id="email"
                            	name="email"
                            	v-model="email">
	                        <span class="text-danger" v-for="error in errors.email">
                        		{{ error }}
	                        </span>
	                    </div>

	                    <div class="form-group col-lg-6">
							<label for="email">Fecha Cumpleaños</label>
							<datepicker placeholder="Select Date" 
								:full-month-name="true"
								:bootstrap-styling="true"
								:clear-button="true"
								input-class="form-control"
								:language="languages[language]"
								format="d MMMM yyyy"
								v-model="birthday"
								>
							</datepicker>
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
	
	import { uploadImageUserUrl, apiDomain } from './../config'
	import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
	import * as lang from "vuejs-datepicker/src/locale";

	export default {
		props: ['urlSave'],
		components: {
		    Datepicker
		},
		data: function (){
			return {
				language: "es",
  				languages: lang,
				uploadImageUserUrl,
				picture: null,
				url: this.urlSave,
				type_identification: 'cc',
				identification: '',
				first_name: '',
				last_name: '',
				phone_number: '',
				phone_movil: '',
				email: '',
				birthday: new Date(),
				errors: [],
			}
		},
		methods: {
			handleSubmit: function() {

				console.log(moment(this.birthday).format("YYYY-MM-DD"))

				axios.post(this.url, {

						picture: this.picture,
						type_identification: this.type_identification,
						identification: this.identification,
						first_name: this.first_name,
						last_name: this.last_name,
						phone_number: this.phone_number,
						phone_movil: this.phone_movil,
						email: this.email,
						birthday: this.birthday,

					}).then(response => {
						if(response.status === 200){
							
							this.picture = null;
							this.type_identification = 'cc';
							this.identification = '';
							this.first_name = '';
							this.last_name = '';
							this.phone_number = '';
							this.phone_movil = '';
							this.email = '';
							this.birthday = new Date();

							this.errors = [];
							
							toastr.success('Nuevo Cliente creado con exíto');

							//Ir a lista de usuarios
							window.location.href = apiDomain + 'clients'
						}
					}).catch(error => {
						this.errors = error.response.data.errors;
						var message = error.response.data.message;
						toastr.error(message);
					});
				
			},
			getPicture: function(imageData){
        		this.picture = imageData
        	},
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
</style>