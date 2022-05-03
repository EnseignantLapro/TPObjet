var madive = document.getElementById("toto");
madive.addEventListener("click",toto);
madive.innerHTML = "MERCI" ;

function toto(e){
    e.target.innerHTML = "MERCI BEAUCOU";
    
}

