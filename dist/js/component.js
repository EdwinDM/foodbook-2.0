const app = Vue.createApp({//prueba e retoma de trabajo
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
            ingredientsA: [],
            search_recipes: [],
            liked_recipes: [{ id: 1, image: "./images/recipes/sushi.jpg", name: "Sushi", category: "Lunch", time: "20 mins", level: "Easy", likes: 18, ingredients: "300ml Sushi Rice, 100ml Rice wine, 2 tbs Caster Sugar, 3 tbs Mayonnaise, 1 tbs Rice wine, 1 tbs Soy Sauce1 Cucumber", instructions: "STEP 1 TO MAKE SUSHI ROLLS: Pat out some rice.Lay a nori sheet on the mat, shiny-side down.Dip your hands in the vinegared water, then pat handfuls of rice on top in a 1cm thick layer, leaving the furthest edge from you clear. STEP 2 Spread over some Japanese mayonnaise.Use a spoon to spread out a thin layer of mayonnaise down the middle of the rice. STEP 3 Add the filling.Get your child to top the mayonnaise with a line of their favourite fillings – here we’ve used tuna and cucumber. STEP 4 Roll it up.Lift the edge of the mat over the rice, applying a little pressure to keep everything in a tight roll. STEP 5 Stick down the sides like a stamp.When you get to the edge without any rice, brush with a little water and continue to roll into a tight roll. STEP 6 Wrap in cling film.Remove the mat and roll tightly in cling film before a grown-up cuts the sushi into thick slices, then unravel the cling film. STEP 7 TO MAKE PRESSED SUSHI: Layer over some smoked salmon.Line a loaf tin with cling film, then place a thin layer of smoked salmon inside on top of the cling film. STEP 8 Cover with rice and press down. Press about 3cm of rice over the fish, fold the cling film over and press down as much as you can, using another tin if you have one. STEP 9 Tip it out like a sandcastle.Turn block of sushi onto a chopping board.Get a grown-up to cut into fingers, then remove the cling film. STEP 10 TO MAKE SUSHI BALLS: Choose your topping.Get a small square of cling film and place a topping, like half a prawn or a small piece of smoked salmon, on it. Use damp hands to roll walnut-sized balls of rice and place on the topping. STEP 11 Make into tight balls. Bring the corners of the cling film together and tighten into balls by twisting it up, then unwrap and serve." }],
            categories: [],
            levels: [],
            occasions: []
        }
    },
    mounted: function () {

// -------------------------------------------------------- Categories -------------------------------------------------------- //

        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/categories'
        })
        .then(
            (response) => {
                let categories = response.data;
                categories.forEach((element) => {
                    this.categories.push({ id: element.id, category: element.category });
                });
            }
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Levels -------------------------------------------------------- //

        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/levels'
        })
        .then(
            (response) => {
                let levels = response.data;
                levels.forEach((element) => {
                    this.levels.push({ id: element.id, level: element.level });
                });
            }
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Occasions -------------------------------------------------------- //

        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/occasions'
        })
        .then(
            (response) => {
                let occasions = response.data;
                occasions.forEach((element) => {
                    this.occasions.push({ id: element.id, occasion: element.occasion });
                });
            }
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Recipes -------------------------------------------------------- //

        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/all'
        })
        .then(
            (response) => {
                let recipes = response.data;
                recipes.forEach(element => {
                    this.recipes.push({ 
                        id: element.id,
                        name: element.name,
                        total_time: element.name,
                        image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                        category: element.category,
                        occasion: element.occasion,
                        level: element.level,
                        likes: element.likes
                    });
                });
                this.recent_recipe = this.recipes.slice(-1);
            },
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Top 10 -------------------------------------------------------- //

        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/top10'
        })
        .then(
            (response) => {
                let recipes = response.data;
                recipes.forEach(element => {
                    this.recipes_top.push({ 
                        id: element.id,
                        name: element.name,
                        image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                        description: element.description,
                        category: element.category,
                        occasion: element.occasion,
                        level: element.level,
                        likes: element.likes
                    });
                });
            },
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Selected Recipe -------------------------------------------------------- //

        let id = window.location.search;
        id = id.substring(1);
        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/recipe/'+id
        })
        .then(
            (response) => {

                let ingredient = response.data[1];
                let ingredientsList = "";
                ingredient.forEach(element => {
                    this.ingredientsA.push(`${element.amount} ${element.measurement_unit} ${element.description}`);
                });
                
                ingredientsList = this.ingredientsA.join('|');

                let recipe = response.data[0];
                let instructions = "";
                recipe.forEach(element => {
                    instructions = element.preparation_instructions.replace(/([.,]\s)(Step)/g, "$1|$2");
                    this.selected_recipe.push({ 
                        id: element.id,
                        name: element.name,
                        image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                        description: element.description,
                        category: element.category,
                        preparation_time: element.preparation_time,
                        cooking_time: element.cooking_time,
                        total_time: element.total_time,
                        preparation_instructions: instructions,
                        ingredients: ingredientsList,
                        portions: element.portions,
                        occasion: element.occasion,
                        level: element.level,
                        likes: element.likes
                    });
                });

                let related = response.data[2]
                related.forEach(element => {
                    this.related_recipes.push({ 
                        id: element.id,
                        name: element.name,
                        image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                        description: element.description,
                        category: element.category,
                        occasion: element.occasion,
                        level: element.level,
                        likes: element.likes
                    });
                });
            },
        )
        .catch(
            error => console.log(error)
        );

