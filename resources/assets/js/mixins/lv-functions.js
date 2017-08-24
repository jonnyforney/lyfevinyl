export default {
    data: function() {
        return {
            progress: 0,
        }
    },
    methods: {
        moveProgressBar: function() {
            var display_data = this.$store.state.display;
            var progress = display_data.progress += 16.667;
            console.log("moveProgressBar " + progress);
            var getPercent = (progress / 100);
            var getProgressWrapWidth = $('.progress-wrap').width();
            var progressTotal = getPercent * getProgressWrapWidth;
            var animationLength = 500;
            // on page load, animate percentage bar to data percentage length
            // .stop() used to prevent animation queueing
            $('.progress-bar').stop().animate({
                left: progressTotal
            }, animationLength);
        },
        //  step nav functions
        next: function() {
            var display_data = this.$store.state.display;
            var vinyl_data = this.$store.state.vinyl;
            var shipping_data = this.$store.state.shipping;
            var payment_data = this.$store.state.payment;
            var order_data = this.$store.state.order;

            let prefix = 'step_';
            let current_step = display_data.current_step;

            var index = display_data.steps.indexOf(current_step);
            if (index < display_data.steps.length) {
                var next_step = display_data.steps[index + 1];

                display_data[prefix + next_step].show = true;
                display_data[prefix + current_step].show = false;

                display_data.current_step = next_step;
            }

            window.scrollTo(0, 0)

            this.moveProgressBar();

            //  save data if logged in
            let obj = {
                'step': current_step,
                'data': {
                    'order_id': vinyl_data.order_id,
                    'title': vinyl_data.name,
                    'front_cover_path': vinyl_data.front_cover_path,
                    'sides': vinyl_data.sides,
                    'shipping': shipping_data,
                    'payment': payment_data,
                    'status': order_data.status
                }
            }

            axios.post('/order/save', obj)
                .then((response) => {
                    if (response.data) {
                        console.log(response.data);
                        this.$store.commit('setOrderId', response.data.order_id);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        back: function() {
            var display_data = this.$store.state.display;
            var progress = display_data.progress -= 16.667;
            let prefix = 'step_';
            let current_step = display_data.current_step;

            var index = display_data.steps.indexOf(current_step);
            if (index > 0) {
                var back_step = display_data.steps[index - 1];

                display_data[prefix + back_step].show = true;
                display_data[prefix + current_step].show = false;

                display_data.current_step = back_step;
            }
            window.scrollTo(0, 0)

            console.log("moveProgressBar " + progress);
            var getPercent = (progress / 100);
            var getProgressWrapWidth = $('.progress-wrap').width();
            var progressTotal = getPercent * getProgressWrapWidth;
            var animationLength = 500;
            // on page load, animate percentage bar to data percentage length
            // .stop() used to prevent animation queueing
            $('.progress-bar').stop().animate({
                left: progressTotal
            }, animationLength);

        }
    }
}