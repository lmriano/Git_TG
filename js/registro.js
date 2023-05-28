document.getElementById('form_register').addEventListener('submit', function(e) {    
    e.preventDefault();
    let email = document.getElementById('txt_email').value;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {

        let formulario = new FormData(document.getElementById('form_register'));

        fetch('../php/registro.php', {
                method: 'POST',
                body: formulario
            })
            .then(res => res.json())
            .then(data => {
                if (data === 'true') {
                    document.getElementById('txt_usuario').value = '';
                    document.getElementById('txt_email').value = '';
                    document.getElementById('txt_pass').value = '';
                    alert('El usuario se insertó correctamente');
                    window.location.href = 'login.html';
                } else {
                    console.log(data);
                }
            });
    } else {
        alert('Por favor, ingrese un correo electrónico válido');
    }
});


   