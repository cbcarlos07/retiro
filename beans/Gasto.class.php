<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:23
 */
class Gasto
{
private $cd_gasto;
private $ds_gasto;
private $obs_gasto;
private $valor_gasto;
private $dt_gasto;

    /**
     * @return mixed
     */
    public function getCdGasto()
    {
        return $this->cd_gasto;
    }

    /**
     * @param mixed $cd_gasto
     */
    public function setCdGasto($cd_gasto)
    {
        $this->cd_gasto = $cd_gasto;
    }

    /**
     * @return mixed
     */
    public function getDsGasto()
    {
        return $this->ds_gasto;
    }

    /**
     * @param mixed $ds_gasto
     */
    public function setDsGasto($ds_gasto)
    {
        $this->ds_gasto = $ds_gasto;
    }

    /**
     * @return mixed
     */
    public function getObsGasto()
    {
        return $this->obs_gasto;
    }

    /**
     * @param mixed $obs_gasto
     */
    public function setObsGasto($obs_gasto)
    {
        $this->obs_gasto = $obs_gasto;
    }

    /**
     * @return mixed
     */
    public function getValorGasto()
    {
        return $this->valor_gasto;
    }

    /**
     * @param mixed $valor_gasto
     */
    public function setValorGasto($valor_gasto)
    {
        $this->valor_gasto = $valor_gasto;
    }

    /**
     * @return mixed
     */
    public function getDtGasto()
    {
        return $this->dt_gasto;
    }

    /**
     * @param mixed $dt_gasto
     */
    public function setDtGasto($dt_gasto)
    {
        $this->dt_gasto = $dt_gasto;
    }
 
    
}