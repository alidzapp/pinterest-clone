<?php

$id = User::find(Session::get("user"))->id;
$pms = User::privateMessages(Session::get("user"));
// print_r($pms);