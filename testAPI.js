var DivAttaquante = document.getElementById("divPerso1");
DivAttaquante.addEventListener("click",attaque);
DivAttaquante.addEventListener("mouseover",reset);

function attaque(e){
   e.target.innerHTML = "paff";
   fetch('API_attaque.php')
   .then((resp)=>resp.json())
   .then( function(data){
    e.target.innerHTML = "Aie "+data;
}).catch(function(error){
    alert(error);
});

}
function reset(e){
    e.target.innerHTML = "Attaque Moi !";
 }

