<?php
$url = 'https://6483457cf2e76ae1b95c3b21.mockapi.io/users';

if (isset($_POST['guardar'])) {
    MetodoPOST($url);
    $_POST['guardar']=null;
}elseif(isset($_POST['eliminar'])){
    MetodoDelete($url, $_POST["cedula"]);
}elseif(isset($_POST['buscar'])){
    $id = IdwithCedula($url, $_POST["cedula"]);
    $ArrayBuscado = BuscarByCedula($url, $id);
}elseif(isset($_POST['subir'])){
    $id = $_POST['subir'];
    $ArrayBuscado = BuscarByCedula($url, $id);
}elseif(isset($_POST['actualizar'])){
    $id = IdwithCedula($url, $_POST["cedula"]);
    MetodoPUT($url, $id);
}

function MetodoPOST($url){
    // Crear un array con los datos a enviar a la API
    $data = array(
    "cedula"=> $_POST["cedula"],
    "name" => $_POST["nombre"],
    "surname" => $_POST["apellido"],
    "address"=> $_POST["direccion"],
    "age"=> $_POST["edad"],
    "mail"=> $_POST["email"],
    "time"=> $_POST["hora"],
    "team"=>$_POST["team"],
    "trainer"=>$_POST["trainer"]
    );

    // Convertir los datos a JSON
    $jsonData = json_encode($data);
    // Configurar la solicitud a la API
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'POST',
            'content' => $jsonData
        )
    );
    
    // Realizar la solicitud a la API
    $response = file_get_contents($url, false, stream_context_create($options));

    // Verificar la respuesta de la API
    if (!$response) {
        echo "Error al enviar los datos a la API.";
    }
}

function MetodoPUT($url, $id){
    // Crear un array con los datos a enviar a la API
    $data = array(
    "cedula"=> $_POST["cedula"],
    "name" => $_POST["nombre"],
    "surname" => $_POST["apellido"],
    "address"=> $_POST["direccion"],
    "age"=> $_POST["edad"],
    "mail"=> $_POST["email"],
    "time"=> $_POST["hora"],
    "team"=>$_POST["team"],
    "trainer"=>$_POST["trainer"]
    );

    // Convertir los datos a JSON
    $jsonData = json_encode($data);
    // Configurar la solicitud a la API
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'PUT',
            'content' => $jsonData
        )
    );

    $Editurl = $url . "/" . $id;
    
    // Realizar la solicitud a la API
    $response = file_get_contents($Editurl, false, stream_context_create($options));

    // Verificar la respuesta de la API
    if (!$response) {
        echo "Error al enviar los datos a la API.";
    }
}

function MetodoDelete($url, $cedula){
    $id = IdwithCedula($url, $cedula);
    $Deleteurl = $url . "/" . $id;

    // Configurar la solicitud a la API
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'DELETE'
        )
    );

    $context = stream_context_create($options);

    // Realizar la solicitud DELETE a la API
    $response = file_get_contents($Deleteurl, false, $context);

    // Verificar la respuesta de la API
    if (!$response) {
        echo "Error al eliminar el recurso de la API.";
    }
}

