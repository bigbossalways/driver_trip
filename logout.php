<?php
// Initialize the session.

session_start();
session_destroy();
header('location:login.php');
exit;
