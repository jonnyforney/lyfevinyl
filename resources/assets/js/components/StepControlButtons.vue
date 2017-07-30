<template>
    <div class="row margin-top-50">
    <div class="col-md-2"></div>
    <div class="col-md-3">
        <button class="lvds-button lvds-button--ghost-blue-light" @click="back()">&laquo; Go Back</button>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-3 margin-bottom-30-sm">
        <button class="lvds-button lvds-button--blue-light" @click="next()">Next &raquo;</button>
    </div>
    <div class="col-md-2"></div>
    </div>
</template>

<script>
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        mixins: [lv_functions],
        
    };
</script>
