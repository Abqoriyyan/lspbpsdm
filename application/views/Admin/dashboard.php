<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
    $dataPoints = array( 
        array("label"=>"Tinjau Permohonan", "y" => $report_dashboard_admin->tinjau_permohonan),
        array("label"=>"Invoice Ditagihkan", "y"=> $report_dashboard_admin->invoice_ditagihkan),
        array("label"=>"Belum Penunjukan Asesor", "y" => $report_dashboard_admin->belum_penunjukan_asesor),
        array("label"=>"Asesmen", "y" => $report_dashboard_admin->asesmen),
        array("label"=>"Penetapan Komite", "y" => $report_dashboard_admin->penetapan_komite),
        array("label"=>"Qualitiy Check", "y" => $report_dashboard_admin->quality_check),
        array("label"=>"Sertifikat Terbit", "y" => $report_dashboard_admin->sertifikat_terbit)
    )
    ?>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</body>
</html>


<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Akumulasi Proses Sertifikasi"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		// yValueFormatString: "#,##0.00\"%\"",
		yValueFormatString: "",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>