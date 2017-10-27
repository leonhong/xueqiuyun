<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/font.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/app.css" type="text/css" />
    <script src="bootstrap/js/jquery.min.js"></script>
</head>
<body>
<section class="vbox">
    <section class="panel panel-default">
        <header class="panel-heading" style="background-color: #3ab0e2;margin-left: 20px; margin-right: 20px;">
            <h4 style="color: #fff0ff;">股票列表</h4>
        </header>
        <form method="get" action="/table.php" id="sou">
            <input type="hidden" name="sort" value="" />
            <input type="hidden" name="name" value=""/>
            <input type="hidden" name="htype" value="<?php echo $_GET['htype']?>">
        <div class="row text-sm wrapper" style="margin-left: 20px; margin-right: 20px;">
            <div class="col-sm-4 m-b-xs">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-sm <?php if($_GET['htype']=='gg'||!isset($_GET['htype'])){ echo 'btn-danger active';}else{ echo 'btn-default';} ?>">
                        <input type="radio" name="options" id="gg"> 港股
                    </label>
                    <label class="btn btn-sm <?php if($_GET['htype']=='hs'){ echo 'btn-danger active';}else{ echo 'btn-default';} ?>">
                        <input type="radio" name="options" id="hs"> 沪深
                    </label>
                    <label class="btn btn-sm <?php if($_GET['htype']=='ggt'){ echo 'btn-danger active';}else{ echo 'btn-default';} ?>">
                        <input type="radio" name="options" id="ggt"> 港股通
                    </label>
                </div>
            </div>
            <div class="col-sm-5 m-b-xs">
                筛选公式：
                <select class="input-sm form-control input-s-sm inline" name="type" style="width: 220px;">
                    <option value="-1">选择公式</option>
                    <option value="0" <?php if($_GET['type']=='0'){ ?>selected="selected"<?php } ?>>双五组合</option>
                    <option value="1" <?php if($_GET['type']=='1'){ ?>selected="selected"<?php } ?>>TTM<10并且资产负债率<50%</option>
                    <option value="2" <?php if($_GET['type']=='2'){ ?>selected="selected"<?php } ?>>净净</option>
                    <option value="3" <?php if($_GET['type']=='3'){ ?>selected="selected"<?php } ?>>神奇</option>
                    <option value="4" <?php if($_GET['type']=='4'){ ?>selected="selected"<?php } ?>>R15</option>
                </select>
            </div>

            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="股票代码/股票名称" name="key" value="<?php echo $_GET['key'];?>">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" id="gosearch" type="button">搜索</button>
                      </span>
                </div>
            </div>
        </div>
        </form>
        <div class="table-responsive"id="list" style="margin:0px  20px;">
            <table class="table table-striped b-t b-light text-sm">
                <thead>
                <tr>
                    <th>股票代码 </th>
                    <th>名称 </th>
                    <th  class="th-sortable" data-toggle="class">时间
                     <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='time'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='time'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="time"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">价格
                   <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='gujia'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='gujia'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="gujia"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">财报时间
                     <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='ctime'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='ctime'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="ctime"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">市值(亿)
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='shizhi'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='shizhi'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="shizhi"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">TTM
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='ttm'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='ttm'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="ttm"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">PB
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='pb'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='pb'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="pb"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">ROE
                    <span class="th-sort">
                            <?php if($_GET['type']=='3'){  ?>
                            <i class="fa fa-sort-<?php if($_GET['name']=='roe_sq'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='roe_sq'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="roe_sq"></i>
                            <?php }else{  ?>
                                <i class="fa fa-sort-<?php if($_GET['name']=='roe'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='roe'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="roe"></i>
                             <?php } ?>
                    </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">DYR
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='dyr'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='dyr'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="dyr"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">DebtRatio
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='debtratio'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='debtratio'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="debtratio"></i>
                     </span>
                    </th>
                    <th  class="th-sortable" data-toggle="class">净净流动资产（亿）
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='jinjin'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='jinjin'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="jinjin"></i>
                     </span>
                    </th>
                    <th>净净/市值</th>
                    <th class="th-sortable" data-toggle="class">Rank(TTM)
                    <span class="th-sort">
                            <i class="fa fa-sort-<?php if($_GET['name']=='rank_ttm'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='rank_ttm'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="rank_ttm"></i>
                     </span>
                    </th>
                    <th class="th-sortable" data-toggle="class">Rank(ROE)
                    <span class="th-sort">
                        <?php if($_GET['type']=='3'){  ?>
                            <i class="fa fa-sort-<?php if($_GET['name']=='rank_roesq'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='rank_roesq'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="rank_roesq"></i>
                        <?php }else{  ?>
                            <i class="fa fa-sort-<?php if($_GET['name']=='rank_roe'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='rank_roe'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="rank_roe"></i>
                        <?php } ?>
                     </span>
                    </th>
                    <th class="th-sortable" data-toggle="class">Rank
                    <span class="th-sort">
                        <?php if($_GET['type']=='3'){  ?>
                            <i class="fa fa-sort-<?php if($_GET['name']=='rank_allsq'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='rank_allsq'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="rank_allsq"></i>
                        <?php }else{  ?>
                            <i class="fa fa-sort-<?php if($_GET['name']=='rank_all'){ echo $_GET['sort']=='asc'?'down':'up'; }else{ echo 'down'; } ?> text" sort="<?php if($_GET['name']=='rank_all'){ echo $_GET['sort']; }else{ echo 'asc';}?>" item="rank_all"></i>
                        <?php } ?>
                     </span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                /**
                 * 执行股票列表计算
                 */
                $basedir = dirname(__FILE__) . '/../../lib';
                include  $basedir.'/config.php';
                include  $basedir.'/functions.php';
                include $basedir.'/mysqli.php';


                /*配置数据库*/

