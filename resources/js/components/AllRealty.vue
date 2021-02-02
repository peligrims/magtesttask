<template>
    <v-app>

        <v-card color="rgba(255, 255, 255, 0.7)" v-if="loading">
            <v-layout justify-center align-center fill-height>
                <v-progress-circular :size="80" :width="5" indeterminate color="primary"></v-progress-circular>
            </v-layout>
        </v-card>

        <h3 class="text-center">All realty</h3><br/>
        <v-alert v-if="filtered.length <= 0" type="error" >
                <p>You have no items!</p>
        </v-alert>
        <table class="table table-bordered" >

            <thead>
            <tr>
                <th></th>
                <th>
                    <p id="min"> MIN:{{minPrice}}</p>
                    <p id="max" > MAX:{{maxPrice}}</p>
                </th>
                <th>
                    <div class="filters">
                        <div class="v-input--range-slider">
                            <br>
                            <label>
                                <input type="range"
                                       min="263000"
                                       max="573000"
                                       step="100"
                                       @change="setRangeSliders"
                                       v-model.number ='minPrice'
                                       placeholder="MIN Price">
                            </label><br>

                            <label>
                                <input type="range"
                                       min="263000"
                                       max="573000"
                                       step="100"
                                       @change="setRangeSliders"
                                       v-model.number ='maxPrice' placeholder="MIN Price">
                            </label>
                            <div class="range-value">

                            </div>
                        </div>
                    </div>
                </th>
                <th><label>
                    <input  v-model="bedroom"   placeholder="Search Bedroom">
                </label></th>
                <th><label>
                    <input v-model="bathroom"  placeholder="Search Bathroom">
                </label></th>
                <th><label>
                    <input v-model="storey" placeholder="Search Storey">
                </label></th>
                <th><label>
                    <input v-model="garage"  placeholder="Search Garage">
                </label></th>
                <th>&nbsp;</th>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Bedroom</th>
                <th>Bathroom</th>
                <th>Storey</th>
                <th>Garage</th>
                <th >&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="realty in  filtered" :key="realty.id">
                <td>{{ realty.id }}</td>
                <td>{{ realty.name }}</td>
                <td>{{ realty.price }}</td>
                <td>{{ realty.bedroom }}</td>
                <td>{{ realty.bathroom }}</td>
                <td>{{ realty.storey }}</td>
                <td>{{ realty.garage }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: realty.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteRealty(realty.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </v-app>
</template>
<script>

import {mapGetters,  } from "vuex";
export default {

    computed: {
        ...mapGetters(["allRealties"]),

        price:{
            get(){ return this.$store.getters.price; },
            set( value ){ this.$store.commit("PRICE_COMMIT", value );}
        },
        bedroom:{
            get(){ return this.$store.getters.bedroom; },
            set( value ){ this.$store.commit("BEDROOM_COMMIT", value );}
        },
        bathroom:{
            get(){ return this.$store.getters.bathroom; },
            set( value ){ this.$store.commit("BATHROOM_COMMIT", value );}
        },
        storey:{
            get(){ return this.$store.getters.storey; },
            set( value ){ this.$store.commit("STOREY_COMMIT", value );}
        },
        garage:{
            get(){ return this.$store.getters.garage; },
            set( value ){ this.$store.commit("GARAGE_COMMIT", value );}
        },
        minPrice:{
            get(){ return this.$store.getters.minPrice; },
            set( value ){ this.$store.commit("MIN_PRICE_COMMIT", value );}
        },
        maxPrice:{
            get(){ return this.$store.getters.maxPrice; },
            set( value ){ this.$store.commit("MAX_PRICE_COMMIT", value );}
        },
        loading:{
            get(){ return this.$store.getters.loading; },
            set( value ){ this.$store.commit("LOADING_COMMIT", value );}
        },

        filtered: function () {
            return this.$store.getters.allRealties
                .filter(realty => {return realty.bedroom.includes(this.bedroom)})
                .filter(realty => {return realty.bathroom.includes(this.bathroom)})
                .filter(realty => {return realty.storey.includes(this.storey)})
                .filter(realty => {return realty.garage.includes(this.garage)})
                .filter(realty => {return  realty.price>=this.minPrice && realty.price<=this.maxPrice})
        },

    },

        async mounted() {
        await this.$store.dispatch('getRealties');
    },
    methods: {
        deleteRealty (id) {
            this.$store.dispatch('deleteRealty', id);
        },
        setRangeSliders(){
            if (this.minPrice > this.maxPrice ) {
                let tmp = this.maxPrice;
                this.maxPrice = this.minPrice;
                this.minPrice = tmp;
            }
        },
    }
}
</script>
<style>
input {
    width: 140px;
}
.filters {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.range-slider svg, .range-slider input [type=range]{
    position: absolute;
    left: 0;
    bottom: 0;
}
input [type=range]::-webkit-media-slider-thumb
{
    z-index: 2;
    position: relative;
    top: 2px;
    margin-top: -7px;
}
.range-value {
}
#min,#max {
    margin-bottom: 0;
}

</style>
