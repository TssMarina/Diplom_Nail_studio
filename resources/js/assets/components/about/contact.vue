<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 p-0">
                <div id="map" style="width: 100%; height: 100%;">
                </div>
            </div>

            <div class="col-6 background-contact">
                <div class="row ps-5 pt-5 pb-5">
                    <h1 class="contact-header mt-3 justify-content-start">Контакты</h1>
                    <div class="contact-name pt-0 border-0">hand's up</div>
                    <div class="contact-address border-0">г.Екатеринбург ул.Рощинская, 21к2</div>

                </div>
                <div class="row ps-5 pt-5 pb-5">
                    <div class="contact-number">Телефон: +7 904 982 44 55</div>
                </div>
                <div class="row  ps-5 pt-4 pb-5">
                    <div class="contact-info" >
                        Наша студия расположена в самом сердце Уктуса, на пересечении улиц Рощинская/Молодогвардейцев.
                        Ближайшая станция метро — Ботаническая.
                    </div>
                </div>
                <div class="row ps-5 pt-5 pb-5">
                    <div class="contact-info" >
                        Мы работаем ежедневно с 11 утра до 22 вечера. Перед посещением, пожалуйста, воспользуейтесь
                        функцией онлан-записи. Это позволит мастеру подготовится в вашему визиту.
                    </div>

                </div>


            </div>
        </div>
    </div>


</template>
<script>
    ymaps.ready(function() {
        var map = new ymaps.Map('map',{
            center:[56.782836566643866, 60.665472944989105],
            zoom: 17
        });
        var placemark = new ymaps.Placemark([56.782836566643866, 60.665472944989105],{

        });

        map.geoObjects.add(placemark);

        map.controls.remove('geolocationControl');
        map.controls.remove('searchControl');
        map.controls.remove('trafficControl');
        map.controls.remove('typeSelector');
        map.controls.remove('fullscreenControl');
        map.controls.remove('zoomControl');
        map.controls.remove('rulerControl');

    });
</script>


