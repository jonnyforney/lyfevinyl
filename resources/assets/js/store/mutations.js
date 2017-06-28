module.exports = {
    setName(state, name) {
        state.name = name;
    },
    setSong(state, sides) {
        state.sides = sides;
    },
    setFrontCoverPath(state, path) {
        state.front_cover_path = path;
    },
    setCurrentOrderId(state, id) {
        state.order_id = id;
    }
}