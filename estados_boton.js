const selectsArray = document.querySelectorAll('#Cambiar_estados_boton select');


function HabilitaParteForm(){

    document.getElementById('vbtn-radio1').checked=false;
    document.getElementById('vbtn-radio2').checked=true;
   


}

function HabilitaParteForm2(){

    document.getElementById('vbtn-radio1').checked=true;
    document.getElementById('vbtn-radio2').checked=false;


}





const ValidaSelects = (e) => {
    switch (e.target.name){

        case "radio1":
            if(e.target.value ==="Activo"){
                HabilitaParteForm2();
            }

        break;
        
        case "radio2":
            if(e.target.value ==="Inactivo"){
                HabilitaParteForm();
            }

        break;
               
    }
}

selectsArray.forEach((select) => {
    select.addEventListener('keyup', ValidaSelects);
    select.addEventListener('click', ValidaSelects);
});



//function Habilitar(){

  //  var camp1 = document.getElementById('lista1');
   // var camp2 = document.getElementById();
   // var camp3 = document.getElementById();
   // var camp4 = document.getElementById();

   // if(camp1.value === "SI"){

     //   HabilitaParteForm();
       // select = 'lista2'.disabled=true;
   // }

//}
