
$(document).ready(function() {
    
let table = new DataTable('#tablerequest', {
    columnDefs:[
        {
            targets: 7, // Indexes of the columns to disable ordering (0-based)
            orderable: false // Disable ordering
        }
    ],
    layout: {
        topStart: null,
        topEnd: {
            search: {
                placeholder: 'Type search here...',
                text: 'Search: <i class="fa-solid fa-magnifying-glass"></i>'
            }
        },
        bottomStart: {
            info: {
                text: '<span class="paging">_START_ - _END_</span> of _TOTAL_ records'
            }
        },
        topStart: {
            pageLength: {
                text: 'Page length : _MENU_'
            }
        },
        bottomEnd: {
            paging: {
                numbers: false,
                buttons: 3
            }
        }
    }
});
    $('#tablerequest').show();


    let searchinput = document.getElementById("dt-search-0");


    let td = document.querySelectorAll("table#tablerequest tbody td");
    searchinput.addEventListener("input",()=>{
        td.forEach(t => t.classList.remove("highlight"));
        if(searchinput.value!=""){
            td.forEach(t =>{
                if(t.textContent.toLowerCase().includes(searchinput.value.toLowerCase())){
                    t.classList.add("highlight");
                };
            })
        }
    
    });
    searchinput.addEventListener("blur",()=>{
        td.forEach(t => t.classList.remove("highlight"));
    });
    
} );


// ------------------------- delete Row button & Modal 

let deletebtns = document.querySelectorAll("main #tablerequest tbody .fa-trash-can");
let fullname = document.getElementById("modal-row-fullname");
let request_id;
let row;
deletebtns.forEach(deletebtn=>{
    deletebtn.addEventListener("click",()=>{
        row = deletebtn.closest("tr");
        
        request_id = row.dataset.requestId;
        const deletedrowname = row.childNodes[1].textContent;
        const deletedrowsurname = row.childNodes[2].textContent;
        const deletedrowtype = row.childNodes[3].textContent;
        fullname.textContent = `${deletedrowname} ${deletedrowsurname}`;
        const type = document.createElement("span");
        type.textContent = " (" + deletedrowtype + ")";
        fullname.appendChild(type);
    })
})

let modaldeletebtn = document.getElementById("modaldeletebtn");

modaldeletebtn.addEventListener("click",()=>{
    fetch("php/requests/delete_request.php?request_id=" + request_id)
    .then(res=>res.json())
    .then(data=>{
        console.log(data);
        // here i should add notifications based on the returned error code
        
    })
    row.remove();
    const modal = bootstrap.Modal.getInstance(document.getElementById("deleteRequest"));
    modal.hide();
})