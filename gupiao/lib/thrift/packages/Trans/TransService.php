<?php
/**
 * Autogenerated by Thrift Compiler (0.7.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';

include_once $GLOBALS['THRIFT_ROOT'].'/packages/Trans/Trans_types.php';

interface TransServiceIf {
  public function executecreate($sql, $user, $database, $tablename, $pathname, $fieldseparator, $lineseparator, $key);
  public function droptable($dropsql, $user, $tablename);
}

class TransServiceClient implements TransServiceIf {
  protected $input_ = null;
  protected $output_ = null;

  protected $seqid_ = 0;

  public function __construct($input, $output=null) {
    $this->input_ = $input;
    $this->output_ = $output ? $output : $input;
  }

  public function executecreate($sql, $user, $database, $tablename, $pathname, $fieldseparator, $lineseparator, $key)
  {
    $this->send_executecreate($sql, $user, $database, $tablename, $pathname, $fieldseparator, $lineseparator, $key);
    return $this->recv_executecreate();
  }

  public function send_executecreate($sql, $user, $database, $tablename, $pathname, $fieldseparator, $lineseparator, $key)
  {
    $args = new TransService_executecreate_args();
    $args->sql = $sql;
    $args->user = $user;
    $args->database = $database;
    $args->tablename = $tablename;
    $args->pathname = $pathname;
    $args->fieldseparator = $fieldseparator;
    $args->lineseparator = $lineseparator;
    $args->key = $key;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'executecreate', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('executecreate', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_executecreate()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'TransService_executecreate_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new TransService_executecreate_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("executecreate failed: unknown result");
  }

  public function droptable($dropsql, $user, $tablename)
  {
    $this->send_droptable($dropsql, $user, $tablename);
    return $this->recv_droptable();
  }

  public function send_droptable($dropsql, $user, $tablename)
  {
    $args = new TransService_droptable_args();
    $args->dropsql = $dropsql;
    $args->user = $user;
    $args->tablename = $tablename;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'droptable', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('droptable', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_droptable()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'TransService_droptable_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new TransService_droptable_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("droptable failed: unknown result");
  }

}

// HELPER FUNCTIONS AND STRUCTURES

class TransService_executecreate_args {
  static $_TSPEC;

  public $sql = null;
  public $user = null;
  public $database = null;
  public $tablename = null;
  public $pathname = null;
  public $fieldseparator = null;
  public $lineseparator = null;
  public $key = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'sql',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'user',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'database',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'tablename',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'pathname',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'fieldseparator',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'lineseparator',
          'type' => TType::STRING,
          ),
        8 => array(
          'var' => 'key',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['sql'])) {
        $this->sql = $vals['sql'];
      }
      if (isset($vals['user'])) {
        $this->user = $vals['user'];
      }
      if (isset($vals['database'])) {
        $this->database = $vals['database'];
      }
      if (isset($vals['tablename'])) {
        $this->tablename = $vals['tablename'];
      }
      if (isset($vals['pathname'])) {
        $this->pathname = $vals['pathname'];
      }
      if (isset($vals['fieldseparator'])) {
        $this->fieldseparator = $vals['fieldseparator'];
      }
      if (isset($vals['lineseparator'])) {
        $this->lineseparator = $vals['lineseparator'];
      }
      if (isset($vals['key'])) {
        $this->key = $vals['key'];
      }
    }
  }

  public function getName() {
    return 'TransService_executecreate_args';
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
            $xfer += $input->readString($this->sql);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->user);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->database);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->tablename);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->pathname);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->fieldseparator);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->lineseparator);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->key);
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
    $xfer += $output->writeStructBegin('TransService_executecreate_args');
    if ($this->sql !== null) {
      $xfer += $output->writeFieldBegin('sql', TType::STRING, 1);
      $xfer += $output->writeString($this->sql);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->user !== null) {
      $xfer += $output->writeFieldBegin('user', TType::STRING, 2);
      $xfer += $output->writeString($this->user);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->database !== null) {
      $xfer += $output->writeFieldBegin('database', TType::STRING, 3);
      $xfer += $output->writeString($this->database);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->tablename !== null) {
      $xfer += $output->writeFieldBegin('tablename', TType::STRING, 4);
      $xfer += $output->writeString($this->tablename);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->pathname !== null) {
      $xfer += $output->writeFieldBegin('pathname', TType::STRING, 5);
      $xfer += $output->writeString($this->pathname);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->fieldseparator !== null) {
      $xfer += $output->writeFieldBegin('fieldseparator', TType::STRING, 6);
      $xfer += $output->writeString($this->fieldseparator);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->lineseparator !== null) {
      $xfer += $output->writeFieldBegin('lineseparator', TType::STRING, 7);
      $xfer += $output->writeString($this->lineseparator);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->key !== null) {
      $xfer += $output->writeFieldBegin('key', TType::STRING, 8);
      $xfer += $output->writeString($this->key);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class TransService_executecreate_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::I32,
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'TransServerException',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
      if (isset($vals['ex'])) {
        $this->ex = $vals['ex'];
      }
    }
  }

  public function getName() {
    return 'TransService_executecreate_result';
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
        case 0:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new TransServerException();
            $xfer += $this->ex->read($input);
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
    $xfer += $output->writeStructBegin('TransService_executecreate_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::I32, 0);
      $xfer += $output->writeI32($this->success);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->ex !== null) {
      $xfer += $output->writeFieldBegin('ex', TType::STRUCT, 1);
      $xfer += $this->ex->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class TransService_droptable_args {
  static $_TSPEC;

  public $dropsql = null;
  public $user = null;
  public $tablename = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'dropsql',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'user',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'tablename',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['dropsql'])) {
        $this->dropsql = $vals['dropsql'];
      }
      if (isset($vals['user'])) {
        $this->user = $vals['user'];
      }
      if (isset($vals['tablename'])) {
        $this->tablename = $vals['tablename'];
      }
    }
  }

  public function getName() {
    return 'TransService_droptable_args';
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
            $xfer += $input->readString($this->dropsql);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->user);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->tablename);
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
    $xfer += $output->writeStructBegin('TransService_droptable_args');
    if ($this->dropsql !== null) {
      $xfer += $output->writeFieldBegin('dropsql', TType::STRING, 1);
      $xfer += $output->writeString($this->dropsql);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->user !== null) {
      $xfer += $output->writeFieldBegin('user', TType::STRING, 2);
      $xfer += $output->writeString($this->user);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->tablename !== null) {
      $xfer += $output->writeFieldBegin('tablename', TType::STRING, 3);
      $xfer += $output->writeString($this->tablename);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class TransService_droptable_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::BOOL,
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'TransServerException',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
      if (isset($vals['ex'])) {
        $this->ex = $vals['ex'];
      }
    }
  }

  public function getName() {
    return 'TransService_droptable_result';
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
        case 0:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new TransServerException();
            $xfer += $this->ex->read($input);
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
    $xfer += $output->writeStructBegin('TransService_droptable_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::BOOL, 0);
      $xfer += $output->writeBool($this->success);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->ex !== null) {
      $xfer += $output->writeFieldBegin('ex', TType::STRUCT, 1);
      $xfer += $this->ex->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

?>
