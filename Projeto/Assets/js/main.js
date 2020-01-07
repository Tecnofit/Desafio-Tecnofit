  window.onload = function(){
  	var botoesAtivar = document.getElementsByName("ativar");
  	for (i = 0; i < botoesAtivar.length; i++){
  		botoesAtivar[i].onclick = function(){
  			document.getElementById("ativarModal").value = this.value;
  		}
  	}
  }