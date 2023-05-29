app.component('recent-recipe', {
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
    `<img class='img-poster' v-bind:src='image'>
    <div class='poster-data '>
        <div class='poster-info justify-content-center'>
            <div class='poster-text'>
                <h2 class='poster-title'>{{ name }}</h2>
                <p class='poster-description mt-3'>{{ description }}</p>
                <p class='poster-time justify-content-start'>{{ time }}</p>
                <div class='poster-labels'>
                    <a class='lbl category-base' href='#'>{{ category }}</a>
                    <a class='lbl facil' href='#'>{{ level }}</a>
                </div>
                <a v-bind:href="'details.html?i='+ id" class='btn-green-xl mt-5'>Ver receta</a>
            </div>
        </div>
    </div>`
})