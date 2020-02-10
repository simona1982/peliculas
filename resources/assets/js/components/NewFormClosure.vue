<template>
	<!-- Wrapper -->
	<div id="wrapper-new-form-closure">
		<form name="newFormClosure" method="POST" id="newFormClient" v-on:submit.prevent="handleSubmit">
			<div class="row">
	            <div class="col-lg-6" style="background-color:'blue';">
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label for="type_identification">Informe de Venta diario del</label>
	                        <datepicker placeholder="Select Date" 
								:full-month-name="true"
								:bootstrap-styling="true"
								:clear-button="true"
								input-class="form-control"
								:language="languages[language]"
								format="d MMMM yyyy"
								v-model="date_closure"
								>
							</datepicker>
						</div>
	                </div>
	            </div>
	        </div>
		</form>
	</div>
</template>

<script>
	import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
	import * as lang from "vuejs-datepicker/src/locale";

	export default {
		components: {
		    Datepicker
		},
		data(){
			return{
				language: "es",
  				languages: lang,
  				date_closure: ''
			}
		},
		methods: {
			handleSubmit: function() {

			}
		}
	}
</script>