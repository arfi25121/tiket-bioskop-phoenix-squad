function formValidation(){{if(myFunction()){if(showPage()){}}}
return false;}
var myVar;function myFunction(){myVar=setTimeout(showPage,1000);Submit();document.getElementById("load").style.display="block";}
function showPage(){document.getElementById("loader").style.display="block";document.getElementById("load").style.display="block";}