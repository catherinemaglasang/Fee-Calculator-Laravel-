<div class="alert alert-info" v-if="missing" v-transition="expand">
	Items mark with * are required please fill them accordingly.
</div>
<div class="alert alert-danger" v-if="vin_error" v-transition="expand">
	@{{ server_error }}
</div>
<div class="alert alert-info" v-if="address" v-transition="expand">
	Street Address and Zip should be validated.
</div>
<div class="loading" v-if="loading" v-transition="expand"></div>