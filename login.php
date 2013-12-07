<?php
session_start();
include 'config.php';
class login extends config {
	
	public function checkSessionSercurity() {
		if(isset($_SESSION['user'])) {
			//this could be safe but it's totally not since session hijacking exists, so we will use a specialized salt as a session aswell to validate the session attempt.
			if(isset($_SESSION['ssid'])) {
				//now lets check whenever these values are that legit as they try to appear.
				$userName = stripslashes(mysql_real_escape_string($_SESSION['user']));
				$ssid = stripslashes(mysql_real_escape_string($_SESSION['ssid']));
				
				$sql = mysql_query("SELECT user FROM users WHERE user='" . $userName . "'");
				if($sql) {
					//now lets check our unique session id.
					$sql = mysql_query("SELECT user FROM users WHERE ssid='" . $ssid . "'");
					if($sql) {
						//user name matches with the ssid this will not looks like a threat.
						return true;
					} else {
						//this guy tried to logon while the ssid doesn't match from the database this means that he didn't fill in any passwords but is just trying to hijack the known hash which we now will prevent.
						session_unset($_SESSION['ssid']);
						session_unset($_SESSION['user']);
						session_destroy();
						echo "session hijacking attemps are not allowed on this website!";
						header("LOCATION: index.php");
					}
				} else {
					//invalid session since this session is not activated by our system so the guest tried to inject a random name which doesn't exists in order to logon.
					session_unset($_SESSION['ssid']);
					session_unset($_SESSION['user']);
					session_destroy();
					echo "session hijacking attemps are not allowed on this website!";
					header("LOCATION: index.php");
				}
			} else {
				//oh oh this looks as a session hijacking attempt lets clear everything out.
				session_unset($_SESSION['ssid']);
				session_unset($_SESSION['user']);
				session_destroy();
				echo "session hijacking attemps are not allowed on this website!";
				header("LOCATION: index.php");
			}
		}
		return false;
	}
	
}

?>