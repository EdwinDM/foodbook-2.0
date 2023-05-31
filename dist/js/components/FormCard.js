app.component('form-card', {
    props:{
        title:{
            type: String
        },
        user:{
            type: String
        },
        pass:{
            type: String
        },
        advice1:{
            type: String
        },
        advice2:{
            type: String
        },
        link: {
            type:String
        }
    },
    template:
    /*html*/
    `<h2 class="text-center title-mdxl3 text-black mtl mv-title mt-mv2">{{ title }}</h2>
    <div class="d-flex justify-content-center mt-4">
        <input type="text" class="text-input text-center d-flex" v-bind:placeholder='user' />
    </div>
    <div class="d-flex justify-content-center mt-4">
        <input type="password" class="text-input text-center d-flex" v-bind:placeholder='pass' />
    </div>
    <div class="d-flex justify-content-center mt-3 mobile-version mt-mv1">
        <input class="btn-base btn-green" type="submit" value="Iniciar Sesión">
    </div>
    <h3 class="forms-link text-center mt-4 forms-link-mv mt-mv3">{{ advice1 }}</h3>
    <div class="d-flex justify-content-center mt-1 mobile-version forms-link-mv">
        <a class="forms-link forms-link-hl" v-bind:href="link">{{ advice2 }}</a>
    </div>`
})