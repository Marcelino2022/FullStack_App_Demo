/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

import Vuex from 'vuex';

const store = new Vuex.Store({
    state: {
        teste: 'A ver se funciona'
    }
})

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    store
});

import ExampleComponent from './components/ExampleComponent.vue';
import LoginComponent from './components/Login.vue';
import RegisterComponent from './components/RegisterComponent.vue'
import HomeComponent from './components/Home.vue';
import CoordenacoesComponent from './components/Coordenacoes.vue';
import MembrosComponent from './components/Membros.vue';
import AdicionarMembrosComponent from './components/AdicionarMembro.vue';

import ModalComponent from './components/Modal.vue';
import ButtonHome from './components/ButtonHome.vue';
import ButtonComponent from './components/ButtonComponent.vue';
import AdicionarMembroComponent from './components/AdicionarMembro.vue';
import AdicionarCoordenacaoComponent from './components/AdicionarCoordenacao.vue';
import AdicionarLocalidadeComponent from './components/AdicionarCoordenacao.vue';
import ProvinciaComponent from './components/provincia/Provincia.vue';
import AdicionarProvinciaComponent from './components/provincia/AdicionarProvincia.vue';
import EditarProvinciaComponent from './components/provincia/EditarProvincia.vue';

import InputContainerComponent from './components/InputContainer.vue';
import FiltroComponent from './components/Filtro.vue'
import CardComponent from './components/card.vue'
import AlertComponent from './components/Alert.vue'


app.component('example-component', ExampleComponent);
app.component('login-component', LoginComponent);
app.component('register-component', RegisterComponent)
app.component('home-component', HomeComponent);
app.component('coordenacoes-component', CoordenacoesComponent);
app.component('membros-component', MembrosComponent);
app.component('adicionarMembro-component', AdicionarMembrosComponent);
app.component('adicionarLocalidade-component', AdicionarLocalidadeComponent);
app.component('modal-component', ModalComponent);
app.component('buttonHome-component', ButtonHome)
app.component('buttonComponent-component', ButtonComponent)
app.component('adicionarMembro-component', AdicionarMembroComponent);
app.component('adicionarCoordenacao-component', AdicionarCoordenacaoComponent);
app.component('adicionarLocalidade-component', AdicionarLocalidadeComponent);
app.component('provincia-component', ProvinciaComponent);
app.component('adicionarProvincia-component', AdicionarProvinciaComponent);
app.component('editarProvincia-component', EditarProvinciaComponent);

app.component('input-container-component', InputContainerComponent);
app.component('filtro-component', FiltroComponent);
app.component('card-component', CardComponent)
app.component('alert-component', AlertComponent)




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
