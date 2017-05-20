<template>
    <section class="text-center">
    <div class="row">
        <div class="col-md-10 col-center">
        <h1 class="lvds-headline" v-html="heading"></h1>
        </div>
    </div>
    <div class="row margin-bottom-30">
        <div class="col-md-10 col-center">
        <h2 class="lvds-headline--secondary" v-html="subhead"></h2>
        </div>
    </div>
    </section>
</template>

<script>
    export default {
        props: ['heading', 'subhead'],
    };
</script>