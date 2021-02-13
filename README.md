# Entrevista de PHP

En el siguiente repo encontrarán las respuestas a todos los ejercicios suministrados por el challenge de [Entrevista_PHP](https://github.com/leangasoftware/php-interview)

Para replicar la base de datos inclui el archivo SQL llamado viviendadb.sql en el root del proyecto.

Se usó el CSV sumistrado en el ejercicio [El csv del repo](https://gist.github.com/leifermendez/627650290d3edaeb420eef50395da73f)

## Ejercicio 1

Se accede directamente en el la página principal donde se sube el csv en un pequeño form a informa del estatus de la conexion de la base de datos y tambien si se subio correctamente el archivo.

---

## Ejercicio 2

Para filtrar el rango minimo o máximo se puede probar con este endpoint
http://localhost/PHP_interview/api/rango.php?min=2&max=10

Los parametros que recibe son:

1. **min:** El valor minimo.
2. **max**: El valor máximo.

Para filtrar por numero de habitaciones se puede probar con este
http://localhost/PHP_interview/api/habitaciones.php?habitaciones=2

El parametro que recibe es:

1. **habitaciones**: El número de habitaciones.

---

## Ejercicio 3

Para filtrar las locaciones basados en el metro cuadrado por zona.

http://localhost/PHP_interview/api/metro_cuadrado.php?lat=40.3658&long=-3.58845&distancia=10

Los parametros que reciben son:

1. **lat:** la latidud.
2. **long:** la longitud.
3. **distancia:** la cantidad de kilometros.

---

## Ejercicio 4

Para probar reportes:

http://localhost/PHP_interview/api/reporte.php?filtro=habitaciones&valor=3&tipo=pdf

La forma en la que trabaja es que selecciona en la base de datos todos los resultados que concuerden con los parametros del endpoint.

Por simplicidad para generar reportes de pdf usé la libreria [FPDF](http://www.fpdf.org/) y reprensenté solo las columnas id_vivienda, latitud, longitud y precio.

Los parametros que recibe son son:

1. **filtro:** que es igual al nombre de cualquier columna de la base de datos.
2. **valor:** que es valor que se le va a asociar al filtro.
3. **tipo:** si quiere reporte en **csv** o **pdf**.

_**Ejemplo:** se busca generar un reporte pdf de todas las locaiones con 3 habitaciones
el filtro es "habitaciones", el valor es "3" y el tipo es "pdf"_

---

## Referencia de columnas

Para usar como filtros u endpoints o simplemente referencia de esta manera estan escritos el nombre de las columnas en la base de datos.

id, latitud, id_vivienda, titulo, anunciante, descripcion, reformado, telefonos, tipo, precio, precio_metro, direccion, provincia, ciudad, metros_cuadrados, habitaciones, baños, parking, segunda_mano, armarios_empotrados, construido_en, amueblado, calefaccion_individual, calefaccion_energetica, planta, exterior, interior, ascensor, fecha, calle, barrio, distrito, terraza, trastero, cocina_equipada, cocina_equipada2, aire_acondicionado, piscina, jardin, metros_cuadrados_utiles, movilidad_reducida, plantas, mascotas, balcon,

---

## Extra❗

El proyecto esta subido a heroku 👉🏼 https://blooming-oasis-68578.herokuapp.com/ aunque no esta atado a ninguna base de datos MySQL por las nuevas politicas nuevas de Heroku que piden datos financieros inclusive para usar los productos gratis. Así que solo está hosteado el php.
