<template>
	<!-- Wrapper -->
	<div id="wrapper-table-point-sales">
	    <v-server-table
	    	:url="url"
	        :columns="columns"
	        :options="options"
            ref="reservationAdminVueTable">

	        <!--input slot="selected" slot-scope="props" type="checkbox" :checked="props.row.selected" v-model="checkedRows" :value="props.row"-->

	        <div slot="afterLimit" style="margin-top: 10px">
                <button type="submit" @click.prevent="createReservation" class="btn btn-primary">
                    <font-awesome-icon iconPrefix="fas" icon="plus-circle"></font-awesome-icon>
                    Crear
                </button>
            </div>


	        <span slot="actions" slot-scope="props"> 
	            <button v-on:click="deleteReservation(props.row.id, props.row)" class="btn btn-danger">
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
                columns: ['description', 'reservation_date', 'reservation_time', 'phone', 'movil', 'email', 'decoration', 'quantity', 'actions' ],
                options: {
                    headings: {
                        //id: 'ID',
                        description: 'Reservación',
                        reservation_date: 'Fecha',
                        reservation_time: 'Hora',
                        movil: 'movil',
                        phone: 'Telefono',
                        email: 'Email',
                        decoration: 'Decoración',
                        quantity: 'No Personas',
                        actions: 'Actions'
                    },
                    sortable: ['email'],
                    filterable: ['email'],
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
            createReservation: function() {
                //Ir a crear usuario
                window.location.href = apiDomain + 'reservations/create'
            },
            deleteReservation: function(id, row){
                
                var url = apiDomain + 'reservations/' + id

                this.$swal({
                    title: 'Estas seguro que deseas borrar la reservación: ' + row.description + '?',
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

                                    this.$refs.reservationAdminVueTable.refresh()
                                }
                            })
                    }
                })
            },
            createPdf(){
                //do whatever you want with your this.checkedRows
            }  
        }
	}
</script>