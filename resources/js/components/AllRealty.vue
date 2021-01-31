<template>
    <v-app>
        <h3 class="text-center">All realty</h3><br/>
        <table class="table table-bordered" >

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Bedroom</th>
                <th>Bathroom</th>
                <th>Storey</th>
                <th>Garage</th>
                <th width="100">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="realty in  allRealties" :key="realty.id">
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
import {mapGetters } from "vuex";
export default {
    computed: mapGetters(["allRealties"]),
    //computed: {allRealties(){return this.$store.getters.allRealties;}},
    async mounted() {
        this.$store.dispatch('getRealties');
    },
    methods: {
        deleteRealty (id) {
            this.$store.dispatch('deleteRealty', id);
        }
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
    margin-bottom: 0px;
}
.alpha { color: red; }
</style>
