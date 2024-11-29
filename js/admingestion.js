let lis = document.querySelectorAll("#managementul li");
let pages = document.querySelectorAll(".parent .output .page");
lis.forEach(li=>{
    li.addEventListener("click",()=>{
        lis.forEach(cli=>{
            cli.classList.remove("active");
        })
        pages.forEach(page=>{
            page.classList.remove("active");
        })
        li.classList.add("active");
        let target = document.getElementById(li.dataset.page);
        target.classList.add("active");
    })
})