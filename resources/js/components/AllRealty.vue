<template>
    <v-app>
        <v-flex xs12 class="text-center pt-5" v-if="loading">
            <v-progress-circular indeterminate :size="100" :width="4" color="purple"></v-progress-circular>
        </v-flex>
        <h3 class="text-center">All realty</h3><br/>
        <v-alert
            v-if="filteredRealty.length <= 0"
            color="red lighten-2"
            dismissible
            icon="mdi-car-wash"
            type="error"
        >You have no items</v-alert>
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th></th>
                <th>
                    <p id="min"> MIN:{{minPrice}}</p>
                    <p id="max" > MAX:{{maxPrice}}</p></th>
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
                    <input type="search" class="search" v-model ='mbedroom' placeholder="Search Bedroom">
                </label></th>
                <th><label>
                    <input type="search" class="search" v-model ='mbathroom' placeholder="Search Bathroom">
                </label></th>
                <th><label>
                    <input type="search" class="search" v-model ='mstorey' placeholder="Search Storey">
                </label></th>
                <th><label>
                    <input type="search" class="search" v-model ='mgarage'  placeholder="Search Garage">
                </label></th>
                <th width="100">&nbsp;</th>
            </tr>
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
            <tr v-for="realty in filteredRealty" :key="realty.id">
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
import VueCircle from 'vue2-circle-progress'

export default {
    components: {
        VueCircle
    },
    data() {
        return {
            loading:false,
            realties: [],
            mprice:'',
            mbedroom: '',
            mbathroom: '',
            mstorey: '',
            mgarage: '',
            minPrice:263604,
            maxPrice:572002
        }
    },
    created() {
        this.loading = true;
        this.axios.get('http://localhost:8000/api/realties')
            .then(response => {this.realties = response.data;} )
            .catch(error => console.log(error))
            .finally(() => this.loading = false)
        },
    computed: {
        filteredRealty: function () {
            let wm = this;
            return this.realties
                .filter(realty => {return realty.bedroom.includes(this.mbedroom)})
                    .filter(realty => {return realty.bathroom.includes(this.mbathroom)})
                            .filter(realty => {return realty.storey.includes(this.mstorey)})
                                .filter(realty => {return realty.garage.includes(this.mgarage)})
                                    .filter(realty => {return  realty.price>=wm.minPrice && realty.price<=wm.maxPrice})
        },
    },
    methods: {
        deleteRealty(id) {
            this.axios
                .delete(`http://localhost:8000/api/realty/delete/${id}`)
                .then(response => {
                    let i = this.realty.map(item => item.id).indexOf(id); // find index of your object
                    this.realties.splice(i, 1)
                });
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
    margin-bottom: 0px;
}
.alpha { color: red; }
</style>
