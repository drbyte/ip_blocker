<?php
// Designed for Zen Cart v1.5.7 or newer

class zcObserverWhosOnlineIpBlockerLink extends base
{
    public function __construct()
    {
        if (function_exists('ip_blocker_is_enabled') && ip_blocker_is_enabled()) {
            $this->attach($this, ['ADMIN_WHOSONLINE_IP_LINKS']);
        }
    }

    /**
     * @param string $eventID name of the observer event fired
     * @param string $item whos_online record
     * @param string $additional_ipaddress_links updateable list of links
     * @param array $whois_url url of whois service to use for inquiring about the ip address
     */
    protected function update(&$class, $eventID, $item, &$additional_ipaddress_links, &$whois_url)
    {
        if (empty($item)) return;

        $additional_ipaddress_links .= ' &mdash; <a href="' . zen_href_link(FILENAME_WHOS_ONLINE, zen_get_all_get_params(array('ip', 'action')) . 'action=block&ip=' . $item['ip_address']) . '">' . IP_BLOCKER_TEXT_BLOCK_IP . '</a>';
    }
}
