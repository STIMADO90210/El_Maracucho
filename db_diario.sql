-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2016 a las 18:01:23
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_diario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_cat` mediumint(9) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `categoria`) VALUES
(1, 'sucesos '),
(2, 'opinion'),
(4, 'sociales'),
(5, 'farandula'),
(6, 'politica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id_come` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `comenta` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_noticia` int(11) NOT NULL,
  PRIMARY KEY (`id_come`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_come`, `nombre`, `comenta`, `fecha`, `hora`, `id_noticia`) VALUES
(1, 'RAFAEL BASTIDAS', 'En el paso 1, selecciona la versión de Ubuntu que\r\ndeseas descargar. Para procesadores de un solo\r\nnúcleo, selecciona la versión 10.04 LTS. Para\r\nprocesadores más modernos, puedes seleccionar la\r\núltima versión (versión que aparece seleccionada por\r\ndefecto en el desplegable de versiones). Si tienes\r\ndudas sobre si elegir la versión para 32 o 64 bits, elige\r\nla de 32-bits. Pulsa el botón “Start download” y\r\naguarda a que se descargue el archivo.', '2016-07-18', '00:00:00', 2),
(2, 'RAFAEL BASTIDAS', 'En el paso 1, selecciona la versión de Ubuntu que\r\ndeseas descargar. Para procesadores de un solo\r\nnúcleo, selecciona la versión 10.04 LTS. Para\r\nprocesadores más modernos, puedes seleccionar la\r\núltima versión (versión que aparece seleccionada por\r\ndefecto en el desplegable de versiones). Si tienes\r\ndudas sobre si elegir la versión para 32 o 64 bits, elige\r\nla de 32-bits. Pulsa el botón “Start download” y\r\naguarda a que se descargue el archivo.', '2016-07-18', '00:00:00', 2),
(3, 'pedro pirela', 'tenemos que llevar la cuenta del número de productos que se han introducido en el carrito. En el momento de creación del objeto carrito, el número de productos debe ser igual a cero. También necesitaremos guardar los id_producto de cada uno de los productos que se vayan introduciendo en el carrito. Lo haremos a través del array $array_id_prod, que es una de las propiedades del objeto.', '2016-07-18', '00:00:00', 2),
(4, 'laura bueno', 'tenemos que llevar la cuenta del número de productos que se han introducido en el carrito. En el momento de creación del objeto carrito, el número de productos debe ser igual a cero. También necesitaremos guardar los id_producto de cada uno de los productos que se vayan introduciendo en el carrito. Lo haremos a través del array $array_id_prod, que es una de las propiedades del objeto.', '2016-07-18', '00:00:00', 2),
(5, 'EMPRESAS POLAR', 'Problema:\r\nEl 15 de marzo de 2011, Natalia le comentó a su madre, que\r\ncomenzaría a ahorrar dinero para comprar un nuevo ordenador\r\ny que a tal fin, todos los días guardaría en una caja de zapatos,\r\n$2,75.', '2016-07-18', '00:00:00', 2),
(6, 'laura bueno', 'En el paso 1, selecciona la versión de Ubuntu que deseas descargar. Para procesadores de un solo núcleo, selecciona la versión 10.04 LTS. Para procesadores más modernos, puedes seleccionar la última versión (versión que aparece seleccionada por defecto en el desplegable de versiones). Si tienes dudas sobre si elegir la versión para 32 o 64 bits, elige la de 32-bits. Pulsa el botón “Start download” y aguarda a que se descargue el archivo.', '2016-07-18', '21:11:04', 2),
(7, 'jose manuel', 'Como bien comentamos antes, hubiese sido posible, crear un\r\nenlace simbólico en /var/www/ que apuntara a /home/tuusuario/\r\ncurso-php/.\r\nDe haber optado por esta alternativa, nos hubiésemos valido\r\ndel comando ln (ele ene) con la opción -s, destinado a crear\r\nenlaces simbólicos (o symlinks).\r\nComo la escritura en el directorio /var/www/ está restringida a\r\nusuarios con permiso de root (super usuarios), deberíamos\r\nhaber ejecutado dicho comando anteponiendo el comando\r\nsudo.\r\nLa sintaxis para crear enlaces simbólicos dentro de una\r\ncarpeta, es:', '2016-07-18', '23:16:55', 1),
(8, 'EMPRESAS POLAR', 'Como bien comentamos antes, hubiese sido posible, crear un\r\nenlace simbólico en /var/www/ que apuntara a /home/tuusuario/\r\ncurso-php/.\r\nDe haber optado por esta alternativa, nos hubiésemos valido\r\ndel comando ln (ele ene) con la opción -s, destinado a crear\r\nenlaces simbólicos (o symlinks).\r\nComo la escritura en el directorio /var/www/ está restringida a\r\nusuarios con permiso de root (super usuarios), deberíamos\r\nhaber ejecutado dicho comando anteponiendo el comando\r\nsudo.\r\nLa sintaxis para crear enlaces simbólicos dentro de una\r\ncarpeta, es:', '2016-07-18', '23:17:17', 1),
(9, 'rafael orozco', 'que pareja mas linda si estan cuchi esta foto esta espectacular', '2016-07-19', '11:10:21', 11),
(11, 'raul oropeza', 'que paso xq se repitio dos veces ese comentario', '2016-07-19', '11:11:07', 11),
(12, 'rafael orozco', 'no se que paso\r\n', '2016-07-19', '11:12:37', 11),
(13, 'tony', 'La mayoría de las veces, encontraremos bibliografía que al\r\nmomento de referirse a las tecnologías GLAMP, suprimen la “G”\r\ndel comienzo, cometiendo el grave error de llamarlas\r\nsimplemente LAMP. De la misma forma, en una gran cantidad\r\nde casos, la documentación se refiere al Sistema Operativo\r\nGNU/Linux, como “Linux”, suprimiendo las siglas “GNU”.\r\nPero ¿Qué tiene aquello de errado? La respuesta a esta\r\npregunta, está en la gran diferencia entre GNU/Linux y Linux.', '2016-07-19', '11:13:32', 10),
(14, 'pedro pirela', 'Para instalar Ubuntu como único Sistema Operativo, sigue los\r\nsiguientes pasos:\r\n1. ingresa en\r\nhttp://www.ubuntu.com/download/ubuntu/download\r\n2. En el paso 1, selecciona la versión de Ubuntu que\r\ndeseas descargar. Para procesadores de un solo\r\nnúcleo, selecciona la versión 10.04 LTS. Para\r\nprocesadores más modernos, puedes seleccionar la\r\núltima versión (versión que aparece seleccionada por\r\ndefecto en el desplegable de versiones). Si tienes\r\ndudas sobre si elegir la versión para 32 o 64 bits, elige\r\nla de 32-bits. Pulsa el botón “Start download” y\r\naguarda a que se descargue el archivo.\r\n3. Una vez descargado el archivo, podrás quemarlo en\r\nun CD/DVD o un Pendrive USB. En el paso 2 de la URL\r\nde descarga, selecciona CD o USB stick según tus\r\npreferencias y el Sistema Operativo desde el cual\r\nharás la copia (Windows o Mac). Pulsa el botón “show\r\nme how” y sigue las instrucciones de quemado.\r\n4. A continuación, salta al paso 4 del sitio de descarga (el\r\n3 es solo para probar Ubuntu sin instalarlo); pulsa el\r\nbotón “show me how” y sigue las instrucciones para\r\ninstalar Ubuntu en tu ordenador.', '2016-07-19', '11:14:36', 10),
(15, 'fsgasdgsag', 'Al escribir comandos, nombres de archivos y/o directorios en\r\nla terminal, pulsando la tecla de tabulación, se\r\nautocompletan.\r\nCuando al pulsar la tecla de tabulación, un pitido es\r\nemitido, puede significar una de dos cosas: a) que el\r\ncomando, nombre de archivo o directorio no se ha\r\nlocalizado; b) la más frecuente, que existen varias opciones\r\nposibles para autocompletar.\r\nPor eso, cuando un pitido sea emitido, pulsa la tecla\r\nde tabulación dos veces consecutivas. Si existen\r\nvarias opciones, te las mostrará en pantalla.', '2016-07-19', '11:32:56', 2),
(16, 'laura bueno', 'este periodico es muy chimbo nadie va a leer esta porqueria', '2016-07-19', '16:56:22', 8),
(17, 'villalobos', 'esto esta muy feo', '2016-07-20', '09:19:30', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `id_not` mediumint(9) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `detalle` text NOT NULL,
  `imagen` varchar(150) NOT NULL,
  `fecha_cadena` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL,
  `descarga` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_not`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_not`, `titulo`, `detalle`, `imagen`, `fecha_cadena`, `fecha`, `descarga`, `id_categoria`) VALUES
