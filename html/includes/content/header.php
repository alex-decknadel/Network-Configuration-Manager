<header class="outerwrap">
		
	<div class="innerwrap">

		<?php 
			if (isset($_SESSION['adminType'])) 
			{
				switch ($_SESSION['adminType']) 
				{
					case 'Head Admin':
						require 'headerContent/headAdmin.php';
						break;
					
					case 'Site Admin':
						require 'headerContent/siteAdmin.php';
						break;
					default:
						require 'headerContent/noHeader.php';
				}
			}
			else
			{
				require 'headerContent/loginHeader.php';
			}		
		?>

	</div>

</header>
