function EnviaPost(conf, destino, id){
    if(conf == 0 ? true : (confirm("Confirma essa ação?"))){
        frmAdmin.id.value = id;
        frmAdmin.action = destino + '.php';
        frmAdmin.submit(); 
    }
}


