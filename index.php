<?php

class Button extends StdClass {
	private $name;
	private $link;
	private $color;
	private $category;

	public function __construct($category, $name, $color, $link) {
		$this->name = $name;
		$this->color = $color;
		$this->link = $link;
		$this->category = $category;
	}

	public function render() {
		$html = 
			'<div class="button ' . $this->color . '" class="button" id="' . $this->category . '_' . $this->name . '" link="' . $this->link . '">
				<span class="button-image">
					<img src="images/' . $this->category . '.png" alt="" height="150" width="150">
				</span>
				<span type="button" class="button-link" align="center">' . $this->name . '</span>
			</div>';

		return $html;
	}
}

$buttonList = array();

function addToggleButtons($category, $linkOn, $linkOff) {
	global $buttonList;
	$buttonList[$category][] = new Button($category, 'On', 'green', $linkOn);
	$buttonList[$category][] = new Button($category, 'Off', 'orange', $linkOff);
}

if (!file_exists('settings.ini')) {
	die('No config file found.');
}

$settings = parse_ini_file("settings.ini", true);

foreach ($settings as $category => $buttonData) {
	addToggleButtons($category, $buttonData[1], $buttonData[0]);
}

?>

<html>
	<head>
		<title>Home Control</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	    <link href="style.css" rel="stylesheet" type="text/css">
	    <script src="script.js"></script>
	</head>
 	<body>
	 	<div class="container" align="center">
	 	 	<div class="message hidden" align="center" id="message"></div>
	 		<?php foreach ($buttonList as $category => $buttons) {
	 			$categoryParts = explode('_', $category);
	 			$categoryString = '';
	 			foreach ($categoryParts as $part) {
	 				$categoryString .= ' ' . ucfirst($part);
	 			}

	 			echo '<div align="center" class="category"><h2>' . $categoryString . '</h2>';
	 			foreach ($buttons as $button) {
	 				echo $button->render();
	 			}
	 			echo '</div>';
	 		}?>
	 	</div>
 	</body>
</html>