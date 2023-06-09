<?php
$url = 'https://6483457cf2e76ae1b95c3b21.mockapi.io/users';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Crear un array con los datos a enviar a la API
    $data = array(
        "id"=> $_POST["cedula"],
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

    if (isset($_POST['guardar'])) {
        // Configurar la solicitud a la API
        $options = array(
        'http' => array(
            'header' => "Content-Type: application/json",
            'method' => 'POST',
            'content' => $jsonData
        )
    );

    $context = stream_context_create($options);

    // Realizar la solicitud a la API
    $response = file_get_contents($url, false, $context);

    // Verificar la respuesta de la API
    if ($response) {
    } else {
        echo "Error al enviar los datos a la API.";
    }
    }

    $_POST=array();
    $data=array();
}

function createUser($url){
    
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
        $ApiDatos = json_decode($response, true);
    
        // Mostrar la información obtenida
        foreach ($ApiDatos as $user) {
            echo "<tr>
            <td>" . $user["name"] . "</td>
            <td>" . $user["surname"] . "</td>
            <td>" . $user["addres"] . " </td>
            <td>" . $user["age"] . " </td>
            <td>" . $user["mail"] . " </td>
            <td>" . $user["time"] . " </td>
            <td>" . $user["team"] . " </td>
            <td>" . $user["trainer"] . "</td>
            </tr>";
        }
    } else {
        echo "Error al obtener la información de la API.";
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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <nav>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                        </div>
                        <div class="col titulo">
                            <label for="">CAMPUSLAND</label>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Apellidos" name="apellido">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" placeholder="Edad" name="edad" min="0">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion">
                        </div>
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Correo Electronico">
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
                        <input type="time" name="hora" id="" class="form-control">
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
                        <input type="text" placeholder="Team" name="team" id="" class="form-control">
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
                        <input type="text" name="trainer" placeholder="Trainer" id="" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" name="cedula" placeholder="Cédula" id="" class="form-control">
                    </div>
                </div>
            </main>
        </form>
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
                        <?php createUser($url);  ?>
                </tbody>
            </table>
        </footer>
    </div>
</body>
</html>