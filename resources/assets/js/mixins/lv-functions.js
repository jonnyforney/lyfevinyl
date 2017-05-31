export default {
    methods: {
        //  step nav functions
        next: function() {
            var data = this.$store.state;

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
            if(history.pushState) {
              history.pushState(null, null, '#myhash');
            }
            else {
              location.hash = '#myhash';
            }
        },
        back: function() {
            var data = this.$store.state;

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
        }
    }
}
