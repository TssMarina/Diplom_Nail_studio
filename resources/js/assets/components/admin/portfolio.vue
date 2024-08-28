<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table class="table table-secondary">
                    <thead>
                    <tr>
                        <th scope="col"  class="admin-table-header">Фотография</th>
                        <th scope="col"  class="admin-table-header">
                            <button class="btn" v-on:click="addNew()" >
                                <i class="fa-solid fa-circle-plus favour_add_button"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="isEdit === true">
                            <td><input class="form-control" type="file" @change="changeFile"/></td>
                            <td class="favour-table-data text-center py-3">
                                <button class="btn" v-on:click="formSubmit">
                                    <i class="fa-solid fa-check favour_add_button"></i>
                                </button>
                            </td>
                    </tr>
                    <tr v-for="image in this.images">
                        <td class="favour-table-data text-center py-3">
                            <img height="200" v-bind:src="'../images/portfolio/'+image.image" alt="image">
                        </td>
                        <td class="favour-table-data text-center py-3">
                            <button class="btn" v-on:click="remove(image)">
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
            images: null,
            isEdit: false,
            edited: null,
            file: null,
        }
    },
    created () {
        this.load();
    },
    methods: {
        addNew(){
            this.isEdit = true;
        },
        remove(image){
          axios.post(`/api/admin/portfolio/delete/${image.id}`).then((data) =>
                this.load()
            );
        },
        load () {
            axios.get('/api/admin/portfolio').then((data) => this.images = data.data.images);
        },
        changeFile($event){
            this.file = $event.target.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            axios.post('/api/admin/portfolio/create', data, config)
                .then((res) => {
                    existingObj.success = res.data.success;
                    this.load()
                    this.isEdit = false
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        }
    }
}
</script>
