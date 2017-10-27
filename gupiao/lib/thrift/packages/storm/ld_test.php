<?php
/**
 * 获取用户app列表
 */

#$basedir = dirname(__FILE__) . '/../../../../lib';
#include $basedir . '/config.php';
#include $basedir . '/functions.php';
#include $basedir . '/mysqli.php';

require_once $GLOBALS['THRIFT_ROOT'].'/packages/storm/ClusterAdmin.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocket.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocketPool.php';
require_once $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TFramedTransport.php';
require_once $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php';

function getUserTopologies($users)
{
#     $socket = new TSocket($storm_conf['host'], $storm_conf['port']);
     $socket = new TSocket("103.28.10.251", 8001);
     $socket->setSendTimeout(10000);
     $socket->setRecvTimeout(50000);
     $transport = new TFramedTransport($socket);
     $protocol = new TBinaryProtocol($transport);
     $transport->open();
     $client = new ClusterAdminClient($protocol);
     $topologies = $client->getAllTopologyConf();
     ksort($topologies, SORT_STRING);
#     $allAssignments = $client->getAllTopologyAssignment();
     $allClusterSate = $client->getAllClusterState();
     $transport->close();
          
     $return_topologies=array();
     $tmp_topology=array();
     $tmp_details=array();
     foreach ($topologies as $key => $val) {
     	 $all_details=array();
         $name = $key;
         $topologyConf = $val;
  #       $assignments = $allAssignments[$name]->assignment;
         $usedWorkers = 0;
         $usedClusters = 0;
	 $tmp_contain=false;
         $group_conf=$topologyConf->other_attr['group'];
         if (!in_array($group_conf, $users) && !in_array("all", $users)) {
              	continue;
         }
     
         $tmp_topology['name']=$name;
         $tmp_topology['update_php']="http://test.nbds.sys.corp.qihoo.net:9002/view/storm/update_app.php?topology=".$name;
         $tmp_topology['log_php']="http://test.nbds.sys.corp.qihoo.net:9002/view/storm/log.php?topology=".$name;
         $tmp_topology['version']=$topologyConf->version;
         $tmp_topology['input_type']=$topologyConf->input_type;
         $tmp_topology['workers']=0; 
     

         foreach ($topologyConf->each_cluster_workers as $cluster => $assignment){
             $assign = json_decode($assignment,true);
             $tmp_cluster = '';
             $tmp_details['cluster']=$cluster;
             $tmp_details['cluster_url']='';
             $tmp_details['allocated_workers']=$assign['workers'];
             $tmp_details['used_workers']=0;
             $tmp_details['function']='http://nbds.sys.corp.qihoo.net/view/storm/stat.php?cluster_name='.$cluster.'&app_name='.$name;
             $tmp_details['running_version']='';
             $status='KILLED'; 
             $tmp_details['update']='';
             $tmp_details['uptime']='0h';
             $contain_topo=false;
             if (array_key_exists($cluster, $allClusterSate))
             {     
                   $tmp_cluster = json_encode($allClusterSate[$cluster]);
             #      if ( strpos($tmp_cluster,$name)  )
         	  foreach($allClusterSate[$cluster] as $key => $value)
         	  {
         		if ($key == 'topology_list') {
         		     foreach($value as $k => $v )
         		     {
         			  if($k == $name)
         			  { 
         			       $contain_topo=true;
         			  }
         		     }
         		}
         	  }
                   if ( $contain_topo  )
                   {
                       $topology=$allClusterSate[$cluster]->topology_list[$name];
                       $id=$topology->id;
                       if (empty($id)) {
                       	   $address = $allClusterSate[$cluster]->address . ":8360/";
                       } else {
                         	   $address = $allClusterSate[$cluster]->address . ":8360/topology/" . $id;
                            }	
                       $uptimesecs=$topology->attr['uptime'];
                       $uptimehour = ceil($uptimesecs / 3600) . "h";
                       $status=$topology->status;
                       if (!in_array("all", $users) && $status == "KILLED") {
                           continue;
                       }
                       $tmp_details['cluster_url']=$address;
                       if( $topology->workers > $topology->workers && $status != "KILLED")
                       {
                           $tmp_details['used_workers']=0;
                       } else
                       {
                           $tmp_details['used_workers']=$topology->workers;	
                       }
                       if($topology->version !=null)
                       {
                           $tmp_details['running_version']=$topology->version;
                       } else
                       {
                           $tmp_details['running_version']='';
                       }
                       if ($topology->updatepercent !=null)
                       {
                           $tmp_details['update']=$topology->updatepercent . "%";
                       } else
                       {
                           $tmp_details['update']='';
                       }
         	      if($status != "KILLED"){
                           $usedClusters = $usedClusters + 1;
                       }
                       $usedWorkers = $usedWorkers + $topology->workers;
                       $tmp_topology['workers']=$usedWorkers;
                       $tmp_details['uptime']=$uptimehour;
         	  }
               }
             if($status != 'KILLED')
             {
		array_push($all_details,$tmp_details);
	     }
         }
         $tmp_topology['topology_details']=$all_details;

         array_push($return_topologies,$tmp_topology);
    }
    return $return_topologies;
}

