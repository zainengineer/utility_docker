<?php

class Model_DockerDigInfo
{
    use Model_Singleton;
    protected $_aIps = [];
    protected $_bDataFilled = false;
    protected $_aHostEntries = [];
    protected $_aServiceNameMap = [];
    protected $_aServiceName = [];

    protected function fillData()
    {
        if (!$this->_bDataFilled) {
            $this->_bDataFilled = true;
            $aDockerInspect = getDockerInfo()->getInspectParts();
            foreach ($aDockerInspect as $aDockerInfo) {
                $aConfig = $aDockerInfo['Config'];

                $aLabels = $aConfig['Labels'];
                $vServiceName = $aLabels['com.docker.compose.service'];
                $vName = ltrim($aDockerInfo['Name'],'/');
                $this->_aServiceNameMap[$vServiceName] = $vName;
                $this->_aServiceName[$vServiceName] = $vServiceName;

                $aNetworkSetting = $aDockerInfo['NetworkSettings'];
                $this->processNetwork($vServiceName, $aNetworkSetting);
            }
        }
    }

    protected function processNetwork($vServiceName, $aNetworkSetting)
    {
        $aDefaultNetwork = current($aNetworkSetting['Networks']);
        $this->_aIps[$vServiceName] = $aDefaultNetwork['IPAddress'];
        $vHost = $vServiceName;
        $aLinks = $aDefaultNetwork['Links'];
        $aLinks = $aLinks?: [];
        foreach ($aLinks as $vLink) {
            //local sub domain
            if (strpos($vLink, '.')) {
                $aParts = explode(':', $vLink);
                $vHost  = $aParts[1];
            }
        }
        $this->_aHostEntries[$vHost] = $aDefaultNetwork['IPAddress'];
    }
    public function getHostsEntries()
    {
        $this->fillData();
        return $this->_aHostEntries;
    }
    public function getServiceNameMap()
    {
        $this->fillData();
        return $this->_aServiceNameMap;
    }
    public function getServiceName()
    {
        $this->fillData();
        return $this->_aServiceName;
    }
}