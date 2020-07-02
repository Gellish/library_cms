<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1;

use Twilio\Options;
use Twilio\Values;

abstract class WorkspaceOptions {
    /**
     * @param string $defaultActivitySid The default_activity_sid
     * @param string $eventCallbackUrl The event_callback_url
     * @param string $friendlyName The friendly_name
     * @param string $timeoutActivitySid The timeout_activity_sid
     * @return UpdateWorkspaceOptions Options builder
     */
    public static function update($defaultActivitySid = Values::NONE, $eventCallbackUrl = Values::NONE, $friendlyName = Values::NONE, $timeoutActivitySid = Values::NONE) {
        return new UpdateWorkspaceOptions($defaultActivitySid, $eventCallbackUrl, $friendlyName, $timeoutActivitySid);
    }

    /**
     * @param string $friendlyName The friendly_name
     * @return ReadWorkspaceOptions Options builder
     */
    public static function read($friendlyName = Values::NONE) {
        return new ReadWorkspaceOptions($friendlyName);
    }

    /**
     * @param string $eventCallbackUrl The event_callback_url
     * @param string $template The template
     * @return CreateWorkspaceOptions Options builder
     */
    public static function create($eventCallbackUrl = Values::NONE, $template = Values::NONE) {
        return new CreateWorkspaceOptions($eventCallbackUrl, $template);
    }
}

class UpdateWorkspaceOptions extends Options {
    /**
     * @param string $defaultActivitySid The default_activity_sid
     * @param string $eventCallbackUrl The event_callback_url
     * @param string $friendlyName The friendly_name
     * @param string $timeoutActivitySid The timeout_activity_sid
     */
    public function __construct($defaultActivitySid = Values::NONE, $eventCallbackUrl = Values::NONE, $friendlyName = Values::NONE, $timeoutActivitySid = Values::NONE) {
        $this->options['defaultActivitySid'] = $defaultActivitySid;
        $this->options['eventCallbackUrl'] = $eventCallbackUrl;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['timeoutActivitySid'] = $timeoutActivitySid;
    }

    /**
     * The default_activity_sid
     * 
     * @param string $defaultActivitySid The default_activity_sid
     * @return $this Fluent Builder
     */
    public function setDefaultActivitySid($defaultActivitySid) {
        $this->options['defaultActivitySid'] = $defaultActivitySid;
        return $this;
    }

    /**
     * The event_callback_url
     * 
     * @param string $eventCallbackUrl The event_callback_url
     * @return $this Fluent Builder
     */
    public function setEventCallbackUrl($eventCallbackUrl) {
        $this->options['eventCallbackUrl'] = $eventCallbackUrl;
        return $this;
    }

    /**
     * The friendly_name
     * 
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName) {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The timeout_activity_sid
     * 
     * @param string $timeoutActivitySid The timeout_activity_sid
     * @return $this Fluent Builder
     */
    public function setTimeoutActivitySid($timeoutActivitySid) {
        $this->options['timeoutActivitySid'] = $timeoutActivitySid;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Taskrouter.V1.UpdateWorkspaceOptions ' . implode(' ', $options) . ']';
    }
}

class ReadWorkspaceOptions extends Options {
    /**
     * @param string $friendlyName The friendly_name
     */
    public function __construct($friendlyName = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The friendly_name
     * 
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName) {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Taskrouter.V1.ReadWorkspaceOptions ' . implode(' ', $options) . ']';
    }
}

class CreateWorkspaceOptions extends Options {
    /**
     * @param string $eventCallbackUrl The event_callback_url
     * @param string $template The template
     */
    public function __construct($eventCallbackUrl = Values::NONE, $template = Values::NONE) {
        $this->options['eventCallbackUrl'] = $eventCallbackUrl;
        $this->options['template'] = $template;
    }

    /**
     * The event_callback_url
     * 
     * @param string $eventCallbackUrl The event_callback_url
     * @return $this Fluent Builder
     */
    public function setEventCallbackUrl($eventCallbackUrl) {
        $this->options['eventCallbackUrl'] = $eventCallbackUrl;
        return $this;
    }

    /**
     * The template
     * 
     * @param string $template The template
     * @return $this Fluent Builder
     */
    public function setTemplate($template) {
        $this->options['template'] = $template;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Taskrouter.V1.CreateWorkspaceOptions ' . implode(' ', $options) . ']';
    }
}