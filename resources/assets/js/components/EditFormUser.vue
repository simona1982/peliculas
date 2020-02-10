<template>
	<!-- Wrapper -->
	<div id="wrapper-edit-form-user">
		<form name="editFormUser" method="POST" id="editFormUser" v-on:submit.prevent="handleSubmit">
	        <div class="row">

	            <div class="col-lg-4">
	                <div class="picture-user">
	              		<file-field @sendPicture="getPicture" :url="urlUser" ></file-field>
	                </div>
	            </div>

	            <div class="col-lg-8">
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label for="username">username *</label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="username"
	                            id="username" 
	                            v-model="username"
	                            placeholder="avelasquez">
	                        <span class="text-danger" v-for="error in errors.username">
	                        	{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                       <label for="email">email *</label>
	                       <input 
	                            type="text" 
	                            class="form-control" 
	                            name="email"
	                            id="email" 
	                            placeholder="avelasquez@gmail.com"
	                            disabled>
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
	                        <label for="password">Password</label>
	                        <input 
	                            type="password" 
	                            class="form-control" 
	                            name="password"
	                            id="password" 
	                            placeholder="******"
	                            disabled>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label for="password-confirm">Confirm Password</label>
	                        <input 
	                            type="password" 
	                            class="form-control" 
	                            name="password-confirm"
	                            id="password-confirm" 
	                            placeholder="******"
	                            disabled>
	                    </div>
	                    <div class="form-group col-lg-6">
	                    	<label for="profile">Perfil</label>
	                    	<select 
                            	class="form-control m-b" 
                            	name="profile"
                            	v-model="profile"
                            	disabled>
		                        <option value="manager">Administrador Punto</option>
		                        <option value="waiter">Mesero</option>
		                    </select>
	                    </div> 	
	                </div>	
	                <div>
	                    <button class="btn btn-primary m-t-n-xs" type="submit">
	                        <font-awesome-icon icon="check"></font-awesome-icon>
	                        <strong>Actualizar</strong>
	                    </button>

	                    <button class="btn btn-default m-t-n-xs" v-on:click.prevent="goToListUser">
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

	export default {
		props: ['urlSave', 'urlUser', 'id'],
		data(){
			return{
				url: this.urlSave,
				picture: null,
				username: '',
				first_name: '',
				last_name: '',
				profile: null,
				errors: [],
			}
		},
		created(){

			//users/{id}/get-user
			var url = apiDomain + 'users/' + this.id + '/get-user'

			//usuario
			axios.get(url).
				then(response => {
					if(response.status === 200){
						var data = response.data.data
						console.log(data)

						this.username = data.username;
						this.email = data.email;
						this.first_name = data.first_name;
						this.last_name = data.last_name;
						this.profile = data.profile;

						//this.uploadImageUserUrl = apiDomain + 'image-user/' + data.picture
						//console.log(this.uploadImageUserUrl)
					}
				})
		},
		methods: {
			getPicture: function(imageData){
        		this.picture = imageData
        	},
        	handleSubmit: function (){

        		//Actualiza el usuario
        		axios.put(this.url, {
						picture: this.picture,
						username: this.username,
						first_name: this.first_name,
						last_name: this.last_name,
					}).then(response => {
						if(response.status === 200){
							
							this.errors = [];

							this.$swal(
                              'Actualizado!',
                              'Your file has been deleted.',
                              'success'
                            )
							
							toastr.success('Nuevo usuario actualizado exíto');

							//Ir a lista de usuarios
							//window.location.href = apiDomain + 'users'
						}
					}).catch(error => {
						this.errors = error.response.data.errors;
						var message = error.response.data.message;
						toastr.error(message);
					});
        	},
        	goToListUser: function() {
        		window.location.href = apiDomain + 'users'
        	}
		}
	}
</script>