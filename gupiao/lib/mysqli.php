<?php
/**
 * 数据库类
 */
class DB
{
    public $conf;//配置
    public $conn;//连接

    /**
     * 构造函数 
     */
    function __construct ($conf) {
        $this->conf = $conf;
        $this->conn = new mysqli($conf['host'], $conf["username"], $conf["password"], $conf["database"], $conf['port']);
        if ($this->conn->connect_errno) {
            dayLog('db_mysqli', "Failed to connect to MySQL: (" . $this->conn->connect_errno . ")",  $this->conn->connect_error);
            return false;
        }
        $this->conn->select_db($this->conf['database']);
        $this->conn->set_charset('utf8');
    }

    /**
     * 执行sql
     */
    function query($sql) {
        if (!$this->conn->query($sql)) {
            dayLog('db_mysqli', 'query', 'error', $this->conn->error, $sql);
            return false;
        } else {
            dayLog('db_mysqli', 'query', 'success', $sql);
        }
        return true;
    }

    /**
     * 插入数据库
     */
    function insert ($table, $data) {
        foreach ($data as $k=>$v) {
            $data[$k]= "`" . $k . "`='" . $this->escape($v) . "'";
        }
        $this->conn->select_db($this->conf['database']);
        $sql = "INSERT INTO " . $table . " SET " . implode(', ', $data);
        if (!$this->conn->query($sql)) {
            dayLog('db_mysqli', 'insert', 'error', $sql);
            return false;
        } else {
            dayLog('db_mysqli', 'insert', 'success', $sql);
            return $this->conn->insert_id;
        }
    }

    /**
     * 删除数据库
     */
    function delete ($table, $data) {
        foreach ($data as $k=>$v) {
            $data[$k]= "`" . $k . "`='" . $this->escape($v) . "'";
        }
        $condition = implode(' AND ', $data);
        $this->conn->select_db($this->conf['database']);
        $sql = "DELETE FROM " . $table . " WHERE " . $condition;
        if (!$this->conn->query($sql)) {
            dayLog('db_mysqli', 'delete', 'error', $sql);
            return false;
        } else {
            dayLog('db_mysqli', 'delete', 'success', $sql);
            return true;
        }
    }

    /**
     * 更新数据库
     */
    function update ($table, $data, $condition='FALSE') {
        foreach ($data as $k=>$v) {
            $data[$k]="`" . $k . "`='" . $this->escape($v) . "'";
        }
        $this->conn->select_db($this->conf['database']);
        $sql = "UPDATE " . $table . " SET " . implode(', ', $data) . " WHERE " . $condition;
        if (!$this->conn->query($sql)) {
            dayLog('db_mysqli', 'update', 'error', $this->conn->error, $sql);
            return false;
        } else {
            dayLog('db_mysqli', 'update', 'success', $sql);
        }
        return $this->conn->affected_rows;
    }

    /**
     * 替换数据库
     */
    function replace ($table, $data) {
        foreach ($data as $k=>$v) {
            $data[$k]="`" . $k . "`='" . $this->escape($v) . "'";
        }    
        $this->conn->select_db($this->conf['database']);
        $sql = "REPLACE INTO " . $table . " SET " . implode(', ', $data);
        if (!$this->conn->query($sql)) {
            dayLog('db_mysqli', 'replace', 'error', $sql);
            return false;
        } else {
            dayLog('db_mysqli', 'replace', 'success', $sql);
            return true;
        }
    }

    /**
     * 查询数据库
     */
    function select ($sql) {
        if (!$result = $this->conn->query($sql)) {
            dayLog('db_mysqli', 'select', 'error', $sql);
            return false;
        }
        $all=array();
        while ($row = $result->fetch_assoc()) {
            $all[]=$row;
        }    
        return $all;
    }

    /**
     * 查询数据库
     */
    function selectOne ($sql) {
        if (!$result = $this->conn->query($sql)) {
            dayLog('db_mysqli', 'selectOne', 'error', $sql);
            return false;
        }
        $all=array();
        while ($row = $result->fetch_assoc()) {
            $all=$row;
            break;
        }    
        return $all;
    }
    
    /**
     * 查询结果行数
     */
    function count ($sql) {
        if (!$result = $this->conn->query($sql)) {
            dayLog('db_mysqli', 'count', 'error', $sql);
            return false;
        }
        return $result->num_rows;
    }

    /**
     * 检查是否存在 
     */
    function isExist ($table, $data) {
        foreach ($data as $k=>$v) {
            $data[$k]="`" . $k . "`='" . $this->escape($v) . "'";
        }    
        $sql = "SELECT * FROM " . $table . " WHERE " . implode(' AND ', $data);
        return $this->count($sql);
    }

    /**
     * 检查数据库是否存在
     */
    function checkDb($db) {
        $sql  = " SELECT `TABLE_NAME` from `INFORMATION_SCHEMA`.`TABLES`";
        $sql .= " WHERE `TABLE_SCHEMA`='$db'";
        return $this->count($sql);
    }

    /**
     * 检查数据库是否存在,不存在就创建数据库
     */
    function checkAndCreateDb($db) {
        if (!$this->checkDb($db)) {
            $sql = "CREATE DATABASE $db";
            if (!$this->conn->query($sql)) {
                dayLog('db_mysqli', 'checkAndCreateDb', 'error', $sql);
            } else {
                dayLog('db_mysqli', 'checkAndCreateDb', 'success', $sql);
            }
        }
    }

    /**
     * 检查表是否存在
     */
    function checkTable($db, $table) {
        $sql  = " SELECT `TABLE_NAME` from `INFORMATION_SCHEMA`.`TABLES`";
        $sql .= " WHERE `TABLE_SCHEMA`='$db' AND `TABLE_NAME`='$table'";
        return $this->count($sql);
    }

    /**
     * 检查表是否存在,不存在就创建表
     */
    function checkAndCreateTable($db, $table, $fromDb, $fromTable) {
        if (!$this->checkTable($db, $table)) {
            $sql = "CREATE TABLE $db.$table LIKE $fromDb.$fromTable";
            if (!$this->conn->query($sql)) {
                dayLog('db_mysqli', 'checkAndCreateTable', 'error', $this->conn->error, $sql);
            } else {
                dayLog('db_mysqli', 'checkAndCreateTable', 'success', $sql);
            }
        }
    }

    function escape($value) {
        return $this->conn->escape_string($value);
    }
}
