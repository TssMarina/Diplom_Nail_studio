import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import header_menu from "./assets/components/fnh/header.vue"
const headerMenuApp = createApp({
    components: {
        header_menu
    }
});

headerMenuApp.mount('#headerMenu')

import portfolio from "./assets/components/about/portfolio.vue"
const portfolioApp = createApp({
    components: {
        portfolio
    }
});

portfolioApp.mount('#portfolio')

import favour from "./assets/components/about/favour.vue"
const favourApp = createApp({
    components: {
        favour
    }
});

favourApp.mount('#favour')


import welcome from "./assets/components/about/welcome.vue"
const welcomeApp = createApp({
    components: {
        welcome
    }
});

welcomeApp.mount('#welcome')

import appointment from "./assets/components/about/appointment.vue"
const appointmentApp = createApp({
    components: {
        appointment
    }
});

appointmentApp.mount('#appointment')

import contact from "./assets/components/about/contact.vue"
const contactApp = createApp({
    components: {
        contact
    }
});

contactApp.mount('#contact')

import login from "./assets/components/auth/login.vue"
const loginApp = createApp({
    components: {
        login
    }
});

loginApp.mount('#login')

import header_admin from "./assets/components/admin/header.vue"
const headerAdminApp = createApp({
    components: {
        header_admin
    }
});

headerAdminApp.mount('#headerAdmin')

import favour_admin from "./assets/components/admin/favour.vue"
const favourAdminApp = createApp({
    components: {
        favour_admin
    }
});

favourAdminApp.mount('#favourAdmin')

import portfolio_admin from "./assets/components/admin/portfolio.vue"
const portfolioAdminApp = createApp({
    components: {
        portfolio_admin
    }
});

portfolioAdminApp.mount('#portfolioAdmin')

import appointment_admin from "./assets/components/admin/appointment.vue"
const appointmentAdminApp = createApp({
    components: {
        appointment_admin
    }
});

appointmentAdminApp.mount('#appointmentAdmin')

import calendar_admin from "./assets/components/admin/calendar.vue"
const calendarAdminApp = createApp({
    components: {
        calendar_admin
    }
});

calendarAdminApp.mount('#calendarAdmin')

