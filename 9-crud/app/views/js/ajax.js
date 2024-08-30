const formularios_ajax = document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "¿Estas seguro?",
            text: "Quieres realizar la accion solicitada",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, realizar",
            cancelButtonText: "No, cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Capturando datos en el formulario
                let data = new FormData(this);

                // obteniendo el metodo
                let method = this.getAttribute("method");

                // Obteniendo la ruta
                let action = this.getAttribute("action");

                let headers = new Headers();

                let config = {
                    method: method,
                    headers: headers,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data,
                };

                fetch(action, config)
                    .then(response => response.json())
                    .then(response => {
                        console.log('>>>>', response)
                        return alertas_ajax(response)
                    })
                    .catch(error => console.log('error', error))
            }
        });

    })
});

function alertas_ajax(alert) {
    if (alert.type == 'simple') {
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar',
        });
    }
    else if (alert.type == 'recargar') {
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    }
    else if (alert.type == 'clear') {
        Swal.fire({
            icon: alert.icon,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".FormularioAjax").reset();
            }
        });
    }
    else if (alert.type == 'redirect') {
        window.location.href = alert.url;
    }
}

// Boton para Cerrar la session
let btn_exit = document.getElementById("btn_exit");

btn_exit.addEventListener("click", function (event) {
    event.preventDefault();

    Swal.fire({
        title: "¿Quieres salir del sistema?",
        text: "La session actual se cerrara y saldras del sistema",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, salir",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            // accediendo al href
            let url = this.getAttribute("href");
            window.location.href = url;
        }
    });
});