<template>
<!-- Wrapper -->
<div id="wrapper-new-form-point-sale">
    <form name="newFormPointSale" method="POST" id="newFormPointSale" v-on:submit.prevent="handleSubmit">
        <div class="row">
            <div class="col-lg-4">
                <div class="picture-user">
                    <file-field @sendPicture="getPicture" :url="uploadImageUserUrl" ></file-field>
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
    import { apiDomain, uploadImageUserPathUrl, uploadImageUserUrl } from './../config';

    export default {
        props: ['urlSave'],
        data: function () {
            return {
                uploadImageUserUrl,
                path: uploadImageUserPathUrl,
                url: this.urlSave,
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

            var url = apiDomain + 'users/all-users'

            axios.get(url).
                then(response => {
                    if(response.status === 200){

                        this.options = response.data.data
                    }
                })
        },
        methods: {
            handleSubmit: function() {

                axios.post(this.url, {
                        picture: this.picture,
                        name: this.name,
                        user_id: (Object.entries(this.user_selected).length === 0)? null: this.user_selected.id,
                        sistemaPos: this.sistemaPos,
                        location: this.location,
                    
                    }).then(response => {
                        if(response.status === 200){
                            this.picture = null,
                            this.name = '';
                            this.user_selected = {};
                            this.sistemaPos = true;
                            this.location = '';
                            this.errors = [];
                            
                            toastr.success('Nuevo punto de venta creado con exíto');

                            //Ir a lista de puntos
                            window.location.href = apiDomain + 'points-sale'
                        }
                    }).catch(error => {
                        this.errors = error.response.data.errors;
                        var message = error.response.data.message;
                        toastr.error(message);
                    });
                
            },
            getPicture: function(imageData){
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