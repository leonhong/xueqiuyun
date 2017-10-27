#! /bin/bash
path=`dirname $0`
echo $path
cd $path

#echo `pwd`

/bin/bash ./HKstock/start_hk_history_fuzhai.sh
/bin/bash ./HKstock/start_hk_history_caiwu.sh
/bin/bash ./HKstock/start_hk_history_xianjin.sh
/bin/bash ./HKstock/start_hk_history_lirun.sh
