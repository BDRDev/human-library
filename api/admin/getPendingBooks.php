<?php

include_once('../../_includes/config.php');
include_once ABSOLUTE_PATH . '/classes/admin.class.php';

$admin = new Admin();

echo json_encode($admin->getPendingUsers());