export default {
        state:{
            realties: [],
            loading:true,
            price:'',
            bedroom: '',
            bathroom: '',
            storey: '',
            garage: '',
            minPrice:263604,
            maxPrice:572002
        },
        mutations:{
            SET_LOADING (state, realties) {
                state.realties = realties
            },
            DELETE_REALIES (state, realtyId) {
                state.realties.splice(realtyId, 1)
            },
            PRICE_COMMIT( state, payload ){
                state.price=payload;
            },
            BEDROOM_COMMIT( state, payload ){
                state.bedroom=payload;
            },
            BATHROOM_COMMIT( state, payload ){
                state.bathroom=payload;
            },
            STOREY_COMMIT( state, payload ){
                state.storey=payload;
            },
            GARAGE_COMMIT( state, payload ){
                state.garage=payload;
            },
            MIN_PRICE_COMMIT( state, payload ){
                state.minPrice=payload;
            },
            MAX_PRICE_COMMIT( state, payload ){
                state.maxPrice=payload;
            },
            LOADING_COMMIT( state){
                state.loading=false;
            },
        },

        actions: {
            async getRealties(ctx) {
               const res = await fetch('http://localhost:8000/api/realties')
                const realties = await res.json();
                ctx.commit('SET_LOADING', realties);
                ctx.commit('LOADING_COMMIT', false);

            },
            async deleteRealty (ctx, realtiesId) {
                axios
                    .delete('http://localhost:8000/api/realty/delete/' + realtiesId)
                    .then(response => {
                        ctx.commit('DELETE_REALIES', response.data.id)
                        console.log(response)
                    });
            },

        },
            getters: {
                allRealties(state) {
                    return state.realties
                },
                price (state) {
                    return state.price
                },

                bedroom (state) {
                    return state.bedroom
                },
                bathroom (state) {
                    return state.bathroom
                },

                storey (state) {
                    return state.storey
                },
                garage (state) {
                    return state.garage
                },
                minPrice (state) {
                    return state.minPrice
                },
                maxPrice (state) {
                    return state.maxPrice
                },
                loading (state) {
                    return state.loading
                }

        }
}

