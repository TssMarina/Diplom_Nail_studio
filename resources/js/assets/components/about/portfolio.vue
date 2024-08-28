<template>
    <div class="container-fluid">
        <h1 class="portfolio-header pt-3">Портфолио</h1>
        <h6 class="portfolio-title">Тиши пилим дольше ходим</h6>
        <div class="col-4 offset-4">
            <div id="carouselExampleControls" class="carousel slide portfolio-carousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active justify-content-center">
                        <img src="images/portfolio/photo_2023-06-20_12-38-34.jpg" class="d-block portfolio-image" alt="image">
                    </div>
                    <div v-for="image in this.images">
                        <div class="carousel-item text-center">
                            <img v-bind:src="'../images/portfolio/'+image.image" class="d-block portfolio-image" alt="image">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
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
        }
    },
    created () {
        this.load();
    },
    methods: {
        load () {
            axios.get('/api/admin/portfolio').then((data) => this.images = data.data.images);
        },

    }
}
</script>
