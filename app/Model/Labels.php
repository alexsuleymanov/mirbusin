<?
	class Model_Labels extends Model_Model{
		protected $name = 'labels';
		protected $depends = array();
		protected $relations = array();
		protected $multylang = 1;
		protected $visibility = 0;

		public $par = 0;

		public function __construct($id = 0){
			parent::__construct($id);
		}
	}
