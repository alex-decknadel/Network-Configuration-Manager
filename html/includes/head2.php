	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet" />

	<script src="common/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="common/js/lib.js" type="text/javascript"></script>
	<script src="common/js/updateTime.js" type="text/javascript"></script>

	<script>

		// Load jQuery and other Javascript after page is done loading	
		$( document.body ).ready(function () {

			$( "#mobilenav" ).click(function() {

				$( "#primary" ).slideToggle( "fast", function() {});

			});			

		});

	</script>

</head>
