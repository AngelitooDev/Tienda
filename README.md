README - API y Web para Gestión de Productos

=======================================
CONTROLADOR: ProductControllerApi
=======================================

Este controlador expone una API REST para gestionar productos. A continuación, se explican los endpoints y cómo usarlos en Postman:

1. **Listar todos los productos (GET)**
    - URL: `http://localhost/api/productos`
    - Método: GET
    - Respuesta: Devuelve una lista de todos los productos en formato JSON.
    - Código de respuesta: 200

2. **Mostrar un producto específico (GET)**
    - URL: `http://localhost/api/productos/{id}`
    - Método: GET
    - Parámetros:
        - `{id}`: ID del producto a consultar.
    - Respuesta: Devuelve el producto solicitado en formato JSON.
    - Código de respuesta:
        - 200 si se encuentra el producto.
        - 404 si el producto no existe.

3. **Crear un producto (POST)**
    - URL: `http://localhost/api/productos`
    - Método: POST
    - Cuerpo de la solicitud (JSON):
      ```json
      {
        "type": "Armas cortas",
        "name": "Nombre del producto",
        "description": "Descripción del producto",
        "stock": 10,
        "weight": 1.5,
        "image": "https://example.com/imagen.jpg"
      }
      ```
    - Respuesta: Devuelve el producto creado en formato JSON.
    - Código de respuesta:
        - 201 si se crea correctamente.
        - 422 si los datos son inválidos.

4. **Actualizar un producto (PUT)**
    - URL: `http://localhost/api/productos/{id}`
    - Método: PUT
    - Parámetros:
        - `{id}`: ID del producto a actualizar.
    - Cuerpo de la solicitud (JSON):
      ```json
      {
        "type": "Armas largas",
        "name": "Nombre actualizado",
        "description": "Descripción actualizada",
        "stock": 20,
        "weight": 2.0,
        "image": "https://example.com/imagen-actualizada.jpg"
      }
      ```
    - Respuesta: Devuelve el producto actualizado en formato JSON.
    - Código de respuesta:
        - 200 si se actualiza correctamente.
        - 404 si el producto no existe.

5. **Eliminar un producto (DELETE)**
    - URL: `http://localhost/api/productos/{id}`
    - Método: DELETE
    - Parámetros:
        - `{id}`: ID del producto a eliminar.
    - Respuesta: Devuelve un mensaje de éxito.
    - Código de respuesta:
        - 200 si se elimina correctamente.
        - 404 si el producto no existe.

=======================================
CONTROLADOR: ProductViewController
=======================================

Este controlador maneja las vistas web de la gestión de productos. A continuación, se explican sus métodos principales:

1. **Listar todos los productos**
    - URL: `http://localhost/productos`
    - Método: GET
    - Función: Muestra todos los productos en una tabla en la vista.

2. **Formulario para crear un producto**
    - URL: `http://localhost/productos/crear`
    - Método: GET
    - Función: Muestra un formulario para crear un nuevo producto.

3. **Guardar un producto**
    - URL: `http://localhost/productos`
    - Método: POST
    - Función: Valida y guarda un nuevo producto en la base de datos.

4. **Formulario para editar un producto**
    - URL: `http://localhost/productos/{id}/editar`
    - Método: GET
    - Función: Muestra un formulario para editar un producto existente.

5. **Actualizar un producto**
    - URL: `http://localhost/productos/{id}`
    - Método: PUT
    - Función: Valida y actualiza un producto existente en la base de datos.

6. **Eliminar un producto**
    - URL: `http://localhost/productos/{id}`
    - Método: DELETE
    - Función: Elimina un producto y su imagen asociada (si existe).

=======================================
NOTAS ADICIONALES
=======================================

- **Validación de datos en la API:**
    - El campo `type` solo acepta valores: "Armas cortas", "Cuchillos", "Armas largas".
    - La imagen debe ser una URL válida.
    - Otros campos como `name`, `description`, `stock` y `weight` tienen validaciones específicas para evitar datos inválidos.
