<template>
	<!-- Wrapper -->
	<div id="wrapper-table-user">
	    <v-server-table
	    	:url="url"
	        :columns="columns"
	        :options="options"
            ref="userAdminVueTable">

	        <!--input slot="selected" slot-scope="props" type="checkbox" :checked="props.row.selected" v-model="checkedRows" :value="props.row"-->

	        <div slot="afterLimit" style="margin-top: 10px">
	            <button type="submit" @click.prevent="createUser" class="btn btn-primary">
                    <font-awesome-icon iconPrefix="fas" icon="plus-circle"></font-awesome-icon>
                    Crear
                </button>
	        </div>

	        <span slot="actions" slot-scope="props"> 
                <button v-on:click="viewUser(props.row.id, props.row)" class="btn btn-success">
                    <font-awesome-icon iconPrefix="fas" icon="eye"></font-awesome-icon>
                    Ver
                </button>
	            <button v-on:click="editUser(props.row.id, props.row)" class="btn btn-info">
                    <font-awesome-icon iconPrefix="fas" icon="paste"></font-awesome-icon>
                    Editar
                </button>
	            <button v-on:click="deleteUser(props.row.id, props.row)" class="btn btn-danger">
                    <font-awesome-icon iconPrefix="fas" icon="trash"></font-awesome-icon>
                    Eliminar
                </button>
	        </span>
	    </v-server-table>
	</div>
</template>

<script>
    import { apiDomain } from './../config'

	export default {
		props: ['urlList'],
		data(){
			return {
				url: this.urlList,
                checkedRows:[], 
                columns: ['username', 'email', 'first_name', 'last_name', 'actions' ],
                options: {
                    headings: {
                        //id: 'ID',
                        username: 'Usuario',
                        email: 'Email',
                        first_name: 'Nombre(s)',
                        last_name: 'Apellidos(s)',
                        actions: 'Actions'
                    },
                    sortable: ['username'],
                    filterable: ['username'],
                    requestFunction: function (data) {
                        
                        return axios.get(this.url,{
	                            params: data
	                        }).catch(function (e) {
	                            this.dispatch('error', e);
	                        }.bind(this));

                    },
                    responseAdapter: function(resp) {
                        var data = this.getResponseData(resp);
                        
                        return {
                            data: data.data,
                            count: data.count
                        }
                    }

                    //function(resp) { var data = this.getResponseData(resp); return { data: data.data, count: data.count } }
                }
			}
		},
        created(){
            console.log('entorno' + process.env.NODE_ENV)
        },
		methods: {
            viewUser: function(id, row) {
                var user = id
                window.location.href = apiDomain + 'users/' + user
            },
            editUser: function(id, row){

                window.location.href = apiDomain + 'users/' + id + '/edit'

            },
            deleteUser: function (id, row){

                var url = apiDomain + 'users/' + id

                this.$swal({
                    title: 'Estas seguro que deseas borrar el usuario: ' + row.username + '?',
                    text: "No podrás revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrarlo!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(url, {id: id})
                            .then(response => {
                                if(response.status === 200){

                                    this.$swal(
                                      'Eliminado!',
                                      'Your file has been deleted.',
                                      'success'
                                    )

                                    this.$refs.userAdminVueTable.refresh()
                                }
                            })
                    }
                })

            },
            createUser: function (){
                //Ir a crear usuario
                window.location.href = apiDomain + 'users/create'
            }  
        }
	}
</script>