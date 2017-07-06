module.exports = {
    setCustomerId(state, id) {
        state.customer_id = id;
    },
    setOrderId(state, id) {
        state.order_id = id;
    },
    setName(state, name) {
        state.name = name;
    },
    setSong(state, sides) {
        state.sides = sides;
    },
    setFrontCoverPath(state, path) {
        state.front_cover_path = path;
    }
}