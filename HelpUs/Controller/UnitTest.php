<?php
require_once 'QueryBuilder.php';

$u = new User(NULL);
$u->setEmail("sama@gmail.com");
$u->setFullname("sama amer");
$u->setUsername("Sama3amer");
$u->setGender("female");
$u->getDOB("27/3/1996");
$u->getPassword(sha1("12345678"));
$u->getUserTypeID(1);



$q = new QueryBuilder;
$q->AddUser($u);

?>