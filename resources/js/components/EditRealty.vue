<template>
    <div>
        <h3 class="text-center">Edit Realty</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateRealty">
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

                    <button type="submit" class="btn btn-primary">Update Realty</button>
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
    created() {
        this.axios
            .get(`http://localhost:8000/api/realty/edit/${this.$route.params.id}`)
            .then((response) => {
                this.realty = response.data;
                console.log(response);
            });
    },
    methods: {
        updateRealty() {
            this.axios
                .post(`http://localhost:8000/api/realty/update/${this.$route.params.id}`, this.realty)
                .then((response) => {
                    this.$router.push({name: 'home'});
                });
        }
    }
}
</script>
