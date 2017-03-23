<?php
	namespace App;
	
	class Forms {
		public function addData($form_id = -1, $title = "Add Data", $extra = "") {
			$txtDebug = "Forms::addData(\$form_id) \$form_id - {$form_id}";
			//die("<pre>{$txtDebug}</pre>");
			//$extra = "{'func': 'function() {alert(\"Awlo\")}'}";
			$html = '<a class="btn btn-xs btn-alt" data-toggle="modal" data-target=".modalDataForm" onClick="launchDataModal(-1,'.$form_id.', '.$extra.', this, 1);">'.$title.'</a>';
			return $html;
		}
	}
?>