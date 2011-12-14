<?php

class ctr {

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
