<?php
    session_start();

    sessionCheck();
    function sessionCheck(){
        if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
            header('location: login.php');
        }
    }