<?php
/**
 * Created by PhpStorm.
 * User: joserto86
 * Date: 22/07/21
 * Time: 19:38
 */

namespace App\Message;


class ElementMessage
{
    private $name;

    private $fid;

    private $fno;

    public function __construct($name, $fid, $fno)
    {
        $this->name = $name;
        $this->fid = $fid;
        $this->fno = $fno;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ElementMessage
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFid()
    {
        return $this->fid;
    }

    /**
     * @param mixed $fid
     * @return ElementMessage
     */
    public function setFid($fid)
    {
        $this->fid = $fid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFno()
    {
        return $this->fno;
    }

    /**
     * @param mixed $fno
     * @return ElementMessage
     */
    public function setFno($fno)
    {
        $this->fno = $fno;
        return $this;
    }
}