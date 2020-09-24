<?php


class MySQL
{
    private $dbConn;

    public function __construct()
    {
        $this->dbConn = new mysqli(
            "localhost",
            "jose", // Change me
            "jose", // Change me
            "dbDevops");
        if ($this->dbConn->connect_error)
            exit("Connection error");
    }

    public function addTool($symbol,$tool,$license,$number,$logo)
    {
        $insert_tool_query = "INSERT INTO dbDevops.tbDevops VALUES ('{$symbol}','{$tool}','{$license}','{$number}','{$logo}')";
        if ($this->dbConn->query($insert_tool_query))
            echo "<h1>Añadido correctamente</h1>";
        else
            exit("Insertion error");
    }
    public function getTools()
    {
        $select_tools_query = "SELECT * FROM dbDevops.tbDevops ORDER BY NumeroElementoQuimico";
        $result = $this->dbConn->query($select_tools_query);
        $array = array();
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $array[] = array(
                    "symbol" => $row["SimboloQuimico"],
                    "tool" => $row["Tool"],
                    "license" => $this->getLicenceByCode($row["Licencia"]),
                    "number" => $row["NumeroElementoQuimico"],
                    "logo" => base64_encode($row["Logo"])
                    //"logo" => $row["Logo"]
                );
            }
            //print_r($array);
            return $array;
        }
        else
            return false;
    }
    function getLicenceByCode($code)
    {
        $select_license_query = "SELECT * FROM dbdevops.tblicencia WHERE Licencia = '{$code}'";
        $result = $this->dbConn->query($select_license_query);
        if($result->num_rows > 0)
        {
            $license_name = $result->fetch_assoc()["NombreLicencia"];
        }
        else
            $license_name = "Error";
        return $license_name;
    }
}