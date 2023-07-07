const app = Vue.createApp({
    data() {
        return {
            //Users
            name: "",
            username: "",
            country: "",
            email: "",
            password: "",
            recoverPass: "",
            online: false,
            //Users

            //Sesion Iniciada
            logid: "",
            logusername: "",
            logemail:"",
            logname:"",
            //Sesion Iniciada
            
            //Recetas
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
            liked_recipes: [],
            categories: [],
            levels: [],
            occasions: []
            //Recetas
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

// -------------------------------------------------------- Liked Recipe -------------------------------------------------------- //

        let userId = localStorage.getItem('id');
        axios({
            method: 'get',
            url: 'http://foodbook-admin.test/api/users/savedrecipes/'+userId
        })
        .then(
            (response) => {
                let recipes = response.data;
                recipes.forEach(element => {
                    this.liked_recipes.push({ 
                        id: element.id,
                        name: element.name,
                        image: "http://foodbook-admin.test/storage/imgs/"+element.image,
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

        let token = localStorage.getItem('token');
        if (token) {
            this.online = true;
            this.logid = localStorage.getItem('id');
            this.logname = localStorage.getItem('name');
            this.logemail = localStorage.getItem('email');
            this.logusername = localStorage.getItem('username');
            console.log(localStorage.getItem('id'));
            console.log(localStorage.getItem('name'));
            console.log(localStorage.getItem('email'));
            console.log(localStorage.getItem('username'));
        } else {
            this.online = false;
        }

    },
    methods: {
        onClickRecipeLike(index) {
            let id = window.location.search;
            idrecipe = id.substring(1)
            let logid = localStorage.getItem('id');
            
            axios({
                method: 'get',
                url:'http://foodbook-admin.test/api/users/likes/' +logid+ '/' +idrecipe
            })
            .then(
                (response) => {
                    let session = response.data;
                    console.log(session);
                }
            )

            axios({
                method: 'get',
                url:'http://foodbook-admin.test/api/users/saverecipe/' +logid+ '/' +idrecipe
               })
            .then(
                (response) => {
                    let session = response.data;
                    console.log(session);
                }
            )
            this.selected_recipe[index].likes += 1;
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
        },

        //--------------------------------------Registrar un Usuario--------------------------------------\\

        onClickRegister(){ 
            localStorage.removeItem('token');
            localStorage.removeItem('id');
            localStorage.removeItem('name');
            localStorage.removeItem('username');
            localStorage.removeItem('email');
            localStorage.removeItem('country');

            let userData = {name: this.name, last_name: this.username, country: this.country, email: this.email, password: this.password};
            
            axios.post('http://foodbook-admin.test/api/users/register', userData)
            .then(response => {
                window.location.href = 'http://localhost/foodbook-2.0/dist/login.html';
                console.log('Respuesta del Servidor:', response.data);
            })
            .catch(error => {
                console.error('Error al enviar la solicitud:', error);
            });
        },

        onClickLogin(){
            localStorage.removeItem('token');
            localStorage.removeItem('id');
            localStorage.removeItem('name');
            localStorage.removeItem('username');
            localStorage.removeItem('email');
            localStorage.removeItem('country');

            axios({
                method: 'post',
                url:'http://foodbook-admin.test/api/users/login?email='+this.email + '&password=' +this.password,
            })
            .then(
                (response) => {
                    let session = response.data;

                    localStorage.setItem('token', session.accessToken);
                    localStorage.setItem('id', session.user.id);
                    localStorage.setItem('name', session.user.name);
                    localStorage.setItem('username', session.user.last_name);
                    localStorage.setItem('email', session.user.email);
                    localStorage.setItem('country', session.user.country);
                    console.log('Respuesta del Servidor:', response.data);
                    window.location.href = 'http://localhost/foodbook-2.0/dist/user.html';
                }
            )
            .catch(error => {
                console.error('Error al enviar la solicitud:', error);
            });
        },

        onClickLogout(){
            localStorage.removeItem('token');
            localStorage.removeItem('id');
            localStorage.removeItem('name');
            localStorage.removeItem('email');
            localStorage.removeItem('username');

            let token = localStorage.getItem('token');
            axios({
                method: 'get',
                url: 'http://foodbook-admin.test/api/users/logout',
                headers: {Authorization: `Bearer ${token}`}
            })
            .then(
                (response) => {
                    let session = response.data;
                    localStorage.removeItem('token');
                    localStorage.removeItem('id');
                    localStorage.removeItem('name');
                    localStorage.removeItem('email');
                    localStorage.removeItem('username');
                }
            )
        },

        onClickRecover(){
            axios({
                method: 'post',
                url:'http://foodbook-admin.test/api/users/recoverpassword?email='+this.email,
            })
            .then(
                (response) => {
                    console.log('Respuesta del Servidor:', response.data.password);
                    this.recoverPass = response.data.password;
                }
            )
            .catch(error => {
                console.error('Error al enviar la solicitud:', error);
            });
        },
    }
})

const emitter = mitt();
app.config.globalProperties.$test = emitter;