<?php
if (isset($_GET['cmd'])) {
    require_once 'lightlance_api/index.php';
} else {
    require_once 'login.php';
}