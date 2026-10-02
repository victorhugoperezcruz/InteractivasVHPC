const botonMenu = document.getElementById('boton-menu');
const navegacion = document.getElementById('navegacion');
const botonesFiltro = document.querySelectorAll('.filtro');
const productos = document.querySelectorAll('.producto');
const botonesAgregar = document.querySelectorAll('.agregar');
const favoritos = document.querySelectorAll('.favorito');
const contador = document.getElementById('contador');
const carrito = document.getElementById('carrito');
const formulario = document.getElementById('formulario');
const mensaje = document.getElementById('mensaje');
const buscador = document.getElementById('buscador');
const ordenar = document.getElementById('ordenar');
const listaProductos = document.querySelector('.productos');
const sinResultados = document.getElementById('sin-resultados');
const panelCarrito = document.getElementById('panel-carrito');
const cerrarCarrito = document.getElementById('cerrar-carrito');
const fondoCarrito = document.getElementById('fondo-carrito');
const carritoProductos = document.getElementById('carrito-productos');
const carritoVacio = document.getElementById('carrito-vacio');
const total = document.getElementById('total');
const botonPagar = document.getElementById('boton-pagar');
const aviso = document.getElementById('aviso');
const volverArriba = document.getElementById('volver-arriba');

const productosEnCarrito = [];

botonMenu.addEventListener('click', () => {
  navegacion.classList.toggle('abierto');
});

navegacion.querySelectorAll('a').forEach((enlace) => {
  enlace.addEventListener('click', () => {
    navegacion.classList.remove('abierto');
  });
});

botonesFiltro.forEach((boton) => {
  boton.addEventListener('click', () => {
    botonesFiltro.forEach((filtro) => filtro.classList.remove('activo'));
    boton.classList.add('activo');
    actualizarProductos();
  });
});

botonesAgregar.forEach((boton) => {
  boton.addEventListener('click', () => {
    const producto = boton.closest('.producto');
    const nombre = producto.querySelector('h3').textContent;
    const precio = Number(producto.dataset.precio);
    const existente = productosEnCarrito.find((item) => item.nombre === nombre);

    if (existente) {
      existente.cantidad += 1;
    } else {
      productosEnCarrito.push({ nombre, precio, cantidad: 1 });
    }

    actualizarCarrito();
    mostrarAviso(`${nombre} se agregó al carrito.`);
    boton.textContent = 'Agregado';
    setTimeout(() => {
      boton.textContent = 'Agregar';
    }, 1200);
  });
});

carrito.addEventListener('click', () => {
  abrirCarrito();
});

favoritos.forEach((boton) => {
  boton.addEventListener('click', () => {
    boton.classList.toggle('seleccionado');
    boton.textContent = boton.classList.contains('seleccionado') ? '♥' : '♡';
    mostrarAviso(boton.classList.contains('seleccionado') ? 'Producto guardado en favoritos.' : 'Producto quitado de favoritos.');
  });
});

buscador.addEventListener('input', actualizarProductos);
ordenar.addEventListener('change', () => {
  const productosOrdenados = [...productos].sort((a, b) => {
    const precioA = Number(a.dataset.precio);
    const precioB = Number(b.dataset.precio);
    if (ordenar.value === 'menor') return precioA - precioB;
    if (ordenar.value === 'mayor') return precioB - precioA;
    return 0;
  });
  productosOrdenados.forEach((producto) => listaProductos.appendChild(producto));
  actualizarProductos();
});

function actualizarProductos() {
  const categoriaElegida = document.querySelector('.filtro.activo').dataset.categoria;
  const textoBuscado = buscador.value.toLowerCase().trim();
  let visibles = 0;

  productos.forEach((producto) => {
    const nombre = producto.querySelector('h3').textContent.toLowerCase();
    const categoriaCoincide = categoriaElegida === 'todos' || producto.dataset.categoria === categoriaElegida;
    const textoCoincide = nombre.includes(textoBuscado);
    const mostrarProducto = categoriaCoincide && textoCoincide;
    producto.classList.toggle('oculto', !mostrarProducto);
    if (mostrarProducto) visibles += 1;
  });

  sinResultados.classList.toggle('visible', visibles === 0);
}

function actualizarCarrito() {
  const cantidadTotal = productosEnCarrito.reduce((suma, producto) => suma + producto.cantidad, 0);
  const precioTotal = productosEnCarrito.reduce((suma, producto) => suma + producto.precio * producto.cantidad, 0);
  contador.textContent = cantidadTotal;
  total.textContent = `$${precioTotal.toFixed(2)}`;
  carritoVacio.classList.toggle('oculto', productosEnCarrito.length > 0);
  carritoProductos.innerHTML = '';

  productosEnCarrito.forEach((producto) => {
    const fila = document.createElement('div');
    fila.className = 'item-carrito';
    fila.innerHTML = `<div><strong>${producto.nombre}</strong><span>$${producto.precio.toFixed(2)} cada uno</span></div><div class="controles-cantidad"><button type="button" data-accion="restar">−</button><span>${producto.cantidad}</span><button type="button" data-accion="sumar">+</button><button class="eliminar" type="button" data-accion="eliminar">×</button></div>`;
    fila.querySelectorAll('button').forEach((boton) => {
      boton.addEventListener('click', () => cambiarCantidad(producto.nombre, boton.dataset.accion));
    });
    carritoProductos.appendChild(fila);
  });
}

function cambiarCantidad(nombre, accion) {
  const producto = productosEnCarrito.find((item) => item.nombre === nombre);
  if (!producto) return;
  if (accion === 'sumar') producto.cantidad += 1;
  if (accion === 'restar') producto.cantidad -= 1;
  if (accion === 'eliminar' || producto.cantidad <= 0) {
    productosEnCarrito.splice(productosEnCarrito.indexOf(producto), 1);
  }
  actualizarCarrito();
}

function abrirCarrito() {
  panelCarrito.classList.add('abierto');
  fondoCarrito.classList.add('visible');
  panelCarrito.setAttribute('aria-hidden', 'false');
  carrito.setAttribute('aria-expanded', 'true');
}

function cerrarPanelCarrito() {
  panelCarrito.classList.remove('abierto');
  fondoCarrito.classList.remove('visible');
  panelCarrito.setAttribute('aria-hidden', 'true');
  carrito.setAttribute('aria-expanded', 'false');
}

cerrarCarrito.addEventListener('click', cerrarPanelCarrito);
fondoCarrito.addEventListener('click', cerrarPanelCarrito);

botonPagar.addEventListener('click', () => {
  if (productosEnCarrito.length === 0) {
    mostrarAviso('Agrega un producto antes de continuar.');
    return;
  }
  mostrarAviso('La compra está lista para continuar.');
  cerrarPanelCarrito();
});

function mostrarAviso(texto) {
  aviso.textContent = texto;
  aviso.classList.add('visible');
  setTimeout(() => aviso.classList.remove('visible'), 2500);
}

window.addEventListener('scroll', () => {
  volverArriba.classList.toggle('visible', window.scrollY > 500);
});

volverArriba.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

formulario.addEventListener('submit', (evento) => {
  evento.preventDefault();
  mensaje.textContent = 'Gracias por suscribirte.';
  formulario.reset();
});
