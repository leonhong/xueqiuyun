<?php
/**
 * Autogenerated by Thrift Compiler (0.7.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 */
include_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';


$GLOBALS['E_hadoopfs_WriteFormat'] = array(
  'DEFAULT' => 0,
  'CSV' => 1,
  'XLS' => 2,
  'XLSX' => 3,
  'MYSQL' => 4,
  'ORACLE' => 5,
  'SQLSERVER' => 6,
  'DB2' => 7,
);

final class hadoopfs_WriteFormat {
  const DEFAULT = 0;
  const CSV = 1;
  const XLS = 2;
  const XLSX = 3;
  const MYSQL = 4;
  const ORACLE = 5;
  const SQLSERVER = 6;
  const DB2 = 7;
  static public $__names = array(
    0 => 'DEFAULT',
    1 => 'CSV',
    2 => 'XLS',
    3 => 'XLSX',
    4 => 'MYSQL',
    5 => 'ORACLE',
    6 => 'SQLSERVER',
    7 => 'DB2',
  );
}

class hadoopfs_ThriftHandle {
  static $_TSPEC;

  public $id = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I64,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_ThriftHandle';
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
    $xfer += $output->writeStructBegin('hadoopfs_ThriftHandle');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I64, 1);
      $xfer += $output->writeI64($this->id);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_Pathname {
  static $_TSPEC;

  public $pathname = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'pathname',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['pathname'])) {
        $this->pathname = $vals['pathname'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_Pathname';
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
            $xfer += $input->readString($this->pathname);
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
    $xfer += $output->writeStructBegin('hadoopfs_Pathname');
    if ($this->pathname !== null) {
      $xfer += $output->writeFieldBegin('pathname', TType::STRING, 1);
      $xfer += $output->writeString($this->pathname);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_FileStatus {
  static $_TSPEC;

  public $path = null;
  public $length = null;
  public $isdir = null;
  public $block_replication = null;
  public $blocksize = null;
  public $modification_time = null;
  public $permission = null;
  public $owner = null;
  public $group = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'path',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'length',
          'type' => TType::I64,
          ),
        3 => array(
          'var' => 'isdir',
          'type' => TType::BOOL,
          ),
        4 => array(
          'var' => 'block_replication',
          'type' => TType::I16,
          ),
        5 => array(
          'var' => 'blocksize',
          'type' => TType::I64,
          ),
        6 => array(
          'var' => 'modification_time',
          'type' => TType::I64,
          ),
        7 => array(
          'var' => 'permission',
          'type' => TType::STRING,
          ),
        8 => array(
          'var' => 'owner',
          'type' => TType::STRING,
          ),
        9 => array(
          'var' => 'group',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['path'])) {
        $this->path = $vals['path'];
      }
      if (isset($vals['length'])) {
        $this->length = $vals['length'];
      }
      if (isset($vals['isdir'])) {
        $this->isdir = $vals['isdir'];
      }
      if (isset($vals['block_replication'])) {
        $this->block_replication = $vals['block_replication'];
      }
      if (isset($vals['blocksize'])) {
        $this->blocksize = $vals['blocksize'];
      }
      if (isset($vals['modification_time'])) {
        $this->modification_time = $vals['modification_time'];
      }
      if (isset($vals['permission'])) {
        $this->permission = $vals['permission'];
      }
      if (isset($vals['owner'])) {
        $this->owner = $vals['owner'];
      }
      if (isset($vals['group'])) {
        $this->group = $vals['group'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_FileStatus';
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
            $xfer += $input->readString($this->path);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->length);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->isdir);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->block_replication);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->blocksize);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->modification_time);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->permission);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->owner);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->group);
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
    $xfer += $output->writeStructBegin('hadoopfs_FileStatus');
    if ($this->path !== null) {
      $xfer += $output->writeFieldBegin('path', TType::STRING, 1);
      $xfer += $output->writeString($this->path);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->length !== null) {
      $xfer += $output->writeFieldBegin('length', TType::I64, 2);
      $xfer += $output->writeI64($this->length);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->isdir !== null) {
      $xfer += $output->writeFieldBegin('isdir', TType::BOOL, 3);
      $xfer += $output->writeBool($this->isdir);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->block_replication !== null) {
      $xfer += $output->writeFieldBegin('block_replication', TType::I16, 4);
      $xfer += $output->writeI16($this->block_replication);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->blocksize !== null) {
      $xfer += $output->writeFieldBegin('blocksize', TType::I64, 5);
      $xfer += $output->writeI64($this->blocksize);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->modification_time !== null) {
      $xfer += $output->writeFieldBegin('modification_time', TType::I64, 6);
      $xfer += $output->writeI64($this->modification_time);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->permission !== null) {
      $xfer += $output->writeFieldBegin('permission', TType::STRING, 7);
      $xfer += $output->writeString($this->permission);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->owner !== null) {
      $xfer += $output->writeFieldBegin('owner', TType::STRING, 8);
      $xfer += $output->writeString($this->owner);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->group !== null) {
      $xfer += $output->writeFieldBegin('group', TType::STRING, 9);
      $xfer += $output->writeString($this->group);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_BlockLocation {
  static $_TSPEC;

  public $hosts = null;
  public $names = null;
  public $offset = null;
  public $length = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'hosts',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        2 => array(
          'var' => 'names',
          'type' => TType::LST,
          'etype' => TType::STRING,
          'elem' => array(
            'type' => TType::STRING,
            ),
          ),
        3 => array(
          'var' => 'offset',
          'type' => TType::I64,
          ),
        4 => array(
          'var' => 'length',
          'type' => TType::I64,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['hosts'])) {
        $this->hosts = $vals['hosts'];
      }
      if (isset($vals['names'])) {
        $this->names = $vals['names'];
      }
      if (isset($vals['offset'])) {
        $this->offset = $vals['offset'];
      }
      if (isset($vals['length'])) {
        $this->length = $vals['length'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_BlockLocation';
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
            $this->hosts = array();
            $_size0 = 0;
            $_etype3 = 0;
            $xfer += $input->readListBegin($_etype3, $_size0);
            for ($_i4 = 0; $_i4 < $_size0; ++$_i4)
            {
              $elem5 = null;
              $xfer += $input->readString($elem5);
              $this->hosts []= $elem5;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::LST) {
            $this->names = array();
            $_size6 = 0;
            $_etype9 = 0;
            $xfer += $input->readListBegin($_etype9, $_size6);
            for ($_i10 = 0; $_i10 < $_size6; ++$_i10)
            {
              $elem11 = null;
              $xfer += $input->readString($elem11);
              $this->names []= $elem11;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->offset);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->length);
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
    $xfer += $output->writeStructBegin('hadoopfs_BlockLocation');
    if ($this->hosts !== null) {
      if (!is_array($this->hosts)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('hosts', TType::LST, 1);
      {
        $output->writeListBegin(TType::STRING, count($this->hosts));
        {
          foreach ($this->hosts as $iter12)
          {
            $xfer += $output->writeString($iter12);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->names !== null) {
      if (!is_array($this->names)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('names', TType::LST, 2);
      {
        $output->writeListBegin(TType::STRING, count($this->names));
        {
          foreach ($this->names as $iter13)
          {
            $xfer += $output->writeString($iter13);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    if ($this->offset !== null) {
      $xfer += $output->writeFieldBegin('offset', TType::I64, 3);
      $xfer += $output->writeI64($this->offset);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->length !== null) {
      $xfer += $output->writeFieldBegin('length', TType::I64, 4);
      $xfer += $output->writeI64($this->length);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_createopt {
  static $_TSPEC;

  public $user = null;
  public $compress = null;
  public $extopt = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'user',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'compress',
          'type' => TType::BOOL,
          ),
        3 => array(
          'var' => 'extopt',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['user'])) {
        $this->user = $vals['user'];
      }
      if (isset($vals['compress'])) {
        $this->compress = $vals['compress'];
      }
      if (isset($vals['extopt'])) {
        $this->extopt = $vals['extopt'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_createopt';
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
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->compress);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->extopt);
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
    $xfer += $output->writeStructBegin('hadoopfs_createopt');
    if ($this->user !== null) {
      $xfer += $output->writeFieldBegin('user', TType::STRING, 1);
      $xfer += $output->writeString($this->user);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->compress !== null) {
      $xfer += $output->writeFieldBegin('compress', TType::BOOL, 2);
      $xfer += $output->writeBool($this->compress);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->extopt !== null) {
      $xfer += $output->writeFieldBegin('extopt', TType::STRING, 3);
      $xfer += $output->writeString($this->extopt);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_QuotaInfo {
  static $_TSPEC;

  public $namenode_info = null;
  public $files = null;
  public $total = null;
  public $used = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'namenode_info',
          'type' => TType::I64,
          ),
        2 => array(
          'var' => 'files',
          'type' => TType::I64,
          ),
        3 => array(
          'var' => 'total',
          'type' => TType::I64,
          ),
        4 => array(
          'var' => 'used',
          'type' => TType::I64,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['namenode_info'])) {
        $this->namenode_info = $vals['namenode_info'];
      }
      if (isset($vals['files'])) {
        $this->files = $vals['files'];
      }
      if (isset($vals['total'])) {
        $this->total = $vals['total'];
      }
      if (isset($vals['used'])) {
        $this->used = $vals['used'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_QuotaInfo';
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
            $xfer += $input->readI64($this->namenode_info);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->files);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->total);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->used);
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
    $xfer += $output->writeStructBegin('hadoopfs_QuotaInfo');
    if ($this->namenode_info !== null) {
      $xfer += $output->writeFieldBegin('namenode_info', TType::I64, 1);
      $xfer += $output->writeI64($this->namenode_info);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->files !== null) {
      $xfer += $output->writeFieldBegin('files', TType::I64, 2);
      $xfer += $output->writeI64($this->files);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->total !== null) {
      $xfer += $output->writeFieldBegin('total', TType::I64, 3);
      $xfer += $output->writeI64($this->total);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->used !== null) {
      $xfer += $output->writeFieldBegin('used', TType::I64, 4);
      $xfer += $output->writeI64($this->used);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_UserInfo {
  static $_TSPEC;

  public $username = null;
  public $spaceQuota = null;
  public $userGroup = null;
  public $mode = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'username',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'spaceQuota',
          'type' => TType::I64,
          ),
        3 => array(
          'var' => 'userGroup',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'mode',
          'type' => TType::I16,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['username'])) {
        $this->username = $vals['username'];
      }
      if (isset($vals['spaceQuota'])) {
        $this->spaceQuota = $vals['spaceQuota'];
      }
      if (isset($vals['userGroup'])) {
        $this->userGroup = $vals['userGroup'];
      }
      if (isset($vals['mode'])) {
        $this->mode = $vals['mode'];
      }
    }
  }

  public function getName() {
    return 'hadoopfs_UserInfo';
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
            $xfer += $input->readString($this->username);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->spaceQuota);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->userGroup);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->mode);
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
    $xfer += $output->writeStructBegin('hadoopfs_UserInfo');
    if ($this->username !== null) {
      $xfer += $output->writeFieldBegin('username', TType::STRING, 1);
      $xfer += $output->writeString($this->username);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->spaceQuota !== null) {
      $xfer += $output->writeFieldBegin('spaceQuota', TType::I64, 2);
      $xfer += $output->writeI64($this->spaceQuota);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->userGroup !== null) {
      $xfer += $output->writeFieldBegin('userGroup', TType::STRING, 3);
      $xfer += $output->writeString($this->userGroup);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->mode !== null) {
      $xfer += $output->writeFieldBegin('mode', TType::I16, 4);
      $xfer += $output->writeI16($this->mode);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class hadoopfs_MalformedInputException extends TException {
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
    return 'hadoopfs_MalformedInputException';
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
    $xfer += $output->writeStructBegin('hadoopfs_MalformedInputException');
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

class hadoopfs_ThriftIOException extends TException {
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
    return 'hadoopfs_ThriftIOException';
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
    $xfer += $output->writeStructBegin('hadoopfs_ThriftIOException');
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