$db_conf['host'] = 'localhost';
$db_conf['username'] = 'root';
$db_conf['password'] = '20160401';
$db_conf['database'] = 'stock';
$db_conf['prot'] = '3306';

                /*实例DB*/
                $db =  new DB($db_conf);
                $prepage = 50;
                if($_GET['htype']=='ggt'){
                    $where = 'where is_hk=1 ';
                }else{
                    $where = 'where 1=1 ';
                }

                if(!empty($_GET['key'])){
                    $where .= " and (a.`code` like '%{$_GET['key']}%' or b.name like '%{$_GET['key']}%') ";
                }

                $name = $_GET['name'];
                $sort = $_GET['sort'];
                if($_GET['type']>-1){
                    switch($_GET['type']){
                        case '0':
                             $where .= " and a.ttm < 5 and a.ttm > 0 and a.dyr > 0.05 ";
                            break;
                        case '1':
                             $where .= " and a.ttm <10 and a.ttm > 0 and a.debtratio < 0.5 and a.debtratio >0 ";
                            break;
                        case '2':
                            $where .= " and  a.ttm > 0 and a.shizhi < a.jinjin ";
                            break;
                        case '3':
                            //$where .=" order by a.rank_all asc";
                            if(empty($name) && empty($sort)) {
                               $name = 'rank_allsq';
                               $sort  = 'asc';
                            }
                            break;
                    }
                }
                $order = '';
                if(!empty($name) && !empty($sort)){
                    switch($name){
                        case 'time':
                              $order = " order by b.update_time $sort";
                            break;
                        case 'gujia':
                             $order = " order by b.gujia $sort";
                            break;
                        case 'rank_all':
                            $order = " order by a.rank_all $sort";
                            break;
                        default:
                            $order = " order by a.$name  $sort";
                            break;
                    }

                 }

                //获取数据总数
                $sql = "select a.*,b.* from xl_hk_huizong as a left join xl_hk_value as b on a.`code`=b.`code` $where $order";

                $count = $db->count($sql);
                //计算页数
                $pagecount = ceil($count/$prepage);
                $page = $_GET['page']?$_GET['page']:1;
                $begin = ($page-1)*$prepage;
                $sql = "select a.*,b.* from xl_hk_huizong as a left join xl_hk_value as b on a.`code`=b.`code` $where $order  limit $begin,$prepage";
                /*echo $sql;
                exit;*/
                $list = $db->select($sql);

                ?>
                        <?php
                            foreach($list as $k=>$v) {
                                ?>
                        <tr <?php if($v['is_hk']=='1'){ ?>style="background-color: #e8f3fd;" item="1" <?php } ?>>
                            <td><a href="detail.html" class="active" data-toggle="class"><?php echo $v['code'];?></a></td>
                            <td><?php echo $v['name'];?></td>
                            <td><?php echo $v['update_time'];?></td>
                            <td><?php echo $v['gujia'];?></td>
                            <td><?php echo $v['ctime'];?></td>
                            <td><?php echo sprintf('%.3f',$v['shizhi']/100000000); ?></td>
                            <td><?php echo sprintf('%.3f',$v['ttm']);?></td>
                            <td><?php echo sprintf('%.3f',$v['pb']);?></td>
                            <?php if($_GET['type']=='3'){  ?>
                                <td><?php echo sprintf('%.3f',$v['roe_sq']*100)."%";?></td>
                            <?php }else{ ?>
                                <td><?php echo sprintf('%.3f',$v['roe']*100)."%";?></td>
                            <?php } ?>
                            <td><?php echo sprintf('%.3f',$v['dyr']*100)."%";?></td>
                            <td><?php echo sprintf('%.3f',$v['debtratio']*100)."%";?></td>
                            <td><?php echo $v['jinjin']!='--'?sprintf('%.3f',$v['jinjin']/100000000):$v['jinjin'];?></td>
                            <td><?php echo sprintf('%.3f',(($v['jinjin']/100000000)/($v['shizhi']/100000000))*100)."%"; ?></td>
                            <td><?php echo $v['rank_ttm'];?></td>
                            <?php if($_GET['type']=='3'){  ?>
                                <td><?php echo $v['rank_roesq'];?></td>
                                <td><?php echo $v['rank_allsq'];?></td>
                            <?php }else{ ?>
                                <td><?php echo $v['rank_roe'];?></td>
                                <td><?php echo $v['rank_all'];?></td>
                            <?php } ?>
                        </tr>
                        <?php
                            }
                        ?>
                </tbody>
            </table>
        </div>
        <footer class="panel-footer" style="margin-right: 20px; margin-left: 20px;">
            <div class="row">
                <!--<div class="col-sm-4 hidden-xs">
                    <select class="input-sm form-control input-s-sm inline">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>-->
                <div class="col-sm-12 text-right text-center-xs" >
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href="/table.php?page=<?php echo ($page-1)>0?($page-1):1; ?>&key=<?php echo $_GET['key'];?>&type=<?php echo $_GET['type'];?>&htype=<?php echo $_GET['htype'];?>&name=<?php echo $_GET['name'];?>&sort=<?php echo $_GET['sort'];?>"><i class="fa fa-chevron-left"></i></a></li>
                        <?php for($i=1;$i<=$pagecount;$i++){ ?>
                        <li><a href="/table.php?page=<?php echo $i;?>&key=<?php echo  $_GET['key'];?>&type=<?php echo $_GET['type'];?>&htype=<?php echo $_GET['htype'];?>&name=<?php echo $_GET['name'];?>&sort=<?php echo $_GET['sort'];?>" <?php if($i==$page){ ?> style="background-color: #eeeeee;"<?php } ?> ><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li><a href="/table.php?page=<?php echo ($page+1)<=$pagecount?($page+1):$pagecount; ?>&key=<?php echo $_GET['key'];?>&type=<?php echo $_GET['type'];?>&htype=<?php echo $_GET['htype'];?>&name=<?php echo $_GET['name'];?>&sort=<?php echo $_GET['sort'];?>"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </section>
</section>
</body>
<script>
    $(document).ready(function(){
        $('tbody').find('tr').mouseover(function(){
            $(this).attr('style',"background-color:#F3F9FE");
        })
        $('tbody').find('tr').mouseout(function(){
            $(this).removeAttr('style');
            if($(this).attr('item')=='1'){
                $(this).attr('style',"background-color:#e8f3fd");
            }
        })

        $('#gosearch').click(function(){
            $('#sou').submit();
       })

        $('input[name=options]').click(function(){
            window.location.href="/table.php?htype="+$(this).attr('id');
        })

        $('.th-sort').find('i').click(function(){
           if($(this).attr('sort')=='asc'){
               $('input[name=sort]').val('desc');
           }else{
               $('input[name=sort]').val('asc');
           }
            $('input[name=name]').val($(this).attr('item'));
            $('#sou').submit();
        })
    })
</script>
</html>