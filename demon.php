<?php
//don't use pool
$obj = new Redis();
$rs = $obj->connect("192.168.20.130");
$obj->select(5);
$obj->set("test", '1111');
var_dump($obj->get("test"));

$obj = new PDO('mysql:host=192.168.20.130;dbname=test1', "admin", "admin");
$rs = $obj->query("show tables");
var_dump($rs->fetchAll());

//use pool
$obj = new redis_connect_pool();
$rs = $obj->connect("192.168.20.130");
$obj->select(5);
$obj->set("test", '1111');
var_dump($obj->get("test"));
$obj->release();

$obj1 = new pdo_connect_pool('mysql:host=192.168.20.131;dbname=db1', "admin", "admin");
$rs = $obj1->query("show tables");
var_dump($rs->fetchAll());
$obj1->release();

/* tips：
 * 1、The relase() method will release the connections to the pool that the process holds.
 * 2、after rshutdown/mshutdown will trigger the release() function.
 */


/* 说明：
 * 1、relase方法：通知中间件,可以将这个进程持有的链接放回连接池
 * 2、请求结束（rshutdown/mshutdown阶段）会调用自动调用release
 */
