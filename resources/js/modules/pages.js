export default {
    mutations: {
        setDraftLastUpdated (state, timestamp) {
            console.log(timestamp)
            state.draftLastUpdated = timestamp;
        },
    },

    getters: {
        getDraftLastUpdated: state => {
            return state.draftLastUpdated;
        }
    },

    state: {
        draftLastUpdated: null,
    },
}
