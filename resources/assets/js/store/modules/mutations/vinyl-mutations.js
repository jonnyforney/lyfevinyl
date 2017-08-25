export default {
    setCustomerId(state, id) {
        state.customer_id = id;
    },
    setOrderId(state, id) {
        state.order_id = id;
    },
    setName(state, name) {
        state.name = name;
    },
    setSong(state, songs) {
        state.songs = songs;
    },
    addSong(state, song) {
        state.songs.push(song);
    },
    removeSong(state, song) {
        let index = state.songs.indexOf(song);
        if (index > -1) {
            state.songs = state.songs.splice(index, 1);
        }
    },
    setFrontCoverPath(state, path) {
        state.front_cover_path = path;
    }
}