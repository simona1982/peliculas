<template>
	<!-- Wrapper -->
	<div id="wrapper-table-point-sales">
	    <v-server-table
	    	:url="url"
	        :columns="columns"
	        :options="options"
            ref="clientAdminVueTable">


	        <div slot="afterLimit" style="margin-top: 10px">
                <button type="submit" @click.prevent="createClient" class="btn btn-primary">
                    <font-awesome-icon iconPrefix="fas" icon="plus-circle"></font-awesome-icon>
                    Crear
                </button>
            </div>

	        <span slot="actions" slot-scope="props"> 
                <button v-on:click="viewClient(props.row.id, props.row)" class="btn btn-success">
                    <font-awesome-icon iconPrefix="fas" icon="eye"></font-awesome-icon>
                    Ver
                </button>
                <button v-on:click="editClient(props.row.id, props.row)" class="btn btn-info">
                    <font-awesome-icon iconPrefix="fas" icon="paste"></font-awesome-icon>
                    Editar
                </button>
	            <button v-on:click="deleteClient(props.row.id, props.row)" class="btn btn-danger">
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
                columns: ['type_identification', 'identification', 'first_name', 'last_name', 'phone_number', 'phone_movil', 'email', 'birthday', 'actions' ],
                options: {
                    headings: {
                        //id: 'ID',
                        type_identification: 'Tipo Iden.',
                        identification: 'Identificación',
                        first_name: 'Nombre(s)',
                        last_name: 'Apellidos',
                        phone_number: 'Telefono',
                        phone_movil: 'Movil',
                        email: 'Email',
                        birthday: 'Cumpleaños',
                        actions: 'Actions'
                    },
                    sortable: ['first_name', 'last_name'],
                    filterable: ['first_name', 'last_name'],
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
		methods: {
            viewClient: function(id, row){
                var client = id
                window.location.href = apiDomain + 'clients/' + client
            },
            deleteClient: function(id, row) {

                var url = apiDomain + 'clients/' + id

                this.$swal({
                    title: 'Estas seguro que deseas borrar el cliente: ' + row.first_name + ' ' + row.last_name + '?',
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

                                    this.$refs.clientAdminVueTable.refresh()
                                }
                            })
                    }
                })
            },
            editClient: function(id, row){
                window.location.href = apiDomain + 'clients/' + id + '/edit'
            },
            createClient: function() {
                //Ir a crear usuario
                window.location.href = apiDomain + 'clients/create'
            }
        }
	}
</script>