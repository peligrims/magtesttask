<template>
    <div>
        <h3 class="text-center">All realty</h3><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>
                    <div class="filters">
                    <div class="v-input--range-slider">
                        <lable>Range Price</lable><br>
                        <input type="range"
                               min="263000"
                               max="573000"
                               step="100"
                               @change="setRangeSliders"
                               v-model.number ='minPrice'
                               placeholder="MIN Price"><br>

                        <input type="range"
                               min="263000"
                               max="573000"
                               step="100"
                               @change="setRangeSliders"
                               v-model.number ='maxPrice' placeholder="MIN Price">
                        <div class="range-value">
                            <p> MIN:{{minPrice}}</p>
                            <p> MAX:{{maxPrice}}</p>
                        </div>
                    </div>
                    </div>
                </th>
                <th><input type="search" class="search" v-model ='mbedroom' placeholder="Search Bedroom"></th>
                <th><input type="search" class="search" v-model ='mbathroom' placeholder="Search Bathroom"></th>
                <th><input type="search" class="search" v-model ='mstorey' placeholder="Search Storey"></th>
                <th><input type="search" class="search" v-model ='mgarage'  placeholder="Search Garage"></th>
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

    </div>
</template>

<script>
export default {
    data() {
        return {
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
        this.axios
            .get('http://localhost:8000/api/realties')
            .then(response => {
                this.realties = response.data;
            });
        //console.log(this.realties);
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
        }

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
.range-slider {
    width: 200px;
    margin: auto 16px;
    text-align: center;
    position: relative;
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
</style>
