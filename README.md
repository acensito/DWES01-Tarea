##
#  DWES - Tarea 2

## Enunciado:

La tarea consta de 4 partes:

- En la 1ª deberás responder a las preguntas que se propondrán dado un supuesto práctico.
- En la 2ª realizarás la instalación de las herramientas con las que vamos a trabajar a lo largo del curso y en la que se te pedirán unas capturas concretas para demostrar que has realizado dicha parte.
- En la 3ª realizarás una aplicación web con PHP
- En la 4ª documentaras todo el proceso y te auto-evaluarás, pero se recomienda ir realizando esto a la vez que se resuelven los apartados y no dejarlo para el final.

Todo será entregado en un  **único documento****. **Encontrarás la plantilla que has de rellenar en el apartado &quot;Recursos necesarios&quot; de esta tarea. No olvides cambiar el nombre del documento poniendo tus datos tal y como se indica en el apartado &quot;Indicaciones de entrega&quot;.

**PARTE I:****  SUPUESTO PRÁCTICO**

Se quiere programar una aplicación web para acceder a la banca electrónica del banco ético Diodos Bank. En principio, la aplicación se compondrá sólo de tres páginas:

- Una página de inicio, donde cuentan en qué consiste la banca ética y te solicitan el usuario y la contraseña de acceso, con un botón que lleva a tu página personal.
- Una página de bienvenida a la banca electrónica, donde aparecen tu nombre y apellidos, con un menú estándar para todos los usuarios.
- Una página de visualización de movimientos, en la que se muestra el listado actualizado de los últimos 5 movimientos de tu cuenta.

Preguntas:

1. ¿Qué tipo de páginas, estáticas o dinámicas, se necesitan para programar cada una de las páginas que componen la aplicación? ¿Por qué?
2. Si en la página de introducción de usuario/contraseña quieres comprobar, antes de enviar los datos, que la contraseña tiene una longitud concreta, ¿qué tecnología/lenguaje utilizarás? ¿Qué ventajas/inconvenientes tendría usar otras tecnologias/lenguajes?
3. Si se decide utilizar una arquitectura AMP, ¿qué lenguajes se podrían usar para programar las páginas dinámicas?
4. ¿Qué componentes necesitas instalar en tu servidor para ejecutar la aplicación si se quiere usar una arquitectura AMP?

**PARTE II:****  INSTALACIÓN** DE SW

Instala en el  **sistema operativo windows**  (si trabajas con linux puedes crear una máquina virtual windows 7 o windows 8 con VirtualBox) el **jdk8u60**  (o la última que haya en el momento de la instalación),  **Netbeans 8.0.2**  y el paquete  **Xampp 1.8.3**  para Windows o XAMPP Portable Lite 1.8.3 (si trabajas con Windows XP tendrás que usar la versión 1.8.2 que usa PHP 5.4.19 en lugar de 5.5.3 ya que la versión anterior no está soportada para XP ni para  2003, haciendo una captura de tu sistema operativo para justificar el uso de esta versión, para esta tarea no se debe instalar la versión 1.8.2 a no ser que esté debidamente justificado).

Después arranca Apache y MySQL y comprueba en el navegador que la instalación ha sido correcta con el acceso a localhost.

Haz capturas de las pantallas de la instalación que se indican a continuación de cada una de estas herramientas (apareciendo en ellas de fondo tu usuario de la plataforma de educación a distancia, las capturas no se considerarán válidas si no aparece este fondo, para ello abre el navegador con una página del curso en la que se visualice tu foto y nombre y sin minimizarlo haz las instalaciones ):

