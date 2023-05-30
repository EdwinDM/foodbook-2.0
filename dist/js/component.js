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
            liked_recipes: [{ id: 1, image: "./images/recipes/sushi.jpg", name: "Sushi", category: "Lunch", time: "20 mins", level: "Easy", likes: 18, ingredients: "300ml Sushi Rice, 100ml Rice wine, 2 tbs Caster Sugar, 3 tbs Mayonnaise, 1 tbs Rice wine, 1 tbs Soy Sauce1 Cucumber", instructions: "STEP 1 TO MAKE SUSHI ROLLS: Pat out some rice.Lay a nori sheet on the mat, shiny-side down.Dip your hands in the vinegared water, then pat handfuls of rice on top in a 1cm thick layer, leaving the furthest edge from you clear. STEP 2 Spread over some Japanese mayonnaise.Use a spoon to spread out a thin layer of mayonnaise down the middle of the rice. STEP 3 Add the filling.Get your child to top the mayonnaise with a line of their favourite fillings – here we’ve used tuna and cucumber. STEP 4 Roll it up.Lift the edge of the mat over the rice, applying a little pressure to keep everything in a tight roll. STEP 5 Stick down the sides like a stamp.When you get to the edge without any rice, brush with a little water and continue to roll into a tight roll. STEP 6 Wrap in cling film.Remove the mat and roll tightly in cling film before a grown-up cuts the sushi into thick slices, then unravel the cling film. STEP 7 TO MAKE PRESSED SUSHI: Layer over some smoked salmon.Line a loaf tin with cling film, then place a thin layer of smoked salmon inside on top of the cling film. STEP 8 Cover with rice and press down. Press about 3cm of rice over the fish, fold the cling film over and press down as much as you can, using another tin if you have one. STEP 9 Tip it out like a sandcastle.Turn block of sushi onto a chopping board.Get a grown-up to cut into fingers, then remove the cling film. STEP 10 TO MAKE SUSHI BALLS: Choose your topping.Get a small square of cling film and place a topping, like half a prawn or a small piece of smoked salmon, on it. Use damp hands to roll walnut-sized balls of rice and place on the topping. STEP 11 Make into tight balls. Bring the corners of the cling film together and tighten into balls by twisting it up, then unwrap and serve." }],
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
                        likes: 0,
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
        axios({
            method: 'get',
            url: 'https://www.themealdb.com/api/json/v1/1/search.php'+category
        })
        .then(
            (response) => {
                let items = response.data.meals;
                items.forEach(element => {
                    this.search_recipes.push({ 
                        id: element.idMeal,
                        image: element.strMealThumb,
                        name: element.strMeal,
                        category: element.strCategory,
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
        onClickRecipeLike(index) {
            this.selected_recipe[index].likes += 1;

            let id = window.location.search;
            console.log(id);
            axios({
                method: 'get',
                url: 'https://www.themealdb.com/api/json/v1/1/lookup.php'+id
            })
            .then(
                (response) => {
                    let items = response.data.meals;
                    items.slice(0, 5).forEach(element => {
                        this.liked_recipes.push({ 
                            id: element.idMeal,
                            image: element.strMealThumb,
                            name: element.strMeal,
                            category: element.strCategory,
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
            console.log(this.liked_recipes)
        },


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