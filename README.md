# API LIBROS

Endpoint de la API : http://localhost/TPEAPI/api/libros

## Tabla de ruteo
| URL          | Verbo        | Controller    | Metodo      |
| -----------  | -----------  | ------------- | ---------   |
| libros    |  GET         | ApiController | [getLibros()](https://github.com/joelkiehr/tpe_web/blob/main/Controller/ApiController.php#L27) |
| libros/:ID|  GET         | ApiController | [getLibro()](https://github.com/joelkiehr/tpe_web/blob/main/Controller/ApiController.php#L103)  |
| libros    |  POST        | ApiController | [AddLibro()](https://github.com/joelkiehr/tpe_web/blob/main/Controller/ApiController.php#L117)  |
| libros/:ID    |  PUT         | Apicontroller | [EditLibro()](https://github.com/joelkiehr/tpe_web/blob/main/Controller/ApiController.php#L134) |
| libros/:ID    |  DELETE      | Apicontroller | [DeleteLibro()](https://github.com/joelkiehr/tpe_web/blob/main/Controller/ApiController.php#L157/)|
| auth/token    | GET          | AuthController  | [getToken()](https://github.com/joelkiehr/tpe_web/blob/main/Controller/AuthController.php#L34)|



## `GET` `/libros`
Retorna como resultado una coleccion entera de entidades.

## `GET` `/libros/:ID`

Retorna como resultado una registro por su ID. 

Ejemplo:
`libros/8`

Salida
#### Código de respuesta 200 OK
```json
   {
       "id": 8,
       "nombre": "El sonámbulo",
       "nombre_del_autor": "asd",
       "anio_publicacion": 2019,
       "descripcion": "El arquitecto Leon Nader y su mujer, Natalie, acaban de instalarse en un bonito piso. Una mañana, Natalie empieza a empaquetar sus cosas y abandona rápidamente la vivienda, con la cara amoratada y los brazos heridos. Leon sale en su búsqueda desconcertado y pronto se da cuenta de que Natalie ha desaparecido. Leon, quien padecía sonambulismo cuando era pequeño, había llegado a recibir tratamiento psiquiátrico debido a su comportamiento agresivo mientras dormía. Ahora piensa que la desaparición de su esposa puede estar relacionada con su antigua enfermedad. ¿Será él el único culpable? ¿Pudo hacerle algo a Natalie mientras dormía?",
       "id_autor": null
    },
```
#### Código de respuesta en caso de error: `Libro no encontrada, 404`

## `POST` `/libros`
#### IMPORTANTE: REQUIERE TOKEN DE AUTENTICACION

Crea una nuevo registro.
Se debe utilizar el body con el siguiente formato JSON:


```json
{
        "nombre": String,
        "nombre_del_autor": String,
        "anio_publicacion": int,
        "descripcion": String,
        "id_autor": int
    }
```
#### Código de respuesta `201 Created`
#### Codigos de respuesta en caso de error `Complete los campos, 400`

## `PUT` `/libros/:ID`
#### IMPORTANTE: REQUIERE TOKEN DE AUTENTICACION

Modifica un registro existente

Ejemplo `/libros/9`
##### registro existente

```json
    {
   "id": 9,
        "nombre": "El héroe perdido",
        "nombre_del_autor": "asd",
        "anio_publicacion": 2014,
        "descripcion": "Cuando Jason despierta sabe que algo va muy mal. Está en un autobúscamino de un campamento para chicos problemáticos. Y le acompañan Piper-una muchacha (bastante guapa, por cierto) que dice que es su novia- yel que parece ser su mejor amigo, Leo...Pero él no recuerda nada: ni quién es ni cómo ha llegado allí.Pocas horas después, los tres descubrirán no solo que son hijos dedioses del Olimpo sino que su destino es cumplir una profecía de locos:liberar a Hera, diosa de la furia, de las garras de un enemigo que llevamucho tiempo planeando su venganza...«Con toda la acción, el ingenio y el corazón habituales en Riordan.»Publisher's Weekly",
        "id_autor": null
}
```
Enviamos la siguiente petición:

```json
    {
   "id": 9,
        "nombre": "El héroe perdido",
        "nombre_del_autor": "asd",
        "anio_publicacion": 2001,
        "descripcion": "Cuando Jason despierta sabe que algo va muy mal. Está en un autobúscamino de un campamento para chicos problemáticos. Y le acompañan Piper-una muchacha (bastante guapa, por cierto) que dice que es su novia- yel que parece ser su mejor amigo, Leo...Pero él no recuerda nada: ni quién es ni cómo ha llegado allí.Pocas horas después, los tres descubrirán no solo que son hijos dedioses del Olimpo sino que su destino es cumplir una profecía de locos:liberar a Hera, diosa de la furia, de las garras de un enemigo que llevamucho tiempo planeando su venganza...«Con toda la acción, el ingenio y el corazón habituales en Riordan.»Publisher's Weekly",
        "id_autor": 2
}
```

#### Resultado:

```json
    {
   "id": 9,
        "nombre": "El héroe perdido",
        "nombre_del_autor": "asd",
        "anio_publicacion": 2001,
        "descripcion": "Cuando Jason despierta sabe que algo va muy mal. Está en un autobúscamino de un campamento para chicos problemáticos. Y le acompañan Piper-una muchacha (bastante guapa, por cierto) que dice que es su novia- yel que parece ser su mejor amigo, Leo...Pero él no recuerda nada: ni quién es ni cómo ha llegado allí.Pocas horas después, los tres descubrirán no solo que son hijos dedioses del Olimpo sino que su destino es cumplir una profecía de locos:liberar a Hera, diosa de la furia, de las garras de un enemigo que llevamucho tiempo planeando su venganza...«Con toda la acción, el ingenio y el corazón habituales en Riordan.»Publisher's Weekly",
        "id_autor": 2
}
```
#### Código de respuesta `200 OK`
#### Códigos de respuesta en caso de error `No se encuentra el libro con el id $id,404`


## `DELETE` `/libros/:ID`

Borra una entidad existente
Ejemplo `/libros/24` 
#### Si la entidad existe devolverá como respuesta `Libro borrado,200` de lo contrario nos devolverá `El libro con el $id no existe, 404`

## `GET` `/auth/token`

Obtiene un token único por usuario que permite realizar acciones de POST, PUT y DELETE.

Importante: Para obtener un Token se debe tener un usuario en el sitio peliculas.


Como cabezera de autenticazion debe ser 'Basic Auth' e ingresar los datos de login de usuario
![image](https://user-images.githubusercontent.com/51015162/201585879-01e5e0a2-add5-45ca-9fc9-5d657fd92025.png)

Para utilizar el Token dado, en cualquier accion POST, PUT y DELETE debe utilizar como cabezera de autenticacion 'Bearer Token'

Por ejemplo:
![image](https://user-images.githubusercontent.com/51015162/201586341-f0d02df1-efed-4726-8218-5fc4b4a3903c.png)



## FIltrar por calificacion 
`/libros?field=value&value=value`

Permite filtrar libros por el año de publicacion de la tabla

Ejemplo: Filtrar todos los libros con año de publicacion `/libros?field=value&value=value` :
```json
[
    {
        "id": 9,
        "nombre": "El héroe perdido",
        "nombre_del_autor": "asd",
        "anio_publicacion": 2014,
        "descripcion": "Cuando Jason despierta sabe que algo va muy mal. Está en un autobúscamino de un campamento para chicos problemáticos. Y le acompañan Piper-una muchacha (bastante guapa, por cierto) que dice que es su novia- yel que parece ser su mejor amigo, Leo...Pero él no recuerda nada: ni quién es ni cómo ha llegado allí.Pocas horas después, los tres descubrirán no solo que son hijos dedioses del Olimpo sino que su destino es cumplir una profecía de locos:liberar a Hera, diosa de la furia, de las garras de un enemigo que llevamucho tiempo planeando su venganza...«Con toda la acción, el ingenio y el corazón habituales en Riordan.»Publisher's Weekly",
        "id_autor": null
    },
    {
        "id": 10,
        "nombre": "La marca de Antenea",
        "nombre_del_autor": "sad",
        "anio_publicacion": 2014,
        "descripcion": "El destino de la humanidad pende de un hilo: Gea ha abierto de par enpar las Puertas de la Muerte para liberar a sus despiadados monstruos.Los únicos que pueden cerrarlas son Percy, Jason, Piper, Hazel, Frank,Leo y Annabeth, el equipo de semidioses griegos y romanos elegido poruna antigua profecía. Pero su misión es todavía más difícil de lo queparece: sospechan que para encontrar las puertas deberán cruzar elocéano, tienen solo seis días para conseguirlo y, por si fuera poco,acaba de estallar la guerra entre sus dos campamentos y ahora ellos sonun objetivo...¿Lograrán ganar esta carrera de obstáculos contrarreloj?",
        "id_autor": null
    },
```
## Paginacion

Agrupa una cantidad determinada de resultados.
`/libros?page={int}&limit={int}`

| Parámetro | Descripcion |
|-----------|-------------|
| page={int}|Selecciona el registro de donde comenzará a paginarse|
| limit={int}|Limite de resultados|

En caso de que el limite no este definido, la cantidad de resultados sera de 10.

Ejemplo de uso: `libros?page=2&limit=2`

```json
[
    "Cantidad: 4",
    [
         {
        	"id": 1,
        	"nombre": "addd",
        	"nombre_del_autor": "fff",
        	"anio_publicacion": 34,
        	"descripcion": "aa",
        	"id_autor": 2
    	},
    	{
        	"id": 7,
        	"nombre": "xxxxxxx",
        	"nombre_del_autor": "fff",
        	"anio_publicacion": 34,
        	"descripcion": "aa",
        	"id_autor": 2
    	},
    	{
        	"id": 8,
        	"nombre": "El sonámbulo",
        	"nombre_del_autor": "asd",
        	"anio_publicacion": 2019,
        	"descripcion": "El arquitecto Leon Nader y su mujer, Natalie, acaban de 		instalarse en un bonito piso. Una mañana, Natalie empieza a empaquetar sus 		cosas y abandona rápidamente la vivienda, con la cara amoratada y los brazos 		heridos. Leon sale en su búsqueda desconcertado y pronto se da cuenta de que 		Natalie ha desaparecido. Leon, quien padecía sonambulismo cuando era 		pequeño, había llegado a recibir tratamiento psiquiátrico debido a su 		comportamiento agresivo mientras dormía. Ahora piensa que la desaparición de 		su esposa puede estar relacionada con su antigua enfermedad. ¿Será él el 		único culpable? ¿Pudo hacerle algo a Natalie mientras dormía?",
        	"id_autor": null
    	},
    	{
        	"id": 9,
        	"nombre": "El héroe perdido",
        	"nombre_del_autor": "asd",
        	"anio_publicacion": 2014,
        	"descripcion": "Cuando Jason despierta sabe que algo va muy mal. Está en un 		autobúscamino de un campamento para chicos problemáticos. Y le acompañan 		Piper-una muchacha (bastante guapa, por cierto) que dice que es su novia- 		yel que parece ser su mejor amigo, Leo...Pero él no recuerda nada: ni quién 		es ni cómo ha llegado allí.Pocas horas después, los tres descubrirán no solo 		que son hijos dedioses del Olimpo sino que su destino es cumplir una 		profecía de locos:liberar a Hera, diosa de la furia, de las garras de un 		enemigo que llevamucho tiempo planeando su venganza...«Con toda la acción, 		el ingenio y el corazón habituales en Riordan.»Publisher's Weekly",
        	"id_autor": null
   	 },
]
```

## Orden por campo

`/libros?field={campo}&order=ASC/DESC`

| Parámetro | Descripcion |
|-----------|-------------|
| field={campo}|Selección del campo a ordenar|
| order={ASC/DESC} | Ordenar de manera ascendente(ASC) o descendente(DESC)|
