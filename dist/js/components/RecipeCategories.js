app.component('recipe-categories', {
    props:{
        id:{
            type:Number
        },
        name:{
            type:String
        }
    },
    methods:{
        onClickCategoryButton(){
            console.log(this.id);
            this.$emit('selectedcategory', this.id);
        }
    },
    template:
    /*html*/
    `<a class='dropdown-item' href="index.html#recetas" v-on:click="onClickCategoryButton">{{ name }}</a>`
})