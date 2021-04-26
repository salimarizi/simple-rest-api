<?php
namespace App\Soap\Request;

/**
 *
 */
class GetStudentsData
{
    protected $id;
    protected $nrp;
    protected $nama;
    protected $prodi;
    protected $fakultas;
    protected $universitas;

    public function __construct($id, $nrp, $nama, $prodi, $fakultas, $universitas)
    {
        $this->id = $id;
        $this->nrp = $nrp;
        $this->nama = $nama;
        $this->prodi = $prodi;
        $this->fakultas = $fakultas;
        $this->universitas = $universitas;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getNRP()
    {
        return $this->nrp;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getProdi()
    {
        return $this->prodi;
    }

    public function getFakultas()
    {
        return $this->fakultas;
    }

    public function getUniversitas()
    {
        return $this->universitas;
    }
}

?>
