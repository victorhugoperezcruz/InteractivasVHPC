// Configuración e inicialización de las 5 gráficas distintas de ApexCharts (Renderizado en SVG)
// Tipologías: 1. Línea (line), 2. Barras (bar), 3. Área Polar (polarArea), 4. Dona (donut), 5. Radar (radar)
const apexChartInstances = {
	sales: null,
	channels: null,
	polar: null,
	marketShare: null,
	radar: null
};

function getBaseToolbarConfig(filename, enableZoom = true) {
	return {
		show: true,
		offsetX: 0,
		offsetY: 0,
		tools: {
			download: true,
			selection: enableZoom,
			zoom: enableZoom,
			zoomin: enableZoom,
			zoomout: enableZoom,
			pan: enableZoom,
			reset: enableZoom
		},
		export: {
			csv: {
				filename: filename,
				headerCategory: 'Categoría'
			},
			svg: {
				filename: filename
			},
			png: {
				filename: filename
			}
		},
		autoSelected: 'zoom'
	};
}

function getBaseAnimationsConfig() {
	return {
		enabled: true,
		easing: 'easeinout',
		speed: 650,
		animateGradually: {
			enabled: true,
			delay: 100
		},
		dynamicAnimation: {
			enabled: true,
			speed: 450
		}
	};
}

function getBaseLegendConfig(position = 'top') {
	return {
		show: true,
		position: position,
		horizontalAlign: 'center',
		fontSize: '12px',
		fontWeight: 600,
		labels: {
			colors: '#e2e8f0'
		},
		markers: {
			width: 10,
			height: 10,
			radius: 12
		},
		itemMargin: {
			horizontal: 10,
			vertical: 5
		},
		onItemClick: {
			toggleDataSeries: true
		},
		onItemHover: {
			highlightDataSeries: true
		}
	};
}

// 1. Opciones para Gráfica de Línea (Line)
function buildLineApexOptions() {
	const data = window.SHARED_CHART_DATA.sales;

	return {
		chart: {
			id: 'apex-line-sales',
			type: 'line',
			height: '100%',
			width: '100%',
			background: 'transparent',
			foreColor: '#94a3b8',
			fontFamily: 'Inter, system-ui, sans-serif',
			zoom: {
				enabled: true,
				type: 'x',
				autoScaleYaxis: true
			},
			toolbar: getBaseToolbarConfig('apex-linea-ventas', true),
			animations: getBaseAnimationsConfig()
		},
		theme: {
			mode: 'dark'
		},
		colors: data.series.map((s) => s.color),
		series: data.series.map((s) => ({
			name: s.name,
			data: [...s.data]
		})),
		xaxis: {
			categories: [...data.labels],
			axisBorder: { show: false },
			axisTicks: { show: false },
			labels: {
				style: {
					colors: '#94a3b8',
					fontSize: '12px'
				}
			},
			tooltip: { enabled: false }
		},
		yaxis: {
			min: 0,
			labels: {
				style: {
					colors: '#94a3b8',
					fontSize: '12px'
				},
				formatter: (value) => `$${Math.round(value)}k`
			}
		},
		grid: {
			borderColor: 'rgba(148, 163, 184, 0.12)',
			strokeDashArray: 0,
			xaxis: { lines: { show: true } },
			yaxis: { lines: { show: true } },
			padding: { top: 6, right: 12, bottom: 0, left: 8 }
		},
		stroke: {
			show: true,
			curve: 'smooth',
			width: 3
		},
		markers: {
			size: 5,
			strokeColors: '#0f172a',
			strokeWidth: 2,
			hover: {
				size: 7
			}
		},
		dataLabels: {
			enabled: false
		},
		legend: getBaseLegendConfig('top'),
		tooltip: {
			enabled: true,
			shared: true,
			intersect: false,
			theme: 'dark',
			y: {
				formatter: (value) => (typeof value === 'number' ? `$${value.toFixed(1)} k USD` : value)
			}
		}
	};
}

