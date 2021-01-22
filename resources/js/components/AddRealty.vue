<template>
    <div>
        <h3 class="text-center">Add realty</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addRealty">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="realty.name">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="realty.price">
                    </div>
                    <div class="form-group">
                        <label>Bedroom</label>
                        <input type="text" class="form-control" v-model="realty.bedroom">
                    </div>
                    <div class="form-group">
                        <label>Bathroom</label>
                        <input type="text" class="form-control" v-model="realty.bathroom">
                    </div>
                    <div class="form-group">
                        <label>Storey</label>
                        <input type="text" class="form-control" v-model="realty.storey">
                    </div>
                    <div class="form-group">
                        <label>Garage</label>
                        <input type="text" class="form-control" v-model="realty.garage">
                    </div>
                    <button type="submit" class="btn btn-primary " style="margin-top: 10px;">Add Realty</button>
                </form>
            </div>




        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            realty: {}
        }
    },
    methods: {
        addRealty() {
            this.axios
                .post('http://localhost:8000/api/realty/add', this.realty)
                .then(response => (this.$router.push({name: 'home'})
                     //console.log(this.realty)
                ))
                .catch(error => console.log(error))
                .finally(() => this.loading = false)
        },

    }
}
</script>
