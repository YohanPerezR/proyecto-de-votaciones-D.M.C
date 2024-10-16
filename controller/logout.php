<?php

require_once("../model/Usuarios.php");
session_start();
Usuarios::logout();
