<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 12/05/2015
 * Time: 11:32
 */

namespace WebSite\Controller;
use Symfony\Component\Yaml\Parser;

abstract class AbstractBaseController {
    protected function getConnection() {
        $config = new \Doctrine\DBAL\Configuration();
        $yaml = new Parser();
        $connectionParams = $yaml->parse(file_get_contents('../app/config/config-dev.yml'));
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams['doctrine'], $config);
        return $conn;
    }
}