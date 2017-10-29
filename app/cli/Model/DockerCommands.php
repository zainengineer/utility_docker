<?php

class Model_DockerCommands
{
    use Model_Singleton;
    public function exec()
    {
        global $argv;
        $aArguments = $argv;
        $oAction = getDockerActions();
        if (empty($aArguments[1])){
            $oAction->noAction();
            return ;
        }
        if ($aArguments[1] =='ssh'){
            if (empty($aArguments[2])){
                $oAction->noSshService();
            }else{
                $oAction->ssh($aArguments[2]);
            }
            return;
        }
        if ($aArguments[1] =='ip_list'){
             $oAction->getHostsEntry();
            return;
        }

    }
}