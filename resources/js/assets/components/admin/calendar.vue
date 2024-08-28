<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 v-text="this.error" class="text-danger text-center"></h1>
                <table class="table table-secondary">
                    <thead>
                    <tr>
                        <th scope="col-3"  class="admin-table-header">Дата</th>
                        <th scope="col-4"  class="admin-table-header">Время</th>
                        <th scope="col-3"  class="admin-table-header">Мастер</th>
                        <th scope="col-2"  class="admin-table-header">
                            <button class="btn" v-on:click="addNew()" >
                                <i class="fa-solid fa-circle-plus favour_add_button"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-if="isEdit === true">
                            <td class="col-3">
                                <input class="form-control" v-model="this.edited.date" type="date"/>
                            </td>
                            <td class="col-4">
                                <div v-for="n in this.count" :key="n" class="d-inline-flex">
                                    <select class="form-select form-control mb-2 " v-model="this.hour[n]">
                                        <option v-for="h in 15" :key="h" :value="h+7" v-text="h+7"></option>
                                    </select>
                                    <select class="form-select form-control me-3 mb-2" v-model="this.minute[n]">
<!--                                        <option v-for="m in 6" :key="m" :value="(m-1)*10" v-text="(m-1)*10"></option>-->
                                        <option value="00" key="00">00</option>
                                        <option value="30" key="30">30</option>
                                    </select>
                                </div>
                                <button class="btn" v-on:click="this.count++">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                            <td class="col-3">
                                <select class="form-select" v-model="this.edited.master">
                                    <option v-for="master in this.masters" :value="master.id" v-text="master.firstname + ' ' + master.lastname"></option>
                                </select>
                            </td>
                            <td class="favour-table-data text-center py-3 pt-2">
                                <button class="btn" v-on:click="cancel()">
                                    <i class="fa-solid fa-xmark favour_add_button"></i>
                                </button>
                                <button class="btn" v-on:click="createNew()">
                                    <i class="fa-solid fa-check favour_add_button"></i>
                                </button>
                            </td>
                        </tr>
                        <tr v-for="calendar in this.calendars">
                            <td class="favour-table-data text-center py-3" v-text="calendar.date"/>

                            <td class="favour-table-data py-3">
                                <span v-for="time in calendar.time" class="mx-2">{{time}}</span>
                            </td>

                            <td class="favour-table-data text-center py-3" v-text="calendar.master"/>

                            <td class="favour-table-data text-center py-3">
                                <button class="btn" v-on:click="remove(calendar.id)">
                                    <i class="fa-solid fa-trash  favour_add_button"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data: function () {
        return {
            isEdit: false,
            calendars: null,
            masters: null,
            error: null,
            count: 1,
            hour: [],
            minute: [],
            edited: {
                date: "",
                master: "",
            },
        }
    },
    created () {
        this.load();
        axios.get('/api/admin/masters').then((data) => this.masters = data.data.masters);
    },
    methods: {
        remove (calendar_id) {
            axios.post(`/api/admin/calendar/delete/${calendar_id}`).then((data) =>
                this.load()
            );
        },
        addNew () {
            this.isEdit = true;
        },
        cancel () {
            this.error = null;
            this.edited = {
                date: "",
                master: "",
            };
            this.hour = [];
            this.minute = [];
            this.isEdit = false;
        },
        createNew () {
            let times = [];
            for (let i = 1; i <= this.hour.length-1; i++){
                times.push(
                    {
                        'time': this.hour[i]+':'+(this.minute[i] === 0 ? '00' : this.minute[i]),
                        'status': "free"
                    }
                );
            }
            let calendar = {
                date: this.edited.date,
                master: this.edited.master,
                time: times,
            }

            axios.post('/api/admin/calendar/create', calendar).then((data) => {
                this.isEdit = false;
                this.cancel();
                this.load();
            }).catch((error) => {
                this.error = error.response.data.message;
            });
        },
        load () {
            this.error = null;
            axios.get('/api/admin/calendar').then((data) => this.calendars = data.data.calendars);
        }
    }
}
</script>
