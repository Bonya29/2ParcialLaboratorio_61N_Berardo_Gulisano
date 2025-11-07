# 📋 TODO LIST

## 🏗️ Arquitectura MVC

### **Modelo (M)**
- `todoModel.php` - Maneja operaciones de base de datos
- `rutinaModel.php` - Maneja operaciones de base de datos de rutina
- `Model.php` (clase base) - Proporciona métodos CRUD genéricos

### **Vista (V)**
- `todolist.php` - Lista principal de tareas
- `addTodo.php` - Formulario para nuevas tareas
- `editTodo.php` - Formulario para editar tareas
- `rutinalist.php` - Lista principal de rutinas
- `addRutina.php` - Formulario para nueva rutina
- `editRutina.php` - Formulario para editar rutina
- `inc_header.php` - Navegación y estructura base
- `inc_footer.php` - Scripts y cierre

### **Controlador (C)**
- `todoController.php` - Lógica de negocio
- `rutinaController.php` - Lógica de negocio para rutinas
- `Controller.php` (clase base) - Métodos helper comunes

## 🔄 FLUJO COMPLETO DE LA APLICACIÓN

### **1. INICIO DE LA APLICACIÓN**
```
Usuario accede → index.php → Core::run() → Autoloader → Configuración
```

**Archivos involucrados:**
- `index.php` - Punto de entrada
- `Core.php` - Inicializa el framework
- `core_config.php` - Configuración global
- `Autoloader.php` - Carga automática de clases

### **2. NAVEGACIÓN A TODO LIST**
```
URL: /todo → Core::dispatch() → todoController::index()
```

**Flujo detallado:**
1. Usuario hace clic en "Todo List" u escribe `/todo` | Usuario hace clic en "Mis Rutinas" u escribe `/rutinas`
2. `Core.php` procesa la URL con `filter_url()`
3. `dispatch()` determina controlador: `todoController` o `rutinasController`
4. `dispatch()` determina método: `index`
5. Se instancia en `todoController` o `rutinasController`  y ejecuta `index()`

### **3. CARGAR LISTA DE TAREAS O RUTINAS**
```
todoController::index() → todoModel::getAllWithDetails() → View::render()
rutinasController::index() → rutinasModel::getAll() → View::render()
```

**Proceso paso a paso:**
1. **Controlador** (`todoController::index()` ):
   - Llama a `todoModel::getAllWithDetails()`
   - Prepara datos para la vista
   - Llama a `View::render('todolist', $data)`

1. **Controlador** (`rutinasController::index()` ):
   - Llama a `rutinasModel::getAll()`
   - Prepara datos para la vista
   - Llama a `View::render('rutinaslist', $data)`

2. **Modelo** (`todoModel::getAllWithDetails()`):
   - Extiende `Model::all()` (clase base)
   - Ejecuta consulta SQL: `SELECT * FROM todos ORDER BY created_at DESC`
   - Procesa cada tarea con `Todo::getPriorityText()` y `Todo::getPriorityColor()`
   - Retorna array con datos procesados

2. **Modelo** (`rutinaModel::getAll()`):
- Extiende `Model::all()` (clase base)
- Ejecuta consulta SQL: `SELECT * FROM rutina ORDER BY tipo DESC`
- Devuelve arreglo con las rutinas registradas
- Retorna array con datos procesados

3. **Vista** (`todolist.php`):
   - Incluye `inc_header.php` (navegación)
   - Muestra `Toast::flash()` (notificaciones)
   - Renderiza lista de tareas con Bootstrap
   - Incluye `inc_footer.php` (scripts)

3. **Vista** (`rutinalist.php`):
- Incluye `inc_header.php` (navegación)
- Renderiza lista de tareas con Bootstrap
- Incluye `inc_footer.php` (scripts)


### **4. AGREGAR NUEVA TAREA**
```
Formulario → todoController::store() → todoModel::create() → Redirect::to()
Formulario → rutinaController::store() → rutinaModel::create() → Redirect::to()
```

**Flujo completo:**
1. **Usuario accede al formulario**:
   - URL: `/todo/add`
   - `todoController::add()` renderiza `addTodo.php`

