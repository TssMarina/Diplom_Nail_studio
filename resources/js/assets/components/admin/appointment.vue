<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-secondary">
                    <thead>
                    <tr>
                        <th scope="col"  class="admin-table-header">Дата время</th>
                        <th scope="col"  class="admin-table-header">Услуга</th>
                        <th scope="col"  class="admin-table-header">Фио</th>
                        <th scope="col"  class="admin-table-header">Телефон</th>
                        <th scope="col"  class="admin-table-header">Мастер</th>
                        <th scope="col"  class="admin-table-header">Статус</th>
                        <th scope="col"  class="admin-table-header">
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="appointment in this.appointments">
                        <td class="favour-table-data text-center py-3" v-text="appointment.datetime"  />

                        <td class="favour-table-data py-3" v-text="appointment.favour_name" />

                        <td class="favour-table-data text-center py-3" v-text="appointment.name"/>

                        <td class="favour-table-data text-center py-3" v-text="appointment.phone"/>

                        <td class="favour-table-data text-center py-3" v-text="appointment.master_name"/>

                        <td class="favour-table-data text-center py-3" v-text="appointment.status"/>

                        <td class="favour-table-data text-center py-3">
                            <button class="btn" v-on:click="setStatus('ACCEPTED', appointment.id)" :disabled="appointment.status==='ACCEPTED'">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="btn" v-on:click="setStatus('CANCEL', appointment.id)" :disabled="appointment.status==='CANCEL'">
                                <i class="fa-solid fa-xmark"></i>
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
            appointments: null,
        }
    },
    created () {
        this.load();
    },
    methods: {
        setStatus (status,id) {
           axios.post(`/api/admin/appointment/${id}`,{status: status}).then((data) =>
                this.load()
            );
        },
        load () {
             axios.get('/api/admin/appointment').then((data) => this.appointments = data.data.appointments);
        }
    }
}
</script>
