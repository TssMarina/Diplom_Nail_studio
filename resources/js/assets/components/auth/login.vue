<template>
    <div class="container-fluid background-login align-middle">
        <div class="row text-center mx-0 mt-5">
            <div class="col-4 offset-4 mt-5">
                <div class="login-form py-2">
                    <h4 class="login-header mt-3">АВТОРИЗАЦИЯ</h4>
                    <div class="form-item d-flex justify-content-center">
                        <input class="form-control form-input" type="email"  id="email2" name="email" placeholder="email" v-model="email">
                    </div>
                    <div class="form-item d-flex justify-content-center">
                        <input class="form-control form-input" type="password" name="password" placeholder="пароль" v-model="password">
                    </div>
                    <div class="form-item d-flex justify-content-center pt-2">
                        <button class="btn form-button" v-on:click="login">авторизоваться</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>




<script>
import axios from "axios";
    export default {
        data() {
            return {
                email: "",
                password: ""
            }
        },
        methods: {
            login(){
                axios.post('/api/login', this.$data
                ).then((data)=>{
                    window.location.replace('/admin')
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
