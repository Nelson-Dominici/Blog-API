<?php

namespace app\Modules\User\Account;

$group->post("/login", [UserAccountController::class, "loginUser"]);
$group->post("/register", [UserAccountController::class, "registerUser"]);