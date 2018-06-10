<?php
	//Q&A arrays.
	$Questions = array("Bot: Hello there, my name is PHP_Bot. How are you doing today?", "Bot: Do you write PHP codes?", "Bot: How old are you?", "Bot: Do you love playing games?");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$store = $_POST['storage'];
		$respo = $_POST['response'];
		$count = $_POST['counter']+1;
		$chatResp = "";
		if ($count == 1) {
			$chatResp = "Bot: Ok <br />".$Questions[$count];
		}
		elseif ($count == 2) {
			if (strtolower($respo) == "yes") {
				$chatResp = "Bot: Wow! That's great. I was made with PHP. <br />".$Questions[$count];
			}
			elseif (strtolower($respo) == "no") {
				$chatResp = "Bot: Oh. You really should consider learning it though. <br />".$Questions[$count];
			}
			else{
				$count = $count - 1;
				$chatResp = "Bot: Could you reply with a \"yes\" or \"no\"";
			}
		}
		elseif ($count == 3) {
			if (filter_var($respo, FILTER_VALIDATE_INT) == true) {
				if ($respo < 13) {
					$chatResp = "Bot: young lad, enjoy this moment while it lasts. <br />".$Questions[$count];
				}
				elseif ($respo < 20) {
					$chatResp = "Bot: As a teenager, you really should start preparing for adult-hood. <br />".$Questions[$count];
				}
				elseif ($respo > 70) {
					$chatResp = "Bot: You should get some rest after so many years of service. <br />".$Questions[$count];
				}
				else{
					$chatResp = "Bot: As an adult, you sure have a lot of responsibilities. Be diligent. <br />".$Questions[$count];
				}
			}
			else{
				$count = $count - 1;
				$chatResp = "Bot: Could you reply with an integer value";
			}
		}
		elseif ($count == 4) {
			if (strtolower($respo) == "yes") {
				$chatResp = "That's great! What's the full meaning of PHP <br />";
			}
			elseif (strtolower($respo) == "no") {
				$chatResp = "Bot: Oh, Try your hands on something new. You never can tell. <br />";
			}
			else{
				$count = $count - 1;
				$chatResp = "Bot: Could you reply with a \"yes\" or \"no\"";
			}
		}

		$store = $store."<br/>You: ".$respo."<br />".$chatResp; 
		echo $store;
	}
	else
	{
		echo $Questions[0];
	}
?>
<!Doctype html>
<html>
	<head>
		<title>Test Chat Bot</title>
	</head>
	<body>
		<form action="index.php" method="POST">
			<input type="text" name="counter" style="display:none" value=<?php 
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						echo $count;
					}
					else
						echo 0;
				?>
			/>
			<textarea name="storage" style="display:none">
				<?php 
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						echo $store;
					}
					else
						echo $Questions[0];
				?>
			</textarea>
			<br />
			<input type="text" name="response" size="50" required/>
			
			<button id="submit" type="submit">Submit</button>
		</form>
	</body>
</html>