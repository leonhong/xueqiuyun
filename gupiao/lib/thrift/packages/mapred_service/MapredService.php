<?php
/**
 * Autogenerated by Thrift Compiler (0.7.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';

include_once $GLOBALS['THRIFT_ROOT'].'/packages/mapred_service/mapred_service_types.php';

interface MapredServiceIf {
  public function getJobStatus($jobId);
  public function importDataSimple($conf, $inputPath, $outputPath);
  public function importDataRegex($conf, $inputPath, $outputPath);
  public function grep($conf, $inputPath, $outputPath);
  public function submitJob($cmdList);
}

class MapredServiceClient implements MapredServiceIf {
  protected $input_ = null;
  protected $output_ = null;

  protected $seqid_ = 0;

  public function __construct($input, $output=null) {
    $this->input_ = $input;
    $this->output_ = $output ? $output : $input;
  }

  public function getJobStatus($jobId)
  {
    $this->send_getJobStatus($jobId);
    return $this->recv_getJobStatus();
  }

  public function send_getJobStatus($jobId)
  {
    $args = new MapredService_getJobStatus_args();
    $args->jobId = $jobId;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'getJobStatus', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('getJobStatus', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_getJobStatus()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'MapredService_getJobStatus_result', $this->input_->isStrictRead());
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
      $result = new MapredService_getJobStatus_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("getJobStatus failed: unknown result");
  }

  public function importDataSimple($conf, $inputPath, $outputPath)
  {
    $this->send_importDataSimple($conf, $inputPath, $outputPath);
    return $this->recv_importDataSimple();
  }

  public function send_importDataSimple($conf, $inputPath, $outputPath)
  {
    $args = new MapredService_importDataSimple_args();
    $args->conf = $conf;
    $args->inputPath = $inputPath;
    $args->outputPath = $outputPath;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'importDataSimple', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('importDataSimple', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_importDataSimple()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'MapredService_importDataSimple_result', $this->input_->isStrictRead());
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
      $result = new MapredService_importDataSimple_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("importDataSimple failed: unknown result");
  }

  public function importDataRegex($conf, $inputPath, $outputPath)
  {
    $this->send_importDataRegex($conf, $inputPath, $outputPath);
    return $this->recv_importDataRegex();
  }

  public function send_importDataRegex($conf, $inputPath, $outputPath)
  {
    $args = new MapredService_importDataRegex_args();
    $args->conf = $conf;
    $args->inputPath = $inputPath;
    $args->outputPath = $outputPath;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'importDataRegex', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('importDataRegex', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_importDataRegex()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'MapredService_importDataRegex_result', $this->input_->isStrictRead());
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
      $result = new MapredService_importDataRegex_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("importDataRegex failed: unknown result");
  }

  public function grep($conf, $inputPath, $outputPath)
  {
    $this->send_grep($conf, $inputPath, $outputPath);
    return $this->recv_grep();
  }

  public function send_grep($conf, $inputPath, $outputPath)
  {
    $args = new MapredService_grep_args();
    $args->conf = $conf;
    $args->inputPath = $inputPath;
    $args->outputPath = $outputPath;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'grep', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('grep', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_grep()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'MapredService_grep_result', $this->input_->isStrictRead());
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
      $result = new MapredService_grep_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("grep failed: unknown result");
  }

  public function submitJob($cmdList)
  {
    $this->send_submitJob($cmdList);
    return $this->recv_submitJob();
  }

  public function send_submitJob($cmdList)
  {
    $args = new MapredService_submitJob_args();
    $args->cmdList = $cmdList;
    $bin_accel = ($this->output_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'submitJob', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('submitJob', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_submitJob()
  {
    $bin_accel = ($this->input_ instanceof TProtocol::$TBINARYPROTOCOLACCELERATED) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, 'MapredService_submitJob_result', $this->input_->isStrictRead());
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
      $result = new MapredService_submitJob_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    if ($result->ex !== null) {
      throw $result->ex;
    }
    throw new Exception("submitJob failed: unknown result");
  }

}

// HELPER FUNCTIONS AND STRUCTURES

class MapredService_getJobStatus_args {
  static $_TSPEC;

  public $jobId = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'jobId',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['jobId'])) {
        $this->jobId = $vals['jobId'];
      }
    }
  }

  public function getName() {
    return 'MapredService_getJobStatus_args';
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
            $xfer += $input->readString($this->jobId);
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
    $xfer += $output->writeStructBegin('MapredService_getJobStatus_args');
    if ($this->jobId !== null) {
      $xfer += $output->writeFieldBegin('jobId', TType::STRING, 1);
      $xfer += $output->writeString($this->jobId);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class MapredService_getJobStatus_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRUCT,
          'class' => 'MRJobStatus',
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'MapredServerException',
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
    return 'MapredService_getJobStatus_result';
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
          if ($ftype == TType::STRUCT) {
            $this->success = new MRJobStatus();
            $xfer += $this->success->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new MapredServerException();
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
    $xfer += $output->writeStructBegin('MapredService_getJobStatus_result');
    if ($this->success !== null) {
      if (!is_object($this->success)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('success', TType::STRUCT, 0);
      $xfer += $this->success->write($output);
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

class MapredService_importDataSimple_args {
  static $_TSPEC;

  public $conf = null;
  public $inputPath = null;
  public $outputPath = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'conf',
          'type' => TType::MAP,
          'ktype' => TType::STRING,
          'vtype' => TType::STRING,
          'key' => array(
            'type' => TType::STRING,
          ),
          'val' => array(
            'type' => TType::STRING,
            ),
          ),
        2 => array(
          'var' => 'inputPath',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'outputPath',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['conf'])) {
        $this->conf = $vals['conf'];
      }
      if (isset($vals['inputPath'])) {
        $this->inputPath = $vals['inputPath'];
      }
      if (isset($vals['outputPath'])) {
        $this->outputPath = $vals['outputPath'];
      }
    }
  }

  public function getName() {
    return 'MapredService_importDataSimple_args';
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
            $this->conf = array();
            $_size0 = 0;
            $_ktype1 = 0;
            $_vtype2 = 0;
            $xfer += $input->readMapBegin($_ktype1, $_vtype2, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $key5 = '';
              $val6 = '';
              $xfer += $input->readString($key5);
              $xfer += $input->readString($val6);
              $this->conf[$key5] = $val6;
            }
            $xfer += $input->readMapEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->inputPath);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->outputPath);
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
    $xfer += $output->writeStructBegin('MapredService_importDataSimple_args');
    if ($this->conf !== null) {
      if (!is_array($this->conf)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('conf', TType::MAP, 1);
      {
        $output->writeMapBegin(TType::STRING, TType::STRING, count($this->conf));
        {
          foreach ($this->conf as $kiter7 => $viter8)
          {
            $xfer += $output->writeString($kiter7);
            $xfer += $output->writeString($viter8);
          }
        }
        $output->writeMapEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->inputPath !== null) {
      $xfer += $output->writeFieldBegin('inputPath', TType::STRING, 2);
      $xfer += $output->writeString($this->inputPath);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->outputPath !== null) {
      $xfer += $output->writeFieldBegin('outputPath', TType::STRING, 3);
      $xfer += $output->writeString($this->outputPath);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class MapredService_importDataSimple_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'MapredServerException',
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
    return 'MapredService_importDataSimple_result';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new MapredServerException();
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
    $xfer += $output->writeStructBegin('MapredService_importDataSimple_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
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

class MapredService_importDataRegex_args {
  static $_TSPEC;

  public $conf = null;
  public $inputPath = null;
  public $outputPath = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'conf',
          'type' => TType::MAP,
          'ktype' => TType::STRING,
          'vtype' => TType::STRING,
          'key' => array(
            'type' => TType::STRING,
          ),
          'val' => array(
            'type' => TType::STRING,
            ),
          ),
        2 => array(
          'var' => 'inputPath',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'outputPath',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['conf'])) {
        $this->conf = $vals['conf'];
      }
      if (isset($vals['inputPath'])) {
        $this->inputPath = $vals['inputPath'];
      }
      if (isset($vals['outputPath'])) {
        $this->outputPath = $vals['outputPath'];
      }
    }
  }

  public function getName() {
    return 'MapredService_importDataRegex_args';
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
            $this->conf = array();
            $_size9 = 0;
            $_ktype10 = 0;
            $_vtype11 = 0;
            $xfer += $input->readMapBegin($_ktype10, $_vtype11, $_size9);
            for ($_i13 = 0; $_i13 < $_size9; ++$_i13)
            {
              $key14 = '';
              $val15 = '';
              $xfer += $input->readString($key14);
              $xfer += $input->readString($val15);
              $this->conf[$key14] = $val15;
            }
            $xfer += $input->readMapEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->inputPath);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->outputPath);
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
    $xfer += $output->writeStructBegin('MapredService_importDataRegex_args');
    if ($this->conf !== null) {
      if (!is_array($this->conf)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('conf', TType::MAP, 1);
      {
        $output->writeMapBegin(TType::STRING, TType::STRING, count($this->conf));
        {
          foreach ($this->conf as $kiter16 => $viter17)
          {
            $xfer += $output->writeString($kiter16);
            $xfer += $output->writeString($viter17);
          }
        }
        $output->writeMapEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->inputPath !== null) {
      $xfer += $output->writeFieldBegin('inputPath', TType::STRING, 2);
      $xfer += $output->writeString($this->inputPath);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->outputPath !== null) {
      $xfer += $output->writeFieldBegin('outputPath', TType::STRING, 3);
      $xfer += $output->writeString($this->outputPath);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class MapredService_importDataRegex_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'MapredServerException',
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
    return 'MapredService_importDataRegex_result';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new MapredServerException();
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
    $xfer += $output->writeStructBegin('MapredService_importDataRegex_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
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

class MapredService_grep_args {
  static $_TSPEC;

  public $conf = null;
  public $inputPath = null;
  public $outputPath = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'conf',
          'type' => TType::MAP,
          'ktype' => TType::STRING,
          'vtype' => TType::STRING,
          'key' => array(
            'type' => TType::STRING,
          ),
          'val' => array(
            'type' => TType::STRING,
            ),
          ),
        2 => array(
          'var' => 'inputPath',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'outputPath',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['conf'])) {
        $this->conf = $vals['conf'];
      }
      if (isset($vals['inputPath'])) {
        $this->inputPath = $vals['inputPath'];
      }
      if (isset($vals['outputPath'])) {
        $this->outputPath = $vals['outputPath'];
      }
    }
  }

  public function getName() {
    return 'MapredService_grep_args';
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
            $this->conf = array();
            $_size18 = 0;
            $_ktype19 = 0;
            $_vtype20 = 0;
            $xfer += $input->readMapBegin($_ktype19, $_vtype20, $_size18);
            for ($_i22 = 0; $_i22 < $_size18; ++$_i22)
            {
              $key23 = '';
              $val24 = '';
              $xfer += $input->readString($key23);
              $xfer += $input->readString($val24);
              $this->conf[$key23] = $val24;
            }
            $xfer += $input->readMapEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->inputPath);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->outputPath);
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
    $xfer += $output->writeStructBegin('MapredService_grep_args');
    if ($this->conf !== null) {
      if (!is_array($this->conf)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('conf', TType::MAP, 1);
      {
        $output->writeMapBegin(TType::STRING, TType::STRING, count($this->conf));
        {
          foreach ($this->conf as $kiter25 => $viter26)
          {
            $xfer += $output->writeString($kiter25);
            $xfer += $output->writeString($viter26);
          }
        }
        $output->writeMapEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->inputPath !== null) {
      $xfer += $output->writeFieldBegin('inputPath', TType::STRING, 2);
      $xfer += $output->writeString($this->inputPath);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->outputPath !== null) {
      $xfer += $output->writeFieldBegin('outputPath', TType::STRING, 3);
      $xfer += $output->writeString($this->outputPath);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class MapredService_grep_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'MapredServerException',
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
    return 'MapredService_grep_result';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new MapredServerException();
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
    $xfer += $output->writeStructBegin('MapredService_grep_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
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

class MapredService_submitJob_args {
  static $_TSPEC;

  public $cmdList = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'cmdList',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['cmdList'])) {
        $this->cmdList = $vals['cmdList'];
      }
    }
  }

  public function getName() {
    return 'MapredService_submitJob_args';
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
          if ($ftype == TType::LST) {
            $this->cmdList = array();
            $_size27 = 0;
            $_etype30 = 0;
            $xfer += $input->readListBegin($_etype30, $_size27);
            for ($_i31 = 0; $_i31 < $_size27; ++$_i31)
            {
              $elem32 = null;
              $xfer += $input->readString($elem32);
              $this->cmdList []= $elem32;
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
    $xfer += $output->writeStructBegin('MapredService_submitJob_args');
    if ($this->cmdList !== null) {
      if (!is_array($this->cmdList)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('cmdList', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRING, count($this->cmdList));
        {
          foreach ($this->cmdList as $iter33)
          {
            $xfer += $output->writeString($iter33);
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

class MapredService_submitJob_result {
  static $_TSPEC;

  public $success = null;
  public $ex = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        1 => array(
          'var' => 'ex',
          'type' => TType::STRUCT,
          'class' => 'MapredServerException',
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
    return 'MapredService_submitJob_result';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->ex = new MapredServerException();
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
    $xfer += $output->writeStructBegin('MapredService_submitJob_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
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
