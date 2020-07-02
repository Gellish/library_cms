<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Sip;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingList;
use Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingList ipAccessControlListMappings
 * @property \Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingList credentialListMappings
 * @method \Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingContext ipAccessControlListMappings(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingContext credentialListMappings(string $sid)
 */
class DomainContext extends InstanceContext {
    protected $_ipAccessControlListMappings = null;
    protected $_credentialListMappings = null;

    /**
     * Initialize the DomainContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $accountSid The account_sid
     * @param string $sid Fetch by unique Domain Sid
     * @return \Twilio\Rest\Api\V2010\Account\Sip\DomainContext 
     */
    public function __construct(Version $version, $accountSid, $sid) {
        parent::__construct($version);
        
        // Path Solution
        $this->solution = array(
            'accountSid' => $accountSid,
            'sid' => $sid,
        );
        
        $this->uri = '/Accounts/' . $accountSid . '/SIP/Domains/' . $sid . '.json';
    }

    /**
     * Fetch a DomainInstance
     * 
     * @return DomainInstance Fetched DomainInstance
     */
    public function fetch() {
        $params = Values::of(array());
        
        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );
        
        return new DomainInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }

    /**
     * Update the DomainInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return DomainInstance Updated DomainInstance
     */
    public function update($options = array()) {
        $options = new Values($options);
        
        $data = Values::of(array(
            'AuthType' => $options['authType'],
            'FriendlyName' => $options['friendlyName'],
            'VoiceFallbackMethod' => $options['voiceFallbackMethod'],
            'VoiceFallbackUrl' => $options['voiceFallbackUrl'],
            'VoiceMethod' => $options['voiceMethod'],
            'VoiceStatusCallbackMethod' => $options['voiceStatusCallbackMethod'],
            'VoiceStatusCallbackUrl' => $options['voiceStatusCallbackUrl'],
            'VoiceUrl' => $options['voiceUrl'],
        ));
        
        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );
        
        return new DomainInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the DomainInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Access the ipAccessControlListMappings
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingList 
     */
    protected function getIpAccessControlListMappings() {
        if (!$this->_ipAccessControlListMappings) {
            $this->_ipAccessControlListMappings = new IpAccessControlListMappingList(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }
        
        return $this->_ipAccessControlListMappings;
    }

    /**
     * Access the credentialListMappings
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingList 
     */
    protected function getCredentialListMappings() {
        if (!$this->_credentialListMappings) {
            $this->_credentialListMappings = new CredentialListMappingList(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }
        
        return $this->_credentialListMappings;
    }

    /**
     * Magic getter to lazy load subresources
     * 
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     * 
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }
        
        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.DomainContext ' . implode(' ', $context) . ']';
    }
}