document.addEventListener('DOMContentLoaded', function() {

    let filtroActual = 'Todos';

    function filtrarProductos() {
        const texto = $('#inputKeyup').val();
        const cantidad = texto.length;
        let encontrados = 0;

        $('.product-item').each(function() {
            const nombreProducto = $(this).find('.card-title').text().toLowerCase();
            const etiqueta = $(this).find('.badge').text().trim().toLowerCase();
            const coincideBusqueda = nombreProducto.includes(texto.toLowerCase());
            const coincideFiltro = filtroActual === 'Todos' || etiqueta === filtroActual.toLowerCase();
            const coincide = coincideBusqueda && coincideFiltro;

            $(this).toggle(coincide);
            if (coincide) {
                encontrados++;
            }
        });

        $('#resultadoKeyup').html('Texto: "' + texto + '" — ' + cantidad + ' caracteres');
        $('#sinResultados').toggleClass('d-none', encontrados > 0);
    }

    $('#inputKeyup').on('keyup', filtrarProductos);

    $('.filtro-producto').on('click', function() {
        filtroActual = $(this).data('filtro');
        $('.filtro-producto').removeClass('active btn-primary').addClass('btn-outline-primary');
        $(this).addClass('active btn-primary').removeClass('btn-outline-primary');
        filtrarProductos();
    });
    
    console.log('Landing page de tienda cargada (JS Puro)');

    // Instancias de los modales Bootstrap
    const cartModal = new bootstrap.Modal(document.getElementById('carritoModal'));
    const subModal = new bootstrap.Modal(document.getElementById('suscripcionModal'));
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));

    // BOTONES DE AÑADIR AL CARRITO =====
    const addButtons = document.querySelectorAll('.btn-add-to-cart');
    
    addButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Obtener datos del producto
            const product = this.getAttribute('data-product');
            const price = this.getAttribute('data-price');
            
            // Actualizar modal
            document.getElementById('modalProductName').textContent = product;
            document.getElementById('modalProductPrice').textContent = '$' + price;
            
            // Mostrar modal
            cartModal.show();
        });
    });

    // BOTÓN DE SUSCRIPCIÓN =====
    const subscribeBtn = document.getElementById('btnSubscribe');
    const emailInput = document.getElementById('emailInput');
    
    subscribeBtn.addEventListener('click', function() {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && emailRegex.test(email)) {
            document.getElementById('modalEmailSubscription').textContent = email;
            subModal.show();
            emailInput.value = '';
        } else {
            errorModal.show();
        }
    });

    // SCROLL SUAVE PARA ENLACES DEL NAVBAR =====
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            
            if (target) {
                e.preventDefault();
                const targetPosition = target.offsetTop - 70;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // EVENTOS DE CIERRE DE MODALES =====
    document.getElementById('carritoModal').addEventListener('hidden.bs.modal', function() {
        console.log('Modal de carrito cerrado (JS Puro)');
    });

    document.getElementById('suscripcionModal').addEventListener('hidden.bs.modal', function() {
        console.log('Modal de suscripción cerrado (JS Puro)');
    });

    console.log('Todos los modales están listos (JS Puro)');
});