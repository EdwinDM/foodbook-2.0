app.component('recent-recipe', {
    props:{
        image:{
            type: String
        },
        category:{
            type: String,
            default: "Almuerzo"
        },
        occasion:{
            type: String,
            default: "Almuerzo"
        },
        name:{
            type: String
        },
        description:{
            type: String,
            default: "Lorem ipsum dolor sit amet, Fusce rhoncus luctus pellentesque. c viverra finibus, erat ex rutrum dolor, eget dapibus velit urna in nibh. In sodales laoreet lectus. Proin malesuada, est sed fermentum dictum"
        },
        time:{
            type: String
        },
        level:{
            type: String
        },
        likes:{
            type: Number
        },
        id:{
            type: Number
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
                    <a class='lbl category-base' href='#'>{{ occasion }}</a>
                    <a class='lbl facil' href='#'>{{ level }}</a>
                </div>
                <a v-bind:href="'details.html?'+ id" class='btn-green-xl mt-5'>Ver receta</a>
            </div>
        </div>
    </div>`
})