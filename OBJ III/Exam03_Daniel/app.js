// Constantes

const nombre = document.getElementById("nombre")
const email = document.getElementById("email")
const telefono = document.getElementById("telefono")
const estado = document.getElementById("estado")
const contrasena = document.getElementById("contrasena")
const parrafo = document.getElementById("warnings")
const form = document.getElementById("form")

form.addEventListener("submit", e=>{
    e.preventDefault()
    let entrar = false
    let warnings = ""
    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    parrafo.innerHTML = ""

    // Validaciones

    if(nombre.value.length <6){
        warnings += `Nombre no valido <br>`
        entrar = true
    }
    
    if(!regexEmail.test(email.value)){
        warnings += `Correo Electronico no valido <br>`
        entrar = true
    }

    if(telefono.value.length <9){
        warnings += `Telefono no valido <br>`
        entrar = true
    }

    if(estado.value.length <5){
        warnings += `Estado Civil no valido <br>`
        entrar = true
    }

    if(contrasena.value.length <8){
        warnings += `Contraseña no valida - Debe de tener mas de 8 Caracteres`
        entrar = true
    }

    if(entrar){
        parrafo.innerHTML = warnings
    }
    else{
        parrafo.innerHTML = "Registro Completado"
    }
})