<?php

session_start();
mb_internal_encoding();

spl_autoload_register(function ($class) {
	require "classes/" . $class . ".php";
});