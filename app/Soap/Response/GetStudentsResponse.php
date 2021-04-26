<?php
namespace App\Soap\Response;

/**
 *
 */
class GetStudentsDataResponse
{
    protected $GetStudentDataResult;
    public function __construct($GetStudentDataResult)
    {
        $this->GetStudentDataResult = $GetStudentDataResult;
    }

    public function getGetStudentDataResult()
    {
        return $this->GetStudentDataResult;
    }
}

?>