// 2. Opciones para Gráfica de Barras (Bar)
function buildBarApexOptions() {
	const data = window.SHARED_CHART_DATA.channels;

	return {
		chart: {
			id: 'apex-bar-channels',
			type: 'bar',
			height: '100%',
			width: '100%',
			background: 'transparent',
			foreColor: '#94a3b8',
			fontFamily: 'Inter, system-ui, sans-serif',
			toolbar: getBaseToolbarConfig('apex-barras-canales', false),
			animations: getBaseAnimationsConfig()
		},
		theme: {
			mode: 'dark'
		},
		colors: data.series.map((s) => s.color),
		series: data.series.map((s) => ({
			name: s.name,
			data: [...s.data]
		})),
		xaxis: {
			categories: [...data.labels],
			axisBorder: { show: false },
			axisTicks: { show: false },
			labels: {
				style: {
					colors: '#94a3b8',
					fontSize: '12px'
				}
			}
		},
		yaxis: {
			min: 0,
			labels: {
				style: {
					colors: '#94a3b8',
					fontSize: '12px'
				},
				formatter: (value) => `$${Math.round(value)}k`
			}
		},
		grid: {
			borderColor: 'rgba(148, 163, 184, 0.12)',
			strokeDashArray: 0,
			xaxis: { lines: { show: false } },
			yaxis: { lines: { show: true } },
			padding: { top: 6, right: 12, bottom: 0, left: 8 }
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		fill: {
			opacity: 0.88
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '55%',
				borderRadius: 6,
				borderRadiusApplication: 'end'
			}
		},
		dataLabels: {
			enabled: false
		},
		legend: getBaseLegendConfig('top'),
		tooltip: {
			enabled: true,
			shared: true,
			intersect: false,
			theme: 'dark',
			y: {
				formatter: (value) => (typeof value === 'number' ? `$${value.toFixed(1)} k USD` : value)
			}
		}
	};
}

// 3. Opciones para Gráfica de Área Polar (PolarArea)
function buildPolarApexOptions() {
	const polar = window.SHARED_CHART_DATA.polar;

	return {
		chart: {
			id: 'apex-polar-chart',
			type: 'polarArea',
			height: '100%',
			width: '100%',
			background: 'transparent',
			foreColor: '#94a3b8',
			fontFamily: 'Inter, system-ui, sans-serif',
			toolbar: getBaseToolbarConfig('apex-area-polar', false),
			animations: getBaseAnimationsConfig()
		},
		theme: {
			mode: 'dark'
		},
		labels: [...polar.labels],
		series: [...polar.data],
		colors: [...polar.colors],
		stroke: {
			show: true,
			width: 2,
			colors: [...polar.colors]
		},
		fill: {
			opacity: 0.65
		},
		yaxis: {
			show: true,
			labels: {
				style: {
					colors: '#94a3b8',
					fontSize: '10px'
				},
				formatter: (val) => `$${Math.round(val)}M`
			}
		},
		plotOptions: {
			polarArea: {
				rings: {
					strokeWidth: 1,
					strokeColor: 'rgba(148, 163, 184, 0.18)'
				},
				spokes: {
					strokeWidth: 1,
					connectorColors: 'rgba(148, 163, 184, 0.18)'
				}
			}
		},
		legend: getBaseLegendConfig('bottom'),
		tooltip: {
			enabled: true,
			theme: 'dark',
			y: {
				formatter: (value) => `$${value} M USD`
			}
		}
	};
}

// 4. Opciones para Gráfica de Dona (Donut)
function buildDonutApexOptions() {
	const ms = window.SHARED_CHART_DATA.marketShare;

	return {
		chart: {
			id: 'apex-donut-chart',
			type: 'donut',
			height: '100%',
			width: '100%',
			background: 'transparent',
			foreColor: '#94a3b8',
			fontFamily: 'Inter, system-ui, sans-serif',
			toolbar: getBaseToolbarConfig('apex-cuota-mercado', false),
			animations: getBaseAnimationsConfig()
		},
		theme: {
			mode: 'dark'
		},
		labels: [...ms.labels],
		series: [...ms.data],
		colors: [...ms.colors],
		stroke: {
			show: true,
			width: 3,
			colors: ['#0f172a']
		},
		plotOptions: {
			pie: {
				donut: {
					size: '62%',
					labels: {
						show: true,
						name: {
							show: true,
							fontSize: '13px',
							color: '#94a3b8'
						},
						value: {
							show: true,
							fontSize: '20px',
							fontWeight: 700,
							color: '#f8fafc',
							formatter: (val) => `${val}%`
						},
						total: {
							show: true,
							label: 'Participación',
							color: '#94a3b8',
							formatter: (w) => {
								const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
								return `${sum}%`;
							}
						}
					}
				}
			}
		},
		dataLabels: {
			enabled: false
		},
		legend: getBaseLegendConfig('bottom'),
		tooltip: {
			enabled: true,
			theme: 'dark',
			y: {
				formatter: (value) => `${value}% de cuota`
			}
		}
	};
}

