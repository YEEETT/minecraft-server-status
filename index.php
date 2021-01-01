<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php
				$json = file_get_contents('https://api.mcsrvstat.us/2/'.$_GET["s"]);
				$obj = json_decode($json);
				echo $obj->ip.":".$obj->port;
			?>
		</title>
		<?php
			$fav = "https://static.planetminecraft.com/files/resource_media/screenshot/1401/pack5999302.jpg";
			$json = file_get_contents('https://api.mcsrvstat.us/2/'.$_GET["s"]);
			$obj = json_decode($json);
			if ($obj->icon ?? false) {
				$fav = $obj->icon;
			}
			echo "<link rel=\"shortcut icon\" href=\"".$fav."\" />";
		?>
		<style>
			@font-face {
				font-family: minecraft;
				src: url(mc.ttf);
			}
			body {
				background-image: url("bg.png");
				background-repeat: repeat;
			}
			middle {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				font-family: minecraft;
			}
			.server {
				background-color: rgba(0, 0, 0, 0.5);
				border-radius: 0.4rem;
				padding: 0px 15px;
			}
			none {
				color: rgba(0, 0, 0, 0);
			}
		</style>
	</head>
	<body>
		<middle class="server">
			<?php
				$json = file_get_contents('https://api.mcsrvstat.us/2/'.$_GET["s"]);
				$obj = json_decode($json);
				$hostn = $_GET["s"];
				$spaacer = 42;
				if ($obj->hostname ?? false) {
					$hostn = $obj->hostname;
					$spaacer = $spaacer - count_chars($hostn,3);
				}
				$motd = "<span style=\"color: #A00\">Can't connect to server.</span>";
				if ($obj->motd->html ?? false) {
					$motd = $obj->motd->html[0]."<br />".$obj->motd->html[1];
				}
				$pc = "";
				if ($obj->players ?? false) {
					$pc = "<span style=\"color: #AAA\">".$obj->players->online."</span><span style=\"color: #555\">/</span><span style=\"color: #AAA\">".$obj->players->max."</span>";
					$spaacer = $spaacer - count_chars($pc,3);
				}
				$spacer = "";
				for ($i = 0; $i < $spaacer; $i++) {
					$spacer .= "-";
				}
				echo "<p><br /><span style=\"color: #FFF\">".$hostn."<none>".$spacer."</none>".$pc."</span><br />".$motd."</p>";
			?>
		</middle>
	</body>
</html>
