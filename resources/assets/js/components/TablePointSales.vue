<template>
	<!-- Wrapper -->
	<div id="wrapper-table-point-sales">
	    <v-server-table
	    	:url="url"
	        :columns="columns"
	        :options="options"
            ref="pointsAdminVueTable">

	        <div slot="afterLimit" style="margin-top: 10px">
                <button type="submit" @click.prevent="createUser" class="btn btn-primary">
                    <font-awesome-icon iconPrefix="fas" icon="plus-circle"></font-awesome-icon>
                    Crear
                </button>
            </div>


	        <span slot="actions" slot-scope="props"> 
	            <button v-on:click="viewPoint(props.row.id, props.row)" class="btn btn-success">
                    <font-awesome-icon iconPrefix="fas" icon="eye"></font-awesome-icon>
                    Ver
                </button>
                <button v-on:click="editPoint(props.row.id, props.row)" class="btn btn-info">
                    <font-awesome-icon iconPrefix="fas" icon="paste"></font-awesome-icon>
                    Editar
                </button>
	            <button v-on:click="deletePoint(props.row.id, props.row)" class="btn btn-danger">
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
                columns: ['name', 'sistemaPos', 'location', 'actions' ],
                options: {
                    headings: {
                        //id: 'ID',
                        name: 'Nombre',
                        sistemaPos: 'Sistema Pos',
                        location: 'Ubicación',
                        actions: 'Actions'
                    },
                    sortable: ['name'],
                    filterable: ['name'],
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
            viewPoint: function(id, row) {
                var points_sale = id
                window.location.href = apiDomain + 'points-sale/' + points_sale
            },
            createUser: function() {
                //Ir a crear punto de venta
                window.location.href = apiDomain + 'points-sale/create'
            },
            editPoint: function(id, row){
                window.location.href = apiDomain + 'points-sale/' + id + '/edit'
            },
            deletePoint(id, row){
                var url = apiDomain + 'points-sale/' + id

                this.$swal({
                    title: 'Estas seguro que deseas borrar el punto: ' + row.name + '?',
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

                                    this.$refs.pointsAdminVueTable.refresh()
                                }
                            })
                    }
                })
            }  
        }
	}
</script>