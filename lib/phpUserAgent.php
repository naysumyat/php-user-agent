<?php

/**
 * Simple PHP User agent
 *
 * @link      http://github.com/ornicar/php-user-agent
 * @version   1.0
 * @author    Thibault Duplessis <thibault.duplessis at gmail dot com>
 * @license   MIT License
 *
 * Documentation: http://github.com/ornicar/php-user-agent/blob/master/README.markdown
 * Tickets:       http://github.com/ornicar/php-user-agent/issues
 */

require_once(dirname(__FILE__).'/phpUserAgentStringParser.php');

class phpUserAgent
{
  protected $browserName;
  protected $browserVersion;
  protected $operatingSystem;

  public function __construct($userAgentString = null, phpUserAgentStringParser $userAgentStringParser = null)
  {
    $this->configureFromUserAgentString($userAgentString, $userAgentStringParser);
  }

  /**
   * Get the browser name
   *
   * @return string the browser name
   */
  public function getBrowserName()
  {
    return $this->browserName;
  }

  /**
   * Set the browser name
   *
   * @param   string  $name the browser name
   */
  public function setBrowserName($name)
  {
    $this->browserName = $name;
  }

  /**
   * Get the browser version
   *
   * @return string the browser version
   */
  public function getBrowserVersion()
  {
    return $this->browserVersion;
  }

  /**
   * Set the browser version
   *
   * @param   string  $version the browser version
   */
  public function setBrowserVersion($version)
  {
    $this->browserVersion = $version;
  }

  /**
   * Get the operating system name
   *
   * @return  string the operating system name
   */
  public function getOperatingSystem()
  {
    return $this->operatingSystem;
  }

  /**
   * Set the operating system name
   *
   * @param   string $operatingSystem the operating system name
   */
  public function setOperatingSystem($operatingSystem)
  {
    $this->operatingSystem = $operatingSystem;
  }

  /**
   * Tell whether this user agent is unknown or not
   *
   * @return boolean  true if this user agent is unknown, false otherwise
   */
  public function isUnknown()
  {
    return empty($this->browserName);
  }

  /**
   * @return string combined browser name and version
   */
  public function getFullName()
  {
    return $this->getBrowserName().' '.$this->getBrowserVersion();
  }

  public function __toString()
  {
    return $this->getFullName();
  }

  public function configureFromUserAgentString($userAgentString, phpUserAgentStringParser $userAgentStringParser = null)
  {
    if(null === $userAgentStringParser)
    {
      $userAgentStringParser = new phpUserAgentStringParser();
    }

    $this->fromArray($userAgentStringParser->parse($userAgentString));
  }

  /**
   * Convert the user agent to a data array
   *
   * @return  array data
   */
  public function toArray()
  {
    return array(
      'browser_name'      => $this->getBrowserName(),
      'browser_version'   => $this->getBrowserVersion(),
      'operating_system'  => $this->getOperatingSystem()
    );
  }

  /**
   * Configure the user agent from a data array
   *
   * @param array $data
   */
  public function fromArray(array $data)
  {
    $this->setBrowserName($data['browser_name']);
    $this->setBrowserVersion($data['browser_version']);
    $this->setOperatingSystem($data['operating_system']);
  }
}