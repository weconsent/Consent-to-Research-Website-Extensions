<?php

class ctr {

	public function alpha_enroll($post) {
			global $db, $config, $aiki;
			
			$email = mysql_real_escape_string(preg_replace("/[[:blank:]]+/","", strip_tags(trim($post))));
			$alpha_code = md5(rand());
			
			$db->query("INSERT INTO aiki_users (username, email, password, usergroup) VALUES ('$alpha_code', '$email', MD5(MD5('')),'6')");
			
			$randkey = substr($alpha_code, 0, 8);
			
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "From: Consent to Research <noreply@weconsent.us>\r\n";

			$subject = "Your Consent to Research Alpha Code";

			$message = $message."\n\r".
			"Follow this link to begin the alpha testing process: <a href='".$config['url']."alpha/".$randkey."'>".$config['url']."alpha/".$randkey."</a><br/><br/><strong>Consent to Research</strong>";

			mail($email,$subject,$message,$headers);
			return $aiki->message->ok("We have sent an alpha code to your address. Please check your inbox and follow the link.", NULL, false);
			
	}

        public function alpha_login($post) {
                global $membership, $db;

                $code_email = explode(" ", $post);

                $alpha_code = $code_email[0];
                $alpha_email = $code_email[1];

                $username = $db->get_var("SELECT username FROM aiki_users WHERE username LIKE '$alpha_code%'");

                $membership->login($username, '');

                if($alpha_email != '') {

                $db->query("UPDATE aiki_users SET email = '$alpha_email' WHERE username = '$username'");

                }

        }

        public function sage_login($post) {
                global $membership, $db;

                $user_pass = explode(" ", $post);

                $username = $user_pass[0];
                $password = $user_pass[1];

                $membership->login($username, $password);

        }


}

?>
