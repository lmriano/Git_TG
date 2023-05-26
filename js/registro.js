document.getElementById('form_register').addEventListener('submit',function(e){
    e.preventDefault();
    let formulario =new FormData(document.getElementById('form_register'));

    fetch('../php/registro.php',{

        method:'POST',
        body:formulario
    })

    .then(res=>res.json())
    .then(data=>{
        if(data=='true'){
            document.getElementById('txt_usuario').value='';
            document.getElementById('txt_email').value='';
            document.getElementById('txt_pass').value='';
            alert('El usuario se insertó correctamente');
        }else{
            console.log(data);
        }
    })

});



   