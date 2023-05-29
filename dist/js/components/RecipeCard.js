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
            type:String
        }
    },
    methods:{
        onClickLike(){ //Los metodos personalizados debe crearse en los botones que generarán la acción
            console.log("LIKE");
            this.$emit('recipelike', this.index); //De esta manera creamos un metodo personalizado, el cual es generado en el botón correspondiente a este metodo, para posteriormetne ser escuchao por el componente padre el cual ejecutará acciones en base a este metodo eprsonalizado
        },
        onClickUnlike(){
            console.log("UNLIKE");
            this.$emit('recipeunlike', this.index);
        },
        onClickViewRecipe(){
            console.log("VIEW RECIPE");
            this.$emit('recipedetails', this.index);
            //this.$test.emit('foo', "Works!"); //Llamamos a la variable global y accedemos a el metodo emit que se hereda de el objeto almacenado en la variable (por la librería), funciona como un $emit, de esta forma creamos un metodo personalizado el cual no necesita ser escuchado por el componente padre
        }
    },
    template:
    /*html*/
    `<div class="card p-3">
    <img v-bind:src="image" class="card-img-top rounded" alt="featured recipe">
    <div class="card-body p-0">
        <p class="mt-2">{{ category }}</p>
        <h5 class="card-title">{{ name }}</h5>
        <p class="card-text text-truncate">{{ description }}</p>
        <p>{{ time }}</p>
        <p>{{ level }}</p>
        <p>{{ likes }}</p>
        <button class="btn btn-danger" v-on:click="onClickLike()">Like</button>
        <button class="btn btn-success" v-on:click="onClickUnlike()">Unlike</button>
        <button class="btn btn-primary" v-on:click="onClickViewRecipe()" data-bs-toggle="modal" data-bs-target="#staticBackdrop">View Recipe</button>
    </div>
</div>`
})