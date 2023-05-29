app.component('recipe-categories', {
    props:{
        name:{
            type:String
        }
    },
    methods:{
        onClickCategoryButton(){
            console.log(this.name);
            this.$emit('selectedcategory', this.name);
        }
    },
    template:
    /*html*/
    `<a class='dropdown-item' href="#recetas" v-on:click="onClickCategoryButton">{{ name }}</a>`
})