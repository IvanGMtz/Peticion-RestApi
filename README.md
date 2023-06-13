# Formulario PHP con operaciones CRUD

Este formulario PHP utiliza cada método del CRUD (Create, Read, Update, Delete) dependiendo del botón que se seleccione. El formulario solicita los siguientes datos de cada usuario: nombre, apellido, edad, dirección, grupo, hora de ingreso, trainer, team y cédula.

## Funcionalidades

1. **Creación de usuario**
   - Ingresa los datos del usuario en el formulario.
   - Al hacer clic en el botón ✔️, se envían los datos a una API en mockapi.io para crear un nuevo objeto de usuario.
2. **Obtención de usuarios**
   - Al hacer clic en el botón de búsqueda (🔍) cuando el campo de cédula está lleno los datos correspondiente a dicha cédula se ingresan al formulario.
3. **Eliminación de usuario**
   - Al hacer clic en el botón de eliminación (❌), se envía una solicitud a la API para eliminar el objeto de usuario correspondiente. Se debe ingresar la cedula del usuario a eliminar.
4. **Edición de usuario**
   - Al hacer clic en el botón de edición (🖋️), se permite modificar los datos del usuario seleccionado.
   - Los datos modificados se envían a la API para actualizar el objeto de usuario correspondiente.

## Uso del formulario

1. Abre el formulario en un navegador web compatible con PHP.
2. Ingresa los datos del usuario en los campos proporcionados.
3. Selecciona el botón correspondiente a la operación deseada (✔️ para crear, ❌ para eliminar, 🔍 para buscar, 🖋️ para editar).
4. Los datos de los usuarios se mostrarán en una tabla debajo del formulario.
5. El campo obligatorio para el uso de cada uno de los botones es cédula.

### URL

https://6483457cf2e76ae1b95c3b21.mockapi.io/users