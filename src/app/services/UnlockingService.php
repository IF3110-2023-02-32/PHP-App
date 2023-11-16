<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseService.php";
require_once PROJECT_ROOT_PATH . "/src/utils/SoapWrapper.php";
require_once PROJECT_ROOT_PATH . "/src/clients/SocmedSoapClient.php";
require_once PROJECT_ROOT_PATH . "/src/models/UnlockingModel.php";
require_once PROJECT_ROOT_PATH . "/src/repositories/UnlockingRepository.php";

class UnlockingService extends BaseSrv {
  protected static $instance;
  private $client;
  
  private function __construct($client) {
    parent::__construct();
    $this->client = $client;
  }

  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new static(
        SocmedSoapClient::getInstance()
      );
    }
    return self::$instance;
  }

  public function getAcceptedUnlockingBySocmedId($socmedId) {
    $unlocksSQL = UnlockingRepository::getInstance()->getAcceptedUnlockingBySocmedId($socmedId);

    $unlocks = [];
    foreach ($unlocksSQL as $unlockSQL) {
      $unlock = new UnlockingModel();
      $unlocks[] = $unlock->constructFromArray($unlockSQL);
    }
    return $unlocks;
  }

  public function update($socmed_id, $dashboard_id, $link_code) {
    return UnlockingnRepository::getInstance()
            ->updateUnlocking($socmed_id, $dashboard_id, $link_code);
  }

  public function requestUnlocking($socmed_id, $link_code) {
    $resp = $this->client->requestUnlocking($socmed_id, $link_code);
    UnlockingRepository::getInstance()->insertUnlocking($socmed_id, null, $link_code);

    return $resp;
  }

  public function getSoapUnlocking() {
    return $this->client->getUnlocking();
  }

  public function getUnlocking() {
    $sqlRes = UnlockingRepository::getInstance()->getAllUnlockings();

    $unlocks = [];
    foreach ($sqlRes as $unlockSQL) {
      $unlock = new UnlockingModel();
      $unlocks[] = $unlock->constructFromArray($unlockSQL);
    }

    return $subs;
  }

  public function acceptUnlocking($socmed_id, $link_code) {
    return $this->client->acceptUnlocking($socmed_id, $link_code);
  }

  public function rejectUnlocking($socmed_id, $link_code) {
    return $this->client->rejectUnlocking($socmed_id, $link_code);
  }
}
