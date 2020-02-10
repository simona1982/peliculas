<template>
	<div id="wrapper-edit-form-point">
		<form name="editFormPoint" method="POST" id="editFormPoint" v-on:submit.prevent="handleSubmit">
	        <div class="row">

	            <div class="col-lg-4">
	                <div class="picture-user">
	              		<file-field @sendPicture="getPicture" :url="urlPoint" ></file-field>
	                </div>
	            </div>

	            <div class="col-lg-8">
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label for="title">Nombre *</label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="title"
	                            id="title" 
	                            v-model="name"
	                            placeholder="Punto Wings and Beer">
	                        <span class="text-danger" v-for="error in errors.name">
	                            {{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label for="user_selected">Responsable</label>
	                        <v-select v-model="user_selected" label="username" :options="options">
	                            <template slot="option" slot-scope="option">
	                                <img :src="path + option.picture" class="img-circle m-b" width="50px" height="50px">
	                                <strong>&nbsp; &nbsp;{{ option.username }}</strong>
	                            </template>
	                        </v-select>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label for="location">Ubicación</label>
	                        <input 
	                            type="text" 
	                            class="form-control" 
	                            name="location"
	                            id="location" 
	                            v-model="location"
	                            placeholder="Calle 43A #14-67 Barrio Chapinero">
	                        <span class="text-danger" v-for="error in errors.location">
	                            {{ error }}
	                        </span>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <p class="font-extra-bold">Tiene Sistema POS</p>

	                        <div class="radio radio-info radio-inline">
	                            <input type="radio" value="true" name="sitemaPos" v-model="sistemaPos">
	                            <label for="inlineRadio1"> Si </label>
	                        </div>

	                        <div class="radio radio-info radio-inline">
	                            <input type="radio" value="false" name="sitemaPos" v-model="sistemaPos">
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
	                        <strong> Actualizar</strong>
	                    </button>

	                    <button class="btn btn-default m-t-n-xs" v-on:click.prevent="goToListPoint">
	                    	<font-awesome-icon iconPrefix="fas" icon="times"></font-awesome-icon>
	                    	<strong> Cancelar </strong>
	                    </button>
	                </div>
	            </div>

	        </div>
	    </form>
	</div>
</template>

<script>
	import { apiDomain, uploadImageUserPathUrl } from './../config.js';

	export default {
		props: ['urlSave', 'urlPoint', 'id'],
		data(){
			return {
				url: this.urlSave,
				path: uploadImageUserPathUrl,
				picture: null,
                name: '',
                user_selected: {},
                sistemaPos: true,
                location: '',
                options: [],
                errors: [],
			}
		},
		created(){

			var url1 = apiDomain + 'users/all-users'

			//Usuarios
            axios.get(url1).
                then(response => {
                    if(response.status === 200){

                        this.options = response.data.data
                    }
                })

			//points-sale/{id}/get-user
			var url = apiDomain + 'points-sale/' + this.id + '/get-point'

			axios.get(url).
				then(response => {
					if(response.status === 200){
						var data = response.data.data
						console.log(data)

						this.name 			= data.name;
						this.sistemaPos 	= (data.sistemaPos === 0)? false: true;
						this.location 		= data.location;

						if(data.user_id !== null){
							this.user_selected.id 		= data.user.id;
							this.user_selected.username = data.user.username;
							this.user_selected.picture 	= data.user.picture;
						}else{
							this.user_selected = {};
						}
					}
				})
		},
		methods: {
			getPicture: function(imageData){
        		this.picture = imageData
        	},
        	handleSubmit: function() {

    			//Actualiza el punto de venta
    			
        		axios.put(this.url, {

						picture: this.picture,
                        name: this.name,
                        user_id: (Object.entries(this.user_selected).length === 0)? null: this.user_selected.id,
                        sistemaPos: this.sistemaPos,
                        location: this.location,

					}).then(response => {
						if(response.status === 200){
							
							this.errors = [];

							this.$swal(
                              'Actualizado!',
                              'Your file has been deleted.',
                              'success'
                            )
							
							toastr.success('Punto actualizado con exíto');

						}
					}).catch(error => {
						this.errors = error.response.data.errors;
						var message = error.response.data.message;
						toastr.error(message);
					});
        	},
        	goToListPoint: function() {
        		window.location.href = apiDomain + 'points-sale'
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
</style>