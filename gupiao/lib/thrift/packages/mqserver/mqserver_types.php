<?php
/**
 * Autogenerated by Thrift Compiler (0.7.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';


class broker {
  static $_TSPEC;

  public $id = null;
  public $host = null;
  public $port = null;
  public $createdate = null;
  public $jmx_port = null;
  public $version = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'host',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'port',
          'type' => TType::I16,
          ),
        4 => array(
          'var' => 'createdate',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'jmx_port',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'version',
          'type' => TType::I16,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['host'])) {
        $this->host = $vals['host'];
      }
      if (isset($vals['port'])) {
        $this->port = $vals['port'];
      }
      if (isset($vals['createdate'])) {
        $this->createdate = $vals['createdate'];
      }
      if (isset($vals['jmx_port'])) {
        $this->jmx_port = $vals['jmx_port'];
      }
      if (isset($vals['version'])) {
        $this->version = $vals['version'];
      }
    }
  }

  public function getName() {
    return 'broker';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->id);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->host);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->port);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->createdate);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->jmx_port);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->version);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('broker');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I64, 1);
      $xfer += $output->writeI64($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->host !== null) {
      $xfer += $output->writeFieldBegin('host', TType::STRING, 2);
      $xfer += $output->writeString($this->host);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->port !== null) {
      $xfer += $output->writeFieldBegin('port', TType::I16, 3);
      $xfer += $output->writeI16($this->port);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdate !== null) {
      $xfer += $output->writeFieldBegin('createdate', TType::STRING, 4);
      $xfer += $output->writeString($this->createdate);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->jmx_port !== null) {
      $xfer += $output->writeFieldBegin('jmx_port', TType::STRING, 5);
      $xfer += $output->writeString($this->jmx_port);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->version !== null) {
      $xfer += $output->writeFieldBegin('version', TType::I16, 6);
      $xfer += $output->writeI16($this->version);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class kafka_cluster {
  static $_TSPEC;

  public $queues = null;
  public $brokers = null;
  public $borkerlist = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'queues',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'brokers',
          'type' => TType::I64,
          ),
        3 => array(
          'var' => 'borkerlist',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'broker',
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['queues'])) {
        $this->queues = $vals['queues'];
      }
      if (isset($vals['brokers'])) {
        $this->brokers = $vals['brokers'];
      }
      if (isset($vals['borkerlist'])) {
        $this->borkerlist = $vals['borkerlist'];
      }
    }
  }

  public function getName() {
    return 'kafka_cluster';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->queues);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->brokers);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::LST) {
            $this->borkerlist = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $elem5 = new broker();
              $xfer += $elem5->read($input);
              $this->borkerlist []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('kafka_cluster');
    if ($this->queues !== null) {
      $xfer += $output->writeFieldBegin('queues', TType::I64, 1);
      $xfer += $output->writeI64($this->queues);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->brokers !== null) {
      $xfer += $output->writeFieldBegin('brokers', TType::I64, 2);
      $xfer += $output->writeI64($this->brokers);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->borkerlist !== null) {
      if (!is_array($this->borkerlist)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('borkerlist', TType::LST, 3);
      {
        $output->writeListBegin(TType::STRUCT, count($this->borkerlist));
        {
          foreach ($this->borkerlist as $iter6)
          {
            $xfer += $iter6->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class queue {
  static $_TSPEC;

  public $queuename = null;
  public $partitons = null;
  public $replicas = null;
  public $createdate = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'queuename',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'partitons',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'replicas',
          'type' => TType::I32,
          ),
        4 => array(
          'var' => 'createdate',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['queuename'])) {
        $this->queuename = $vals['queuename'];
      }
      if (isset($vals['partitons'])) {
        $this->partitons = $vals['partitons'];
      }
      if (isset($vals['replicas'])) {
        $this->replicas = $vals['replicas'];
      }
      if (isset($vals['createdate'])) {
        $this->createdate = $vals['createdate'];
      }
    }
  }

  public function getName() {
    return 'queue';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->queuename);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->partitons);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->replicas);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->createdate);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('queue');
    if ($this->queuename !== null) {
      $xfer += $output->writeFieldBegin('queuename', TType::STRING, 1);
      $xfer += $output->writeString($this->queuename);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->partitons !== null) {
      $xfer += $output->writeFieldBegin('partitons', TType::I32, 2);
      $xfer += $output->writeI32($this->partitons);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->replicas !== null) {
      $xfer += $output->writeFieldBegin('replicas', TType::I32, 3);
      $xfer += $output->writeI32($this->replicas);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdate !== null) {
      $xfer += $output->writeFieldBegin('createdate', TType::STRING, 4);
      $xfer += $output->writeString($this->createdate);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class partinfo {
  static $_TSPEC;

  public $queue = null;
  public $partitionid = null;
  public $leader = null;
  public $replicas = null;
  public $isr = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'queue',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'partitionid',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'leader',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'replicas',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'isr',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['queue'])) {
        $this->queue = $vals['queue'];
      }
      if (isset($vals['partitionid'])) {
        $this->partitionid = $vals['partitionid'];
      }
      if (isset($vals['leader'])) {
        $this->leader = $vals['leader'];
      }
      if (isset($vals['replicas'])) {
        $this->replicas = $vals['replicas'];
      }
      if (isset($vals['isr'])) {
        $this->isr = $vals['isr'];
      }
    }
  }

  public function getName() {
    return 'partinfo';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->queue);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->partitionid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->leader);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->replicas);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->isr);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('partinfo');
    if ($this->queue !== null) {
      $xfer += $output->writeFieldBegin('queue', TType::STRING, 1);
      $xfer += $output->writeString($this->queue);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->partitionid !== null) {
      $xfer += $output->writeFieldBegin('partitionid', TType::I32, 2);
      $xfer += $output->writeI32($this->partitionid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->leader !== null) {
      $xfer += $output->writeFieldBegin('leader', TType::STRING, 3);
      $xfer += $output->writeString($this->leader);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->replicas !== null) {
      $xfer += $output->writeFieldBegin('replicas', TType::STRING, 4);
      $xfer += $output->writeString($this->replicas);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->isr !== null) {
      $xfer += $output->writeFieldBegin('isr', TType::STRING, 5);
      $xfer += $output->writeString($this->isr);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class offset {
  static $_TSPEC;

  public $group = null;
  public $queue = null;
  public $partid = null;
  public $offset = null;
  public $logSize = null;
  public $lag = null;
  public $owner = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'group',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'queue',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'partid',
          'type' => TType::I16,
          ),
        4 => array(
          'var' => 'offset',
          'type' => TType::I64,
          ),
        5 => array(
          'var' => 'logSize',
          'type' => TType::I64,
          ),
        6 => array(
          'var' => 'lag',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'owner',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['group'])) {
        $this->group = $vals['group'];
      }
      if (isset($vals['queue'])) {
        $this->queue = $vals['queue'];
      }
      if (isset($vals['partid'])) {
        $this->partid = $vals['partid'];
      }
      if (isset($vals['offset'])) {
        $this->offset = $vals['offset'];
      }
      if (isset($vals['logSize'])) {
        $this->logSize = $vals['logSize'];
      }
      if (isset($vals['lag'])) {
        $this->lag = $vals['lag'];
      }
      if (isset($vals['owner'])) {
        $this->owner = $vals['owner'];
      }
    }
  }

  public function getName() {
    return 'offset';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->group);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->queue);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->partid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->offset);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->logSize);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->lag);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->owner);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('offset');
    if ($this->group !== null) {
      $xfer += $output->writeFieldBegin('group', TType::STRING, 1);
      $xfer += $output->writeString($this->group);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->queue !== null) {
      $xfer += $output->writeFieldBegin('queue', TType::STRING, 2);
      $xfer += $output->writeString($this->queue);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->partid !== null) {
      $xfer += $output->writeFieldBegin('partid', TType::I16, 3);
      $xfer += $output->writeI16($this->partid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->offset !== null) {
      $xfer += $output->writeFieldBegin('offset', TType::I64, 4);
      $xfer += $output->writeI64($this->offset);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->logSize !== null) {
      $xfer += $output->writeFieldBegin('logSize', TType::I64, 5);
      $xfer += $output->writeI64($this->logSize);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->lag !== null) {
      $xfer += $output->writeFieldBegin('lag', TType::STRING, 6);
      $xfer += $output->writeString($this->lag);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->owner !== null) {
      $xfer += $output->writeFieldBegin('owner', TType::STRING, 7);
      $xfer += $output->writeString($this->owner);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class consumer {
  static $_TSPEC;

  public $consname = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'consname',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['consname'])) {
        $this->consname = $vals['consname'];
      }
    }
  }

  public function getName() {
    return 'consumer';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->consname);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('consumer');
    if ($this->consname !== null) {
      $xfer += $output->writeFieldBegin('consname', TType::STRING, 1);
      $xfer += $output->writeString($this->consname);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class queueoffset {
  static $_TSPEC;

  public $queue = null;
  public $consumers = null;
  public $offsetlist = null;
  public $totalLag = null;
  public $percent = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'queue',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'consumers',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'consumer',
            ),
          ),
        3 => array(
          'var' => 'offsetlist',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => 'offset',
            ),
          ),
        4 => array(
          'var' => 'totalLag',
          'type' => TType::I64,
          ),
        5 => array(
          'var' => 'percent',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['queue'])) {
        $this->queue = $vals['queue'];
      }
      if (isset($vals['consumers'])) {
        $this->consumers = $vals['consumers'];
      }
      if (isset($vals['offsetlist'])) {
        $this->offsetlist = $vals['offsetlist'];
      }
      if (isset($vals['totalLag'])) {
        $this->totalLag = $vals['totalLag'];
      }
      if (isset($vals['percent'])) {
        $this->percent = $vals['percent'];
      }
    }
  }

  public function getName() {
    return 'queueoffset';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->queue);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::LST) {
            $this->consumers = array();
            $_size7 = 0;
            $_etype10 = 0;
            $xfer += $input->readListBegin($_etype10, $_size7);
            for ($_i11 = 0; $_i11 < $_size7; ++$_i11)
            {
              $elem12 = null;
              $elem12 = new consumer();
              $xfer += $elem12->read($input);
              $this->consumers []= $elem12;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::LST) {
            $this->offsetlist = array();
            $_size13 = 0;
            $_etype16 = 0;
            $xfer += $input->readListBegin($_etype16, $_size13);
            for ($_i17 = 0; $_i17 < $_size13; ++$_i17)
            {
              $elem18 = null;
              $elem18 = new offset();
              $xfer += $elem18->read($input);
              $this->offsetlist []= $elem18;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->totalLag);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->percent);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('queueoffset');
    if ($this->queue !== null) {
      $xfer += $output->writeFieldBegin('queue', TType::STRING, 1);
      $xfer += $output->writeString($this->queue);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->consumers !== null) {
      if (!is_array($this->consumers)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('consumers', TType::LST, 2);
      {
        $output->writeListBegin(TType::STRUCT, count($this->consumers));
        {
          foreach ($this->consumers as $iter19)
          {
            $xfer += $iter19->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->offsetlist !== null) {
      if (!is_array($this->offsetlist)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('offsetlist', TType::LST, 3);
      {
        $output->writeListBegin(TType::STRUCT, count($this->offsetlist));
        {
          foreach ($this->offsetlist as $iter20)
          {
            $xfer += $iter20->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->totalLag !== null) {
      $xfer += $output->writeFieldBegin('totalLag', TType::I64, 4);
      $xfer += $output->writeI64($this->totalLag);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->percent !== null) {
      $xfer += $output->writeFieldBegin('percent', TType::STRING, 5);
      $xfer += $output->writeString($this->percent);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class mqserver_ThriftIOException extends TException {
  static $_TSPEC;

  public $message = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'message',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['message'])) {
        $this->message = $vals['message'];
      }
    }
  }

  public function getName() {
    return 'mqserver_ThriftIOException';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->message);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('mqserver_ThriftIOException');
    if ($this->message !== null) {
      $xfer += $output->writeFieldBegin('message', TType::STRING, 1);
      $xfer += $output->writeString($this->message);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>