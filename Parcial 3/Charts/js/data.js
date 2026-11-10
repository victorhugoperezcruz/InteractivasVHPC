// Datos estáticos compartidos para las 5 comparativas Chart.js (Canvas) vs ApexCharts (SVG).
// Tipologías: 1. Línea, 2. Barras, 3. Área Polar, 4. Dona y 5. Radar.
const SHARED_CHART_DATA = {
	months: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],

	// 1. Gráfica de Línea (Line): Evolución de Ventas Semestrales
	sales: {
		unit: 'k USD',
		labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
		series: [
			{
				name: 'Ventas 2025',
				data: [48.5, 56.2, 52.8, 68.4, 74.1, 82.6],
				color: '#38bdf8',
				backgroundColor: 'rgba(56, 189, 248, 0.20)'
			},
			{
				name: 'Ventas 2026',
				data: [62.0, 71.5, 69.3, 88.9, 95.4, 112.0],
				color: '#34d399',
				backgroundColor: 'rgba(52, 211, 153, 0.20)'
			}
		]
	},

	// 2. Gráfica de Barras (Bar): Facturación por Canal Comercial
	channels: {
		unit: 'k USD',
		labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
		series: [
			{
				name: 'E-Commerce Digital',
				data: [31.0, 38.4, 42.1, 49.5, 55.2, 64.0],
				color: '#818cf8',
				barBackgroundColor: 'rgba(129, 140, 248, 0.85)'
			},
			{
				name: 'Sucursales Retail',
				data: [27.5, 29.8, 31.2, 34.0, 36.8, 41.5],
				color: '#f472b6',
				barBackgroundColor: 'rgba(244, 114, 182, 0.85)'
			}
		]
	},

	// 3. Gráfica de Área Polar (Polar Area): Presupuesto de Inversión por Sector
	polar: {
		unit: 'M USD',
		labels: [
			'Infraestructura Cloud',
			'I+D Inteligencia Artificial',
			'Ciberseguridad Zero-Trust',
			'Automatización DevOps',
			'Analítica de Datos'
		],
		data: [42, 38, 29, 24, 33],
		colors: ['#2dd4bf', '#a78bfa', '#38bdf8', '#f472b6', '#fb923c'],
		bgColors: [
			'rgba(45, 212, 191, 0.65)',
			'rgba(167, 139, 250, 0.65)',
			'rgba(56, 189, 248, 0.65)',
			'rgba(244, 114, 182, 0.65)',
			'rgba(251, 146, 60, 0.65)'
		]
	},

	// 4. Gráfica de Dona (Doughnut / Donut): Cuota de Mercado por Unidad de Negocio
	marketShare: {
		unit: '%',
		labels: ['Cloud SaaS', 'IA & Datos', 'Ciberseguridad', 'Consultoría TI', 'IoT Industrial'],
		data: [34, 26, 18, 13, 9],
		colors: ['#38bdf8', '#34d399', '#818cf8', '#f472b6', '#fb923c']
	},

	// 5. Gráfica de Radar (Radar): Desempeño Técnico y Operativo Multidimensional
	radar: {
		unit: 'pts',
		labels: ['Velocidad', 'Escalabilidad', 'Conversión', 'Retención', 'Disponibilidad', 'Satisfacción'],
		series: [
			{
				name: 'Desempeño 2025',
				data: [72, 68, 75, 70, 84, 78],
				color: '#38bdf8',
				backgroundColor: 'rgba(56, 189, 248, 0.22)'
			},
			{
				name: 'Desempeño 2026',
				data: [88, 85, 82, 89, 95, 91],
				color: '#34d399',
				backgroundColor: 'rgba(52, 211, 153, 0.22)'
			}
		]
	}
};

window.SHARED_CHART_DATA = SHARED_CHART_DATA;
