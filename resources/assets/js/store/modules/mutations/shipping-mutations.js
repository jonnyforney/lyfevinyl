export default {
    setFirstName(state, fname) {
        state.firstName = fname;
    },
    setLastName(state, lname) {
        state.lastName = lname;
    },
    setEmail(state, email) {
        state.email = email;
    },
    setAddressOne(state, addressOne) {
        state.addressLineOne = addressOne;
    },
    setAddressTwo(state, addressTwo) {
        state.addressLineTwo = addressTwo;
    },
    setCity(state, city) {
        state.addressCity = city;
    },
    setState(state, s) {
        state.addressState = s;
    },
    setZip(state, zip) {
        state.addressZip = zip;
    }
}