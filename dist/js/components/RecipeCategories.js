app.component('recipe-categories', {
    props:{
        name:{
            type:String
        }
    },
    methods:{

    },
    template:
    /*html*/
    `<a class='dropdown-item' href="#">{{ name }}</a>`
})