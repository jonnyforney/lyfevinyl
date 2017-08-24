<template>
  <div class="row">
    <hr class="lvds-hr--gray-medium">
    <div class="col-md-6 padding-left-none">
      <button class="lvds-button lvds-button--gray-medium" @click="back()">&laquo; Go Back</button>
    </div>
    <div class="col-md-6 margin-bottom-30-sm padding-right-none">
      <button class="lvds-button lvds-button--blue-light" @click="next()">Next &raquo;</button>
    </div>
  </div>
</template>

<script>
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        mixins: [lv_functions],

    };
</script>
