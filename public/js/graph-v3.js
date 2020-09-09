window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: true, // change to true		
	title:{
		text: "Statistika Nilai Siswa"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "spline",
		dataPoints: [
			{ label: "UTS 1",  y: 2.40  },
			{ label: "UAS 1", y: 3.0  },
			{ label: "UTS 2", y: 1.5  },
			{ label: "UAS 2",  y: 4  },
			{ label: "UTS 3",  y: 4  },
			{ label: "UAS 3",  y: 2.0  }
		]
	}
	]
});
chart.render();

}