document.getElementById('form_login').addEventListener('submit', function(e) {    
    e.preventDefault();
    let email = document.getElementById('txt_email').value;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailRegex.test(email)) {

        let formulario = new FormData(document.getElementById('form_login'));

        fetch('../php/login.php', {
                method: 'POST',
                body: formulario
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data === 'true') {
                    window.location.href = '../Interfaz/configuracion.html';
                } else {
                    console.log(data);
                }
            });
    } else {
        alert('Por favor, ingresa un correo electrónico válido');
    }
});


   