	function get_reg($link)
	{	
		if (isset ($_GET['Registr']))
		{
			
			$info['name'] = $_GET['name'];
			$info['surname'] = $_GET['surname'];
			$info['age'] = $_GET['age'];
			$info['code'] = $_GET['code'];
			$info['telefon'] = $_GET['telefon'];
			$info['av'] = $_GET['av'];
			if($info['av'] == 'on')
				$info['av'] = 1;
			else
				$info['av'] = 0;
			$info['pc'] = $_GET['pc'];
			if($info['pc'] == 'on')
				$info['pc'] = 1;
			else
				$info['pc'] = 0;
			$info['yach'] = $_GET['yach'];
			if($info['yach'] == 'on')
				$info['yach'] = 1;
			else
				$info['yach'] = 0;
			$info['sex'] = $_GET['sex'];
			$info['about'] = $_GET['about'];
						
			$info['login'] = $_GET['login'];
			$info['pass'] = $_GET['pass'];
			
			$info['pass'] = md5($info['pass']); //md5 функция шифрования, принимает строку, выдает ее хеш из 32 символов
			
			$info['salt'] = gen_salt();
			
			$info['salt'] = md5($info['salt']); //md5 функция шифрования, принимает строку, выдает  хеш соли из 32 символов
			
			$info['final_pass'] = md5($info['pass'] . $info['salt']);
			
			//var_dump($info);
			
			$rez = select_login($link,$info['login']);
			if($rez==0)
			{
				insert_user($link,$info);
				$_SESSION['login'] = $info['login'];
				return "Registration!";
				
			}
			else
			{
				return $info;
			}
		}
		return false;
	}
	
	function gen_salt()
	{
		$c = rand(4,9);
		for($i = 0; $i < $c; $i++)
		{
			$salt .= chr(rand(33,122)); 
		}
		return $salt;
	}