// 5. Opciones para Gráfica de Radar (Radar)
function buildRadarApexOptions() {
	const radar = window.SHARED_CHART_DATA.radar;

	return {
		chart: {
			id: 'apex-radar-chart',
			type: 'radar',
			height: '100%',
			width: '100%',
			background: 'transparent',
			foreColor: '#94a3b8',
			fontFamily: 'Inter, system-ui, sans-serif',
			toolbar: getBaseToolbarConfig('apex-desempeno-radar', false),
			animations: getBaseAnimationsConfig()
		},
		theme: {
			mode: 'dark'
		},
		colors: radar.series.map((s) => s.color),
		series: radar.series.map((s) => ({
			name: s.name,
			data: [...s.data]
		})),
		xaxis: {
			categories: [...radar.labels],
			labels: {
				style: {
					colors: ['#e2e8f0', '#e2e8f0', '#e2e8f0', '#e2e8f0', '#e2e8f0', '#e2e8f0'],
					fontSize: '11px',
					fontWeight: 600
				}
			}
		},
		yaxis: {
			min: 40,
			max: 100,
			tickAmount: 3,
			labels: {
				style: {
					colors: '#94a3b8',
					fontSize: '10px'
				}
			}
		},
		stroke: {
			width: 2.5
		},
		fill: {
			opacity: 0.22
		},
		markers: {
			size: 4,
			strokeColors: '#0f172a',
			strokeWidth: 2,
			hover: {
				size: 6
			}
		},
		plotOptions: {
			radar: {
				polygons: {
					strokeColors: 'rgba(148, 163, 184, 0.18)',
					connectorColors: 'rgba(148, 163, 184, 0.18)',
					fill: {
						colors: ['transparent']
					}
				}
			}
		},
		legend: getBaseLegendConfig('top'),
		tooltip: {
			enabled: true,
			shared: true,
			intersect: false,
			theme: 'dark',
			y: {
				formatter: (value) => `${value} pts`
			}
		}
	};
}

function createOrReplaceApex(key, containerId, options) {
	const container = document.getElementById(containerId);
	if (!container || typeof ApexCharts === 'undefined') {
		return null;
	}

	if (apexChartInstances[key]) {
		apexChartInstances[key].destroy();
	}

	apexChartInstances[key] = new ApexCharts(container, options);
	apexChartInstances[key].render();
	return apexChartInstances[key];
}

function initApexChart() {
	if (typeof ApexCharts === 'undefined' || !window.SHARED_CHART_DATA) {
		console.error('No se encontró la librería ApexCharts o los datos compartidos.');
		return null;
	}

	// 1. Gráfica 1: Línea (Line) — Ventas Semestrales
	createOrReplaceApex('sales', 'apexcharts-container-1', buildLineApexOptions());

	// 2. Gráfica 2: Barras (Bar) — Ingresos por Canal Comercial
	createOrReplaceApex('channels', 'apexcharts-container-2', buildBarApexOptions());

	// 3. Gráfica 3: Área Polar (PolarArea) — Inversión por Sector
	createOrReplaceApex('polar', 'apexcharts-container-3', buildPolarApexOptions());

	// 4. Gráfica 4: Dona (Donut) — Cuota de Mercado por Unidad
	createOrReplaceApex('marketShare', 'apexcharts-container-4', buildDonutApexOptions());

	// 5. Gráfica 5: Radar (Radar) — Evaluación Multidimensional de Desempeño
	createOrReplaceApex('radar', 'apexcharts-container-5', buildRadarApexOptions());

	return apexChartInstances;
}

window.initApexChart = initApexChart;
