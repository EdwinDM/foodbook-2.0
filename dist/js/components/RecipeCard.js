app.component('recipe-card', {
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
        index:{
            type:Number
        }
    },
    methods:{

    },
    template:
    /*html*/
    `<a href='details.html'>
        <div class='card-bg'>
            <img class='card-image' v-bind:src='image'>
            <div class='card-data'>
                <div class='card-info'>
                    <div class='card-text'>
                        <h2 class='card-title'>{{ name }}</h2>
                        <h3 class='card-time'>{{ time }}</h3>
                    </div>
                    <div class='card-likes'>
                        <i class='fa-solid fa-heart hearth'></i>
                        <h2 class='like-count'>{{ likes }}</h2>
                    </div>
                </div>
                <div class='card-labels'>
                    <a class='lbl category-base'>{{ category }}</a>
                    <a class='lbl facil' href='#'>{{ level }}</a>
                </div>
            </div>
        </div>
    </a>`
})