1. Una sola captura de la instalación del jdk8u60 en la que se visualice la versión que se está instalando.
2. Una sola captura de la instalación de Netbeans 8.0.2, la pantalla de bienvenida al instalador donde se muestra la versión de Netbeans que se va a instalar y los paquetes a instalar.
3. Una captura del panel de control de XAMPP con Apache y MySQL arrancado.
4. Una captura del navegador con acceso a  [http://localhost/xampp/index.php](http://localhost/xampp/index.php) donde se visualice correctamente la versión de Xampp instalada.



**NOTA 1** : En Netbeans puedes instalar sólo el paquete de PHP, pero si estás matriculado también en los módulos de  **Programación**  o **Entornos de Desarrollo**  es aconsejable que instales el paquete completo, ya que para estos módulos vas a necesitar también el entorno de desarrollo de Java.

**NOTA 2:** : El hecho de exigir en esta tarea el uso de Windows 7/8 y esta versión del paquete XAMPP (aunque sea en una máquina virtual) se debe a que es el software que vais a encontraros el día del examen práctico, por lo que se pretende que todos los alumnos/as se encuentren familiarizados con el entorno. Las versiones instaladas deben ser las indicadas en el enunciado de la tarea.

**NOTA 3** : [OPCIONAL] Si quieres usar Windows 10 o cualquier distro de GNU/Linux también es recomendable que te familiarices y aprendas de estos entornos, sobre todo GNU/Linux puesto que es el  [entorno más usado en servidores Web](https://w3techs.com/technologies/overview/operating_system/all) , y en particular  [Ubuntu el más usado dentro de los GNU/Linux](https://w3techs.com/technologies/details/os-linux/all/all) . De hecho será el entorno que yo use para corregir, pero desafortunadamente aún no podemos conseguir que el entorno del examen sea éste. Sin ánimo de crear polémica... en el foro del punto de encuentro del alumnado podéis aportar vuestras ideas/sugerencias para intentar conseguirlo en éste y otros módulos. Se me ocurre por ejemplo permitir que llevéis un pendrive con una distro Live con persistencia y todo vuestro entorno preparado, aunque podría darse el caso de BIOS bloqueadas, problemas con EFI, drivers gráficos, red desconfigurada, etc. que tendríais que asumir como riesgo.

NOTA 4: Para entender las distintas versiones de XAMPP puedes consultaren la [Wikipedia](https://en.wikipedia.org/wiki/XAMPP). La versión que usaremos será la última que usaba PHP 5.5 con MySQL antes de pasar a MariaDB en posteriores versiones.



**PARTE III:****  **APLICACIÓN WEB EN PHP

Crea una pequeña aplicación web (en php) que gestione operaciones sencillas de nuestro banco:  **Diodos Bank **. Lo primero que mostrará es un pequeño menú con las siguientes opciones:

- Últimos movimientos (últimos 5 movimientos).
- Ingresar dinero.
- Pagar recibos.
- Devolver recibos.

Para el  **ingreso**  de dinero y el  **pago**  de recibos, crea un formulario en el que se solicite la siguiente información:

- Fecha
- Concepto
- Cantidad

La fecha hace referencia al día en el que se realiza la operación (ingreso o pago), el Concepto es la descripción de la operación, y la Cantidad indicará el dinero empleado.

Toda la información referente a los movimientos (las operaciones de ingreso y pago) será almacenada en un  **array**. Todos los campos son obligatorios. Si la inserción ( **ingreso**  o  **pago** ) se efectúa correctamente se debe avisar al usuario y mostrar la lista de los últimos movimientos. En el caso de que la inserción no fuese satisfactoria se notificarán los errores y el formulario seguirá mostrando los campos que se habían intentado introducir para poder modificarlos.

A la hora de  **mostrar los últimos movimientos**  se debe mostrar bien en una tabla (haciendo uso del tag &lt;table&gt; de HTML) o si se prefiere usar CSS haciendo uso de la propiedad display (display: table) una fila por cada elemento de la lista de la compra. Por cada fila deben aparecer 4 columnas: Fecha, Concepto, Cantidad,  **Saldo contable**. Las tres primeras hacen referencia a la información almacenada y la cuarta es un campo calculado consistente en el saldo total después de cada operación. Al final del listado se debe mostrar el saldo contable actual con formato destacado. Si no hay nada que mostrar se debe avisar al usuario.

Para la  **devolución de recibos**  deberás listar los recibos con los 3 campos principales (Fecha, Concepto y Cantidad), en el caso de que hubiesen, sino, habría que notificarlo al usuario. La devolución consistirá en la eliminación del recibo, y por consiguiente en la desaparición del array de movimientos. En caso de que la eliminación se haya efectuado correctamente se debe avisar al usuario y mostrar la lista de recibos restantes, en el caso de que hubiesen.

Todo el código debe estar documentado correctamente (haciendo uso de los comentarios de php).



Deben utilizarse funciones, pueden crearse tantas como se precisen. Al menos existirán las funciones de:

- Calcular\_Saldo\_Contable: tendrá un parámetro de salida que devolverá la cantidad calculada (se hará paso por referencia).
- Validar\_Datos: Validar los campos de fecha, concepto y cantidad.

 Todas las funciones deben ser implementadas en un fichero independiente llamado  **funciones.php**



**PARTE IV:****  **Auto-evaluación

Por último, tienes que  **AUTO-EVALUARTE** , justificando si fuese necesario las notas de cada apartado.



**NOTAS IMPORTANTES:**

- La entrega de cada apartado de la tarea consiste en:
  - A la vez que realizas los apartados de la tarea, elaborar un documento de texto en formato  **.** ODT con una guía (muy resumida, no pierdas demasiado tiempo en esto) y capturas si son necesarias de cada apartado, sobre todo para mostrar que funciona, usando **títulos, un sumario con índices navegables (** [**pincha aquí**](http://aplicacionesysistemas.com/indice-con-libreoffice-writer-video-tutorial/#more-198) ** para ver una guía de cómo hacerlos o ** [**aquí**](https://help.libreoffice.org/Writer/Creating_a_Table_of_Contents/es)** para la última documentación oficial)**, copiando el enunciado de cada apartado e indicando las partes más importantes del código necesario para resolver la cuestión correspondiente.
    - El archivo .ODT debe ser editado desde LibreOffice u OpenOffice. En &quot;Archivo -&gt; Propiedades&quot; me debe dar una idea del tiempo que se ha tardado en su edición. Si falta el .ODT restará 1 punto.  **Desde el propio LibreOffice se debe exportar a PDF, lo que generará un PDF con índices navegables a la izquierda**.
  - **En cada apartado hay que apoyar la documentación **** y comprobar que funciona **** con alguna/s capturas de pantalla. Se recomienda alguna herramienta que agilice el proceso como ** [**Shutter**](http://shutter-project.org/)** (Linux) o ** [**GreenShot**](http://alternativeto.net/software/greenshot/)** (Windows). En alguna de ellas (todas las que se pueda), se debe ver la plataforma con vuestra foto del perfil (la foto que os aparece arriba a la derecha).**
  - El fichero . **ZIP**  a subir en la tarea debe contener una carpeta llamada  **Apellido1\_Apellido2\_Nombre\_DWES01\_Tarea**  que contenga:
    - El documento de texto . **ODT**  explicativo y el mismo documento exportado a . **PDF. Si falta el ** [**índice**](http://aplicacionesysistemas.com/indice-con-libreoffice-writer-video-tutorial/#more-198) ** de contenidos &quot;navegable&quot; en el pdf restará 1 punto.**
    - La hoja de cálculo de auto-evaluación .ODS
    - una carpeta con todos  **los ficheros necesarios y el proyecto de Netbeans completo. ** Si el programa no es fácilmente distribuible (con librerías incluidas en la carpeta dist y con rutas relativas) y multiplataforma (carpetas con &quot;/&quot;) restará 1 punto.
      - Añade librerías y haz un &quot;clean and build&quot; del proyecto.
      - Click derecho sobre el proyecto, propiedades, en las categorías de la izquierda selecciona &quot;libraries&quot; y a la derecha arriba localiza &quot;Libraries folder&quot; y pulsas sobre &quot;Browse&quot;. Ahora si podrás navegar a través de la carpeta dist/lib y elegir la ruta relativa a la derecha.
      - Una vez hecho esto NO hagas &quot;clean and build&quot; sino &quot;BUILD&quot; únicamente, ya que la primera opción reescribiría las carpetas y perderías el acceso a las librerías.

Si hay partes copiadas de otros años o de otros alumnos se darán por inválidas las tareas de ambos alumnos.

##

## Criterios de corrección:

**NOTA\_TOTAL\_TAREA 1 = 0,5\*NOTA\_PARTES1y2 + 0,5\*NOTA\_PARTE3**

| **Puntuación Máxima** | **Criterio** |
| --- | --- |
| Sin calificación | Tarea no entregada. |
| 0 | La tarea entregada no se corresponde con lo que se  pide.El fichero está corrupto o no se puede abrir.La tarea se ha entregado fuera de plazo.La tarea ha sido copiada.No se han usado arrays para desarrollar la tarea. |
| 4 | La tarea se realiza usando bases de datos, Sesiones, Cookies, AJAX, etc que se trabajarán en unidades posteriores.La tarea no se puede ejecutar. |
| 10 | La tarea entregada y que funcione correctamente (que no corresponda a ninguno de los apartados mencionados anteriormente) será corregida según la siguiente valoración: |

** **

**Puntuación total de las Partes I y II: 10 puntos.**

1. Tipos de páginas y argumentación correcta: 1,5 puntos.

2. Tecnología/lenguaje a usar para comprobar la longitud de la contraseña: 1,5 puntos.

3. Lenguajes a usar en la arquitectura AMP: 1 punto

4. Componentes a instalar en el servidor para usar la arquitectura AMP: 2 puntos.

5. Instalación de jdk8u60: 1 punto.

6. Instalación de Netbeans 8.0.2: 1 punto.

7. Instalación de Xampp 1.8.3: 1 punto.

8. Acceso al servidor local para la comprobación de la correcta instalación (seleccionando la página en español donde se visualiza la versión de XAMPP): 1 punto.

** **

**Parte III: Sobre 10 puntos**

|  1) Últimos movimientos | Últimos 10 movimientos. | 0,5 |
| --- | --- | --- |
| Formato al dinero (€ con 2 decimales) | 0,5 |
| Saldo contable | 1 |
| Saldo actual/total (destacado) | 0,5 |
| Cantidades en negativo en color rojo (totales y pago de recibos). | 0,2 |
| 2) Ingresar dinero. | Formulario de ingreso. | 0,1 |
| Validación de datos: FECHA | 0,1 |
| Validación de datos: CONCEPTO | 0,1 |
| Validación de datos: DESCRIPCIÓN | 0,1 |
| Botón &quot;Ingresar&quot; | 0,1 |
| 3) Pagar recibos. | Formulario de pago. | 0,1 |
| Validación de datos: FECHA | 0,1 |
| Validación de datos: CONCEPTO | 0,1 |
| Validación de datos: DESCRIPCIÓN | 0,1 |
| Botón &quot;Pagar&quot; | 0,1 |
| 4) Devolver recibos. | Listar sólo recibos | 1 |
| Eliminar recibos individualmente. | 1 |
| General | Ingresos y pagos en una misma lista. | 0,5 |
| Estética y organización de la página. | 0,4 |
| Estructuración del código (uso de funciones, inclusión de ficheros externos, documentación del código, variables intuitivas, optimización,…) | 2 |
| Cargar la lista actualizada después de cada ingreso y cada pago. | 0,4 |
| Impresión general de la aplicación. | 1 |

**IMPORTANTE** :

La tarea debe ser realizada y entregada como se indica en el apartado _Enunciado_.

Para las capturas, recuerda que debe aparecer siempre de fondo tu usuario de la plataforma de educación a distancia, las capturas no se considerarán válidas si no se visualizan bien (deben ser claras y legibles,  no se obtendrá la puntuación máxima de cada apartado si la imagen se ve borrosa o su tamaño no permite visualizar correctamente su contenido) o no aparece de fondo el usuario de la plataforma.

Además se aplicarán los criterios expuestos en el programa del módulo.

Se considerará entregada la tarea y se calificará con  **0 puntos**  en los casos siguientes:

- El/los fichero/s que se solicitan en la tarea están corruptos (no se pueden abrir o leer con el programa indicado).
- La entrega se encuentra incompleta o no corresponde a lo que se solicita en el enunciado de la tarea (faltan archivos, se entregan otros distintos, etc).
- La tarea ha sido copiada.

El alumno/a debe comprobar una vez subida la tarea que la entrega está correcta para que, en caso de incidencia o error, se notifique de manera inmediata al tutor/a del módulo. En caso contrario se aplicarán las medidas anteriores.

Si se detecta que que el/la alumno/a ha copiado en alguna de las tareas supondrá una calificación de 0 puntos en ésta. Si la copia se ha realizado de otro/a alumno/a supondrá una calificación de 0 puntos en dicha tarea para ambos alumnos/as.

##

## Recursos necesarios:

[Plantilla para realizar la tarea](http://www.juntadeandalucia.es/educacion/gestionafp/datos/tareas/DAW/DWES_14076/2016-17/DAW_DWES_1_2016-17_Individual__383198/Apellido1_Apellido2_Nombre_DWES1_Tarea_E1.odt)

[Plantilla para auto-evaluar la tarea](http://www.juntadeandalucia.es/educacion/gestionafp/datos/tareas/DAW/DWES_14076/2016-17/DAW_DWES_1_2016-17_Individual__383198/Apellido1_Apellido2_Nombre_DWES1_Auto-evaluacion_Tarea.ods)

**Para la Parte 2:**

[Enlace para la descarga del JDK8u60.](http://www.oracle.com/technetwork/java/javase/downloads/index-jsp-138363.html)

[Enlace para la descarga de Netbeans 8.0.2](https://netbeans.org/downloads/)

[Enlace para la descarga de Xampp para Windows](https://sourceforge.net/projects/xampp/files/)

**Para la parte 3:**

Al menos será necesario tener instalado y configurado XAMPP con Apache y MySQL arrancados, y un editor para php, por ejemplo NetBeans, Brackets o Notepad++

Enlaces de ayuda para la elaboración de la tarea:

[Manual de php. ](http://www.w3schools.com/tags/tag_table.asp)

[Uso de la etiqueta table en HTML](http://www.w3schools.com/tags/tag_table.asp) (inglés).  [Otro enlace](http://librosweb.es/xhtml/capitulo_7/tablas_basicas.html) (español).

[Uso de la etiqueta div en HTML ](http://www.w3schools.com/tags/tag_div.asp)(inglés).  [Otro enlace](http://librosweb.es/css/capitulo_12/estructura_o_layout.html) (español).

[Uso de la propiedad display de CSS](http://librosweb.es/css_avanzado/capitulo_4/propiedad_display.html) para simular tablas.

## Corrección: