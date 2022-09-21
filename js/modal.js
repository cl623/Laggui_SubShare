// Open and close Modals
function openModal(){
    document.getElementById("myModal").style.display = "block";

}

function closeModal(){
    document.getElementById("myModal").style.display = "none"
}

window.onclick = function(event){
    if(event.target === modal){
        modal.style.display = "none";
    }
}
