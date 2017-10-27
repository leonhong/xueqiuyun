<?php
/**
 * Autogenerated by Thrift Compiler (0.7.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';


class msg {
  static $_TSPEC;

  public $code = null;
  public $msg = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'code',
          'type' => TType::I16,
          ),
        2 => array(
          'var' => 'msg',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['code'])) {
        $this->code = $vals['code'];
      }
      if (isset($vals['msg'])) {
        $this->msg = $vals['msg'];
      }
    }
  }

  public function getName() {
    return 'msg';
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
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->code);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->msg);
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
    $xfer += $output->writeStructBegin('msg');
    if ($this->code !== null) {
      $xfer += $output->writeFieldBegin('code', TType::I16, 1);
      $xfer += $output->writeI16($this->code);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->msg !== null) {
      $xfer += $output->writeFieldBegin('msg', TType::STRING, 2);
      $xfer += $output->writeString($this->msg);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class creatInfo {
  static $_TSPEC;

  public $user = null;
  public $type = null;
  public $ip = null;
  public $port = null;
  public $path = null;
  public $timestamps = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'user',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'type',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'ip',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'port',
          'type' => TType::I16,
          ),
        5 => array(
          'var' => 'path',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'timestamps',
          'type' => TType::I64,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['user'])) {
        $this->user = $vals['user'];
      }
      if (isset($vals['type'])) {
        $this->type = $vals['type'];
      }
      if (isset($vals['ip'])) {
        $this->ip = $vals['ip'];
      }
      if (isset($vals['port'])) {
        $this->port = $vals['port'];
      }
      if (isset($vals['path'])) {
        $this->path = $vals['path'];
      }
      if (isset($vals['timestamps'])) {
        $this->timestamps = $vals['timestamps'];
      }
    }
  }

  public function getName() {
    return 'creatInfo';
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
            $xfer += $input->readString($this->user);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->type);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->ip);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->port);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->path);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->timestamps);
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
    $xfer += $output->writeStructBegin('creatInfo');
    if ($this->user !== null) {
      $xfer += $output->writeFieldBegin('user', TType::STRING, 1);
      $xfer += $output->writeString($this->user);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->type !== null) {
      $xfer += $output->writeFieldBegin('type', TType::STRING, 2);
      $xfer += $output->writeString($this->type);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->ip !== null) {
      $xfer += $output->writeFieldBegin('ip', TType::STRING, 3);
      $xfer += $output->writeString($this->ip);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->port !== null) {
      $xfer += $output->writeFieldBegin('port', TType::I16, 4);
      $xfer += $output->writeI16($this->port);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->path !== null) {
      $xfer += $output->writeFieldBegin('path', TType::STRING, 5);
      $xfer += $output->writeString($this->path);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->timestamps !== null) {
      $xfer += $output->writeFieldBegin('timestamps', TType::I64, 6);
      $xfer += $output->writeI64($this->timestamps);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class channelInfo {
  static $_TSPEC;

  public $user = null;
  public $type = null;
  public $fileSize = null;
  public $acceptPercentage = null;
  public $channelFillPercentage = null;
  public $dataSavePercentage = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'user',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'type',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'fileSize',
          'type' => TType::I64,
          ),
        4 => array(
          'var' => 'acceptPercentage',
          'type' => TType::DOUBLE,
          ),
        5 => array(
          'var' => 'channelFillPercentage',
          'type' => TType::DOUBLE,
          ),
        6 => array(
          'var' => 'dataSavePercentage',
          'type' => TType::DOUBLE,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['user'])) {
        $this->user = $vals['user'];
      }
      if (isset($vals['type'])) {
        $this->type = $vals['type'];
      }
      if (isset($vals['fileSize'])) {
        $this->fileSize = $vals['fileSize'];
      }
      if (isset($vals['acceptPercentage'])) {
        $this->acceptPercentage = $vals['acceptPercentage'];
      }
      if (isset($vals['channelFillPercentage'])) {
        $this->channelFillPercentage = $vals['channelFillPercentage'];
      }
      if (isset($vals['dataSavePercentage'])) {
        $this->dataSavePercentage = $vals['dataSavePercentage'];
      }
    }
  }

  public function getName() {
    return 'channelInfo';
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
            $xfer += $input->readString($this->user);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->type);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->fileSize);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->acceptPercentage);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->channelFillPercentage);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->dataSavePercentage);
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
    $xfer += $output->writeStructBegin('channelInfo');
    if ($this->user !== null) {
      $xfer += $output->writeFieldBegin('user', TType::STRING, 1);
      $xfer += $output->writeString($this->user);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->type !== null) {
      $xfer += $output->writeFieldBegin('type', TType::STRING, 2);
      $xfer += $output->writeString($this->type);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->fileSize !== null) {
      $xfer += $output->writeFieldBegin('fileSize', TType::I64, 3);
      $xfer += $output->writeI64($this->fileSize);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->acceptPercentage !== null) {
      $xfer += $output->writeFieldBegin('acceptPercentage', TType::DOUBLE, 4);
      $xfer += $output->writeDouble($this->acceptPercentage);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->channelFillPercentage !== null) {
      $xfer += $output->writeFieldBegin('channelFillPercentage', TType::DOUBLE, 5);
      $xfer += $output->writeDouble($this->channelFillPercentage);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->dataSavePercentage !== null) {
      $xfer += $output->writeFieldBegin('dataSavePercentage', TType::DOUBLE, 6);
      $xfer += $output->writeDouble($this->dataSavePercentage);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class allMonitorInfo {
  static $_TSPEC;

  public $ChannelCount = null;
  public $allFileSize = null;
  public $maxMemory = null;
  public $memoryUsed = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'ChannelCount',
          'type' => TType::MAP,
          'ktype' => TType::STRING,
          'vtype' => TType::I16,
          'key' => array(
            'type' => TType::STRING,
          ),
          'val' => array(
            'type' => TType::I16,
            ),
          ),
        2 => array(
          'var' => 'allFileSize',
          'type' => TType::I64,
          ),
        3 => array(
          'var' => 'maxMemory',
          'type' => TType::I32,
          ),
        4 => array(
          'var' => 'memoryUsed',
          'type' => TType::MAP,
          'ktype' => TType::STRING,
          'vtype' => TType::I32,
          'key' => array(
            'type' => TType::STRING,
          ),
          'val' => array(
            'type' => TType::I32,
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['ChannelCount'])) {
        $this->ChannelCount = $vals['ChannelCount'];
      }
      if (isset($vals['allFileSize'])) {
        $this->allFileSize = $vals['allFileSize'];
      }
      if (isset($vals['maxMemory'])) {
        $this->maxMemory = $vals['maxMemory'];
      }
      if (isset($vals['memoryUsed'])) {
        $this->memoryUsed = $vals['memoryUsed'];
      }
    }
  }

  public function getName() {
    return 'allMonitorInfo';
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
          if ($ftype == TType::MAP) {
            $this->ChannelCount = array();
            $_size0 = 0;
            $_ktype1 = 0;
            $_vtype2 = 0;
            $xfer += $input->readMapBegin($_ktype1, $_vtype2, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $key5 = '';
              $val6 = 0;
              $xfer += $input->readString($key5);
              $xfer += $input->readI16($val6);
              $this->ChannelCount[$key5] = $val6;
            }
            $xfer += $input->readMapEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->allFileSize);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->maxMemory);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::MAP) {
            $this->memoryUsed = array();
            $_size7 = 0;
            $_ktype8 = 0;
            $_vtype9 = 0;
            $xfer += $input->readMapBegin($_ktype8, $_vtype9, $_size7);
            for ($_i11 = 0; $_i11 < $_size7; ++$_i11)
            {
              $key12 = '';
              $val13 = 0;
              $xfer += $input->readString($key12);
              $xfer += $input->readI32($val13);
              $this->memoryUsed[$key12] = $val13;
            }
            $xfer += $input->readMapEnd();
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
    $xfer += $output->writeStructBegin('allMonitorInfo');
    if ($this->ChannelCount !== null) {
      if (!is_array($this->ChannelCount)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('ChannelCount', TType::MAP, 1);
      {
        $output->writeMapBegin(TType::STRING, TType::I16, count($this->ChannelCount));
        {
          foreach ($this->ChannelCount as $kiter14 => $viter15)
          {
            $xfer += $output->writeString($kiter14);
            $xfer += $output->writeI16($viter15);
          }
        }
        $output->writeMapEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->allFileSize !== null) {
      $xfer += $output->writeFieldBegin('allFileSize', TType::I64, 2);
      $xfer += $output->writeI64($this->allFileSize);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->maxMemory !== null) {
      $xfer += $output->writeFieldBegin('maxMemory', TType::I32, 3);
      $xfer += $output->writeI32($this->maxMemory);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->memoryUsed !== null) {
      if (!is_array($this->memoryUsed)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('memoryUsed', TType::MAP, 4);
      {
        $output->writeMapBegin(TType::STRING, TType::I32, count($this->memoryUsed));
        {
          foreach ($this->memoryUsed as $kiter16 => $viter17)
          {
            $xfer += $output->writeString($kiter16);
            $xfer += $output->writeI32($viter17);
          }
        }
        $output->writeMapEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class singleMontiorInfo {
  static $_TSPEC;

  public $id = null;
  public $nodeName = null;
  public $channelCount = null;
  public $startTime = null;
  public $maxMemory = null;
  public $memortPercentage = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I16,
          ),
        2 => array(
          'var' => 'nodeName',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'channelCount',
          'type' => TType::I16,
          ),
        4 => array(
          'var' => 'startTime',
          'type' => TType::I64,
          ),
        6 => array(
          'var' => 'maxMemory',
          'type' => TType::I32,
          ),
        5 => array(
          'var' => 'memortPercentage',
          'type' => TType::DOUBLE,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['nodeName'])) {
        $this->nodeName = $vals['nodeName'];
      }
      if (isset($vals['channelCount'])) {
        $this->channelCount = $vals['channelCount'];
      }
      if (isset($vals['startTime'])) {
        $this->startTime = $vals['startTime'];
      }
      if (isset($vals['maxMemory'])) {
        $this->maxMemory = $vals['maxMemory'];
      }
      if (isset($vals['memortPercentage'])) {
        $this->memortPercentage = $vals['memortPercentage'];
      }
    }
  }

  public function getName() {
    return 'singleMontiorInfo';
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
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->id);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->nodeName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->channelCount);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->startTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->maxMemory);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->memortPercentage);
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
    $xfer += $output->writeStructBegin('singleMontiorInfo');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I16, 1);
      $xfer += $output->writeI16($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->nodeName !== null) {
      $xfer += $output->writeFieldBegin('nodeName', TType::STRING, 2);
      $xfer += $output->writeString($this->nodeName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->channelCount !== null) {
      $xfer += $output->writeFieldBegin('channelCount', TType::I16, 3);
      $xfer += $output->writeI16($this->channelCount);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->startTime !== null) {
      $xfer += $output->writeFieldBegin('startTime', TType::I64, 4);
      $xfer += $output->writeI64($this->startTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->memortPercentage !== null) {
      $xfer += $output->writeFieldBegin('memortPercentage', TType::DOUBLE, 5);
      $xfer += $output->writeDouble($this->memortPercentage);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->maxMemory !== null) {
      $xfer += $output->writeFieldBegin('maxMemory', TType::I32, 6);
      $xfer += $output->writeI32($this->maxMemory);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class flume_ThriftIOException extends TException {
  static $_TSPEC;

  public $message = null;
  public $code = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'message',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'code',
          'type' => TType::I16,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['message'])) {
        $this->message = $vals['message'];
      }
      if (isset($vals['code'])) {
        $this->code = $vals['code'];
      }
    }
  }

  public function getName() {
    return 'flume_ThriftIOException';
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
        case 2:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->code);
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
    $xfer += $output->writeStructBegin('flume_ThriftIOException');
    if ($this->message !== null) {
      $xfer += $output->writeFieldBegin('message', TType::STRING, 1);
      $xfer += $output->writeString($this->message);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->code !== null) {
      $xfer += $output->writeFieldBegin('code', TType::I16, 2);
      $xfer += $output->writeI16($this->code);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>