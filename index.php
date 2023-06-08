<?php

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
        <form action="POST">
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
                                <input class="btn" type="submit" name="guardar"  value="✔️">
                            </div>
                            <div class="col">
                                <input class="btn" type="submit" name="eliminar" value="❌">
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
                                <input class="btn" name="actualizar" type="submit" value="🖋️">
                            </div>
                            <div class="col">
                                <input class="btn" name="buscar" type="submit" value="🔍">
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

            </table>
        </footer>
    </div>
</body>
</html>