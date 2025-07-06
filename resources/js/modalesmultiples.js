document.addEventListener("DOMContentLoaded", function () {
    const botones = document.querySelectorAll('[id^="abrirmodal-"]');
    botones.forEach((boton) => {
        boton.addEventListener("click", function () {
            const id = boton.id.replace("abrirmodal-", "modal-");
            const modal = document.getElementById(id);
            if (modal) modal.showModal();
        });
    });

    document.addEventListener("click", function (e) {
        if (e.target.id.startsWith("cerrarmodal-")) {
            const modalId = e.target.id.replace("cerrarmodal-", "");
            const modal = document.getElementById(modalId);
            if (modal) modal.close();
        }
    });
});
