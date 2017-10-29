<?php

class Model_DockerActions
{
    use Model_Singleton;
    public function getHostsEntry()
    {
        $aHostEntries = getDockerDigInfo()->getHostsEntries();
        $vHosts = "";
        foreach ($aHostEntries as $vHostName => $vIp) {
            $vHosts.="$vHostName\t\t\t$vIp\n";
        }
        $this->displayString($vHosts);
    }
    protected function displayString($vString)
    {
//        echo $vString;
        echo "cat <<EOF\n$vString\nEOF\n";
    }
    public function ssh($vService)
    {
        $aServiceNameMap = getDockerDigInfo()->getServiceNameMap();
        $vContainerName = $aServiceNameMap[$vService];
        echo "docker exec -it $vContainerName bash";
    }
    public function noSshService()
    {
        $vOutput = "Please provide name of the service, (one of the below)\n";
        $vOutput.= implode("  ",getDockerDigInfo()->getServiceName()) . "\n";
        $this->displayString($vOutput);
    }
    public function ipList()
    {
        getDockerActions()->getHostsEntry();
    }
    public function noAction()
    {
        $vMessage = "Try parameters like 'ssh util'  or like 'ip_list'";
        $this->displayString($vMessage);
    }
}