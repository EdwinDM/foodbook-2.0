const app = Vue.createApp({
    data() {
        return {
            recipe: []
        }
    },
    mounted: function () {
        let id = urlObject.searchParams.get('id');
        console.log(id);
        axios({
            method: 'get',
            url: 'https://www.themealdb.com/api/json/v1/1/lookup.php?i='+id
        })
        .then(
            (response) => {
                let recipe = response.data.meals;
                recipe.forEach(element => {
                    this.recipe.push({ 
                        id: element.idMeal,
                        image: element.strMealThumb,
                        name: element.strMeal,
                        category: "Seafood",
                        time: "20 mins",
                        level: "Easy",
                        likes: 18,
                        ingredients: "NA",
                        instructions: "NA"
                    });
                });
            },
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