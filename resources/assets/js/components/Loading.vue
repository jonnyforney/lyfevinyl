<template>
  <img id="loading-image" src="imgs/loading-spinner.png" />
</template>

<script>
    export default {
        props: [

        ],
        created(){
          setTimeout(() => {
            this.loading = false;
          },1000);
        },
        data: function() {
           return {
               data: {
                 loading: true,
               }
           }
       },
     }

</script>