(1, 'Carrito de la compra en PHP', 'Vamos a ver una manera sencilla de realizar un carrito de la compra en PHP, utilizando una\r\nvariable de sesión para guardar los datos del carrito, como los nombres de los productos, sus\r\nprecios y otros datos de interés. En estos ejemplos nos vamos a centrar exclusivamente en la\r\nfuncionalidad del carrito, es decir, la memorización de los productos comprados a lo largo de\r\ntoda la sesión, dejando de lado todo lo relativo a presentación o la extracción de los productos\r\nde una base de datos.', 'Familia-Famintegral12.JPG', 'martes 12 de julio del 2016', '2016-07-13 19:31:39', 'javescript:alert(''En Proceso de Descarga'')', 1),
(2, 'Estudio de las necesidades del carrito', 'Ahora nos vamos a fijar en la clase carrito. Para empezar vamos a hacer un estudio de las\r\nfuncionalidades y datos que debería contener.\r\nMétodos del objeto carrito\r\nLas funcionalidades que debería implementar el objeto carrito se definirán como métodos de la\r\nclase carro de la compra. En principio, se deben crear los siguientes métodos:\r\n• Introducir un producto en el carrito\r\n• Eliminar un producto del carrito\r\n• Mostrar el carrito\r\n• Otras funcionalidades que seguro que necesitarás a medida que avances en el trabajo...\r\nDatos a utilizar\r\nPara empezar, tenemos que llevar la cuenta del número de productos que se han introducido\r\nen el carrito. En el momento de creación del objeto carrito, el número de productos debe ser\r\nigual a cero.\r\nTambién necesitaremos guardar los id_producto de cada uno de los productos que se vayan\r\nintroduciendo en el carrito. Lo haremos a través del array $array_id_prod, que es una de las\r\npropiedades del objeto.', 'Familia Ruiz 07.JPG', 'Sabado 15 de julio 2016', '2016-07-13 19:32:06', 'javascript:alert(''en proceso'')', 1),
(8, 'Configurando el directorio de tu Web Local', ' Si todo lo anterior, te dejó la frase “no quería saber tanto”,\r\nrondando en tu cabeza, sabrás disculparme, pero debo\r\ncontarte también sobre goto (aunque entre nos, a veces puede\r\nser útil).                                                                                   ', '14353829-Soldador-Ilustraci-n-Listas-para-vinilo-Foto-de-archivo.jpg', '42343434', '2016-07-14 03:31:25', 'fhgshst34t35t45t5g', 2),
(10, 'Funciones definidas por el usuario', '                Definición\r\nUna función, es una forma de agrupar expresiones y sentencias\r\n(algoritmos) que realicen determinadas acciones, pero que\r\néstas, solo se ejecuten cuando son llamadas (al igual que las\r\nfunciones nativas de PHP).', 'herreria_Taladro Magnetico Dewalt.jpg', '28/54/54', '2016-07-14 14:13:31', 'fgdsfgdsfgsdgfsdfg', 4),
(11, 'Carrito de la compra en PHP', '            Vamos a ver una manera sencilla de realizar un carrito de la compra en PHP, utilizando una\r\nvariable de sesión para guardar los datos del carrito, como los nombres de los productos, sus\r\nprecios y otros datos de interés. En estos ejemplos nos vamos a centrar exclusivamente en la\r\nfuncionalidad del carrito, es decir, la memorización de los productos comprados a lo largo de\r\ntoda la sesión, dejando de lado todo lo relativo a presentación o la extracción de los productos\r\nde una base de datos.\r\nPara entender este manual son necesarios unos conocimientos previos sobre PHP, que se\r\npueden obtener de la lectura de nuestro manual de PHP http://www.desarrolloweb.com/php/ o\r\nlos talleres prácticos de la tecnología http://www.desarrolloweb.com/manuales/6/. Debemos\r\nprestar especial atención al manejo de sesiones en PHP y, dado que esta implementación del\r\ncarrito está realizada utilizando programación orientada a objetos, será necesario que\r\nconozcamos un poco ese tipo de programación, particularmente en PHP 4.\r\nEl carrito lo hemos creado con la versión PHP 4. Para que este ejemplo funcione en PHP 5 (que\r\nbásicamente cambia con respecto a su antecesor en el trabajo con objetos) habría que realizar\r\nalgunas modificaciones.    ', 'IMG_20150823_180104.jpg', '434242524', '2016-07-17 20:34:05', '32252sfsfsfs', 6),
(12, 'Trabajando con MySQL desde PHP', '              seguridad- en nuestros archivos PHP, solo nos conectaremos a una base de datos, para realizar consultas de selección, modificación, inserción y  eliminación de registros en tablas y bases de datos existentes. No crearemos tablas ni bases de datos desde nuestros archivos PHP, sino que lo haremos desde el administrador de MySQL por línea de comandos.\r\n            A fin de poder trabajar con los ejemplos de este capítulo, comenzaremos creando una nueva base de datos, con la tabla que necesitaremos.\r\nEjecuta las siguientes sentencias, desde el Shell interactivo de MySQL: ', 'IMG_20150620_182551.jpg', '12121334', '2016-07-18 14:20:30', 'effadf<sdfas', 4),
(13, 'Usos e importancia', '                Como bien hemos dicho antes, tanto cookies como sesiones se\r\nutilizan para personalizar la experiencia del usuario. De esta\r\nforma, podremos saber que todos los sistemas Web que\r\nrestringen su acceso mediante contraseñas, pueden hacerlo\r\ngracias al uso de cookies y sesiones. Por ello, es tan importante\r\ntener dominio tanto de unas como de otras.', 'piquenaudy.jpg', '54454545', '2016-07-18 14:23:17', 'gfgsdgfsdgfs', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nivel` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `email`, `pass`, `nivel`) VALUES
(1, 'rafael orozco', 'equintero171@gmail.com', 'eureka3000', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
