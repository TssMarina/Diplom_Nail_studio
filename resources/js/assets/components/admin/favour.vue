<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col"  class="admin-table-header">Название услуги</th>
                            <th scope="col"  class="admin-table-header">Прайс</th>
                            <th scope="col"  class="admin-table-header">Категория</th>
                            <th scope="col"  class="admin-table-header">
                                <button class="btn" v-on:click="addNew()" >
                                    <i class="fa-solid fa-circle-plus favour_add_button"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="isEdit === true">
                            <td><input class="form-control" v-model="this.edited.name"/></td>
                            <td><input class="form-control" v-model="this.edited.price"/></td>
                            <td>
                                <select class="form-select" v-model="this.edited.category">
                                    <option v-for="category in this.categories" v-text="category"></option>
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
                        <tr v-for="favour in this.favours">
                                <td class="favour-table-data text-center py-3" v-text="favour.name"  v-if="this.isEdit !== favour.id"/>
                                <td v-else><input class="form-control" v-model="this.edited.name"/></td>

                                <td class="favour-table-data py-3" v-text="favour.price" v-if="this.isEdit !== favour.id"/>
                                <td v-else><input class="form-control" v-model="this.edited.price"/></td>

                                <td class="favour-table-data text-center py-3" v-text="favour.category" v-if="this.isEdit !== favour.id"/>
                                <td v-else>
                                    <select v-model="this.edited.category">
                                        <option v-for="category in this.categories" v-text="category"></option>
                                    </select>
                                </td>

                                <td class="favour-table-data text-center py-3" v-if="this.isEdit !== favour.id">
                                    <button class="btn" v-on:click="edit(favour)">
                                        <i class="fa-solid fa-pencil favour_add_button"></i>
                                    </button>
                                    <button class="btn" v-on:click="remove(favour.id)">
                                        <i class="fa-solid fa-trash  favour_add_button"></i>
                                    </button>
                                </td>
                                <td class="favour-table-data text-center py-3" v-else>
                                    <button class="btn" v-on:click="cancel()">
                                        <i class="fa-solid fa-xmark favour_add_button"></i>
                                    </button>
                                    <button class="btn" v-on:click="editFavour(favour.id)">
                                        <i class="fa-solid fa-check favour_add_button"></i>
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
                favours: null,
                isEdit: false,
                categories: null,
                edited: {
                    name: "",
                    price: null,
                    category: "",
                },
            }
        },
        created () {
            this.load();
            axios.get('/api/admin/categories').then((data) => this.categories = data.data.categories);
        },
        methods: {
            remove (favour_id) {
                axios.post(`/api/admin/favour/delete/${favour_id}`).then((data) =>
                    this.load()
                );
            },
            edit (favour) {
                this.isEdit = favour.id;
                this.edited = {
                    name: favour.name,
                    price: favour.price,
                    category: favour.category
                }
            },
            addNew () {
                this.isEdit = true;
            },
            cancel () {
                this.isEdit = false;
            },
            createNew () {
                axios.post('/api/admin/favour/create', this.edited).then((data) => {
                    this.isEdit = false;
                    this.load();
                });
            },
            editFavour (id) {
                axios.post(`/api/admin/favour/edited/${id}`, this.edited).then((data) => {
                    this.isEdit = false;
                    this.load();
                });
            },
            load () {
                axios.get('/api/admin/favour').then((data) => this.favours = data.data.favours);
            }
        }
    }
</script>
