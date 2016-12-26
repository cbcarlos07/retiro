<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 24/12/2016
 * Time: 22:39
 */
class Retiro
{
  private $cd_retiro;
  private $ds_retiro;
  private $data_retiro;

    /**
     * @return mixed
     */
    public function getCdRetiro()
    {
        return $this->cd_retiro;
    }

    /**
     * @param mixed $cd_retiro
     */
    public function setCdRetiro($cd_retiro)
    {
        $this->cd_retiro = $cd_retiro;
    }

    /**
     * @return mixed
     */
    public function getDsRetiro()
    {
        return $this->ds_retiro;
    }

    /**
     * @param mixed $ds_retiro
     */
    public function setDsRetiro($ds_retiro)
    {
        $this->ds_retiro = $ds_retiro;
    }

    /**
     * @return mixed
     */
    public function getDataRetiro()
    {
        return $this->data_retiro;
    }

    /**
     * @param mixed $data_retiro
     */
    public function setDataRetiro($data_retiro)
    {
        $this->data_retiro = $data_retiro;
    }
    
    
}