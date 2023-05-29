const app = Vue.createApp({
    data() {
        return {
            categories: [

            ]
        }
    },
    mounted: function () {
        axios({
            method: 'get',
            url: 'https://www.themealdb.com/api/json/v1/1/list.php?c=list'
        })
        .then(
            (response) => {
                let categories = response.data.meals;
                categories.forEach((element, index) => {
                    this.categories.push({ id: index, name: element.strCategory });
                });
            }
        )
        .catch(
            error => console.log(error)
        );
    },
    methods: {

    }
})

const emitter = mitt();
app.config.globalProperties.$test = emitter;