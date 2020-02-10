<template>
<div class="wrapper-upload-closure">
	
	<form class="form-horizontal" v-on:submit.prevent="handleSubmit" enctype="multipart/form-data">
		
        <div class="form-group">
            <label class="col-sm-4 control-label">Fecha del Cierre *</label>
            <div class="col-sm-8">
	            <datepicker placeholder="Select Date" 
	                :full-month-name="true"
	                :bootstrap-styling="true"
	                :clear-button="true"
	                input-class="form-control"
	                :language="languages[language]"
	                format="d MMMM yyyy"
	                v-model="date_closure"
	                ></datepicker>
	        </div>
        </div>
        <div class="form-group">
			<label class="col-sm-4 control-label">Archivo (txt)</label>
			<div class="col-sm-8">
				<input type="file" class="form-control" name="file-closure" id="file-closure">
				<!--input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
					<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label-->
			</div>
        </div>
        <div class="hr-line-dashed"></div>
  
	    <button type="submit" class="dropdown-toggle btn btn-primary btn-block">
	        <font-awesome-icon icoPrefix="['fas']" icon="check"></font-awesome-icon>
	        Enviar
	    </button>

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
			return {
				language: "es",
  				languages: lang,
  				date_closure: '',
			}
		},
		methods: {
			handleSubmit: function() {
				alert('hola')
			}
		}
	}

</script>

<!--style>
.js .inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    max-width: 80%;
    font-size: 1.25rem;
    /* 20px */
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
    /* 10px 20px */
}

.no-js .inputfile + label {
    display: none;
}

.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
}

.inputfile + label * {
    /* pointer-events: none; */
    /* in case of FastClick lib use */
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    /* 4px */
    margin-right: 0.25em;
    /* 4px */
}



/* style 1 */

.inputfile-1 + label {
    color: #f1e5e6;
    background-color: #d3394c;
}

.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover {
    background-color: #722040;
}
</style-->