<template>
	<div class="file-field-wrapper">
		
		<img v-bind:src="imagePreview" class="preview-image" v-on:click="openUpload">

		<input type="file" name="image" id="file-field" v-on:change="updatePreview" style="display: none">

	</div>
</template>

<script>
	
	

	export default {
		props: ['url'],
		data(){
			return {
				imagePreview: this.url
			}
		},
		methods: {
			openUpload: function() {
				document.getElementById('file-field').click()
			},
			updatePreview: function(e) {
				var reader, files = e.target.files

				if(files.length === 0){
					console.log('empty');
				}

				reader = new FileReader()

				reader.onload = (e) => {
					this.imagePreview = e.target.result
					this.$emit('sendPicture', e.target.result)
				}

				reader.readAsDataURL(files[0])
			}
		}
	}

</script>

<style>
	.preview-image{
		width: 350px;
		height: 350px;
	}
</style>