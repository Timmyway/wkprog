const { createApp, ref, reactive } = Vue;

const app = createApp({
    setup() {
        const showMenu = ref(false);
        const wkList = reactive(['Planche', 'Muscle up - Cycle 1', 'Muscle up - Cycle 2',
            'Muscle up - Cycle 3', 'Muscle up - Thenx', 'Core training', 'Back Lever', 'Front Lever'
        ]);

        const form = ref({
            selectedWorkout: 'Planche',
            trainingNumber: 10
        });

        const workouts = ref(workoutData);

        function truncate(str, n=125) {
            if (!str) {
                return '';
            }
            if (str.length > n) {
                console.log('Str is too long ', str.length);
                return str.slice(0, n+1) + '...';
            }
            return str;
        }

        return { workouts, form, wkList, showMenu, truncate };
    }
});

app.mount('#app');