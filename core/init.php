<?php

session_start();
mb_internal_encoding("UTF-8");

spl_autoload_register(function ($class) {
	require "classes/" . $class . ".php";
});