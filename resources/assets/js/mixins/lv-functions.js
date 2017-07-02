export default {
    methods: {
        moveProgressBar: function() {
            var data = this.$store.state;
            var progress = data.progress += 25;
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
            var data = this.$store.state;
            let progress = data.progress += 25;

            let prefix = 'step_';
            let current_step = data.current_step;

            var index = data.steps.indexOf(current_step);
            if (index < data.steps.length) {
                var next_step = data.steps[index + 1];

                data[prefix + next_step].show = true;
                data[prefix + current_step].show = false;

                data.current_step = next_step;
            }

            window.scrollTo(0, 0)

            // PROGRESS BAR FUNCTIONALITY
            console.log(progress);
            var getPercent = (progress / 100);
            var getProgressWrapWidth = $('.progress-wrap').width();
            var progressTotal = getPercent * getProgressWrapWidth;
            var animationLength = 500;
            // on page load, animate percentage bar to data percentage length
            // .stop() used to prevent animation queueing
            $('.progress-bar').stop().animate({
                left: progressTotal
            }, animationLength);

            //  save data if logged in
            let obj = {
                'step': current_step,
                'data': {
                    'order_id': data.order_id,
                    'title': data.name
                }
            }

            axios.post('/order/save', obj)
                .then((response) => {
                    console.log(response.data);
                    this.$store.commit('setCurrentOrderId', response.data.order_id);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        back: function() {
            var data = this.$store.state;
            let progress = data.progress -= 25;

            let prefix = 'step_';
            let current_step = data.current_step;

            var index = data.steps.indexOf(current_step);
            if (index > 0) {
                var back_step = data.steps[index - 1];

                data[prefix + back_step].show = true;
                data[prefix + current_step].show = false;

                data.current_step = back_step;
            }
            window.scrollTo(0, 0)

            // PROGRESS BAR FUNCTIONALITY
            console.log(progress);
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