1. **Usuario accede al formulario**:
   - URL: `/rutinas/add`
   - `rutinasController::add()` renderiza `addRutina.php`

2. **Usuario envía formulario**:
   - POST a `/todo/store`
   - `todoController::store()` procesa datos

2. **Usuario envía formulario**:
- POST a `/rutinas/store`
- `rutinasController::store()` procesa datos

3. **Validación**:
   - `$this->validatePost(['task'])` verifica campos requeridos
   - Si falla: `Toast::new()` + `Redirect::to()`

3. **Validación**:
   - `rutinaController::store()` verifica campos requeridos
   - Si es válido, ejecuta: `rutinaModel::create($data)`

4. **Guardado**:
   - `todoModel::create($todoData)` extiende `Model::create()`
   - Ejecuta `INSERT INTO todos` con prepared statements

4. **Guardado**:
   - `rutinasModel::create($todoData)` extiende `Model::create()`
   - Ejecuta `INSERT INTO rutinas` con prepared statements
   
5. **Redirección**:
   - `$this->redirectWithMessage('todo', 'Tarea agregada exitosamente', 'success')`
   - `Toast::new()` guarda mensaje en `$_SESSION`
   - `Redirect::to()` redirige a `/todo`


6. **Confirmación**:
   - Usuario llega a `/todo`
   - `Toast::flash()` lee mensaje de `$_SESSION` y lo muestra
   - Mensaje se auto-elimina de `$_SESSION`

### **5. EDITAR TAREA EXISTENTE**
```
Formulario → todoController::update() → todoModel::update() → Redirect::to()
Formulario → rutinasController::update() → rutinasModel::update() → Redirect::to()
```

**Flujo completo:**
1. **Usuario accede al formulario de edición**:
   - Hace clic en botón "Editar" de una tarea
   - URL: `/todo/edit?id=123`
   - `todoController::edit()` busca la tarea con `todoModel::find()`
   - Renderiza `editTodo.php` con datos pre-cargados

1. **Usuario accede al formulario de edición**:
   - Hace clic en botón "Editar" de una rutina
   - URL: `/rutina/edit?id=5`
   - `rutinasController::edit()` busca la tarea con `rutinasModel::find()`
   - Renderiza `editRutina.php` con datos pre-cargados

2. **Usuario modifica y envía formulario**:
   - POST a `/todo/update`
   - `todoController::update()` procesa datos
   
2. **Usuario modifica y envía formulario**:
   - POST a `/rutina/update`
   - `rutinaController::update()` procesa datos

3. **Validación**:
   - Valida ID y campos requeridos
   - Si falla: redirección con mensaje de error
 
4. **Actualización**:
   - `todoModel::update($id, $todoData)` extiende `Model::update()`
   - Ejecuta `UPDATE todos SET task = ?, description = ?, priority = ? WHERE id = ?`

4. **Actualización**:
   - `rutinasModel::update()` extiende `Model::update()`
   - Ejecuta `UPDATE rutina SET nombre = ?, tipo = ?, descripcion = ? WHERE id = ?`

5. **Confirmación**:
   - Redirección a `/todo` con mensaje de éxito
   - Redirección a `/rutinas` con mensaje de éxito

### **6. CAMBIAR ESTADO DE TAREA**
```
Enlace → todoController::toggle() → Todo::toggleStatus() → Redirect::to()
```

**Proceso:**
1. Usuario hace clic en botón de estado
2. GET a `/todo/toggle?id=123`
3. `todoController::toggle()`:
   - Valida ID
   - Verifica que tarea existe con `todoModel::find()`
   - Llama a `Todo::toggleStatus()`
4. `Todo::toggleStatus()` ejecuta: `UPDATE todos SET completed = NOT completed WHERE id = ?`
5. Redirección con mensaje de confirmación

### **7. ELIMINAR TAREA**
```
Enlace → Confirmación JS → todoController::delete() → todoModel::delete()
Enlace → rutinaController::delete() → rutinaModel::delete()
```

**Flujo:**
1. Usuario hace clic en botón eliminar
2. JavaScript muestra `confirm('¿Eliminar esta tarea?')`
3. Si confirma: GET a `/todo/delete?id=123`
4. `todoController::delete()`:
   - Valida ID
   - Verifica existencia
   - Llama a `todoModel::delete()`
