$(document).ready(function () {
    const carrito = {};
    let filtroActual = 'Todos';
    const cartModal = new bootstrap.Modal(document.getElementById('carritoModal'));
    const subModal = new bootstrap.Modal(document.getElementById('suscripcionModal'));
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));

    function mostrarCarrito() {
        let total = 0;
        let cantidadTotal = 0;
        const productos = Object.keys(carrito);

        $('#cartItems').empty();

        if (productos.length === 0) {
            $('#emptyCart').show();
        } else {
            $('#emptyCart').hide();

            $.each(carrito, function (producto, item) {
                const subtotal = item.precio * item.cantidad;
                total += subtotal;
                cantidadTotal += item.cantidad;

                $('#cartItems').append(
                    '<div class="d-flex justify-content-between align-items-center border-bottom py-2">' +
                        '<div><strong>' + producto + '</strong><br>' +
                        '<small class="text-muted">$' + item.precio.toFixed(2) + ' cada uno</small></div>' +
                        '<div class="d-flex align-items-center gap-2">' +
                            '<button class="btn btn-sm btn-outline-secondary btn-minus" data-producto="' + producto + '">-</button>' +
                            '<span>' + item.cantidad + '</span>' +
                            '<button class="btn btn-sm btn-outline-secondary btn-plus" data-producto="' + producto + '">+</button>' +
                        '</div>' +
                    '</div>'
                );
            });
        }

        $('#cartCount').text(cantidadTotal);
        $('#cartTotal').text('$' + total.toFixed(2));
    }

    function filtrarProductos() {
        const texto = $('#inputKeyup').val().toLowerCase();
        const cantidad = texto.length;
        let encontrados = 0;

        $('.product-item').each(function () {
            const nombre = $(this).find('.card-title').text().toLowerCase();
            const etiqueta = $(this).find('.badge').text().trim().toLowerCase();
            const coincide = nombre.includes(texto) &&
                (filtroActual === 'Todos' || etiqueta === filtroActual.toLowerCase());

            $(this).toggle(coincide);
            if (coincide) {
                encontrados++;
            }
        });

        $('#resultadoKeyup').html('Texto: "' + $('#inputKeyup').val() + '" — ' + cantidad + ' caracteres');
        $('#sinResultados').toggleClass('d-none', encontrados > 0);
    }

    $('#inputKeyup').on('keyup', filtrarProductos);

    $('.filtro-producto').on('click', function () {
        filtroActual = $(this).data('filtro');
        $('.filtro-producto').removeClass('active btn-primary').addClass('btn-outline-primary');
        $(this).addClass('active btn-primary').removeClass('btn-outline-primary');
        filtrarProductos();
    });

    $('.btn-add-to-cart').on('click', function (e) {
        e.preventDefault();
        const producto = $(this).data('product');
        const precio = Number($(this).data('price'));

        if (carrito[producto]) {
            carrito[producto].cantidad++;
        } else {
            carrito[producto] = { precio: precio, cantidad: 1 };
        }

        mostrarCarrito();
        cartModal.show();
    });

    $('#cartItems').on('click', '.btn-plus', function () {
        carrito[$(this).data('producto')].cantidad++;
        mostrarCarrito();
    });

    $('#cartItems').on('click', '.btn-minus', function () {
        const producto = $(this).data('producto');
        carrito[producto].cantidad--;

        if (carrito[producto].cantidad === 0) {
            delete carrito[producto];
        }

        mostrarCarrito();
    });

    $('#btnCheckout').on('click', function () {
        if (Object.keys(carrito).length > 0) {
            alert('Compra realizada correctamente.');
            Object.keys(carrito).forEach(function (producto) {
                delete carrito[producto];
            });
            mostrarCarrito();
            cartModal.hide();
        }
    });

    $('#btnSubscribe').on('click', function () {
        const email = $('#emailInput').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email && emailRegex.test(email)) {
            $('#modalEmailSubscription').text(email);
            subModal.show();
            $('#emailInput').val('');
        } else {
            errorModal.show();
        }
    });

    $('a[href^="#"]').on('click', function (e) {
        const target = $($(this).attr('href'));

        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 70
            }, 600);
        }
    });

    mostrarCarrito();
});