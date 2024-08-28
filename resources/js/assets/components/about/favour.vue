<template>
    <div class="container-fluid favour-image-center">
        <h1 class="favour-header pt-2">Услуги и прайс</h1>
        <div class="row">
            <div class="col-lg-6 col-12 ps-5 favour-image-left">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="favour-table-header">Маникюр</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="favour in this.favours">
                            <td v-if="favour.category === 'MANICURE'" class="favour-table-data text-start ps-5  py-3" v-text="favour.name"/>
                            <td v-if="favour.category === 'MANICURE'" class="favour-table-data py-3 text-start" v-text="favour.price + ' ₽'"/>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-12 ps-5 favour-border-left favour-image-right">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="favour-table-header">Педикюр</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="favour in this.favours">
                            <td v-if="favour.category === 'PEDICURE'" class="favour-table-data text-start ps-5 py-3" v-text="favour.name"/>
                            <td v-if="favour.category === 'PEDICURE'" class="favour-table-data py-3" v-text="favour.price + ' ₽'"/>
                        </tr>
                    </tbody>
                </table>
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
        }
    },
    created() {
        axios.get('/api/admin/favour').then((data)=>this.favours = data.data.favours)
    }
}
</script>
