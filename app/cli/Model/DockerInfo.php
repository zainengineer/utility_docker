<?php
class Model_DockerInfo
{
    use Model_Singleton;
    protected $_inspectParts;
    protected $_aDockerCompose;
    public function getInspectParts()
    {
        if (is_null($this->_inspectParts)){
            $this->_inspectParts = [];
            $aInspect = getInfoPassed()->getInspectParts();
            foreach ($aInspect as $vInspectService) {
                $this->_inspectParts[] = current(json_decode($vInspectService,true));
            }
        }
        return $this->_inspectParts;
    }
    public function getDockerCompose()
    {
        if (is_null($this->_aDockerCompose)){
            $vDockerCompose = getInfoPassed()->getDockerCompose();
            $this->_aDockerCompose = yaml_parse($vDockerCompose);
        }
        return $this->_aDockerCompose;
    }

}