let modal = document.getElementById("myModal");
let unfriendModal = document.getElementById("unfriendModal");

// Open and close Modals
function openModal(){
    modal.style.display = "block";
}

function closeModal(){
    if(unfriendModal.style.display == 'block'){
        unfriendModal.style.display = "none";
    }
    else{
        modal.style.display = "none";
    }
}

window.onclick = function(event){
    if(event.target === modal){
        modal.style.display = "none";
    }
    else if(event.target === unfriendModal){
        unfriendModal.style.display = "none";
    }
}
