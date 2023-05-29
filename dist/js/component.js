const app = Vue.createApp({
    data() {
        return {
            selectedIndex: 0,
            all_recipes: [],
            hasRecipes: true,
            recipes: [],
            recipes_top: [],
            recent_recipe: [],
            selected_recipe: [],
            related_recipes: [],
            search_recipes: [],
            categories: []
        }
    },
    mounted: function () {

// -------------------------------------------------------- Categories -------------------------------------------------------- //

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

// -------------------------------------------------------- Recipes -------------------------------------------------------- //

        axios({
            method: 'get',
            url: 'https://www.themealdb.com/api/json/v1/1/filter.php?c=Chicken'
        })
        .then(
            (response) => {
                let recipes = response.data.meals;
                recipes.forEach(element => {
                    this.recipes.push({ 
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
                this.recipes_top = this.recipes.slice(0, 10);
                this.recent_recipe = this.recipes.slice(0, 1);
                this.related_recipes = this.recipes.slice(0, 5);
            },
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Selected Recipe -------------------------------------------------------- //

        let id = window.location.search;
        axios({
            method: 'get',
            url: 'https://www.themealdb.com/api/json/v1/1/lookup.php'+id
        })
        .then(
            (response) => {
                let recipe = response.data.meals;
                recipe.forEach(element => {
                    this.selected_recipe.push({ 
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

// -------------------------------------------------------- Search Recipes -------------------------------------------------------- //

        let category = window.location.search;
        console.log(category);
        axios({
            method: 'get',
            url: 'https://www.themealdb.com/api/json/v1/1/filter.php'+category
        })
        .then(
            (response) => {
                let items = response.data.meals;
                items.forEach(element => {
                    this.search_recipes.push({ 
                        id: element.idMeal,
                        image: element.strMealThumb,
                        name: element.strMeal,
                        category: category,
                        time: "20 mins",
                        level: "Easy",
                        likes: 18,
                        ingredients: "NA",
                        instructions: "NA"
                    });
                });
            }
        )
        .catch(
            error => console.log(error)
        );
        
    },
    methods: {
        onClickSelectedCategory(category) {
            axios({
                method: 'get',
                url: 'https://www.themealdb.com/api/json/v1/1/filter.php?c='+category
            })
            .then(
                (response) => {
                    let items = response.data.meals;
                    this.recipes = [];
                    items.forEach(element => {
                        this.recipes.push({ 
                            id: element.idMeal,
                            image: element.strMealThumb,
                            name: element.strMeal,
                            category: category,
                            time: "20 mins",
                            level: "Easy",
                            likes: 18,
                            ingredients: "NA",
                            instructions: "NA"
                        });
                    });
                }
            )
            .catch(
                error => console.log(error)
            );
        }
    }
})

const emitter = mitt();
app.config.globalProperties.$test = emitter;