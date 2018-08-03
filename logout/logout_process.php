<?php

include_once '../_includes/config.php';


//unsets all sessions
session_unset();

header("Location: ../index.php");