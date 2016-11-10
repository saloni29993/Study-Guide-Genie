<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_SESSION['username']; ?>'s CheatSheet</title>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<meta name="description" content="Freewall demo for draggable" />
		<meta name="viewport" content="initial-scale=0.5; maximum-scale=0.5; user-scalable=0;"/>
		<meta name="keywords" content="javascript, dynamic, grid, layout, jquery plugin, flex layouts"/>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="freewall-master/freewall.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<style type="text/css">
			.layout{

			}

			.free-wall {
				margin: 15px;
				background-color: white;
			}
			.cell {
				
				cursor: move;
				max-width: 580px;
				height: auto;
				/*overflow: hidden;*/
				
				
			}
			.cell .cover {
			
				background-color: #fff;
				text-decoration: none;
				opacity: 1;
				overflow-x: hidden;
		
			}
			.handle {
		
				width: auto;
				height: auto;
				overflow-x: hidden;
			}

			.card{
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .notecard{
            padding: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            

        }

        .notranslate{
            white-space:pre-wrap;
        }
/*
        .well {
    background: rgb(255, 255, 255);
}*/

		</style>
	</head>
	<body>
		<script type="text/javascript">


		</script>
		
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
			<hr>

		<center><a class="btn btn-lg btn-danger" href="javascript:window.print()">Click here to Generate Cheatsheet !</a></center>
		<hr>
			
		<div class="layout">
			<div id="freewall" class="free-wall">

			<?php 
			$con=mysqli_connect("localhost","root","","javagenie");

			$uid = $_SESSION['uid'];
			$query = "SELECT * from cheatsheet where uid='$uid'" ;

			$result = mysqli_query($con,$query);

			while($row = mysqli_fetch_array($result))
			{
				echo "<div class='cell notecard' style='background-color:#fff;'>
					<div class='cover'><div class='handle'>";

					echo "<table class='table table-responsive table-striped'>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                                <span class='label label-primary'> Topic </span> &nbsp; <b>" .$row['topic'] ."</b> 
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                               ".$row['content'] ." <!-- <span class='label label-danger'> Content</span> -->
                                            </td>
                                        </tr>";

                                        if($row['code'] != "")
                                        {
                                        	echo "<tr class='codescroll'>
                                            <td>
                                               <div ><pre>".$row['code'] ."<pre></div>
                                            </td>
                                        </tr>";
                                        }


					echo "</tbody></table></div></div>
					</div>";
			}



			 ?>
			 </div>
				</div>

		</div>
		<div class="col-md-2"></div>
		</div>
		<script type="text/javascript">
			


			var wall = new Freewall("#freewall");
			wall.reset({
				draggable: true,
				selector: '.cell',
				animate: true,
				cellW: 150,
				cellH: 150,
				onResize: function() {
					wall.refresh();
				},
				onBlockMove: function() {
					console.log(this);
				}
			});
			wall.fitWidth();
			// for scroll bar appear;
			$(window).trigger("resize");
		</script>
	</body>
</html>
