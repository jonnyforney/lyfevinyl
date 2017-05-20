<template>
    <main id="index">
  <section class="lvds-section lvds-section--hero lvds-section--homepage-hero text-center">
    <div class="container lvds-navigation">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12 col-md-3">
              <a href="/">
                <img class="lvds-nav__logo" :src="lv_logo_navy" />
              </a>
            </div>
            <div class="col-sm-12 col-md-3 col-md-offset-6 mobile--hide">
              <button class="lvds-button lvds-button__cta lvds-button--yellow" @click="openApp()">
                Build yours now
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-center">
          <h1 class="lvds-headline--hero">Custom vinyl records for those special moments.</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-center medium-up--hide">
          <button class="lvds-button lvds-button__cta lvds-button--yellow" @click="openApp()">Build yours now</button>
        </div>
      </div>
    </div>
  </section>
  <section class="lvds-section lvds-section--white" id="how">
    <div class="container">
      <div class="row medium-up--mgn-50 text-center">
        <div class="col-md-4">
          <img class="lvds-icons__3blocks" :src="lv_upload_music" />
          <h2 class="lvds-headline--tertiary text-blue-light">Upload your music</h2>
          <p class="lvds-para">Lorem ipsum doodle potato sit amet, mas ninos running in Greenland.</p>
        </div>
        <div class="col-md-4">
          <img class="lvds-icons__3blocks" :src="lv_album_art" />
          <h2 class="lvds-headline--tertiary text-blue-light">Add album art</h2>
          <p class="lvds-para">Lorem ipsum doodle potato sit amet, mas ninos running in Greenland.</p>
        </div>
        <div class="col-md-4">
          <img class="lvds-icons__3blocks" :src="lv_record" />
          <h2 class="lvds-headline--tertiary text-blue-light">Sit back &amp; relax</h2>
          <p class="lvds-para">Lorem ipsum doodle potato sit amet, mas ninos running in Greenland.</p>
        </div>
      </div>
    </div>
  </section>
</main>
</template>

<script>
    export default {
        props: ['lv_logo_navy', 'lv_upload_music', 'lv_album_art', 'lv_record'],
        data: function() {
            return {};
        },
        computed: {

        },
        methods: {
            //open app
            openApp: function() {
                var self = this;
                /*if (laravel.isLoggedIn) window.location.href = '/app';
                else {*/
                swal({
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#e3e3e3',
                    confirmButtonText: 'Login / Register',
                    cancelButtonText: 'Continue as guest',
                    buttonsStyling: true
                }).then(function() {
                    //  login / register
                    window.location.href = '/login';
                }, function() {
                    //  continue as guest
                    self.setGuest();
                });
                //}
            },
            setGuest: function() {
                console.log('setting current user as guest...');
                //  other code
                window.location.href = '/app';
            }
        },
        ready() {
            console.log('loaded')
        }
    };
</script>