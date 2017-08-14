<template>
  <div class="row">
    <hr class="lvds-hr--gray-medium">
    <div class="col-md-6">
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
