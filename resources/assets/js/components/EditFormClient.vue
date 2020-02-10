<template>
	<!-- Wrapper -->
	<div id="wrapper-edit-form-client">
		<form name="editFormClient" method="POST" id="editFormClient" v-on:submit.prevent="handleSubmit">
	        <div class="row">

	            <div class="col-lg-4">
	                <div class="picture-user">
	              		<file-field @sendPicture="getPicture" :url="urlClient" ></file-field>
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
	                        <strong> Actualizar</strong>
	                    </button>

	                    <button class="btn btn-default m-t-n-xs" v-on:click.prevent="goToListClient">
	                    	<font-awesome-icon iconPrefix="fas" icon="times"></font-awesome-icon>
	                    	<strong> Cancelar </strong>
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
	
	import { apiDomain } from './../config.js';

	import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
	import * as lang from "vuejs-datepicker/src/locale";

	export default {
		props: ['urlSave', 'urlClient', 'id'],
		data(){
			return{
				language: "es",
  				languages: lang,
				url: this.urlSave,
				picture: null,
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
		created(){

			//users/{id}/get-user
			var url = apiDomain + 'clients/' + this.id + '/get-client'

			//usuario
			axios.get(url).
				then(response => {
					if(response.status === 200){
						var data = response.data.data
						console.log(data)

						this.type_identification = data.type_identification;
						this.identification 	 = data.identification;
						this.first_name 		 = data.first_name;
						this.last_name 			 = data.last_name;
						this.phone_number 		 = data.phone_number;
						this.phone_movil 		 = data.phone_movil;
						this.email 		 		 = data.email;
						this.birthday 		     = data.birthday;

					}
				})
		},
		methods: {
			getPicture: function(imageData){
        		this.picture = imageData
        	},
        	handleSubmit: function (){

        		//Actualiza el cliente
        		axios.put(this.url, {
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
							
							this.errors = [];

							this.$swal(
                              'Actualizado!',
                              'Your file has been deleted.',
                              'success'
                            )
							
							toastr.success('Cliente actualizado exíto');

							//Ir a lista de usuarios
							//window.location.href = apiDomain + 'users'
						}
					}).catch(error => {
						this.errors = error.response.data.errors;
						var message = error.response.data.message;
						toastr.error(message);
					});
        	},
        	goToListClient: function() {
        		window.location.href = apiDomain + 'clients'
        	}
		}
	}
</script>