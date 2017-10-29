<?php

class Model_InfoPassed
{
    use Model_Singleton;
    protected static $instance;
    protected $_aRawInput;
    protected $_aInspectParts;
    protected $_aInfoParts;

    protected function getRawInput()
    {
        if (is_null($this->_aRawInput)) {
            $this->_aRawInput = stream_get_contents(STDIN);
        }
        return $this->_aRawInput;
    }

    protected function getInfoChunks()
    {
        return $this->_aInfoParts ?:
          ($this->_aInfoParts = explode($this->getChunkSeparator(), $this->getRawInput()));
    }
    public function getDockerCompose()
    {
        $aChunks = $this->getInfoChunks();
        return $aChunks[0];
    }

    protected function getChunkSeparator()
    {
        return "__z_separate__";
    }

    protected function getInspectSeparator()
    {
        return "--z-inspect-separator--";
    }

    public function getInspectParts()
    {
        if (is_null($this->_aInspectParts)){
            $aChunks = $this->getInfoChunks();
            $vChunk = trim($aChunks[2]);
            $aInspect = explode($this->getInspectSeparator(), $vChunk);
            $this->_aInspectParts = array_filter($aInspect);
        }
        return $this->_aInspectParts;
    }

    protected function getParameters()
    {
        global $argv;
        return $argv;
    }
}