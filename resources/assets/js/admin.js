/**
 * Created by kutas on 05.03.17.
 */
require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('shipping-types', require('./components/admin/ShippingTypes.vue'));
Vue.component('payment-types', require('./components/admin/PaymentTypes.vue'));
Vue.component('order-statuses', require('./components/admin/OrderStatuses.vue'));
Vue.component('orders', require('./components/admin/Orders.vue'));

Vue.component('product-edit', require('./components/admin/Products/ProductEdit.vue'));
Vue.component('products', require('./components/admin/Products/Products.vue'));

Vue.component('factory-edit', require('./components/admin/Factories/FactoryEdit.vue'));
Vue.component('factories', require('./components/admin/Factories/Factories.vue'));

Vue.component('modificators', require('./components/admin/Modifcators/Modificators.vue'));

const admin = new Vue({
    el: '#admin'
});
