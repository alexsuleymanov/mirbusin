<?
	abstract class AS_Pay_Esystem{
		abstract public function pay($params);

		public function is_success(){
			return true;
		}
	}