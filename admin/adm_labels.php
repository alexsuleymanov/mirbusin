<?	require("adm_incl.php");
	//---- GENERAL ----

	$title = "Надписи";
	$model = "Model_Labels";
	$default_order = "id";
		
	$can_add = 1;
	$can_del = 1;
	$can_edit = 1;

	//---- SHOW ----
	$show_cond = array();

	function showhead() {
	}

	function onshow($row) {
		return $row;
	}

	$fields = array(
		'intname' => array(
			'label' => "Внутренее имя",
			'type' => 'text',
			'show' => 1,
			'edit' => 1,
			'set' => 1,
			'sort' => 1,
			'filter' => 1,
			'multylang' => 0,
		),
		'comm' => array(
			'label' => "Комментарий",
			'type' => 'text',
			'show' => 1,
			'edit' => 1,
			'set' => 1,
			'sort' => 1,
			'filter' => 1,
			'multylang' => 0,
		),
        'value' => array(
			'label' => "Значение",
			'type' => 'textarea',
			'show' => 0,
			'edit' => 1,
			'set' => 1,
			'multylang' => 1,
			'admin_level' => 2,
		),
		'type' => array(
			'label' => "",
			'type' => 'custom',
			'content' => "<input type=\"hidden\" name=\"type\" value=\"".$_GET['type']."\">",
			'show' => 0,
			'edit' => 1,
			'set' => 1,
			'multylang' => 0,
		),
	);


	//---- DEL ----
	function ondel($id) {
	}

	//---- SET ----
	function onset($id) {
	}

	
	require("lib/admin.php");