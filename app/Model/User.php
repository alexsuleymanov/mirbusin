<?
	class Model_User extends Model_Model {
		public $type;

		protected $name = 'user';
		protected $depends = array("order");
		protected $relations = array();
		protected $visibility = 1;
		public $par = 0;
		private $user_id;
		private $user_opt;
		
		public function __construct($type = '', $id = 0, $opt = 0) {
			$this->type = $type;
			$this->id = $id;
			$this->opt = $opt;
			
			parent::__construct($id);
		}
		
		public static function isauth(){
			if (defined("ASWEB_ADMIN") && $_SESSION['admin_userid']) {
				return true;
			} elseif ($_SESSION['userid']){
				return true;
			}else{
				return false;			
			}
		}
		
		public static function mkpass()
		{
			return md5(time());
		}
		
		public static function authfromcookie(){			
			if ($_COOKIE['user_id111']) {
				$User = new Model_User('client');
				$_SESSION['userid'] = $_COOKIE['user_id111'];
				$user = $User->get($_SESSION['userid']);
				$_SESSION['username'] = $user->name;
				$_SESSION['useremail'] = $user->email;
				$_SESSION['usertype'] = $user->type;
				$_SESSION['useropt'] = $user->opt;
				$_SESSION['userminiopt'] = $user->miniopt;
				$_SESSION['userdiscount'] = (Model_User::isOpt()) ? 0 : $User->user_discount($_SESSION['userid']);
				
				return true;
			}
		}	
		
		public static function user_discount($user_id){
			$Discount = new Model_Discount();
			$Order = new Model_Order();
			
			$order_total = $Order->total($user_id);			
			$discount = 0 + $Discount->getnakop($order_total);
			
			return $discount;
		}
		
		public static function login($user)
		{
			$_SESSION['userid'] = $user->id;
			$_SESSION['username'] = $user->name;
			$_SESSION['useremail'] = $user->email;
			$_SESSION['useropt'] = $user->opt;
			$_SESSION['userminiopt'] = $user->miniopt;
			$_SESSION['userdiscount'] = AS_Discount::calculateUserDiscount(new Model_Discount, new Model_Order, new Model_User('client'), (int) $user->id);

			setcookie("user_id111", $user->id, time()+60*60*24*3000);
		}
		
		public static function logoff()
		{
			unset($_SESSION['userid']);
			unset($_SESSION['username']);
			unset($_SESSION['useremail']);
			unset($_SESSION['usertype']);
			unset($_SESSION['userdiscount']);
			unset($_SESSION['useropt']);
			unset($_SESSION['userminiopt']);
			
			setcookie("user_id111", null, -1, "/");
			setcookie("username", null, -1, "/");
			setcookie("usertype", null, -1, "/");
			setcookie("userdiscount", null, -1, "/");
			setcookie("userdiscountlevel", null, -1, "/");
			setcookie("useropt", null, -1, "/");		
		}
		
		public static function userid() {
			if (defined('ASWEB_ADMIN')) {
				return intval(0 + $_SESSION['admin_userid']);
			} else {		
				return intval(0 + $_SESSION['userid']);
			}
		}
		
		public static function isOpt() {
			if (defined('ASWEB_ADMIN')) {
				return (!isset($_SESSION['admin_useropt']) || $_SESSION['admin_useropt'] < 0) ? 0 : $_SESSION['admin_useropt']; 
			} else {
				return (!isset($_SESSION['useropt']) || $_SESSION['useropt'] < 0) ? 0 : $_SESSION['useropt']; 
			}
		}
	}
