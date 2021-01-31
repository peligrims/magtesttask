export default {
        state:{
            realties: [],
        },
        mutations:{
            SET_LOADING (state, realties) {
                state.realties = realties
            },
            DELETE_REALIES (state, RealtyId) {
                state.realties.splice(RealtyId, 1)
            }
        },
        actions: {
            async getRealties(ctx) {
                const res = await fetch('http://localhost:8000/api/realties')
                const realties = await res.json();
                ctx.commit('SET_LOADING', realties)
            },
            async deleteRealty (ctx, realtiesId) {
                axios
                    .delete('http://localhost:8000/api/realty/delete/' + realtiesId)
                    .then(response => {
                        ctx.commit('DELETE_REALIES', response.data.id)
                        console.log(response)
                    });
            }
        },
            getters: {
                allRealties(state) {
                    return state.realties
                },
            }
}
