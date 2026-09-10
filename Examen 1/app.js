$(function () {
	var movies = [];
	var selectedDecade = 'all';
	var favoriteKey = 'movieReviewsFavorites';
	var favoriteIds = readFavorites();

	function readFavorites() {
		try {
			return JSON.parse(localStorage.getItem(favoriteKey)) || [];
		} catch (error) {
			return [];
		}
	}

	function saveFavorites() {
		localStorage.setItem(favoriteKey, JSON.stringify(favoriteIds));
		updateFavoriteCount();
		renderFavorites();
		if ($('body').data('page') === 'home') {
			renderMovies();
		}
		if ($('body').data('page') === 'detail') {
			updateDetailFavorite();
		}
	}

	function isFavorite(id) {
		return favoriteIds.indexOf(id) !== -1;
	}

	function updateFavoriteCount() {
		$('#favoriteCount').text(favoriteIds.length);
	}

	function stars(rating) {
		var fullStars = Math.round(rating / 2);
		return Array.from({ length: 5 }, function (_, index) {
			return index < fullStars ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
		}).join('');
	}

	function movieCard(movie) {
		var favoriteClass = isFavorite(movie.id) ? ' is-favorite' : '';
		var favoriteIcon = isFavorite(movie.id) ? 'bi-heart-fill' : 'bi-heart';
		return '<div class="col"><article class="card h-100" data-id="' + movie.id + '">' +
			'<div class="position-relative"><img class="card-img-top" src="' + movie.image + '" alt="Poster de ' + movie.title + '" loading="lazy"><button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle favorite-toggle' + favoriteClass + '" data-id="' + movie.id + '" type="button" aria-label="Guardar ' + movie.title + '"><i class="bi ' + favoriteIcon + '"></i></button></div>' +
			'<div class="card-body"><h3 class="h5 card-title text-truncate">' + movie.title + '</h3><div class="d-flex justify-content-between align-items-center text-secondary small"><span>' + movie.year + '</span><span class="text-warning">' + stars(movie.rating) + '</span></div><div class="d-flex justify-content-between align-items-center gap-2 mt-3"><span class="text-secondary small">' + movie.rating.toFixed(1) + ' / 10</span><a class="link-primary small fw-bold" href="reseña.html?id=' + movie.id + '">Ver reseña <i class="bi bi-arrow-up-right"></i></a></div></div>' +
			'</article></div>';
	}

	function favoriteCard(movie) {
		return '<div class="col"><article class="card h-100 position-relative"><img class="card-img-top" src="' + movie.image + '" alt="Poster de ' + movie.title + '"><button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle favorite-delete" data-id="' + movie.id + '" type="button" aria-label="Eliminar ' + movie.title + '"><i class="bi bi-x-lg"></i></button><div class="card-body"><h3 class="h6 card-title text-truncate">' + movie.title + '</h3><div class="d-flex justify-content-between align-items-center text-secondary small"><span>' + movie.year + '</span><strong class="text-dark">' + movie.rating.toFixed(1) + '</strong></div><div class="text-warning small mt-1">' + stars(movie.rating) + '</div><a class="link-primary small fw-bold d-inline-block mt-2" href="reseña.html?id=' + movie.id + '">Ver detalles <i class="bi bi-arrow-right"></i></a></div></article></div>';
	}

	function renderMovies() {
		var query = ($('#searchInput').val() || '').toLowerCase().trim();
		var filtered = movies.filter(function (movie) {
			var decadeMatch = selectedDecade === 'all' || (movie.year >= Number(selectedDecade) && movie.year <= Number(selectedDecade) + 9);
			return decadeMatch && movie.title.toLowerCase().indexOf(query) !== -1;
		});
		$('#movieGrid').html(filtered.map(movieCard).join('')).toggleClass('d-none', filtered.length === 0);
		$('#emptyState').toggleClass('d-none', filtered.length !== 0);
	}

	function renderFavorites() {
		var favorites = movies.filter(function (movie) { return isFavorite(movie.id); });
		$('#favoritesGrid').html(favorites.map(favoriteCard).join('')).toggleClass('d-none', favorites.length === 0);
		$('#favoritesEmpty').toggleClass('d-none', favorites.length !== 0);
	}

	function loadLocalMovies() {
		return $.getJSON('PELICULAS.json');
	}

	function formatMoney(value) {
		if (typeof value !== 'number') return 'No disponible';
		return '$' + value.toLocaleString('en-US');
	}

	function formatDuration(minutes) {
		if (!minutes) return 'Duracion no disponible';
		var hours = Math.floor(minutes / 60);
		var remainingMinutes = minutes % 60;
		return hours + 'h ' + (remainingMinutes ? remainingMinutes + 'min' : '');
	}

	function normalizeMovies(data) {
		return data.filter(function (movie) {
			return movie.type === 'movie' || !movie.type;
		}).map(function (movie) {
			return {
				id: movie.id,
				title: movie.primaryTitle || movie.originalTitle || 'Sin titulo',
				year: movie.startYear || 0,
				duration: formatDuration(movie.runtimeMinutes),
				rating: Number(movie.averageRating) || 0,
				metascore: Number(movie.metascore) || 0,
				image: movie.primaryImage || (movie.thumbnails && movie.thumbnails[1] ? movie.thumbnails[1].url : ''),
				synopsis: movie.description || 'Esta pelicula no tiene sinopsis disponible.',
				genres: movie.genres || [],
				interests: movie.interests || [],
				languages: movie.spokenLanguages || [],
				countries: movie.countriesOfOrigin || [],
				budget: formatMoney(movie.budget),
				gross: formatMoney(movie.grossWorldwide)
			};
		});
	}

	function loadMovies() {
		var imdbQuery = '{ title(id: "tt0111161") { id titleText { text } releaseYear { year } } }';
		return $.ajax({
			url: 'https://api.graphql.imdb.com/',
			method: 'POST',
			contentType: 'application/json',
			data: JSON.stringify({ query: imdbQuery }),
			timeout: 1800
		}).then(function (response) {
			if (!response || !response.data || !response.data.title) {
				return $.Deferred().reject().promise();
			}
			return loadLocalMovies();
		}).catch(function () {
			return loadLocalMovies();
		});
	}

	function showMovies() {
		loadMovies().done(function (data) {
			movies = normalizeMovies(data);
			$('#loadingState').addClass('d-none');
			$('#movieGrid').removeClass('d-none');
			renderMovies();
			renderFavorites();
			if ($('body').data('page') === 'detail') {
				renderDetail();
			}
		}).fail(function () {
			$('#loadingState').html('<div class="text-center py-5"><i class="bi bi-wifi-off fs-1 text-danger"></i><h3>No pudimos cargar la cartelera</h3><p>Comprueba tu conexion e intenta de nuevo.</p><button class="btn btn-danger" id="reloadMovies" type="button">Reintentar</button></div>');
		});
	}

	function renderDetail() {
		var id = new URLSearchParams(window.location.search).get('id');
		var movie = movies.find(function (item) { return item.id === id; });
		if (!movie) {
			$('#detailLoading').addClass('d-none');
			$('#detailError').removeClass('d-none');
			return;
		}
		var scoreClass = movie.metascore >= 70 ? 'score-green' : movie.metascore >= 50 ? 'score-yellow' : 'score-red';
		var badgeList = movie.genres.concat(movie.interests).map(function (item) { return '<span class="badge text-bg-secondary">' + item + '</span>'; }).join('');
		var favoriteClass = isFavorite(movie.id) ? ' is-favorite' : '';
		var favoriteText = isFavorite(movie.id) ? ' En favoritos' : ' Guardar en favoritos';
		$('#detailContent').html('<div class="row g-4 border-bottom pb-5"><div class="col-md-4 col-lg-3"><img class="img-fluid rounded shadow" src="' + movie.image + '" alt="Poster de ' + movie.title + '"></div><div class="col-md-8 col-lg-9 align-self-end"><span class="text-danger text-uppercase fw-bold small">Reseña destacada</span><h1 class="display-3 fw-bold">' + movie.title + '</h1><p class="text-secondary">' + movie.year + ' &middot; ' + movie.duration + ' &middot; IMDb ' + movie.rating.toFixed(1) + '</p><div class="d-flex flex-wrap gap-3 text-secondary small"><span><i class="bi bi-star-fill text-warning"></i> ' + movie.rating.toFixed(1) + ' / 10</span><span><i class="bi bi-translate"></i> ' + movie.languages.join(', ') + '</span><span><i class="bi bi-geo-alt"></i> ' + movie.countries.join(', ') + '</span></div><button class="btn btn-outline-dark mt-4 detail-favorite' + favoriteClass + '" data-id="' + movie.id + '" type="button"><i class="bi bi-heart-fill"></i>' + favoriteText + '</button></div></div><div class="row g-5 pt-5"><div class="col-lg-8"><h2>La historia</h2><p class="lead text-secondary">' + movie.synopsis + '</p><div class="d-flex flex-wrap gap-2 my-4">' + badgeList + '</div><h2>Por que verla</h2><p class="text-secondary">Una pelicula con una identidad visual poderosa, personajes memorables y una mirada que permanece mucho despues de los creditos.</p></div><aside class="col-lg-4"><dl class="list-group list-group-flush"><div class="list-group-item"><dt>Metascore</dt><dd><strong>' + movie.metascore + ' / 100</strong><div class="progress mt-2"><div class="progress-bar ' + (movie.metascore >= 70 ? 'bg-success' : movie.metascore >= 50 ? 'bg-warning' : 'bg-danger') + '" style="width:' + movie.metascore + '%"></div></div></dd></div><div class="list-group-item"><dt>Presupuesto</dt><dd>' + movie.budget + '</dd></div><div class="list-group-item"><dt>Recaudacion</dt><dd>' + movie.gross + '</dd></div><div class="list-group-item"><dt>Generos</dt><dd>' + movie.genres.join(', ') + '</dd></div></dl></aside></div>');
		$('#detailLoading').addClass('d-none');
		$('#detailContent').removeClass('d-none').hide().fadeIn(500);
	}

	function updateDetailFavorite() {
		var id = new URLSearchParams(window.location.search).get('id');
		var button = $('.detail-favorite');
		if (!button.length || !id) return;
		button.toggleClass('is-favorite', isFavorite(id)).html('<i class="bi bi-heart-fill"></i>' + (isFavorite(id) ? ' En favoritos' : ' Guardar en favoritos'));
	}

	$(document).on('click', '.favorite-toggle, .detail-favorite', function () {
		var id = $(this).data('id');
		favoriteIds = readFavorites();
		if (isFavorite(id)) {
			favoriteIds = favoriteIds.filter(function (favoriteId) { return favoriteId !== id; });
		} else {
			favoriteIds.push(id);
		}
		saveFavorites();
	});

	$(document).on('click', '.favorite-delete', function () {
		favoriteIds = readFavorites().filter(function (id) { return id !== $(this).data('id'); }.bind(this));
		saveFavorites();
	});

	$('#clearFavorites').on('click', function () {
		favoriteIds = [];
		saveFavorites();
	});
	$('#searchInput').on('keyup', renderMovies);
	$('#decadeFilters').on('click', '.filter-btn', function () {
		selectedDecade = $(this).data('decade');
		$('.filter-btn').removeClass('btn-dark active').addClass('btn-outline-dark');
		$(this).removeClass('btn-outline-dark').addClass('btn-dark active');
		renderMovies();
	});
	$('#retryButton').on('click', function () { window.location.reload(); });
	$(document).on('click', '#reloadMovies', function () { window.location.reload(); });
	$(window).on('storage', function (event) {
		if (event.originalEvent.key === favoriteKey) {
			favoriteIds = readFavorites();
			updateFavoriteCount();
			renderFavorites();
			renderMovies();
			updateDetailFavorite();
		}
	});

	updateFavoriteCount();
	showMovies();
});