function MetodoGET($url){ 
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'GET'
        )
    );
    
    $context = stream_context_create($options);
    
    // Realizar la solicitud a la API
    $response = file_get_contents($url, false, $context);
    
    // Verificar la respuesta de la API
    if ($response) {
        // Decodificar la respuesta JSON en un array asociativo
        return $ApiDatos = json_decode($response, true);
    } else {
        echo "Error al obtener la información de la API.";
    }
}
$ApiDatos = MetodoGET($url);
function MostrarUsuarios($ApiDatos){
    foreach ($ApiDatos as $user) {
        echo "<tr>
        <td>" . $user["name"] . "</td>
        <td>" . $user["surname"] . "</td>
        <td>" . $user["address"] . " </td>
        <td>" . $user["age"] . " </td>
        <td>" . $user["mail"] . " </td>
        <td>" . $user["time"] . " </td>
        <td>" . $user["team"] . " </td>
        <td>" . $user["trainer"] . "</td>
        <td><button type='submit' value='{$user["id"]}' name='subir'>↑</button></td>
        </tr>";
    }
}
function IdwithCedula($url, $cedula) {
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'GET'
        )
    );
    
    $context = stream_context_create($options);
    
    // Realizar la solicitud a la API
    $response = file_get_contents($url, false, $context);
    
    // Verificar la respuesta de la API
    if ($response) {
        $ApiDatos = json_decode($response, true);
        foreach ($ApiDatos as $item) {
            if ($item['cedula'] == $cedula) {
                return $item['id'];
            }
        }
        return null; // Retorna null si no se encuentra el ID
    }    
}
function BuscarByCedula($url, $id){
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'GET'
        )
    );
    
    $context = stream_context_create($options);
    
    // Realizar la solicitud a la API
    $response = file_get_contents($url, false, $context);
    
    // Verificar la respuesta de la API
    if ($response) {
        $ApiDatos = json_decode($response, true);
        foreach ($ApiDatos as $item) {
            if ($item['id'] == $id) {
                return [
                    "nombre"=>$item["name"],
                    "apellido"=>$item["surname"],
                    "direccion"=>$item["address"],
                    "edad"=>$item["age"],
                    "email"=>$item["mail"],
                    "hora"=>$item["time"],
                    "team"=>$item["team"],
                    "trainer"=>$item["trainer"],
                    "cedula"=>$item["cedula"]
                ];
            }
        }
        return null; // Retorna null si no se encuentra el ID
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <nav>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php isset($ArrayBuscado['nombre']) ? print $ArrayBuscado['nombre']  : print "" ?>">
                        </div>
                        <div class="col titulo">
                            <label for="">CAMPUSLAND</label>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Apellidos" name="apellido" value="<?php isset($ArrayBuscado['apellido']) ? print $ArrayBuscado['apellido']  : print "" ?>">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" placeholder="Edad" name="edad" min="0" value="<?php isset($ArrayBuscado['edad']) ? print $ArrayBuscado['edad']  : print "" ?>">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion" value="<?php isset($ArrayBuscado['direccion']) ? print $ArrayBuscado['direccion']  : print "" ?>">
                        </div>
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Correo Electronico" value="<?php isset($ArrayBuscado['email']) ? print $ArrayBuscado['email']  : print "" ?>">
                        </div>
                    </div>
                </div>
            </nav>
            <main>
                <div class="row">
                    <div class="col">
                        <label for="">Horario de entrada</label><br>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="time" name="hora" id="" class="form-control" value="<?php isset($ArrayBuscado['hora']) ? print $ArrayBuscado['hora']  : print "" ?>">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <input class="btn" id="save" type="submit" name="guardar"  value="✔️">
                            </div>
                            <div class="col">
                                <input class="btn" id="delete" type="submit" name="eliminar" value="❌">
                            </div>
                        </div>
                        <input type="hidden" name="">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="text" placeholder="Team" name="team" id="" class="form-control" value="<?php isset($ArrayBuscado['team']) ? print $ArrayBuscado['team']  : print "" ?>">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <input class="btn" id="update" name="actualizar" type="submit" value="🖋️">
                            </div>
                            <div class="col">
                                <input class="btn" id="search" name="buscar" type="submit" value="🔍">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="text" name="trainer" placeholder="Trainer" id="" class="form-control" value="<?php isset($ArrayBuscado['trainer']) ? print $ArrayBuscado['trainer']  : print "" ?>">
                    </div>
                    <div class="col">
                        <input type="text" name="cedula" placeholder="Cédula" id="" class="form-control" value="<?php isset($ArrayBuscado['cedula']) ? print $ArrayBuscado['cedula']  : print "" ?>">
                    </div>
                </div>
            </main>
        <footer>
            <table>
                <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Edad</th>
                            <th>Email</th>
                            <th>Hora/entrada</th>
                            <th>Team</th>
                            <th>Trainer</th>
                        </tr>
                </thead>
                <tbody id="table">
                        <?php MostrarUsuarios($ApiDatos);  ?>
                </tbody>
            </table>
        </footer>
        </form>
    </div>
</body>
</html>