// Configuración e inicialización de las 5 gráficas distintas de Chart.js (Renderizado en HTML5 Canvas)
// Tipologías: 1. Línea (line), 2. Barras (bar), 3. Área Polar (polarArea), 4. Dona (doughnut), 5. Radar (radar)
const chartJSInstances = {
	sales: null,
	channels: null,
	polar: null,
	marketShare: null,
	radar: null
};

function getCommonLegendPlugin(position = 'top') {
	return {
		display: true,
		position: position,
		align: 'center',
		onHover: (event) => {
			if (event?.native?.target) {
				event.native.target.style.cursor = 'pointer';
			}
		},
		onLeave: (event) => {
			if (event?.native?.target) {
				event.native.target.style.cursor = 'default';
			}
		},
		labels: {
			color: '#e2e8f0',
			usePointStyle: true,
			pointStyle: 'circle',
			padding: 16,
			font: {
				family: 'Inter, system-ui, sans-serif',
				size: 12,
				weight: '600'
			}
		}
	};
}

function getCommonTooltipPlugin(unitSuffix, prefix = '$') {
	return {
		enabled: true,
		backgroundColor: 'rgba(15, 23, 42, 0.94)',
		titleColor: '#f8fafc',
		bodyColor: '#cbd5e1',
		borderColor: '#334155',
		borderWidth: 1,
		padding: 12,
		cornerRadius: 8,
		boxPadding: 6,
		usePointStyle: true,
		callbacks: {
			label: (context) => {
				const labelName = context.dataset.label || context.label || '';
				const rawVal = typeof context.parsed === 'object'
					? (context.parsed.y ?? context.parsed.r ?? 0)
					: context.parsed;
				return ` ${labelName}: ${prefix}${Number(rawVal).toFixed(1)} ${unitSuffix}`;
			}
		}
	};
}

function getCartesianScales(prefix = '$', suffix = 'k') {
	return {
		x: {
			grid: {
				color: 'rgba(148, 163, 184, 0.10)',
				drawBorder: false
			},
			ticks: {
				color: '#94a3b8',
				font: {
					family: 'Inter, system-ui, sans-serif',
					size: 12
				}
			}
		},
		y: {
			beginAtZero: true,
			grid: {
				color: 'rgba(148, 163, 184, 0.12)',
				drawBorder: false
			},
			ticks: {
				color: '#94a3b8',
				font: {
					family: 'Inter, system-ui, sans-serif',
					size: 12
				},
				callback: (value) => `${prefix}${value}${suffix}`
			}
		}
	};
}

function createOrReplaceChart(key, canvasId, config) {
	const canvas = document.getElementById(canvasId);
	if (!canvas || typeof Chart === 'undefined') {
		return null;
	}

	if (chartJSInstances[key]) {
		chartJSInstances[key].destroy();
	}

	const ctx = canvas.getContext('2d');
	chartJSInstances[key] = new Chart(ctx, config);
	return chartJSInstances[key];
}

