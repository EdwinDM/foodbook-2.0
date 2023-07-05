app.component('recipe-details', {
    props:{
        name: {
            type: String
        },
        image: {
            type: String
        },
        description: {
            type: String
        },
        category: {
            type: String
        },
        preparation_time: {
            type: Number
        },
        cooking_time: {
            type: Number
        },
        total_time: {
            type: Number
        },
        preparation_instructions: {
            type: String
        },
        ingredients:{
            type: String,
        },
        portions: {
            type: Number
        },
        occasion: {
            type: String
        },
        level: {
            type: String
        },
        likes: {
            type: Number
        },      
        index:{
            type: Number
        }
    },
    computed: {
        showIngredients() {
            let formatted = this.ingredients.split("|");
            return formatted;
        },
        showInstructions() {
            let formatted = this.preparation_instructions.split("|"); //divide las instrucciones por los asteriscos
            return formatted;
        }
    },
    methods: {
        onClickLike(){
            this.$emit('recipelike', this.index);
        },
    },
    template:
    /*html*/
    `<div class="data-container col-5 d-flex justify-content-center align-items-center">
        <div class="details-card">
            <h2 class="title-mdxl2 text-white text-center">{{ name }}</h2>
            <div class="details-card-bg mt-4">
                <img class='details-image' v-bind:src='image'>
                <div class="details-data">
                    <div class="details-info">
                        <div class="details-text d-flex align-items-center h-100">
                            <h3 class="details-time me-3">Prep: {{ preparation_time }} min</h3>
                            <h3 class="w-space-line">|</h3>
                            <h3 class="details-time mx-3">Cook: {{ cooking_time }} min</h3>
                            <h3 class="w-space-line">|</h3>
                            <h3 class="details-time ms-3">Total: {{ total_time }} min</h3>
                        </div>
                        <div class="card-likes mt-3">
                            <a type="button" v-on:click="onClickLike()"><i class="fa-solid fa-heart hearth-xl like"></i></a>
                            <h2 class="like-count-xl mt-4">{{ likes }}</h2>
                        </div>
                    </div>
                    <div class="details-labels">
                        <a class="lbl category-base" href="#">{{ category }}</a>
                        <a class='lbl category-base' href='#'>{{ occasion }}</a>
                        <a class='lbl category-base' href='#'>{{ portions }} pcs</a>
                        <a class="lbl facil" href="#">{{ level }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-4 details-data-container">
        <div class="container-details h-100 d-flex justify-content-center align-items-center">
            <div class="div-100">
                <div class="d-flex">
                    <div class="description-text-container preparation w-100 h-50">
                        <h2 class="title-md1">Descripción</h2>
                        <p class="details-text">{{ description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md d-flex justify-content-center align-items-center mt-4 details-data-container">
        <div class="container-details w-100 h-100 d-flex justify-content-center align-items-start">
            <div>
                <div class="d-flex w-100 h-50">
                    <div class="text-container description w-100">
                        <h2 class="title-md1">Preparación</h2>
                        <p v-for="(instruction, index) in showInstructions" class="details-text preparation-text"><!--{{index + 1}}.--> {{ instruction }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md d-flex justify-content-center align-items-center mt-4 details-data-container">
        <div class="container-details w-100 h-100 d-flex justify-content-start align-items-start">
            <div>
                <div class="d-flex w-100 h-50">
                    <div class="text-container ingredients">
                        <h2 class="title-md1">Ingredientes</h2>
                        <p v-for="ingredient in showIngredients" class="details-text">- {{ ingredient }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>`
})