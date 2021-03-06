<?php
/**
 * Autogenerated by Thrift Compiler (0.9.3)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


final class JobState {
  const RUNNING = 1;
  const SUCCEEDED = 2;
  const FAILED = 3;
  const PREP = 4;
  const KILLED = 5;
  static public $__names = array(
    1 => 'RUNNING',
    2 => 'SUCCEEDED',
    3 => 'FAILED',
    4 => 'PREP',
    5 => 'KILLED',
  );
}

class MRJobStatus {
  static $_TSPEC;

  /**
   * @var int
   */
  public $jobState = null;
  /**
   * @var double
   */
  public $mapProgress = 0;
  /**
   * @var double
   */
  public $reduceProgress = 0;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'jobState',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'mapProgress',
          'type' => TType::DOUBLE,
          ),
        3 => array(
          'var' => 'reduceProgress',
          'type' => TType::DOUBLE,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['jobState'])) {
        $this->jobState = $vals['jobState'];
      }
      if (isset($vals['mapProgress'])) {
        $this->mapProgress = $vals['mapProgress'];
      }
      if (isset($vals['reduceProgress'])) {
        $this->reduceProgress = $vals['reduceProgress'];
      }
    }
  }

  public function getName() {
    return 'MRJobStatus';
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
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->jobState);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->mapProgress);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->reduceProgress);
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
    $xfer += $output->writeStructBegin('MRJobStatus');
    if ($this->jobState !== null) {
      $xfer += $output->writeFieldBegin('jobState', TType::I32, 1);
      $xfer += $output->writeI32($this->jobState);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->mapProgress !== null) {
      $xfer += $output->writeFieldBegin('mapProgress', TType::DOUBLE, 2);
      $xfer += $output->writeDouble($this->mapProgress);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->reduceProgress !== null) {
      $xfer += $output->writeFieldBegin('reduceProgress', TType::DOUBLE, 3);
      $xfer += $output->writeDouble($this->reduceProgress);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class MapredServerException extends TException {
  static $_TSPEC;

  /**
   * @var string
   */
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
    return 'MapredServerException';
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
    $xfer += $output->writeStructBegin('MapredServerException');
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


