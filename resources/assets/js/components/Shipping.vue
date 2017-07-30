<template>
  <section v-if="current_step.show" key="shipping">
    <headline :heading="name" :subhead="current_step.subhead"></headline>
    <div class="row">
      <div class="col-md-8 col-center margin-bottom-30">
        <div class="row">
          <div class="col-md-6">
            <label class="lvds-form__label">First name*</label>
            <input
              class="lvds-form__text-input"
              type="text"
              id="firstName"
              name="firstName"
              v-model="firstName"
              placeholder="John"
              autofocus
              required="true"
            />
          </div>
          <div class="col-md-6">
            <label class="lvds-form__label">Last name*</label>
            <input
              class="lvds-form__text-input"
              type="text"
              id="lastName"
              name="lastName"
              v-model="lastName"
              placeholder="Watson"
              required="true"
            />
          </div>
        </div>
        <div class="row margin-top-30">
          <div class="col-md-12">
            <label class="lvds-form__label">Address Line 1*</label>
            <input
              class="lvds-form__text-input"
              type="text"
              id="addressLineOne"
              name="addressLineOne"
              v-model="addressLineOne"
              placeholder="221B Baker St"
              required="true"
            />
          </div>
        </div>
        <div class="row margin-top-30">
          <div class="col-md-12">
            <label class="lvds-form__label">Address Line 2 (Optional)</label>
            <input
              class="lvds-form__text-input"
              type="text"
              id="addressLineTwo"
              name="addressLineTwo"
              v-model="addressLineTwo"
            />
          </div>
        </div>
        <div class="row margin-top-30">
          <div class="col-md-9">
            <label class="lvds-form__label">City*</label>
            <input
              class="lvds-form__text-input"
              type="text"
              id="city"
              name="city"
              v-model="city"
              placeholder="London"
            />
          </div>
          <div class="col-md-3">
            <label class="lvds-form__label">State*</label>
            <select
              class="lvds-form__text-input"
              id="state"
              name="state"
              v-model="addressState"
            >
            	<option value="AL">AL</option>
            	<option value="AK">AK</option>
            	<option value="AR">AR</option>
            	<option value="AZ">AZ</option>
            	<option value="CA">CA</option>
            	<option value="CO">CO</option>
            	<option value="CT">CT</option>
            	<option value="DC">DC</option>
            	<option value="DE">DE</option>
            	<option value="FL">FL</option>
            	<option value="GA">GA</option>
            	<option value="HI">HI</option>
            	<option value="IA">IA</option>
            	<option value="ID">ID</option>
            	<option value="IL">IL</option>
            	<option value="IN">IN</option>
            	<option value="KS">KS</option>
            	<option value="KY">KY</option>
            	<option value="LA">LA</option>
            	<option value="MA">MA</option>
            	<option value="MD">MD</option>
            	<option value="ME">ME</option>
            	<option value="MI">MI</option>
            	<option value="MN">MN</option>
            	<option value="MO">MO</option>
            	<option value="MS">MS</option>
            	<option value="MT">MT</option>
            	<option value="NC">NC</option>
            	<option value="NE">NE</option>
            	<option value="NH">NH</option>
            	<option value="NJ">NJ</option>
            	<option value="NM">NM</option>
            	<option value="NV">NV</option>
            	<option value="NY">NY</option>
            	<option value="ND">ND</option>
            	<option value="OH">OH</option>
            	<option value="OK">OK</option>
            	<option value="OR">OR</option>
            	<option value="PA">PA</option>
            	<option value="RI">RI</option>
            	<option value="SC">SC</option>
            	<option value="SD">SD</option>
            	<option value="TN">TN</option>
            	<option value="TX">TX</option>
            	<option value="UT">UT</option>
            	<option value="VT">VT</option>
            	<option value="VA">VA</option>
            	<option value="WA">WA</option>
            	<option value="WI">WI</option>
            	<option value="WV">WV</option>
            	<option value="WY">WY</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <back-next-btns></back-next-btns>
  </section>
</template>

<script>
    import Headline from './Headline';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';
    // import Circle2from './~/vue-loading-spinner/src/components/Circle.vue';

    export default {
        firstName: 'first-name',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'back-next-btns': StepControlButtons,
        },
        data: function () {
          return {

          }
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_shipping;
            },
            name: {
                get() {
                    return this.$store.state.order.name;
                },
                set(name) {
                    this.$store.commit('setName', name);
                },
            }
        },
        methods: {

        },
    };
</script>
