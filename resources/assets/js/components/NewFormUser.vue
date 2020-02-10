<template>
	<!-- Wrapper -->
	<div id="wrapper-new-form-user">
		<form name="newFormUser" method="POST" id="newFormUser" v-on:submit.prevent="handleSubmit">
	        <div class="row">
	            <div class="col-lg-4">
	                <!--i class="pe-7s-user fa-5x text-muted">text-center </i-->
	                <div class="picture-user">
	              		<file-field @sendPicture="getPicture" :url="uploadImageUserUrl" ></file-field>
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
	                            v-model="email"
	                            placeholder="avelasquez@gmail.com">
	                        <span class="text-danger" v-for="error in errors.email">
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
	                        <label for="password">Password</label>
	                        <input 
	                            type="password" 
	                            class="form-control" 
	                            name="password"
	                            id="password" 
	                            v-model="password"
	                            placeholder="******">
	                        <span class="text-danger" v-for="error in errors.password">
                        		{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label for="password-confirm">Confirm Password</label>
	                        <input 
	                            type="password" 
	                            class="form-control" 
	                            name="password-confirm"
	                            id="password-confirm" 
	                            v-model="password_confirm"
	                            placeholder="******">
	                        <span class="text-danger" v-for="error in errors.password_confirm">
                        		{{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                    	<label for="profile">Perfil</label>
	                    	<select 
                            	class="form-control m-b" 
                            	name="profile"
                            	v-model="profile">
		                        <option value="manager">Administrador Punto</option>
		                        <option value="waiter">Mesero</option>
		                    </select>
		                    <span class="text-danger" v-for="error in errors.profile">
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
	import { uploadImageUserUrl, apiDomain } from './../config'

	export default {
		props: ['urlSave'],
		data: function (){
			return {
				uploadImageUserUrl,
				picture: null,
				url: this.urlSave,
				username: '',
				email: '',
				password: '',
				password_confirm: '',
				first_name: '',
				last_name: '',
				profile: '',
				errors: [],
			}
		},
		methods: {
			handleSubmit: function() {

				//axios.post('http://192.168.10.10:8000/users', {
				axios.post(this.url, {
						picture: this.picture,
						username: this.username,
						email: this.email,
						password: this.password,
						password_confirm: this.password_confirm,
						first_name: this.first_name,
						last_name: this.last_name,
						profile: this.profile,
					}).then(response => {
						if(response.status === 200){
							this.picture = null;
							this.username = '';
							this.email = '';
							this.password = '';
							this.password_confirm = '';
							this.first_name = '';
							this.last_name = '';
							this.profile = '';
							this.errors = [];
							
							toastr.success('Nuevo usuario creado con exíto');

							//Ir a lista de usuarios
							window.location.href = apiDomain + 'users'
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