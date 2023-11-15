<?php
setcookie('log', $login, time() - 3600 * 24 * 30, "/");
// unset($_COOKIE['log']);

?>