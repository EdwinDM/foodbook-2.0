app.component('recipe-details', {
    props:{
        image:{
            type: String
        },
        category:{
            type: String,
            default: "recipe category"
        },
        name:{
            type: String,
            default: "recipe name"
        },
        description:{
            type: String,
            default: "recipe description"
        },
        time:{
            type: String,
            default: "recipe time"
        },
        level:{
            type: String,
            default: "recipe level"
        },
        likes:{
            type: Number,
            default: 10
        },
        id:{
            type:String
        }
    },
    methods:{

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
                            <h3 class="details-time me-3">{{ time }}</h3>
                            <h3 class="w-space-line">|</h3>
                            <h3 class="details-time mx-3">{{ time }}</h3>
                            <h3 class="w-space-line">|</h3>
                            <h3 class="details-time ms-3">{{ time }}</h3>
                        </div>
                        <div class="card-likes mt-3">
                            <a type="button" href="#"><i class="fa-solid fa-heart hearth-xl like"></i></a>
                            <h2 class="like-count-xl mt-4">{{ likes }}</h2>
                        </div>
                    </div>
                    <div class="details-labels">
                        <a class="lbl category-base" href="#">{{ category }}</a>
                        <a class='lbl category-base' href='#'>Todas</a>
                        <a class='lbl category-base' href='#'>0 Porciones</a>
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
                        <p class="details-text preparation-text">{{ description }}</p>
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
                        <p class="details-text">
                        <ul>
                            <li>Arroz</li>
                            <li>Tomate</li>
                            <li>Ajo</li>
                            <li>Aceite</li>
                            <li>Sal</li>
                            <li>Achiote</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>`
})