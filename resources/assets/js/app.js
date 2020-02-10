
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./vendor/jquery-flot/jquery.flot.js');
require('./vendor/jquery-flot/jquery.flot.resize.js');
require('./vendor/jquery-flot/jquery.flot.pie.js');
require('./vendor/flot.curvedlines/curvedLines.js');
require('./vendor/jquery.flot.spline/index.js');
require('./vendor/sparkline/index.js');
require('./vendor/peity/jquery.peity.min.js');
require('./vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js');
//require('./vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js');
//require('./vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');

require('./homer');
require('./charts');

/**
 * Import librarys
 */
//import Swal from 'sweetalert2'
// Import this component
import '@pencilpix/vue2-clock-picker/dist/vue2-clock-picker.min.css';
const VueClockPickerPlugin = require('@pencilpix/vue2-clock-picker/dist/vue2-clock-picker.plugin.js');

import Datepicker from 'vuejs-datepicker';
import VueSweetalert2 from 'vue-sweetalert2';
//import vSelect from 'vue-select';
import { library } from '@fortawesome/fontawesome-svg-core'
import {
	faCoffee, faBars, faChevronUp, faTimes, faStore, faCalendarPlus, faUserTie, faCheck, faChartLine,
	faPlus, faPlusCircle, faUser, faTrash, faPaste, faEye, faUndo, faFileInvoiceDollar, faArrowUp, faFolder, faFile,
	faFileUpload
} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { ServerTable, ClientTable, Event } from 'vue-tables-2'


library.add(
	faCoffee, faBars, faChevronUp, faTimes, faStore, faCalendarPlus, faUserTie, faCheck, faChartLine, faPlus,
	faPlusCircle, faUser, faTrash, faPaste, faEye, faUndo, faFileInvoiceDollar, faArrowUp, faFolder, faFile,
	faFileUpload);

window.Vue = require('vue');
window.moment = require('moment');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('login', require('./components/Login.vue'));
Vue.component('new-form-point-sale', require('./components/NewFormPointSale.vue'));
Vue.component('new-form-user', require('./components/NewFormUser.vue'));
Vue.component('edit-form-user', require('./components/EditFormUser.vue'));
Vue.component('edit-form-point', require('./components/EditFormPoint.vue'));
Vue.component('new-form-client', require('./components/NewFormClient.vue'));
Vue.component('edit-form-client', require('./components/EditFormClient.vue'));
Vue.component('new-form-reservation', require('./components/NewFormReservation.vue'));
Vue.component('new-form-closure', require('./components/NewFormClosure.vue'));
Vue.component('table-user', require('./components/TableUser.vue'));
Vue.component('table-closure', require('./components/TableClosure.vue'));
Vue.component('table-client', require('./components/TableClient.vue'));
Vue.component('table-point-sales', require('./components/TablePointSales.vue'));
Vue.component('table-reservation', require('./components/TableReservation.vue'));
Vue.component('file-field', require('./components/utility/FileField.vue'));
Vue.component('upload-closure', require('./components/UploadClosure.vue'));
//Vue.component('v-select', vSelect)
Vue.component('datepicker', Datepicker);
//Vue.component('vue-clock-picker', VueClockPicker);

Vue.use(ClientTable);
Vue.use(ServerTable);
Vue.use(VueSweetalert2);
Vue.use(VueClockPickerPlugin);
//Vue.use(VueClockPicker);


const app = new Vue({
	el: '#app'
});
