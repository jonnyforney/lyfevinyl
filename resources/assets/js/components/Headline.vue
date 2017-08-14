<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <h1 class="lvds-headline" v-html="heading"></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2 class="lvds-headline--secondary" v-html="subhead"></h2>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['heading', 'subhead'],
    };
</script>
