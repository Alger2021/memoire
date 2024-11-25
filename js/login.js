let show = document.getElementById("show");
let pass = document.getElementById("password");
show.addEventListener("click",()=>{
    if(pass.getAttribute("type")==="password"){
        pass.setAttribute("type","text");
        show.classList.add("show");
    }
    else{
        pass.setAttribute("type","password");
        show.classList.remove("show");
    }
})

let sun = document.getElementById("sun");
let moon = document.getElementById("moon");
let body = document.querySelector("body");
let container = document.querySelector(".containerform");

sun.addEventListener("click",()=>{
    sun.classList.remove("active");
    moon.classList.add("active");
    body.classList.add("light");
    container.classList.add("light");
})
moon.addEventListener("click",()=>{
    moon.classList.remove("active");
    sun.classList.add("active");
    body.classList.remove("light");
    container.classList.remove("light");
})