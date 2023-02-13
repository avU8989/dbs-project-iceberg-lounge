<?php

function is_checked_in() {
	return isset($_SESSION['benutzerid']);
}

?>