5. `todoModel::delete()` extiende `Model::delete()`
6. Ejecuta: `DELETE FROM todos WHERE id = ?`
7. Redirección con mensaje de confirmación

1. Usuario hace clic en botón eliminar
2. JavaScript muestra `confirm('¿Eliminar esta tarea?')`
3. Si confirma: GET a `/rutinas/delete?id=`
4. `rutinasController::delete()`:
   - Valida ID
   - Verifica existencia
   - Llama a `rutinasModel::delete()`
5. `rutinasModel::delete()` extiende `Model::delete()`
6. Ejecuta: `DELETE FROM rutinas WHERE id = ?`
7. Redirección con mensaje de confirmación

### **8. BÚSQUEDA DE TAREAS**
```
Formulario → todoController::search() → todoModel::search()
```

**Proceso:**
1. Usuario escribe en barra de búsqueda
2. GET a `/todo/search?q=texto`
3. `todoController::search()`:
   - Valida término de búsqueda
   - Llama a `todoModel::search($search)`
4. `todoModel::search()` ejecuta: `SELECT * FROM todos WHERE task LIKE ? OR description LIKE ?`
5. Renderiza misma vista con resultados filtrados

## 🔧 COMPONENTES DEL FRAMEWORK UTILIZADOS

### **Core.php**
- ✅ `init()` - Inicialización del sistema
- ✅ `filter_url()` - Procesamiento de URLs
- ✅ `dispatch()` - Enrutamiento automático

### **Db.php**
- ✅ `query()` - Consultas preparadas seguras
- ✅ Conexión PDO automática
- ✅ Manejo de errores
- ✅ Implemento del patron Singleton

### **Toast.php**
- ✅ `new()` - Guardar notificaciones en sesión
- ✅ `flash()` - Mostrar y auto-eliminar notificaciones
- ✅ Tipos: success, warning, danger, info

### **Redirect.php**
- ✅ `to()` - Redirecciones robustas
- ✅ Fallback JavaScript si headers enviados
- ✅ Soporte URLs internas y externas

### **View.php**
- ✅ `render()` - Renderización de vistas
- ✅ `to_Object()` - Conversión array a objeto

### **Autoloader.php**
- ✅ Carga automática de clases
- ✅ Soporte para Controllers, Models, Classes

## 🌐 URLs DEL SISTEMA

| URL | Controlador | Método | Descripción |
|-----|-------------|--------|-------------|
| `/todo` | todoController | index | Lista principal |
| `/todo/add` | todoController | add | Formulario nueva tarea |
| `/todo/store` | todoController | store | Procesar nueva tarea |
| `/todo/edit?id=1` | todoController | edit | Formulario editar tarea |
| `/todo/update` | todoController | update | Procesar edición tarea |
| `/todo/toggle?id=1` | todoController | toggle | Cambiar estado |
| `/todo/delete?id=1` | todoController | delete | Eliminar tarea |
| `/todo/search?q=texto` | todoController | search | Buscar tareas |
|-------------------------------------------------------------------------|
| `/rutinas` | rutinaController | index | Lista principal |
| `/rutinas/add` | rutinaController | add | Formulario nueva rutina |
| `/rutinas/store` | rutinaController | store | Guardar nueva rutina |
| `/rutinas/edit?id=1` | rutinaController | edit | Formulario editar rutina |
| `/rutinas/update` | rutinaController | update | Procesar edición rutina |
| `/rutinas/delete?id=1` | rutinaController | delete | Eliminar rutina |


## 🧱 Patrones de diseño implementados
- ✅ Controladores, Modelos y Vistas (MVC)
- ✅ Singleton 

## 🚀 INSTALACIÓN

1. **Crear tabla**: Ejecutar `create_todos_table.sql`
2. **Archivos**: Copiar todos los archivos según estructura
3. **Configurar**: Verificar `core_config.php` (BD)
4. **Acceder**: `http://localhost/proyecto/todo` `http://localhost/proyecto/rutinas`

¡El sistema está listo para usar! 🎉