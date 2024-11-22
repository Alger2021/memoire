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