// -------------------------------------------------------- Search Recipes -------------------------------------------------------- //

        let keyword = window.location.search.slice(3);
        console.log(keyword)
        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/recipes/searchbyname/'+keyword
        })
        .then(
            (response) => {
                let items = response.data;
                items.forEach(element => {
                    this.search_recipes.push({ 
                        id: element.id,
                        name: element.name,
                        total_time: element.name,
                        image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                        category: element.category,
                        occasion: element.occasion,
                        level: element.level,
                        likes: element.likes
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
                            likes: 20,
                            ingredients: "NA",
                            instructions: element.strInstructions
                        });
                    });
                }
            )
            .catch(
                error => console.log(error)
            );
        },


        onClickSelectedCategory(category) {
            axios({
                method: 'get',
                url:'http://foodbook-admin.test/api/recipes/filterby/category/'+category
            })
            .then(
                (response) => {
                    let items = response.data;
                    this.recipes = [];
                    items.forEach(element => {
                        this.recipes.push({ 
                            id: element.id,
                            name: element.name,
                            image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                            description: element.description,
                            category: element.category,
                            occasion: element.occasion,
                            level: element.level,
                            likes: element.likes
                        });
                    });
                }
            )
            .catch(
                error => console.log(error)
            );
        },

        onClickSelectedLevel(level) {
            axios({
                method: 'get',
                url:'http://foodbook-admin.test/api/recipes/filterby/level/'+level
            })
            .then(
                (response) => {
                    let items = response.data;
                    this.recipes = [];
                    items.forEach(element => {
                        this.recipes.push({ 
                            id: element.id,
                            name: element.name,
                            image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                            description: element.description,
                            category: element.category,
                            occasion: element.occasion,
                            level: element.level,
                            likes: element.likes
                        });
                    });
                }
            )
            .catch(
                error => console.log(error)
            );
        },

        onClickSelectedOccasion(occasion) {
            axios({
                method: 'get',
                url:'http://foodbook-admin.test/api/recipes/filterby/occasion/'+occasion
            })
            .then(
                (response) => {
                    let items = response.data;
                    this.recipes = [];
                    items.forEach(element => {
                        this.recipes.push({ 
                            id: element.id,
                            name: element.name,
                            image: "http://foodbook-admin.test/storage/imgs/"+element.image,
                            description: element.description,
                            category: element.category,
                            occasion: element.occasion,
                            level: element.level,
                            likes: element.likes
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