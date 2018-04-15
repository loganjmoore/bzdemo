<?php
/**
 * Created by PhpStorm.
 * User: logan_000
 * Date: 4/15/2018
 * Time: 10:04 AM
 */

class dbhelper
{
    function pq($sql, $params)
    {
        global $db;
        $stmt = $db->prepare($sql);

        if (sizeof($params) > 0) {
            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value);
            }
        }

        $stmt->execute();
    }

    function pGetLastInsert()
    {
        global $db;
        return $db->lastInsertId();
    }

    function pGetScalar($sql, $params, $def = "")
    {
        global $db;
        $stmt = $db->prepare($sql);

        if (isset($params)) {
            if (sizeof($params > 0)) {
                foreach ($params as $key => &$value) {
                    $stmt->bindParam($key, $value);
                }
            }
        }

        $stmt->execute();
        $result = $stmt->fetchColumn();

        if (!empty($result))
            return $result;
        else
            return $def;
    }

    function pGetResults($sql, $params)
    {
        global $db;
        $stmt = $db->prepare($sql);

        if (isset($params)) {
            if (sizeof($params > 0)) {
                foreach ($params as $key => &$value) {
                    if (is_integer($value))
                        $stmt->bindParam($key, $value, PDO::PARAM_INT);
                    else
                        $stmt->bindParam($key, $value);
                }
            }
        }

        $stmt->execute();
        $results = array();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}