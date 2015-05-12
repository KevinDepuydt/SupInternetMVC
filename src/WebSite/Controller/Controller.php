<?php

namespace controller;
use Symfony\Component\Yaml\Parser;

abstract class Controller{

    protected function getDoctrine(){
        $config = new \Doctrine\DBAL\Configuration();
        return \Doctrine\DBAL\DriverManager::getConnection($this->getConfig(), $config);
    }

    protected function getConfig()
    {
        $yaml = new Parser();
        return $yaml->parse(file_get_contents(dirname(__DIR__)."../../app/config/config_dev.yml"));
    }

    public function getMessageFlash()
    {
        if(!empty($_SESSION['flashBag']))
            return $_SESSION['flashBag'];
        else
            return false;
    }

    public function getPub(){
        $conn = $this->getDoctrine('database_connection');
        $year = 2014;
        return $conn->fetchAll('SELECT * FROM tbl_pub WHERE pub_annee = '.$year);
    }

    public function getCountItemsBag(){
        if(isset($_SESSION['panier'])) {
            return count($_SESSION['panier']);
        }else{
            return 0;
        }
    }

    public function getTitlePage(){
        $test = $routing->getRouting();
    }

}