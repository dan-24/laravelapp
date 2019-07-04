/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Vuetify from "vuetify";
import VueRouter from "vue-router";
import VeeValidate from "vee-validate";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VeeValidate);

import "vuetify/dist/vuetify.min.css";

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

Vue.component("Admin", require("./components/Admin.vue").default);
import Dashboard from "./pages/Dashboard";
import Permission from "./pages/Permission";
import User from "./pages/User";
import Roles from "./pages/Roles";
import Setting from "./pages/Setting";
import Kategori from "./pages/Kategori";
import Barang from "./pages/Barang";
import Suplier from "./pages/Suplier";
import Nota from "./pages/Nota";
import Penjualan from "./pages/Penjualan";
import Karyawan from "./pages/Karyawan";
import Jabatan from "./pages/Jabatan";
import Piket from "./pages/Piket";

const routes = [
    {
        path: "/admin/",
        component: Dashboard
    },
    {
        path: "/admin/users/",
        component: User
    },
    {
        path: "/admin/roles/",
        component: Roles
    },
    {
        path: "/admin/permission/",
        component: Permission
    },
    {
        path: "/admin/kategori/",
        component: Kategori
    },
    {
        path: "/admin/barang/",
        component: Barang
    },
    {
        path: "/admin/suplier/",
        component: Suplier
    },
    {
        path: "/admin/nota/",
        component: Nota
    },
    {
        path: "/admin/transaksi/",
        component: Penjualan
    },
    {
        path: "/admin/pegawai/",
        component: Karyawan
    },
    {
        path: "/admin/jabatan/",
        component: Jabatan
    },
    {
        path: "/admin/piket/",
        component: Piket
    },
    {
        path: "/admin/setting/",
        component: Setting
    }
];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: "#app"
});
