/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
import VueSweetalert2 from "vue-sweetalert2";
import routers from "./router.js";

import Vue from "vue";
import VueMeta from "vue-meta";
import AutoComplete from "@trevoreyre/autocomplete-vue";
import "sweetalert2/dist/sweetalert2.min.css";

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
axios.defaults.headers["Authorization"] = window.Token;
// axios.defaults.headers['Access-Control-Allow-Origin']="http://127.0.0.1:8000";
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);
Vue.use(VueMeta, {})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const router = new VueRouter(routers);
const app = new Vue({
    el: "#app",
    router: router,
    metaInfo: {
        title: "Satgas Covid-19 Masyarakat Buddhist Banten",
        meta: [
            { charset: "utf-8" },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1, shrink-to-fit=no"
            },
            { name: "csrf-token", content: `${window.Token}` }
        ]
    },
    mounted: function() {
        $(".btn-login").on("click", () => {
            this.$swal({
                title: "Login User",
                html: ` <div class="container-fluid">
                    <div class="p-3 d-flex flex-column justify-content-between">
                            <div class="form-group ">
                                <input type="text" class="form-control form-control-user"
                                    id="formUsername" aria-describedby="emailHelp"
                                    name="Username"
                                    placeholder="Enter Username">
                            </div>
                            <div class="form-group ">
                                <input type="password" name="Password" class="form-control form-control-user"
                                    id="formPassword" placeholder="Password">
                            </div>
                       
                    </div>
            </div>`,
                showConfirmButton: true,
                confirmButtonText: "Login",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const Username = $("#formUsername").val();
                    const Password = $("#formPassword").val();

                    return axios
                        .post("/login", {
                            Username,
                            Password,
                            _token: window.Token
                        })
                        .then(res => {
                            return { route: res.data.route };
                        })
                        .catch(err => {
                            this.$swal.showValidationMessage(
                                "Username atau Password Salah"
                            );
                        });
                }
            })
                .then(res => {
                    if (res.isConfirmed) {
                        const route=res.value.route;
                        this.$router.replace({path:route}).then(()=>{
                            this.$router.go(0)
                        });
                    }
                })
                .catch(err => {});
        });
    }
});