function initChartJS() {
	if (typeof Chart === 'undefined' || !window.SHARED_CHART_DATA) {
		console.error('No se encontró la librería Chart.js o los datos compartidos.');
		return null;
	}

	const data = window.SHARED_CHART_DATA;

	// 1. Gráfica 1: Línea (Line) — Ventas Semestrales
	createOrReplaceChart('sales', 'chartjs-canvas-1', {
		type: 'line',
		data: {
			labels: data.sales.labels,
			datasets: data.sales.series.map((series) => ({
				label: series.name,
				data: [...series.data],
				borderColor: series.color,
				backgroundColor: series.backgroundColor,
				borderWidth: 3,
				fill: false,
				tension: 0.35,
				pointBackgroundColor: series.color,
				pointBorderColor: '#0f172a',
				pointBorderWidth: 2,
				pointRadius: 4,
				pointHoverRadius: 6
			}))
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			interaction: { mode: 'index', intersect: false },
			animation: { duration: 650, easing: 'easeOutQuart' },
			plugins: {
				legend: getCommonLegendPlugin('top'),
				tooltip: getCommonTooltipPlugin('k USD', '$')
			},
			scales: getCartesianScales('$', 'k')
		}
	});

	// 2. Gráfica 2: Barras (Bar) — Ingresos por Canal Comercial
	createOrReplaceChart('channels', 'chartjs-canvas-2', {
		type: 'bar',
		data: {
			labels: data.channels.labels,
			datasets: data.channels.series.map((series) => ({
				label: series.name,
				data: [...series.data],
				borderColor: series.color,
				backgroundColor: series.barBackgroundColor,
				borderWidth: 1.5,
				borderRadius: 6
			}))
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			interaction: { mode: 'index', intersect: false },
			animation: { duration: 650, easing: 'easeOutQuart' },
			plugins: {
				legend: getCommonLegendPlugin('top'),
				tooltip: getCommonTooltipPlugin('k USD', '$')
			},
			scales: getCartesianScales('$', 'k')
		}
	});

	// 3. Gráfica 3: Área Polar (PolarArea) — Inversión por Sector
	createOrReplaceChart('polar', 'chartjs-canvas-3', {
		type: 'polarArea',
		data: {
			labels: [...data.polar.labels],
			datasets: [
				{
					label: 'Inversión',
					data: [...data.polar.data],
					backgroundColor: [...data.polar.bgColors],
					borderColor: [...data.polar.colors],
					borderWidth: 2
				}
			]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			animation: { duration: 650, easing: 'easeOutQuart' },
			plugins: {
				legend: getCommonLegendPlugin('bottom'),
				tooltip: getCommonTooltipPlugin('M USD', '$')
			},
			scales: {
				r: {
					beginAtZero: true,
					ticks: {
						stepSize: 10,
						color: '#94a3b8',
						backdropColor: 'transparent',
						font: { size: 10 }
					},
					grid: {
						color: 'rgba(148, 163, 184, 0.18)'
					}
				}
			}
		}
	});

	// 4. Gráfica 4: Dona (Doughnut) — Cuota de Mercado por Unidad
	createOrReplaceChart('marketShare', 'chartjs-canvas-4', {
		type: 'doughnut',
		data: {
			labels: [...data.marketShare.labels],
			datasets: [
				{
					label: 'Cuota de Mercado',
					data: [...data.marketShare.data],
					backgroundColor: [...data.marketShare.colors],
					borderColor: '#0f172a',
					borderWidth: 3,
					hoverOffset: 8
				}
			]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			cutout: '62%',
			animation: { duration: 650, easing: 'easeOutQuart' },
			plugins: {
				legend: getCommonLegendPlugin('bottom'),
				tooltip: getCommonTooltipPlugin('%', '')
			}
		}
	});

	// 5. Gráfica 5: Radar (Radar) — Evaluación Multidimensional de Desempeño
	createOrReplaceChart('radar', 'chartjs-canvas-5', {
		type: 'radar',
		data: {
			labels: [...data.radar.labels],
			datasets: data.radar.series.map((series) => ({
				label: series.name,
				data: [...series.data],
				borderColor: series.color,
				backgroundColor: series.backgroundColor,
				borderWidth: 2.5,
				pointBackgroundColor: series.color,
				pointBorderColor: '#0f172a',
				pointBorderWidth: 2,
				pointRadius: 4,
				pointHoverRadius: 6
			}))
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			interaction: { mode: 'index', intersect: false },
			animation: { duration: 650, easing: 'easeOutQuart' },
			plugins: {
				legend: getCommonLegendPlugin('top'),
				tooltip: getCommonTooltipPlugin('pts', '')
			},
			scales: {
				r: {
					min: 40,
					max: 100,
					ticks: {
						stepSize: 20,
						color: '#94a3b8',
						backdropColor: 'transparent',
						font: { size: 10 }
					},
					grid: {
						color: 'rgba(148, 163, 184, 0.18)'
					},
					angleLines: {
						color: 'rgba(148, 163, 184, 0.18)'
					},
					pointLabels: {
						color: '#e2e8f0',
						font: {
							family: 'Inter, system-ui, sans-serif',
							size: 11,
							weight: '600'
						}
					}
				}
			}
		}
	});

	return chartJSInstances;
}

window.initChartJS = initChartJS;
