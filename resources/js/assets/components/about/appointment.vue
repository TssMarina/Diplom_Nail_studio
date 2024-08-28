<template>
    <div class="container-fluid ">
        <div class="row align-items-center">
            <div class="col-4 offset-2">
                <div class="appointment-form py-1">
                    <h1 class="form-header mt-3">
                        Запись
                    </h1>
                    <div class="">
                        <div class="form-item d-flex justify-content-center">
                            <select class="form-control form-input form-select" v-model="this.appointment.favour_id">
                                <option :value="null" disabled selected hidden>Выберите услугу</option>
                                <option v-for="favour in this.favours" :value="favour.id" v-text="favour.name"></option>
                            </select>
                        </div>
                        <div class="form-item d-flex justify-content-center">
                            <select class="form-control form-input form-select" v-model="this.appointment.master_id">
                                <option :value="null" disabled selected hidden>Выберите мастера</option>
                                <option v-for="master in this.masters" :value="master.id" v-text="master.lastname+' '+master.firstname"></option>
                            </select>
                        </div>
                        <div class="form-item d-flex justify-content-center">
                            <select class="form-control form-input form-select w-50 mx-4 ms-5" v-model="this.appointment.date" :disabled="!appointment.master_id">
                                <option :value="null"  disabled selected hidden>Дата</option>
                                <option v-for="calendar in this.calendars" v-text="calendar.date"></option>
                            </select>
                            <select class="form-control form-input form-select w-50 mx-4 me-5" v-model="this.appointment.time" :disabled="!appointment.date">
                                <option :value="null" disabled selected hidden>Время</option>
                                <option v-for="time in this.times" v-text="time"></option>
                            </select>
                        </div>
                        <div class="form-item d-flex justify-content-center">
                            <input type="text" class="form-input form-control" v-model="this.appointment.name" placeholder="ФИО">
                        </div>
                        <div class="form-item d-flex justify-content-center text-danger small" v-if="error.name" v-text="error.name"/>
                        <div class="form-item d-flex justify-content-center">
                            <input type="text" class="form-input form-control mask-phone"  v-model="this.appointment.phone" placeholder="Номер телефона">
                        </div>
                        <div class="form-item d-flex justify-content-center text-danger small" v-if="error.phone" v-text="error.phone"/>
                        <div class="form-item d-flex  justify-content-center">
                            <button class="btn form-button" v-on:click="save()">записаться</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 p-0  d-flex justify-content-end">
                <img class="appointment-image " src="\images\hands.png" alt="">
            </div>
        </div>
    </div>
</template>
<script>
    import axios from "axios";

    export default {
        data: function () {
            return {
                favours: null,
                masters: null,
                calendars: null,
                times: null,
                appointment: {
                    date: null,
                    time: null,
                    favour_id: null,
                    name: "",
                    phone: "",
                    master_id: null,
                    status: "",
                },
                error: {},
            }
        },
        created () {
            this.getCalendar(null)
            axios.get('/api/masters').then((data)=>this.masters = data.data.masters)
            axios.get('/api/favour').then((data)=>this.favours = data.data.favours)
        },
        methods: {
            getCalendar(params) {
                axios.get(`/api/calendar?master=${params}`).then((data) => this.calendars = data.data.calendars);
            },
            save() {
                this.error = {};
                axios.post(`/api/appointment/create`, this.appointment).then((data) => {
                    alert('Запись произведена успешно')
                    window.location.replace('/')
                }).catch((error) => {
                        // проверка на наличие ошибки и запись ее в переменной, выше под инпутами вывод ошибки
                        if (error.response.data.errors['phone']) {
                            this.error.phone = error.response.data.errors['phone'][0]
                        }
                        if (error.response.data.errors['name']) {
                            this.error.name = error.response.data.errors['name'][0]
                        }
                    });
            }
        },
        watch: {
            'appointment.date'() {
                if (this.appointment.date !== null) {
                    this.times = this.calendars[this.calendars.findIndex(item => item.date === this.appointment.date)].time;
                }
            },
            'appointment.master_id'() {
                this.appointment.date = null;
                this.appointment.time = null;
                this.times = [];
                this.getCalendar(this.appointment.master_id)
            }
        }
    }

</script>

<style>

</style>
