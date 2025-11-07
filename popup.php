<input type="checkbox" id="modal-toggle" class="modal-toggle">

<div id="modal" class="modal">
    <div class="modal-content">
        <label for="modal-toggle" class="close-button">X</label>
        <a href="<?php echo $PhoneRef;?>" target="_blank">
            <img src="assets/img/modal.png" alt="Logo" class="logo">
        </a>
    </div>
</div>
<style>
/* Ocultar checkbox */
.modal-toggle {
    display: none;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Mostrar el modal si el checkbox está marcado */
.modal-toggle:checked~.modal {
    display: flex;
}

.modal-content {
    background-color: white;
    padding-top: 40px;
    border-radius: 10px;
    text-align: center;
    position: relative;
    max-width: 600px;
}
.modal .modal-content img{
    width: 100%;
}
.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
    text-decoration: none;
    color: black;
    transition: .3s all;
}
.button-modal{
    position: absolute;
    bottom: 1rem;
    right: 4.5rem;
    width: 200px;
    border-radius: .3rem;
    padding: .5rem;
}
.close-button:hover {
    color: #0084d4;
}

.logo {
    border-radius: 0 0 10px 10px;
}
</style>
<script>

window.addEventListener('load', function() {
    document.getElementById('modal-toggle').checked = true;
});

</script>