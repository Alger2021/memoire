
const tabs = document.querySelectorAll('.tab');

tabs.forEach(tab=>{

tab.addEventListener("click",()=>{
    tabs.forEach(tab=>{
        tab.classList.remove("active");
    })
    const pages = document.querySelectorAll("main .container .page");
    pages.forEach(page=>{
        page.classList.remove("active");
    })
    console.log(tab.dataset.tab);
    const target = document.getElementById(tab.dataset.tab);
    tab.classList.add("active");
    target.classList.add("active");
});
})

// ------------------------------ dropDown Menu

let select = document.querySelector(".dropdown .select");
let span = document.querySelector(".dropdown .select span");
let arrow = document.querySelector(".dropdown .arrow");
let options = document.querySelector(".dropdown ul");
let option = document.querySelectorAll(".dropdown ul li");
let hiddenvalue = document.getElementById("dropdownval");
hiddenvalue.value = option[0].dataset.val;
console.log(option);
select.addEventListener("click",()=>{
    select.classList.toggle("open");
    options.classList.toggle("open-menu");
    arrow.classList.toggle("rotate");
    option.forEach(op => {
        op.addEventListener("click",()=>{
            hiddenvalue.value = op.dataset.val;
            span.textContent = op.textContent;
            select.classList.remove("open");
            options.classList.remove("open-menu");
            arrow.classList.remove("rotate");
            option.forEach(opt => {
                opt.classList.remove("active");
            })
            op.classList.add("active");
        })
    });
})
document.addEventListener("click",(event)=>{
    if(!event.target.closest(".dropdown")){
        options.classList.remove("open-menu");
        select.classList.remove("open");
    }
})


// ----------------------------- input label animation

let inputs = document.querySelectorAll("main .container .data .matriculedata input");
inputs.forEach(input => {
    let placeholder = input.getAttribute("placeholder");

    input.addEventListener("focus",()=>{
        input.setAttribute("placeholder","");
    })

    input.addEventListener("blur",()=>{
        if(input.value === ""){
            input.classList.remove("active");
            input.setAttribute("placeholder",placeholder);
        }
        else{
            input.classList.add("active");
        }
    })

});