<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $ns = url('/students');
        $server = new \soap_server();
        $server->configureWSDL('WEB SERVICE MAHASISWA', 'urn:mahasiswaServerWSDL');
        $server->wsdl->schemaTargetNamespace = $ns;

        $server->wsdl->addComplexType(
            "mahasiswaData",
            "complexType",
            "struct",
            "all",
            "",
            array(
                "nrp" => array("name" => "nrp", "type" => "xsd:string"),
                "nama" => array("name" => "nama", "type" => "xsd:string"),
                "prodi" => array("name" => "prodi", "type" => "xsd:string"),
                "fakultas" => array("name" => "fakultas", "type" => "xsd:string"),
                "universitas" => array("name" => "universitas", "type" => "xsd:string")
            )
        );

        $server->wsdl->addComplexType(
            "mahasiswaArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array(
                    "ref" => "SOAP-ENC:arrayType",
                    "wsdl:arrayType" => "tns:mahasiswaData[]"
                )
            ),
            "mahasiswaData"
        );

        $server->register(
            'readall',
            array('input' => 'xsd:String'), // input parameters
            array('output' => 'xsd:Array'), // output parameters
            $ns, // namespace
            "urn:" . $ns . "/readall", // soapaction
            "rpc", // style
            "encoded", // use
            "Mengambil Semua Data Mahasiswa"
        );
    }

    public function index()
    {
        $client = new \nusoap_client(url('/students/readall?wsdl'), true);
        $param = " ";
        $result = $this->readall();
        dd($result);
    }

    public function rss()
    {
        $client = new \nusoap_client(url('/students/readall?wsdl'), true);
        $param = " ";
        $students = $this->readall();
        return response()->view('rest_rss', compact('students'))->header('Content-Type', 'application/xml');
    }

    public function rdf()
    {
        $client = new \nusoap_client(url('/students/readall?wsdl'), true);
        $param = " ";
        $students = $this->readall();
        $nTriples = '';
        $URI = 'http://www.praktikum.com/maranatha';

        $nrp = '';
        foreach ($students as $student) {
            foreach ($student->toArray() as $key => $value) {
                if ($key != 'nrp') {
                  echo $value;
                  $nTriples .= '<'. $URI .'/'. $student->nrp .'>';
                  $nTriples .= ' <'. $URI .'#has'. ucwords($key) .'>';
                  $nTriples .= ' "'. $value .'" .' ."\n";
                }
            }
            $nTriples .= "\n";
        }

        file_put_contents("rdf.txt", $nTriples);
    }

    public function readall() {
        return Student::all();
    }
}
