<?php


class CAS_ProxyChain_AllowedList
{

    private $_chains = array();

    /**
     * Check whether proxies are allowed by configuration
     *
     * @return bool
     */
    public function isProxyingAllowed()
    {
        return (count($this->_chains) > 0);
    }

    /**
     * Add a chain of proxies to the list of possible chains
     *
     * @param CAS_ProxyChain_Interface $chain A chain of proxies
     *
     * @return void
     */
    public function allowProxyChain(CAS_ProxyChain_Interface $chain)
    {
        $this->_chains[] = $chain;
    }

    /**
     * Check if the proxies found in the response match the allowed proxies
     *
     * @param array $proxies list of proxies to check
     *
     * @return bool whether the proxies match the allowed proxies
     */
    public function isProxyListAllowed(array $proxies)
    {
        phpCAS::traceBegin();
        if (empty($proxies)) {
            phpCAS::trace("No proxies were found in the response");
            phpCAS::traceEnd(true);
            return true;
        } elseif (!$this->isProxyingAllowed()) {
            phpCAS::trace("Proxies are not allowed");
            phpCAS::traceEnd(false);
            return false;
        } else {
            $res = $this->contains($proxies);
            phpCAS::traceEnd($res);
            return $res;
        }
    }

    /**
     * Validate the proxies from the proxy ticket validation against the
     * chains that were definded.
     *
     * @param array $list List of proxies from the proxy ticket validation.
     *
     * @return bool if any chain fully matches the supplied list
     */
    public function contains(array $list)
    {
        phpCAS::traceBegin();
        $count = 0;
        foreach ($this->_chains as $chain) {
            phpCAS::trace("Checking chain ". $count++);
            if ($chain->matches($list)) {
                phpCAS::traceEnd(true);
                return true;
            }
        }
        phpCAS::trace("No proxy chain matches.");
        phpCAS::traceEnd(false);
        return false;
    }
}
?>
